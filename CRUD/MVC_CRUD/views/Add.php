<?php
$errors = $_SESSION['errors'] ?? [];
$old    = $_SESSION['old'] ?? [];

unset($_SESSION['errors'], $_SESSION['old']);
?>

<div class="container-fluid mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">

            <div class="card card-info card-outline">
                <div class="card-header text-center">
                    <h5 class="card-title mb-0">STUDENT ADD</h5>
                </div>

                <?php if (!empty($errors)): ?>
                    <div class="alert alert-danger m-3">
                        <ul class="mb-0">
                            <?php foreach ($errors as $error): ?>
                                <li><?php echo $error; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <form method="post" action="index.php?action=store" enctype="multipart/form-data">

                    <div class="card-body">
                        <div class="row g-3">

                            <div class="col-md-6">
                                <label class="form-label">First Name</label>
                                <input type="text" name="firstName" class="form-control" value="<?php echo $old['firstName'] ?? ''; ?>">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Last Name</label>
                                <input type="text" name="lastName" class="form-control" value="<?php echo $old['lastName'] ?? ''; ?>">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" value="<?php echo $old['email'] ?? ''; ?>">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Phone Number</label>
                                <input type="number" name="phoneNumber" class="form-control" value="<?php echo $old['phoneNumber'] ?? ''; ?>">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Password</label>
                                <input type="password" name="password" class="form-control">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Confirm Password</label>
                                <input type="password" name="confirmPassword" class="form-control">
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">Address</label>
                                <textarea name="addres" class="form-control"><?php echo $old['addres'] ?? ''; ?></textarea>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Gender</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gender" value="male" checked>
                                    <label class="form-check-label">Male</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gender" value="Female">
                                    <label class="form-check-label">Female</label>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Hobby</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="hobby[]" value="Carrom">
                                    <label class="form-check-label">Carrom</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="hobby[]" value="Chess">
                                    <label class="form-check-label">Chess</label>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Country</label>
                                <select class="form-select" name="country">
                                    <option value="India">INDIA</option>
                                    <option value="USA">USA</option>
                                </select>
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">Profile Image</label>
                                <input type="file" name="uploadfile" class="form-control">
                            </div>

                        </div>
                    </div>

                    <div class="card-footer text-center">
                        <button type="submit" class="btn btn-info">ADD</button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>