<?php include(__DIR__ . '/../ADMIN/header.php'); ?>
<?php include(__DIR__ . '/../ADMIN/sidebar.php'); ?>


<!-- ADD STUDENT MODAL -->
<div class="modal fade" id="studentAddModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Student</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form id="saveStudent" method="post" enctype="multipart/form-data" novalidate>
                <div class="modal-body">

                    <div id="errorMessage" class="alert alert-warning d-none"></div>

                    <div class="mb-2">
                        <label>First Name <span class="text-danger">*</span></label>
                        <input type="text" name="firstName" class="form-control" required>
                        
                    </div>

                    <div class="mb-2">
                        <label>Last Name <span class="text-danger">*</span></label>
                        <input type="text" name="lastName" class="form-control" required>
                    </div>

                    <div class="mb-2">
                        <label>Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" class="form-control" required pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}" title="Please enter a valid email address">
                    </div>

                    <div class="mb-2">
                        <label>Password <span class="text-danger">*</span></label>
                        <input type="password" name="password" class="form-control" required minlength="6" title="Password must be at least 6 characters">
                    </div>

                    <div class="mb-2">
                        <label>Address <span class="text-danger">*</span></label>
                        <input type="text" name="addres" class="form-control" required>
                    </div>

                    <div class="mb-2">
                        <label>Phone Number <span class="text-danger">*</span></label>
                        <input type="number" name="phoneNumber" class="form-control" required>
                    </div>

                    <div class="mb-2">
                        <label>Gender <span class="text-danger">*</span></label><br>
                        <input type="radio" name="gender" value="male" checked required> Male
                        <input type="radio" name="gender" value="female" required> Female
                    </div>

                    <div class="mb-2">
                        <label>Hobby</label><br>
                        <input type="checkbox" name="hobby[]" value="Carrom"> Carrom
                        <input type="checkbox" name="hobby[]" value="Chess"> Chess
                    </div>

                    <div class="mb-2">
                        <label>Country <span class="text-danger">*</span></label>
                        <select name="country" class="form-select" required>
                            <option value="">Select</option>
                            <option value="India">India</option>
                            <option value="USA">USA</option>
                        </select>
                    </div>

                    <div class="mb-2">
                        <label>Profile Image <span class="text-danger">*</span></label>
                        <input type="file" name="uploadfile" class="form-control" required>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Student</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- EDIT STUDENT MODAL -->
<div class="modal fade" id="studentEditModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Student</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form id="updateStudent" method="post" enctype="multipart/form-data" novalidate>
                <div class="modal-body">

                    <div id="errorMessageUpdate" class="alert alert-warning d-none"></div>

                    <input type="hidden" name="student_id" id="student_id">

                    <div class="mb-2">
                        <label>First Name <span class="text-danger">*</span></label>
                        <input type="text" name="firstName" id="edit_firstName" class="form-control" required>
                    </div>

                    <div class="mb-2">
                        <label>Last Name <span class="text-danger">*</span></label>
                        <input type="text" name="lastName" id="edit_lastName" class="form-control" required>
                    </div>

                    <div class="mb-2">
                        <label>Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" id="edit_email" class="form-control" required pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}" title="Please enter a valid email address">
                    </div>

                    <div class="mb-2">
                        <label>Password <span class="text-danger">*</span></label>
                        <input type="password" name="password" id="edit_password" class="form-control" required minlength="6" title="Password must be at least 6 characters">
                    </div>

                    <div class="mb-2">
                        <label>Address <span class="text-danger">*</span></label>
                        <input type="text" name="addres" id="edit_addres" class="form-control" required>
                    </div>

                    <div class="mb-2">
                        <label>Phone Number <span class="text-danger">*</span></label>
                        <input type="number" name="phoneNumber" id="edit_phoneNumber" class="form-control" required>
                    </div>

                    <div class="mb-2">
                        <label>Gender <span class="text-danger">*</span></label><br>
                        <input type="radio" name="gender" id="edit_gender_male" value="male" required> Male
                        <input type="radio" name="gender" id="edit_gender_female" value="female" required> Female
                    </div>

                    <div class="mb-2">
                        <label>Hobby</label><br>
                        <input type="checkbox" name="hobby[]" id="edit_hobby_carrom" value="Carrom"> Carrom
                        <input type="checkbox" name="hobby[]" id="edit_hobby_chess" value="Chess"> Chess
                    </div>

                    <div class="mb-2">
                        <label>Country <span class="text-danger">*</span></label>
                        <select name="country" id="edit_country" class="form-select" required>
                            <option value="">Select</option>
                            <option value="India">India</option>
                            <option value="USA">USA</option>
                        </select>
                    </div>

                    <div class="mb-2">
                        <label>Profile Image</label>
                        <input type="file" name="uploadfile" id="edit_uploadfile" class="form-control">
                        <small class="text-muted">Leave empty to keep current image</small>
                        <input type="hidden" name="old_image" id="old_image">
                        <div id="current_image_preview" class="mt-2"></div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update Student</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- TABLE - FIXED TO BE INSIDE CARD -->
