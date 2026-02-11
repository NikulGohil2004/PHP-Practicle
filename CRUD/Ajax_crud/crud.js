function addStudentRowToTable(student) {
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
  
    if (student.filenam) {
        row.find('.student-image').attr('src', 'upload/' + student.filenam + '?t=' + new Date().getTime());
        row.find('.student-image').attr('data-filename', student.filenam);
    }
}
var touchedFields = {};
var validationRules = {
    firstName: {
        required: true,
        pattern: /^[a-zA-Z\s]{2,50}$/,
        message: 'First name must be 2-50 characters, letters only'
    },
    lastName: {
         required: true,
        pattern: /^[a-zA-Z\s]{2,50}$/,
        message: 'Last name must be 2-50 characters, letters only'
    },
    email: {
         required: true,
        pattern: /^[^\s@]+@[^\s@]+\.[^\s@]+$/,
        message: 'Please enter a valid email address'
    },
    password: {
        required: true,
        pattern: /^[a-zA-Z0-9\s]{6,50}$/,
        message: 'Password must be 6 to 50 characters only letter'
    },
    phoneNumber: {
         required: true,
        pattern: /^[0-9]{10}$/,
        message: 'Phone number must be exactly 10 digits'
    },
    addres: {
         required: true,
        minLength: 10,
        message: 'Address must be at least 10 characters'
    }
};
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
function showError(field, message) {
    field.classList.add('is-invalid');
    field.classList.remove('is-valid');
    var existingError = field.parentElement.querySelector('.invalid-feedback');
    if (existingError) {
        existingError.remove();
    }

    var errorDiv = document.createElement('div');
    errorDiv.className = 'invalid-feedback';
    errorDiv.style.display = 'block';
    errorDiv.textContent = message;
    
    field.parentElement.appendChild(errorDiv);
}
// Show success state for a field
function showSuccess(field) {
    field.classList.remove('is-invalid');
    field.classList.add('is-valid');
    // Remove error message if any
    var existingError = field.parentElement.querySelector('.invalid-feedback');
    if (existingError) {
        existingError.remove();
    }
}
// Validate a single field
function validateField(field) {
    var fieldName = field.name || field.getAttribute('name');
    var fieldValue = field.value.trim();
    touchedFields[fieldName] = true;
    // Remove previous error message
    var existingError = field.parentElement.querySelector('.invalid-feedback');
    if (existingError) {
        existingError.remove();
    }
    // File validation
    if (field.type === 'file') {
        var hasFile = field.files && field.files.length > 0;
        if (!hasFile && field.hasAttribute('required')) {
            showError(field, 'Please select an image file');
            return false;
        } else if (hasFile) {
            // Validate file type and size
            var file = field.files[0];
            var validTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
            var maxSize = 2 * 1024 * 1024; // 2MB
            
            if (!validTypes.includes(file.type)) {
                showError(field, 'Only JPG, JPEG, PNG, and GIF files are allowed');
                return false;
            }
            if (file.size > maxSize) {
                showError(field, 'File size must be less than 2MB');
                return false;
            }
            showSuccess(field);
            return true;
        }
    }
    // Required field check
    if (field.hasAttribute('required') && fieldValue === '') {
        showError(field, 'This field is required');
        return false;
    }
    
    if (fieldValue === '') {
        field.classList.remove('is-invalid', 'is-valid');
        return true;
    }
    // Custom validation rules
    var cleanFieldName = fieldName.replace('edit_', '');
    if (validationRules[cleanFieldName]) {
        var rule = validationRules[cleanFieldName];
        // Pattern validation
        if (rule.pattern && !rule.pattern.test(fieldValue)) {
            showError(field, rule.message);
            return false;
        }
        // Min length validation
        if (rule.minLength && fieldValue.length < rule.minLength) {
            showError(field, rule.message);
            return false;
        }
    }
    if (field.tagName === 'SELECT' && field.hasAttribute('required')) {
        if (fieldValue === '' || fieldValue === null) {
            showError(field, 'Please select an option');
            return false;
        }
    }
    showSuccess(field);
    return true;
}
function validateForm(formId) {
    var form = document.getElementById(formId);
    var isValid = true;
   
    var fields = form.querySelectorAll('input[type="text"], input[type="email"], input[type="password"], input[type="tel"], input[type="file"], select, textarea');
    fields.forEach(function(field) {
        touchedFields[field.name] = true;
        if (!validateField(field)) {
            isValid = false;
        }
    });
    var genderRadios = form.querySelectorAll('input[name="gender"], input[name="edit_gender"]');
    if (genderRadios.length > 0) {
        var genderChecked = Array.from(genderRadios).some(radio => radio.checked);
        if (!genderChecked) {
            isValid = false;
            genderRadios.forEach(function(radio) {
                showError(radio, 'Please select a gender');
            });
        }
    }
    var hobbyCheckboxes = form.querySelectorAll('input[name="hobby[]"], input[name="edit_hobby[]"]');
    if (hobbyCheckboxes.length > 0) {
        var hobbyChecked = Array.from(hobbyCheckboxes).some(cb => cb.checked);
        if (!hobbyChecked) {
            isValid = false;
            if (hobbyCheckboxes[0]) {
                showError(hobbyCheckboxes[0], 'Please select at least one hobby');
            }
        }
    }
    return isValid;
}
$(document).on('blur', '#saveStudent input, #saveStudent select, #saveStudent textarea, #updateStudent input, #updateStudent select, #updateStudent textarea', function() {
    if (touchedFields[this.name] || this.value.trim() !== '') {
        validateField(this);
    }
});
$(document).on('input', '#saveStudent input:not([type="file"]):not([type="radio"]):not([type="checkbox"]), #updateStudent input:not([type="file"]):not([type="radio"]):not([type="checkbox"])', function() {
    if (touchedFields[this.name]) {
        validateField(this);
    }
});
$(document).on('change', '#saveStudent input[type="file"], #updateStudent input[type="file"]', function() {
    validateField(this);
});
$(document).on('change', '#saveStudent select, #updateStudent select', function() {
    validateField(this);
});

