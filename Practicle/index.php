<!DOCTYPE html>
<html>

<head>
    <title>Practicle</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>

    <div class="container mt-4">
        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addModal">Add</button>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>First-Name</th>
                    <th>Last-Name</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Gender</th>
                    <th>Language</th>
                    <th>Subjects</th>
                    <th>Profile</th>
                    <th>Update</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <div class="search-box">
                <label>Search:</label>
                <input type='text' name='search' id='keyword' placeholder="Type to search...">
            </div><br>  
            <tbody id="userTable"></tbody>
        </table>
    </div>

    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form method="POST" enctype="multipart/form-data" id="submitform">
                        <div>
                            <input id="FirstName" class="form-control" type="text" name="FirstName"
                                placeholder="First-Name" />
                            <small class="text-danger error-msg"></small><br>
                        </div>

                        <div>
                            <input class="form-control" id="LastName" type="text" name="LastName"
                                placeholder="Last-Name" />
                            <small class="text-danger error-msg"></small><br>
                        </div>

                        <div>
                            <input class="form-control" id="Email" type="email" name="Email" placeholder="Email" />
                            <small class="text-danger error-msg"></small><br>
                        </div>

                        <div>
                            <input class="form-control" id="Password" type="password" name="Password"
                                placeholder="Password" />
                            <small class="text-danger error-msg"></small><br>
                        </div>

                        <div>
                            <input class="form-control" id="Confirm-Password" type="password" name="ConfirmPassword"
                                placeholder="Confirm-Password" />
                            <small class="text-danger error-msg"></small><br>
                        </div>


                        <label>Male:-</label>
                        <input type="radio" name="Gender" id="Male" value="Male" checked /><br>
                        <label>Female:-</label>
                        <input type="radio" name="Gender" id="Female" value="Female" /> <br>

                        <div>
                            <select class="form-control" name="Language[]" id="Language" multiple size="4">
                                <option value="" disabled selected>Select:-Language</option>
                                <option value="English">English</option>
                                <option value="German">German</option>
                                <option value="French">French</option>
                                <option value="Italian">Italian</option>
                            </select>
                            <small class="text-danger error-msg"></small>
                            <br>
                        </div>

                        <div class="chc">
                            <label>Subjects:-</label><br>
                            <label>Maths</label>
                            <input type="checkbox" name="Subjects[]" id="Maths" value="Maths" />

                            <label>Physics</label>
                            <input type="checkbox" name="Subjects[]" id="Physics" value="Physics" />

                            <label>Computer</label>
                            <input type="checkbox" name="Subjects[]" id="Computer" value="Computer" />

                            <label>Chemistry</label>
                            <input type="checkbox" name="Subjects[]" id="Chemistry" value="Chemistry" />
                            <br><small class="text-danger error-msg"></small><br>
                        </div>

                        <div>
                            <input type="file" name="Image" id="Image" />
                            <br><small class="text-danger error-msg"></small>
                        </div>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" id="saveUser" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form method="POST" enctype="multipart/form-data" id="editform">
                        <input type="hidden" id="edit_id" name="id" value="">
                        <div>
                            <input class="form-control" id="edit_FirstName" type="text" name="FirstName"
                                placeholder="First-Name" />
                            <small class="text-danger error-msg"></small><br>
                        </div>

                        <div>
                            <input class="form-control" id="edit_LastName" type="text" name="LastName"
                                placeholder="Last-Name" />
                            <small class="text-danger error-msg"></small><br>
                        </div>

                        <div>
                            <input class="form-control" id="edit_Email" type="text" name="Email" placeholder="Email" />
                            <small class="text-danger error-msg"></small><br>
                        </div>

                        <div>
                            <input class="form-control" id="edit_Password" type="text" name="Password"
                                placeholder="Password" />
                            <small class="text-danger error-msg"></small><br>
                        </div>

                        <label>Male:-</label>
                        <input type="radio" name="Gender" id="edit_Male" value="Male" checked /><br>
                        <label>Female:-</label>
                        <input type="radio" name="Gender" id="edit_Female" value="Female" /> <br>

                        <div>
                            <select type="dropdown" class="form-control" name="Language[]" id="edit_Language" multiple>
                                <option value="" disabled>Select:-Lanaguage</option>
                                <option value="English">English</option>
                                <option value="German">German</option>
                                <option value="French">French</option>
                                <option value="Italian">Italian</option>
                            </select>
                            <small class="text-danger error-msg"></small><br>
                        </div>

                        <div class="chc">
                            <label>Maths</label>
                            <input type="checkbox" name="edit_Subjects[]" id="edit_Maths" value="Maths" />

                            <label>Physics</label>
                            <input type="checkbox" name="edit_Subjects[]" id="edit_Physics" value="Physics" />

                            <label>Computer</label>
                            <input type="checkbox" name="edit_Subjects[]" id="edit_Computer" value="Computer" />

                            <label>Chemistry</label>
                            <input type="checkbox" name="edit_Subjects[]" id="edit_Chemistry" value="Chemistry" /><br>
                            <small class="text-danger error-msg"></small><br>
                        </div>

                        <div>
                            <input type="file" name="Image" id="edit_Image" />
                            <img id="preview_Image" src="" alt="Image Preview" width="100" height="100">
                            <small class="text-danger error-msg"></small><br>
                        </div>


                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" id="updateUser" class="btn btn-primary">Update</button>
                </div>
            </div>
        </div>
    </div>
    <script src="Ajax.js"> </script>
</body>

</html>