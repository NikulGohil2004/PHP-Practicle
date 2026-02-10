<?php include(__DIR__ . '/../ADMIN/header.php'); ?>
<?php include(__DIR__ . '/../ADMIN/sidebar.php'); ?>

<!-- Add Student Modal -->
<div class="modal fade" id="studentAddModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Add Student</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form id="studentForm">
                <div class="modal-body">

                    <div class="mb-3">
                        <label>First Name</label>
                        <input type="text" id="firstName" name="firstName" class="form-control">
                        <span class="text-danger error" id="firstNameErr"></span>
                    </div>

                    <div class="mb-3">
                        <label>Last Name</label>
                        <input type="text" id="lastName" name="lastName" class="form-control">
                        <span class="text-danger error" id="lastNameErr"></span>
                    </div>

                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" id="email" name="email" class="form-control">
                        <span class="text-danger error" id="emailErr"></span>
                    </div>

                </div>

                <div class="modal-footer">
                    <!-- IMPORTANT: type="button" -->
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-primary">
                        Add Student
                    </button>
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

            <form id="updateStudent" method="post" enctype="multipart/form-data">
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

<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

<script src="/PHP-Practicle/CRUD/Ajax_crud/crud.js">

</script>

<?php include(__DIR__ . '/../ADMIN/footer.php'); ?>