$(document).on('change', 'input[type="radio"][name="gender"], input[type="radio"][name="edit_gender"]', function() {
    var radios = document.querySelectorAll('input[name="' + this.name + '"]');
    radios.forEach(function(radio) {
        radio.classList.remove('is-invalid');
        var error = radio.parentElement.parentElement.querySelector('.invalid-feedback');
        if (error) error.remove();
    });
});

$(document).ready(function() {
    // Select both create and edit checkbox groups
    var $checkboxes = $('input[name="hobby[]"], input[name="edit_hobby[]"]');

    $checkboxes.change(function() {
        // Find checkboxes within the same group (by name)
        var $group = $('input[name="' + $(this).attr('name') + '"]');
        
        // If at least one is checked, make them all NOT required
        if ($group.is(':checked')) {
            $group.removeAttr('required');
        } else {
            // Otherwise, make them all REQUIRED
            $group.attr('required', 'required');
        }
    });
});

$('#studentAddModal').on('hidden.bs.modal', function () {
    $('.modal-backdrop').remove();
    $('body').removeClass('modal-open');
    $('body').css({'overflow': '', 'padding-right': ''});

    $('#saveStudent')[0].reset();
    $('#saveStudent').find('.is-invalid').removeClass('is-invalid');
    $('#saveStudent').find('.is-valid').removeClass('is-valid');
    $('#saveStudent').find('.invalid-feedback').remove();
    
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
    $('#updateStudent').find('.invalid-feedback').remove();
    $('#updateStudent input, #updateStudent select').removeClass('is-invalid is-valid');
    $('#errorMessageUpdate').addClass('d-none');
    $('#current_image_preview').html('');
    touchedFields = {};
});

$(document).on('submit', '#saveStudent', function(e) {
    e.preventDefault();
    if (!validateForm('saveStudent')) {
        var firstError = $('#saveStudent .is-invalid')[0];
        if (firstError) {
            firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
            firstError.focus();
        }
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

$(document).on('click', '.editStudentBtn', function(e) {
    e.preventDefault();
    var student_id = $(this).val();
    var row = $(this).closest('tr');

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

    $('#student_id').val(student_id);
    $('#edit_firstName').val(firstName);
    $('#edit_lastName').val(lastName);
    $('#edit_email').val(email);
    $('#edit_password').val(password);
    $('#edit_addres').val(addres);
    $('#edit_phoneNumber').val(phoneNumber);
    $('#edit_country').val(country);
    $('#old_image').val(imageFilename);

    if (gender === 'male') {
        $('#edit_gender_male').prop('checked', true);
    } else {
        $('#edit_gender_female').prop('checked', true);
    }
    
    $('#edit_hobby_carrom').prop('checked', hobby.includes('Carrom'));
    $('#edit_hobby_chess').prop('checked', hobby.includes('Chess'));

    if (imageFilename) {
        $('#current_image_preview').html('<img src="upload/' + imageFilename + '" width="100" class="img-thumbnail"><br><small>Current Image</small>');
    }

    $('#studentEditModal').modal('show');
});

$(document).on('submit', '#updateStudent', function(e) {
    e.preventDefault();
    if (!validateForm('updateStudent')) {
     
        var firstError = $('#updateStudent .is-invalid')[0];
        if (firstError) {
            firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
            firstError.focus();
        }
        return false;
    }

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
    
    var student_id = $(this).val();
    var deleteBtn = $(this);
    var row = deleteBtn.closest('tr');
    
    // Store the student_id in the modal's delete button
    $('#confirmDeleteBtn').data('student-id', student_id);
    $('#confirmDeleteBtn').data('row', row);
    
    // Show the modal
    $('#deleteConfirmModal').modal('show');
});
// Handle the actual deletion when user confirms
$(document).on('click', '#confirmDeleteBtn', function() {
    var student_id = $(this).data('student-id');
    var row = $(this).data('row');
    
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
                $('#deleteConfirmModal').modal('hide');
                
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
                $('#deleteConfirmModal').modal('hide');
            } 
            else {
                alertify.error(response.message);
                $('#deleteConfirmModal').modal('hide');
            }
        },
        error: function(xhr, status, error) {
            console.error('AJAX Error:', status, error);
            console.error('Response:', xhr.responseText);
            alertify.error('An error occurred while deleting. Please try again.');
            $('#deleteConfirmModal').modal('hide');
        }
    });
});