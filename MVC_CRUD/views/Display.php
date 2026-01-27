<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display</title>
    <style>
    a:link {
        color: white;
        text-decoration: none;
    }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>
    <div class="container-fluid">
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <h3 class="card-title text-center">STUDENT RECORDS</h3>
                        <button class='btn btn-warning'><a href="views/Register.php">ADD</a></button>

                    </div>
                    <div class="card-body">

                        <div class='table-responsive'>
                            <table border="1" class='table table-bordered'>
                                <thead class='text-center bg-info'>
                                    <tr>
                                        <th class='bg-info'>ID</th>
                                        <th class='bg-info'>First-Name</th>
                                        <th class='bg-info'>Last-Name</th>
                                        <th class='bg-info'>Email</th>
                                        <th class='bg-info'>Password</th>
                                        <th class='bg-info'>Address</th>
                                        <th class='bg-info'>Phone-NO</th>
                                        <th class='bg-info'>Gender</th>
                                        <th class='bg-info'>Country</th>
                                        <th class='bg-info'>Hobby</th>
                                        <th class='bg-info'>File(IMAGE)</th>
                                        <th class='bg-info'>Update</th>
                                        <th class='bg-info'>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while($row = $users->fetch_assoc()) { ?>
                                    <tr class='align-middle text-center'>
                                        <td><?= $row['id'] ?></td>
                                        <td><?= $row['firstName'] ?></td>
                                        <td><?= $row['lastName'] ?></td>
                                        <td><?= $row['email'] ?></td>
                                        <td><?= $row['password'] ?></td>
                                        <td><?= $row['addres'] ?></td>
                                        <td><?= $row['phoneNumber'] ?></td>
                                        <td><?= $row['gender'] ?></td>
                                        <td><?= $row['country'] ?></td>
                                        <td><?= $row['hobby'] ?></td>
                                        <td>
                                            <img src="upload/<?= $row['filenam'] ?>" alt="NO IMAGE" class="rounded"
                                                width="100" height="100">
                                        </td>

                                        <td><button class='btn btn-warning'><a
                                                    href="index.php?action=edit&id=<?= $row['id'] ?>">Update</a></button>
                                        </td>
                                        <td><button class='btn btn-danger'><a
                                                    href="index.php?action=delete&id=<?= $row['id'] ?>">Delete</a></button>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>

</body>

</html>