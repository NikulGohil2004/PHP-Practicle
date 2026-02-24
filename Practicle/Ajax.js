$(document).ready(function () {
    function loadData() {
        $.ajax({
            url: "Display.php",
            type: "GET",
            success: function (data) {
                $("#userTable").html(data);
            }
        });
    }
    loadData();
    $('#addModal').on('show.bs.modal', function () {
        $(".error-msg").text("");
        $("#submitform")[0].reset();
    });
    $("#saveUser").click(function () {
        var valid = true;
        $(".error-msg").text("");

        var firstname = $("#FirstName").val().trim();
        if (firstname === "") {
            $("#FirstName").siblings(".error-msg").first().text("First Name is Required.");
            valid = false;
        }

        var lastname = $("#LastName").val().trim();
        if (lastname === "") {
            $("#LastName").siblings(".error-msg").first().text("Last Name is Required.");
            valid = false;
        }
        var Email = $("#Email").val().trim();
        if (Email === "") {
            $("#Email").siblings(".error-msg").first().text("Email is Required.");
            valid = false;
        }
        var Password = $("#Password").val().trim();
        if (Password === "") {
            $("#Password").siblings(".error-msg").first().text("Password is Required.");
            valid = false;
        }
        var ConfirmPassword = $("#Confirm-Password").val();
        if (ConfirmPassword === "") {
            $("#Confirm-Password").siblings(".error-msg").first().text("ConfirmPassword is Required.");
            valid = false;
        } else if (Password !== ConfirmPassword) {
            $("#Confirm-Password").siblings(".error-msg").first().text("ConfirmPassword and Password is not matching.");
        }
        var Language = $('#Language').val();
        if (!Language || Language.length === 0) {
            $('#Language').siblings('.error-msg').first().text('Language is Required.');
            valid = false;
        }

        if ($('input[name="Subjects[]"]:checked').length === 0) {
            $('.chc').find('.error-msg').text("At least one subject is required.");
            valid = false;
        } else {
            $('.chc').find('.error-msg').text("");
        }

        if ($("#Image").val() === "") {
            $("#Image").siblings(".error-msg").first().text("Image  is Required.");
            valid = false;
        }

        if (!valid) {
            e.preventDefault();
            return false;
        }
        var formData = new FormData(document.getElementById("submitform"));
        $.ajax({
            url: "insert.php",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function () {
                $("#submitform")[0].reset();
                $("#addModal").modal("hide");
                loadData();
            }
        });
    });
    $(document).on('click', '.editBtn', function () {

        var id = $(this).data('id');

        $.ajax({
            url: 'fetch.php',
            type: 'POST',
            data: { id: id },
            dataType: 'json',
            success: function (data) {

                $('#edit_id').val(data.id);
                $('#edit_FirstName').val(data.FirstName);
                $('#edit_LastName').val(data.LastName);
                $('#edit_Email').val(data.Email);
                $('#edit_Password').val(data.Password);
                $('input[name="Gender"]').prop('checked', false);
                $('input[name="Gender"][value="' + data.Gender + '"]').prop('checked', true);
                if (data.Language) {
                    var languagesArray = data.Language.split(',');
                    $('#edit_Language').val(languagesArray).trigger('change');
                }
                $('input[name="Subjects[]"]').prop('checked', false);
                if (data.Subjects) {
                    data.Subjects.split(',').forEach(function (subject) {
                        $('input[name="edit_Subjects[]"][value="' + subject.trim() + '"]')
                            .prop('checked', true);
                    });
                }
                $('#edit_Image').val(data.Image);
                if (data.Image) {
                    $("#preview_Image").attr("src", "upload/" + data.Image);
                }
                $('#editModal').modal('show');
            }
        });

    });
    $('#editModal').on('show.bs.modal', function () {
        $(".error-msg").text("");
        $("#editform")[0].reset();
    });

    $("#updateUser").click(function () {
        var valid = true;
        $(".error-msg").text("");

        var firstname = $("#edit_FirstName").val().trim();
        if (firstname === "") {
            $("#edit_FirstName").siblings(".error-msg").first().text("First Name is Required.");
            valid = false;
        }

        var lastname = $("#edit_LastName").val().trim();
        if (lastname === "") {
            $("#edit_LastName").siblings(".error-msg").first().text("Last Name is Required.");
            valid = false;
        }
        var Email = $("#edit_Email").val().trim();
        if (Email === "") {
            $("#edit_Email").siblings(".error-msg").first().text("Email is Required.");
            valid = false;
        }
        var Password = $("#edit_Password").val().trim();
        if (Password === "") {
            $("#edit_Password").siblings(".error-msg").first().text("Password is Required.");
            valid = false;
        }

        var Language = $('#edit_Language').val();
        if (!Language || Language.length === 0) {
            $('#edit_Language').siblings('.error-msg').first().text('Language is Required.');
            valid = false;
        }

        if ($('input[name="edit_Subjects[]"]:checked').length === 0) {
            $('.chc').find('.error-msg').text("At least one subject is required.");
            valid = false;
        } else {
            $('.chc').find('.error-msg').text("");
        }

        if ($("#edit_Image").val() === "") {
            $("#edit_Image").siblings(".error-msg").first().text("Image  is Required.");
            valid = false;
        }

        if (!valid) {
            e.preventDefault();
            return false;
        }


        var formData = new FormData(document.getElementById("editform"));
        $.ajax({
            url: "update.php",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function () {
                $("#editModal").modal("hide");
                loadData();
            }
        });
    });

    $(document).on('click', '.deleteBtn', function () {
        var id = $(this).data('id');
        if (confirm("Are you sure you want to delete this record?")) {
            $.ajax({
                url: "delete.php",
                type: "POST",
                data: { id: id },
                success: function () {
                    loadData();
                }
            });
        }
    });

    $('#keyword').on("keyup", function () {
        $.ajax({
            url: "search.php",
            method: "POST",
            data: { query: $(this).val() },
            success: function (data) {
                $("#userTable").html(data);
            }
        });
    });
});









