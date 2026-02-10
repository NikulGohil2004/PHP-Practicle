/* RESET FORM & ERRORS WHEN MODAL CLOSES */
$('#studentAddModal').on('hidden.bs.modal', function () {

    // Reset form values
    $('#studentForm')[0].reset();

    // Remove bootstrap validation classes
    $('#studentForm').find('.is-invalid').removeClass('is-invalid');
    $('#studentForm').find('.is-valid').removeClass('is-valid');

    // Clear error messages
    $('.error').text('');
});


/* Example validation (your existing logic can stay) */
$('#studentForm').on('submit', function(e){
    e.preventDefault();

    let valid = true;

    if($('#firstName').val() === ''){
        $('#firstNameErr').text('First name is required');
        $('#firstName').addClass('is-invalid');
        valid = false;
    }

    if($('#lastName').val() === ''){
        $('#lastNameErr').text('Last name is required');
        $('#lastName').addClass('is-invalid');
        valid = false;
    }

    if($('#email').val() === ''){
        $('#emailErr').text('Email is required');
        $('#email').addClass('is-invalid');
        valid = false;
    }

    if(valid){
        // AJAX CALL HERE
        // $.ajax({ ... });
    }
});



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
$(document).on('blur', '#saveStudent input[required]:not([type="file"]), #saveStudent select[required], #updateStudent input[required]:not([type="file"]), #updateStudent select[required]', function() {
    validateField(this);
});

// File input validation on change
$(document).on('change', '#saveStudent input[type="file"][required], #updateStudent input[type="file"]', function() {
    validateField(this);
});

// Reset form validation when modal is closed
$('#studentAddModal').on('hidden.bs.modal', function () {
    $('.modal-backdrop').remove();
    $('body').removeClass('modal-open');
    $('body').css({'overflow': '', 'padding-right': ''});

    $('#saveStudent')[0].reset();
    $('#saveStudent').find('.is-invalid').removeClass('is-invalid');
    $('#saveStudent').find('.is-valid').removeClass('is-valid');
    $('#firstName-error').find('.invalid-feedback').removeClass('.invalid-feedback');

    
    $('#saveStudent input, #saveStudent select').removeClass('is-invalid is-valid');
    $('#errorMessage').addClass('d-none');
    touchedFields = {};
    $('input[name="gender"][value="male"]').prop('checked', true);
});

$('#studentEditModal').on('hidden.bs.modal', function () {
    $('.modal-backdrop').remove();
    $('body').removeClass('modal-open');
    $('body').css({'overflow': '', 'padding-right': ''});
    
    $('#updateStudent')[0].reset();
    $('#updateStudent input, #updateStudent select').removeClass('is-invalid is-valid');
    $('#errorMessageUpdate').addClass('d-none');
    touchedFields = {};
});

// SAVE STUDENT
$(document).on('submit', '#saveStudent', function(e) {
    e.preventDefault();

    var form = this;
    var isValid = true;
    
    $(form).find('input[required], select[required]').each(function() {
        if (this.type === 'file') {
            var hasFile = this.files && this.files.length > 0;
            if (!hasFile) {
                isValid = false;
                if (touchedFields[this.name]) {
                    $(this).addClass('is-invalid');
                    $(this).removeClass('is-valid');
                }
            } else {
                $(this).removeClass('is-invalid');
                $(this).addClass('is-valid');
            }
        } else {
            if (!this.checkValidity()) {
                isValid = false;
                if (touchedFields[this.name]) {
                    $(this).addClass('is-invalid');
                    $(this).removeClass('is-valid');
                }
            } else {
                $(this).removeClass('is-invalid');
                if (touchedFields[this.name]) {
                    $(this).addClass('is-valid');
                }
            }
        }
    });
    
    if (!isValid) {
        $(form).find('input[required], select[required]').each(function() {
            if (!touchedFields[this.name]) {
                touchedFields[this.name] = true;
                if (this.type === 'file') {
                    var hasFile = this.files && this.files.length > 0;
                    if (!hasFile) {
                        $(this).addClass('is-invalid');
                    }
                } else {
                    validateField(this);
                }
            }
        });
        return false;
    }

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
function closeModel(){

}