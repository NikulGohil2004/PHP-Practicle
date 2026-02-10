<?php
// Set JSON content type header
header('Content-Type: application/json');

// Enable error reporting for debugging (remove in production)
error_reporting(E_ALL);
ini_set('display_errors', 0);
ini_set('log_errors', 1);

require 'dbcon.php';

// ============================================
// DELETE STUDENT
// ============================================
if (isset($_POST['delete_student'])) {
    $student_id = mysqli_real_escape_string($con, $_POST['student_id']);
    
    // First, get the image filename to delete it from the server
    $query = "SELECT filenam FROM students WHERE id='$student_id'";
    $query_run = mysqli_query($con, $query);
    
    if (mysqli_num_rows($query_run) > 0) {
        $student = mysqli_fetch_array($query_run);
        $image_filename = $student['filenam'];
        
        // Delete the record from database
        $delete_query = "DELETE FROM students WHERE id='$student_id'";
        $delete_query_run = mysqli_query($con, $delete_query);
        
        if ($delete_query_run) {
            // Delete the image file from upload folder
            if (!empty($image_filename) && file_exists("upload/" . $image_filename)) {
                unlink("upload/" . $image_filename);
            }
            
            $res = [
                'status' => 200,
                'message' => 'Student deleted successfully'
            ];
            echo json_encode($res);
            exit;
        } else {
            $res = [
                'status' => 500,
                'message' => 'Student could not be deleted: ' . mysqli_error($con)
            ];
            echo json_encode($res);
            exit;
        }
    } else {
        $res = [
            'status' => 404,
            'message' => 'Student not found'
        ];
        echo json_encode($res);
        exit;
    }
}

// ============================================
// UPDATE STUDENT
// ============================================
if (isset($_POST['update_student'])) {
    $student_id = mysqli_real_escape_string($con, $_POST['student_id']);
    
    // Check if student exists
    $check_query = "SELECT * FROM students WHERE id='$student_id'";
    $check_result = mysqli_query($con, $check_query);
    
    if (mysqli_num_rows($check_result) == 0) {
        $res = [
            'status' => 404,
            'message' => 'Student not found'
        ];
        echo json_encode($res);
        exit;
    }
    
    $existing_student = mysqli_fetch_array($check_result);
    
    // Escape and sanitize input data
    $firstName   = mysqli_real_escape_string($con, trim($_POST['firstName'] ?? ''));
    $lastName    = mysqli_real_escape_string($con, trim($_POST['lastName'] ?? ''));
    $email       = mysqli_real_escape_string($con, trim($_POST['email'] ?? ''));
    $password    = mysqli_real_escape_string($con, $_POST['password'] ?? '');
    $addres      = mysqli_real_escape_string($con, trim($_POST['addres'] ?? ''));
    $phoneNumber = mysqli_real_escape_string($con, trim($_POST['phoneNumber'] ?? ''));
    $gender      = mysqli_real_escape_string($con, $_POST['gender'] ?? '');
    $country     = mysqli_real_escape_string($con, $_POST['country'] ?? '');
    $hobbyArr    = $_POST['hobby'] ?? [];
    
    // Convert hobby array to string
    $hobby = is_array($hobbyArr) ? implode(', ', $hobbyArr) : '';
    
    // Validate required fields
    if (empty($firstName) || empty($lastName) || empty($email) || empty($password) || 
        empty($addres) || empty($phoneNumber) || empty($gender) || empty($country)) {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        exit;
    }
    
    // Handle file upload (optional for update)
    $filename = $existing_student['filenam']; // Keep old image by default
    
    if (isset($_FILES['uploadfile']) && $_FILES['uploadfile']['error'] == 0) {
        $file = $_FILES['uploadfile'];
        $new_filename = mysqli_real_escape_string($con, basename($file['name']));
        
        $uploadDir = __DIR__ . '/upload/';
        
        if (!is_dir($uploadDir)) {
            if (!mkdir($uploadDir, 0777, true)) {
                $res = [
                    'status' => 500,
                    'message' => 'Failed to create upload directory'
                ];
                echo json_encode($res);
                exit;
            }
        }
        
        $targetPath = $uploadDir . $new_filename;
        
        if (move_uploaded_file($file['tmp_name'], $targetPath)) {
            // Delete old image if it exists and is different from new one
            if (!empty($filename) && $filename != $new_filename && file_exists($uploadDir . $filename)) {
                unlink($uploadDir . $filename);
            }
            $filename = $new_filename;
        } else {
            $res = [
                'status' => 422,
                'message' => 'File upload failed'
            ];
            echo json_encode($res);
            exit;
        }
    }
    
    // Update query
    $update_query = "UPDATE students SET 
        firstName='$firstName',
        lastName='$lastName',
        email='$email',
        password='$password',
        addres='$addres',
        phoneNumber='$phoneNumber',
        gender='$gender',
        country='$country',
        hobby='$hobby',
        filenam='$filename'
        WHERE id='$student_id'";
    
    $update_result = mysqli_query($con, $update_query);
    
    if ($update_result) {
        $res = [
            'status' => 200,
            'message' => 'Student updated successfully',
            'data' => [
                'id' => $student_id,
                'firstName' => $firstName,
                'lastName' => $lastName,
                'email' => $email,
                'password' => $password,
                'addres' => $addres,
                'phoneNumber' => $phoneNumber,
                'gender' => $gender,
                'country' => $country,
                'hobby' => $hobby,
                'filenam' => $filename
            ]
        ];
        echo json_encode($res);
        exit;
    } else {
        $res = [
            'status' => 500,
            'message' => 'Student could not be updated: ' . mysqli_error($con)
        ];
        echo json_encode($res);
        exit;
    }
}