<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h4 class="mb-0">Student Management</h4>
            <button class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#studentAddModal" style="margin-top: -32px;">
                Add Student
            </button>
        </div>

        <div class="card-body" style="max-height: 600px; overflow-y: auto;">
            <table id="myTable" class="table table-bordered table-striped">
                <thead style="position: sticky; top: 0; background-color: #fff; z-index: 10;">
                    <tr>
                        <th>ID</th>
                        <th>First</th>
                        <th>Last</th>
                        <th>Email</th>
                        <th>Password</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th>Gender</th>
                        <th>Country</th>
                        <th>Hobby</th>
                        <th>Image</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require 'dbcon.php';
                    $query = mysqli_query($con, "SELECT * FROM students");
                    $student_count = mysqli_num_rows($query);
                    
                    if ($student_count > 0) {
                        while ($student = mysqli_fetch_assoc($query)) {
                    ?>
                        <tr data-id="<?= $student['id'] ?>">
                            <td><?= $student['id'] ?></td>
                            <td class="firstName"><?= $student['firstName'] ?></td>
                            <td class="lastName"><?= $student['lastName'] ?></td>
                            <td class="email"><?= $student['email'] ?></td>
                            <td class="password"><?= $student['password'] ?></td>
                            <td class="addres"><?= $student['addres'] ?></td>
                            <td class="phoneNumber"><?= $student['phoneNumber'] ?></td>
                            <td class="gender"><?= $student['gender'] ?></td>
                            <td class="country"><?= $student['country'] ?></td>
                            <td class="hobby"><?= $student['hobby'] ?></td>
                            <td class="image">
                                <img src="upload/<?= $student['filenam'] ?>" width="80" class="student-image" data-filename="<?= $student['filenam'] ?>">
                            </td>
                            <td>
                                <button class="btn btn-warning btn-sm editStudentBtn" value="<?= $student['id'] ?>">Edit</button>
                            </td>
                            <td>
                                <button class="btn btn-danger btn-sm deleteStudentBtn" value="<?= $student['id'] ?>">Delete</button>
                            </td>
                        </tr>
                    <?php 
                        }
                    } else {
                    ?>
                        <tr id="noDataRow">
                            <td colspan="13" class="text-center text-muted py-4">
                                <i class="fas fa-inbox fa-3x mb-3"></i>
                                <h5>No Data Found</h5>
                                <p>Click "Add Student" button to add your first student.</p>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

<script>
// Function to add new student row directly to table
function addStudentRowToTable(student) {
    // Remove "No data found" row if it exists
    $('#noDataRow').remove();
    
    var newRow = '<tr data-id="' + student.id + '">' +
        '<td>' + student.id + '</td>' +
        '<td class="firstName">' + escapeHtml(student.firstName) + '</td>' +
        '<td class="lastName">' + escapeHtml(student.lastName) + '</td>' +
        '<td class="email">' + escapeHtml(student.email) + '</td>' +
        '<td class="password">' + escapeHtml(student.password) + '</td>' +
        '<td class="addres">' + escapeHtml(student.addres) + '</td>' +
        '<td class="phoneNumber">' + escapeHtml(student.phoneNumber) + '</td>' +
        '<td class="gender">' + escapeHtml(student.gender) + '</td>' +
        '<td class="country">' + escapeHtml(student.country) + '</td>' +
        '<td class="hobby">' + escapeHtml(student.hobby || '') + '</td>' +
        '<td class="image"><img src="upload/' + escapeHtml(student.filenam) + '" width="80" class="student-image" data-filename="' + escapeHtml(student.filenam) + '"></td>' +
        '<td><button class="btn btn-warning btn-sm editStudentBtn" value="' + student.id + '">Edit</button></td>' +
        '<td><button class="btn btn-danger btn-sm deleteStudentBtn" value="' + student.id + '">Delete</button></td>' +
        '</tr>';
    
    $('#myTable tbody').prepend(newRow);
    $('.card-body').animate({ scrollTop: 0 }, 300);
}

// Function to update student row in table
function updateStudentRowInTable(student) {
    var row = $('tr[data-id="' + student.id + '"]');
    
    row.find('.firstName').text(student.firstName);
    row.find('.lastName').text(student.lastName);
    row.find('.email').text(student.email);
    row.find('.password').text(student.password);
    row.find('.addres').text(student.addres);
    row.find('.phoneNumber').text(student.phoneNumber);
    row.find('.gender').text(student.gender);
    row.find('.country').text(student.country);
    row.find('.hobby').text(student.hobby || '');
    
    // Update image if new one was uploaded
    if (student.filenam) {
        row.find('.student-image').attr('src', 'upload/' + student.filenam + '?t=' + new Date().getTime());
        row.find('.student-image').attr('data-filename', student.filenam);
    }
    
    // Highlight the updated row
    row.css('background-color', '#d4edda');
    setTimeout(function() {
        row.css('background-color', '');
    }, 2000);
}

// Helper function to escape HTML to prevent XSS
function escapeHtml(text) {
    if (text == null || text === undefined) {
        return '';
    }
    var map = {
        '&': '&amp;',
        '<': '&lt;',
        '>': '&gt;',
        '"': '&quot;',
        "'": '&#039;'
    };
    return String(text).replace(/[&<>"']/g, function(m) { return map[m]; });
}

// Function to clear all validation states
function clearValidation(formId) {
    $(formId + ' input').removeClass('is-invalid is-valid');
    $(formId + ' select').removeClass('is-invalid is-valid');
    $(formId + ' input').each(function() {
        this.setCustomValidity('');
    });
    $(formId + ' select').each(function() {
        this.setCustomValidity('');
    });
}

// Track touched fields
var touchedFields = {};

// Validate field on blur (after user touches and leaves)
function validateField(field) {
    var fieldName = field.name || field.getAttribute('name');
    touchedFields[fieldName] = true;
    
    if (field.type === 'file') {
        var hasFile = field.files && field.files.length > 0;
        if (!hasFile && field.hasAttribute('required')) {
            field.classList.add('is-invalid');
            field.classList.remove('is-valid');
        } else if (hasFile) {
            field.classList.remove('is-invalid');
            field.classList.add('is-valid');
        }
    } else {
        if (!field.checkValidity()) {
            field.classList.add('is-invalid');
            field.classList.remove('is-valid');
        } else {
            field.classList.remove('is-invalid');
            field.classList.add('is-valid');
        }
    }
}

// Add blur event to all form fields
$(document).on('blur', '#saveStudent input[required]:not([type="file"]):not([type="radio"]):not([type="checkbox"]), #saveStudent select[required], #updateStudent input[required]:not([type="file"]):not([type="radio"]):not([type="checkbox"]), #updateStudent select[required]', function() {
    validateField(this);
});

// File input validation on change
$(document).on('change', '#saveStudent input[type="file"][required], #updateStudent input[type="file"]', function() {
    validateField(this);
});

// Reset form validation when Add Student modal is closed
$('#studentAddModal').on('hidden.bs.modal', function () {
    // Remove modal backdrop and body classes
    $('.modal-backdrop').remove();
    $('body').removeClass('modal-open');
    $('body').css({'overflow': '', 'padding-right': ''});
    
    // Reset form
    $('#saveStudent')[0].reset();
    
    // Clear all validation states
    clearValidation('#saveStudent');
    
    // Hide error message
    $('#errorMessage').addClass('d-none').text('');
    
    // Reset touched fields
    touchedFields = {};
    
    // Reset default radio button
    $('#saveStudent input[name="gender"][value="male"]').prop('checked', true);
});

// Reset form validation when Edit Student modal is closed
$('#studentEditModal').on('hidden.bs.modal', function () {
    // Remove modal backdrop and body classes
    $('.modal-backdrop').remove();
    $('body').removeClass('modal-open');
    $('body').css({'overflow': '', 'padding-right': ''});
    
    // Reset form
    $('#updateStudent')[0].reset();
    
    // Clear all validation states
    clearValidation('#updateStudent');
    
    // Hide error message
    $('#errorMessageUpdate').addClass('d-none').text('');
    
    // Reset touched fields
    touchedFields = {};
    
    // Clear image preview
    $('#current_image_preview').html('');
});

// SAVE STUDENT
$(document).on('submit', '#saveStudent', function(e) {
    e.preventDefault();

    var form = this;
    var isValid = true;
    
    // Validate all required fields
    $(form).find('input[required], select[required]').each(function() {
        if (this.type === 'file') {
            var hasFile = this.files && this.files.length > 0;
            if (!hasFile) {
                isValid = false;
                touchedFields[this.name] = true;
                $(this).addClass('is-invalid');
                $(this).removeClass('is-valid');
            } else {
                $(this).removeClass('is-invalid');
                $(this).addClass('is-valid');
            }
        } else if (this.type === 'radio') {
            var radioName = this.name;
            var isChecked = $(form).find('input[name="' + radioName + '"]:checked').length > 0;
            if (!isChecked) {
                isValid = false;
            }
        } else {
            if (!this.checkValidity()) {
                isValid = false;
                touchedFields[this.name] = true;
                $(this).addClass('is-invalid');
                $(this).removeClass('is-valid');
            } else {
                $(this).removeClass('is-invalid');
                $(this).addClass('is-valid');
            }
        }
    });
    
    if (!isValid) {
        $('#errorMessage').removeClass('d-none').text('Please fill in all required fields correctly.');
        return false;
    }

    // Hide error message if validation passed
    $('#errorMessage').addClass('d-none').text('');

    let formData = new FormData(this);
    formData.append("save_student", "1");

    $.ajax({
        type: "POST",
        url: "code.php",
        data: formData,
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function(response) {
            let res = response;

            if (res.status == 422) {
                $('#errorMessage').removeClass('d-none').text(res.message);
            } 
            else if (res.status == 200) {
                $('#errorMessage').addClass('d-none');
                alertify.success(res.message);
                $('#studentAddModal').modal('hide');
                
                if (res.data) {
                    addStudentRowToTable(res.data);
                }
            } 
            else {
                alert(res.message);
            }
        },
        error: function(xhr, status, error) {
            console.error('AJAX Error:', status, error);
            console.error('Response:', xhr.responseText);
            
            let errorMsg = 'An error occurred. Please try again.';
            try {
                let errorResponse = JSON.parse(xhr.responseText);
                if (errorResponse.message) {
                    errorMsg = errorResponse.message;
                }
            } catch(e) {
                errorMsg = xhr.responseText || errorMsg;
            }
            
            $('#errorMessage').removeClass('d-none').text(errorMsg);
        }
    });
});

// EDIT STUDENT - LOAD DATA
$(document).on('click', '.editStudentBtn', function(e) {
    e.preventDefault();
    
    var student_id = $(this).val();
    var row = $(this).closest('tr');
    
    // Get data from the row
    var firstName = row.find('.firstName').text();
    var lastName = row.find('.lastName').text();
    var email = row.find('.email').text();
    var password = row.find('.password').text();
    var addres = row.find('.addres').text();
    var phoneNumber = row.find('.phoneNumber').text();
    var gender = row.find('.gender').text();
    var country = row.find('.country').text();
    var hobby = row.find('.hobby').text();
    var imageFilename = row.find('.student-image').attr('data-filename');
    
    // Clear any previous validation
    clearValidation('#updateStudent');
    $('#errorMessageUpdate').addClass('d-none').text('');
    
    // Fill the form
    $('#student_id').val(student_id);
    $('#edit_firstName').val(firstName);
    $('#edit_lastName').val(lastName);
    $('#edit_email').val(email);
    $('#edit_password').val(password);
    $('#edit_addres').val(addres);
    $('#edit_phoneNumber').val(phoneNumber);
    $('#edit_country').val(country);
    $('#old_image').val(imageFilename);
    
    // Set gender radio
    if (gender === 'male') {
        $('#edit_gender_male').prop('checked', true);
    } else {
        $('#edit_gender_female').prop('checked', true);
    }
    
    // Set hobby checkboxes
    $('#edit_hobby_carrom').prop('checked', hobby.includes('Carrom'));
    $('#edit_hobby_chess').prop('checked', hobby.includes('Chess'));
    
    // Show current image
    if (imageFilename) {
        $('#current_image_preview').html('<img src="upload/' + imageFilename + '" width="100" class="img-thumbnail"><br><small>Current Image</small>');
    }
    
    // Show modal
    $('#studentEditModal').modal('show');
});

// UPDATE STUDENT
$(document).on('submit', '#updateStudent', function(e) {
    e.preventDefault();

    var form = this;
    var isValid = true;
    
    // Validate all required fields (except file which is optional in edit)
    $(form).find('input[required]:not([type="file"]), select[required]').each(function() {
        if (this.type === 'radio') {
            var radioName = this.name;
            var isChecked = $(form).find('input[name="' + radioName + '"]:checked').length > 0;
            if (!isChecked) {
                isValid = false;
            }
        } else {
            if (!this.checkValidity()) {
                isValid = false;
                touchedFields[this.name] = true;
                $(this).addClass('is-invalid');
                $(this).removeClass('is-valid');
            } else {
                $(this).removeClass('is-invalid');
                $(this).addClass('is-valid');
            }
        }
    });
    
    if (!isValid) {
        $('#errorMessageUpdate').removeClass('d-none').text('Please fill in all required fields correctly.');
        return false;
    }

    // Hide error message if validation passed
    $('#errorMessageUpdate').addClass('d-none').text('');

    let formData = new FormData(this);
    formData.append("update_student", "1");

    $.ajax({
        type: "POST",
        url: "code.php",
        data: formData,
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function(response) {
            let res = response;

            if (res.status == 422) {
                $('#errorMessageUpdate').removeClass('d-none').text(res.message);
            } 
            else if (res.status == 200) {
                $('#errorMessageUpdate').addClass('d-none');
                alertify.success(res.message);
                $('#studentEditModal').modal('hide');
                
                // Update the row directly without database call
                if (res.data) {
                    updateStudentRowInTable(res.data);
                }
            } 
            else if (res.status == 404) {
                alertify.error(res.message);
            }
            else {
                alert(res.message);
            }
        },
        error: function(xhr, status, error) {
            console.error('AJAX Error:', status, error);
            console.error('Response:', xhr.responseText);
            
            let errorMsg = 'An error occurred. Please try again.';
            try {
                let errorResponse = JSON.parse(xhr.responseText);
                if (errorResponse.message) {
                    errorMsg = errorResponse.message;
                }
            } catch(e) {
                errorMsg = xhr.responseText || errorMsg;
            }
            
            $('#errorMessageUpdate').removeClass('d-none').text(errorMsg);
        }
    });
});

// DELETE STUDENT
$(document).on('click', '.deleteStudentBtn', function(e) {
    e.preventDefault();
    
    if (confirm('Are you sure you want to delete this student?')) {
        var student_id = $(this).val();
        var deleteBtn = $(this);
        var row = deleteBtn.closest('tr');
        
        $.ajax({
            type: "POST",
            url: "code.php",
            data: {
                'delete_student': true,
                'student_id': student_id
            },
            dataType: 'json',
            success: function(response) {
                if (response.status == 200) {
                    alertify.success(response.message);
                    row.fadeOut(300, function() {
                        $(this).remove();
                        
                        // Check if table is empty after deletion
                        if ($('#myTable tbody tr').length === 0) {
                            var noDataRow = '<tr id="noDataRow">' +
                                '<td colspan="13" class="text-center text-muted py-4">' +
                                '<i class="fas fa-inbox fa-3x mb-3"></i>' +
                                '<h5>No Data Found</h5>' +
                                '<p>Click "Add Student" button to add your first student.</p>' +
                                '</td>' +
                                '</tr>';
                            $('#myTable tbody').append(noDataRow);
                        }
                    });
                } 
                else if (response.status == 404) {
                    alertify.error(response.message);
                } 
                else {
                    alertify.error(response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', status, error);
                console.error('Response:', xhr.responseText);
                alertify.error('An error occurred while deleting. Please try again.');
            }
        });
    }
});
</script>

<?php include(__DIR__ . '/../ADMIN/footer.php'); ?>