<?php

$errors = $_SESSION['errors'] ?? [];
$old    = $_SESSION['old'] ?? [];

unset($_SESSION['errors'], $_SESSION['old']);

$hobbies = !empty($data['hobby'])
    ? explode(", ", $data['hobby'])
    : [];
?>

<div class="container-fluid mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">

            <div class="card card-info card-outline">
                <div class="card-header text-center">
                    <h5 class="card-title mb-0">UPDATE STUDENT</h5>
                </div>
   <?php if (!empty($errors)): ?>
                    <div class="alert alert-danger m-3">
                        <ul class="mb-0">
                            <?php foreach ($errors as $error): ?>
                                <li><?= htmlspecialchars($error) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <form method="post"
                      action="index.php?action=update&id=<?= $data['id'] ?>"
                      enctype="multipart/form-data">

                    <input type="hidden" name="id" value="<?= $data['id'] ?>">

                    <div class="card-body">
                        <div class="row g-3">

                            <div class="col-md-6">
                                <label class="form-label">First Name</label>
                                <input type="text" name="firstName" class="form-control"
                                       value="<?= htmlspecialchars($data['firstName']) ?>">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Last Name</label>
                                <input type="text" name="lastName" class="form-control"
                                       value="<?= htmlspecialchars($data['lastName']) ?>">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control"
                                       value="<?= htmlspecialchars($data['email']) ?>">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Password</label>
                                <input type="password" name="password" class="form-control"
                                   value="<?= htmlspecialchars($data['password']) ?>"    >
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">Address</label>
                                <input type="text" name="addres" class="form-control"
                                      value="<?= htmlspecialchars($data['addres'] ?? '') ?>"
>
                                       
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Phone Number</label>
                                <input type="number" name="phoneNumber" class="form-control"
                                       value="<?= htmlspecialchars($data['phoneNumber']) ?>">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Country</label>
                                <select name="country" class="form-select">
                                    <option value="India" <?= ($data['country']=="India")?"selected":"" ?>>India</option>
                                    <option value="USA" <?= ($data['country']=="USA")?"selected":"" ?>>USA</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Gender</label><br>
                                <input type="radio" name="gender" value="male"
                                    <?= ($data['gender']=="male")?"checked":"" ?>> Male
                                <input type="radio" name="gender" value="Female"
                                    <?= ($data['gender']=="Female")?"checked":"" ?>> Female
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Hobby</label><br>
                                <input type="checkbox" name="hobby[]" value="Carrom"
                                    <?= in_array("Carrom",$hobbies)?"checked":"" ?>> Carrom
                                <input type="checkbox" name="hobby[]" value="Chess"
                                    <?= in_array("Chess",$hobbies)?"checked":"" ?>> Chess
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">Current Image</label><br>
                                <?php if (!empty($data['filenam'])): ?>
                                    <img src="upload/<?= htmlspecialchars($data['filenam']) ?>"
                                         width="100" class="mb-2"><br>
                                <?php endif; ?>
                                <input type="file" name="uploadfile" class="form-control">
                            </div>

                        </div>
                    </div>

                    <div class="card-footer text-center">
                        <button type="submit" class="btn btn-info">Update</button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>