// ============================================
// SAVE STUDENT
// ============================================
ob_start();

try {
    if(isset($_POST['save_student']))
    {
        // Check database connection
        if(!isset($con) || !$con) {
            $errorMsg = isset($db_error) ? $db_error : 'Database connection failed';
            throw new Exception($errorMsg);
        }
        
        // Escape and sanitize input data
        $firstName   = mysqli_real_escape_string($con, trim($_POST['firstName'] ?? ''));
        $lastName    = mysqli_real_escape_string($con, trim($_POST['lastName'] ?? ''));
        $email       = mysqli_real_escape_string($con, trim($_POST['email'] ?? ''));
        $password    = mysqli_real_escape_string($con, $_POST['password'] ?? '');
        $addres      = mysqli_real_escape_string($con, trim($_POST['addres'] ?? ''));
        $phoneNumber = mysqli_real_escape_string($con, trim($_POST['phoneNumber'] ?? ''));
        $gender      = mysqli_real_escape_string($con, $_POST['gender'] ?? '');
        $country     = mysqli_real_escape_string($con, $_POST['country'] ?? '');
        $hobbyArr    = $_POST['hobby'] ?? [];
        
        // Convert hobby array to string
        $hobby = is_array($hobbyArr) ? implode(', ', $hobbyArr) : '';
        
        // Handle file upload
        $filename = '';
        if(isset($_FILES['uploadfile']) && $_FILES['uploadfile']['error'] == 0) {
            $file = $_FILES['uploadfile'];
            $filename = mysqli_real_escape_string($con, basename($file['name']));
            
            // Use absolute path or path relative to script location
            $uploadDir = __DIR__ . '/upload/';
            
            // Create upload directory if it doesn't exist
            if(!is_dir($uploadDir)) {
                if(!mkdir($uploadDir, 0777, true)) {
                    throw new Exception('Failed to create upload directory');
                }
            }
            
            $targetPath = $uploadDir . $filename;
            
            // Move uploaded file
            if(!move_uploaded_file($file['tmp_name'], $targetPath)) {
                $errorMsg = 'File upload failed';
                $lastError = error_get_last();
                if($lastError) {
                    $errorMsg .= ': ' . $lastError['message'];
                }
                $res = [
                    'status' => 422,
                    'message' => $errorMsg
                ];
                ob_clean();
                echo json_encode($res);
                exit;
            }
        } else {
            $uploadError = isset($_FILES['uploadfile']) ? 'Error code: ' . $_FILES['uploadfile']['error'] : 'No file uploaded';
            $res = [
                'status' => 422,
                'message' => 'Please upload a profile image. ' . $uploadError
            ];
            ob_clean();
            echo json_encode($res);
            exit;
        }

        $sql = "INSERT INTO students
            (firstName, lastName, email, password, addres, phoneNumber, gender, country, hobby, filenam)
            VALUES
            ('$firstName','$lastName','$email','$password','$addres','$phoneNumber','$gender','$country','$hobby','$filename')";

        $query_run = mysqli_query($con, $sql);

        if($query_run)
        {
            // Get the inserted student ID
            $student_id = mysqli_insert_id($con);
            
            // Return the new student data
            $res = [
                'status' => 200,
                'message' => 'Student Created Successfully',
                'data' => [
                    'id' => $student_id,
                    'firstName' => $firstName,
                    'lastName' => $lastName,
                    'email' => $email,
                    'password' => $password,
                    'addres' => $addres,
                    'phoneNumber' => $phoneNumber,
                    'gender' => $gender,
                    'country' => $country,
                    'hobby' => $hobby,
                    'filenam' => $filename
                ]
            ];
            ob_clean();
            echo json_encode($res);
            exit;
        }
        else
        {
            $res = [
                'status' => 500,
                'message' => 'Student Not Created: ' . mysqli_error($con)
            ];
            ob_clean();
            echo json_encode($res);
            exit;
        }
    }
} catch (Exception $e) {
    ob_clean();
    $res = [
        'status' => 500,
        'message' => 'Error: ' . $e->getMessage()
    ];
    echo json_encode($res);
    exit;
} catch (Error $e) {
    ob_clean();
    $res = [
        'status' => 500,
        'message' => 'Fatal Error: ' . $e->getMessage()
    ];
    echo json_encode($res);
    exit;
}

// ============================================
// GET STUDENT BY ID
// ============================================
if(isset($_GET['student_id']))
{
    $student_id = mysqli_real_escape_string($con, $_GET['student_id']);

    $query = "SELECT * FROM students WHERE id='$student_id'";
    $query_run = mysqli_query($con, $query);

    if(mysqli_num_rows($query_run) == 1)
    {
        $student = mysqli_fetch_array($query_run);

        $res = [
            'status' => 200,
            'message' => 'Student Fetch Successfully by id',
            'data' => $student
        ];
        echo json_encode($res);
        exit;
    }
    else
    {
        $res = [
            'status' => 404,
            'message' => 'Student Id Not Found'
        ];
        echo json_encode($res);
        exit;
    }
}
?>