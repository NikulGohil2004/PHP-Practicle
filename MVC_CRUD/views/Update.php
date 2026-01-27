<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Update</title>
    <style>
    label {
        font-weight: 500;
    }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>
    <div class="container row justify-content-center">
        <div class="card card-info card-outline mb-4 mt-4 w-50 ">
            <div class="card-header text-center">
                <div class="card-title">UPDATE STUDENT</div>
            </div>
            <form method="post" action="index.php?action=update" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6 ">
                            <label for="validationCustom01" class="form-label">First name</label>
                            <input type="text" name="firstName" class="form-control"
                                value="<?php echo $data['firstName']; ?>" required />
                        </div>
                        <div class="col-md-6">
                            <label for="validationCustom02" class="form-label">Last name</label>
                            <input type="text" name="lastName" class="form-control"
                                value="<?php echo $data['lastName']; ?>" required />
                        </div>
                        <div class="col-md-6">
                            <label for="validationCustomUsername" class="form-label">Email</label>
                            <div class="input-group has-validation">
                                <input type="email" name="email" class="form-control"
                                    value="<?php echo $data['email']; ?>" aria-describedby="inputGroupPrepend"
                                    required />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="validationCustom03" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control"
                                value="<?php echo $data['password']; ?>" id="validationCustom03" required />
                        </div>
                        <div class="col-md-6">
                            <label for="validationCustom03" class="form-label">Address</label>
                            <input type="text" class="form-control" name="addres" value="<?php echo $data['addres']; ?>"
                                required />
                        </div>
                        <div class="col-md-6">
                            <label for="validationCustom03" class="form-label">Phone-Number</label>
                            <input type="number" name="phoneNumber" value="<?php echo $data['phoneNumber']; ?>"
                                class="form-control" required />
                        </div>
                        <div class="col-md-4">
                            <label class="form-check-label" for="radioDefault1">
                                Gender
                            </label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gender" value="male"
                                    <?php if($data['gender']=="male") echo "checked"; ?>>
                                <label class="form-check-label" for="radioDefault1">
                                    Male
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gender" value="Female"
                                    <?php if($data['gender']=="Female") echo "checked"; ?>>
                                <label class="form-check-label " for="radioDefault2">
                                    Female
                                </label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <?php $hobbies = explode(", ", $data['hobby']); ?>
                            <label class="form-check-label" for="radioDefault1">
                                Hobby
                            </label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="hobby[]" value="Carrom"
                                    <?php if(in_array("Carrom",$data)) echo "checked"; ?>>
                                <label class="form-check-label" for="checkDefault">
                                    Carrom
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="hobby[]" value="Chess"
                                    <?php if(in_array("Chess",$data)) echo "checked"; ?>>
                                <label class="form-check-label" for="checkChecked">
                                    Chess
                                </label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="validationCustom04" class="form-label">Country</label>
                            <select class="form-select" name="country" required>
                                <option value="India" <?php if($data['country']=="India") echo "selected"; ?>>INDIA
                                </option>
                                <option value="USA" <?php if($data['country']=="USA") echo "selected"; ?>>USA</option>
                            </select>
                        </div>
                        <div class="col-md-6 ">
                            <div class="input-group mb-3">
                                <input type="file" class="form-control" name="uploadfile" value="" required />
                            </div>
                            <div class="cold-md-6">
                                <img src="upload/<?php echo $data['filenam']; ?>" width="100"><br>
                            </div>
                        </div>
                        <div class="card-footer text-center">
                            <input class="btn btn-info" name="submit" value="Update" type="submit" />
                        </div>
            </form>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
                crossorigin="anonymous"></script>
        </div>
</body>

</html>