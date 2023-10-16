<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Notepad</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Ubuntu:wght@300;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
    <script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            let table = new DataTable('#myTable');
        });
    </script>

</head>

<body>

    <!--Edit Modal -->
    <div class="modal fade" id="editmodal" tabindex="-1" aria-labelledby="editmodalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editmodalLabel">Edit Note</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="notepad.php" method="post">

                    <div class="modal-body">
                        <input type="hidden" name="snoEdit" id="snoEdit">
                        <div class="mb-3">
                            <label for="title" class="form-label"> <b class="size">Note Title</b> </label>
                            <input type="text" required class="form-control" id="titleEdit" name="titleEdit" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label"> <b class="size">Note Description</b> </label>
                            <div class="form-floating">
                                <textarea class="form-control" required placeholder="Leave a comment here" id="descriptionEdit" name="descriptionEdit" style="height: 100px"></textarea>

                            </div>
                        </div>



                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <nav class="navbar navbar-expand-lg bg-dark border-bottom border-body" data-bs-theme="dark">

        <div class="container-fluid ">
            <a class="navbar-brand fs-2 ubuntu" href="#"> Notepad</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
                    </li>

                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>


    <?php
    include "necessity.php";
    if (isset($_GET['delete'])) {
        $sno = $_GET['delete'];

        $sql = "DELETE FROM `mynotes` WHERE `mynotes`.`sno` = $sno";
        mysqli_query($conn, $sql);
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['snoEdit'])) {
            // Update the Record
            $sno = $_POST["snoEdit"];
            $title = $_POST['titleEdit'];
            $description = $_POST['descriptionEdit'];

            // Sql query to be executed

            $sql = "UPDATE `mynotes` SET `title` = '$title' , `description` = '$description' WHERE `mynotes`.`sno` = $sno";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                $update = true;
            } else {
                echo "We could not update the record successfully";
            }
        } else {


            $title = $_POST['title'];
            $description = $_POST['description'];

            //Insert data into a table in a database using PHP

            $sql = "INSERT INTO `$table` (`title`, `description`) VALUES ('" . $title . "', '" . $description . "');";
            $result = mysqli_query($conn, $sql);

            //Check for the data insertion  success

            if ($result) {
                echo '<div class="alert alert-primary alert-dismissible fade show" role="alert">
             <strong>Success!</strong> The data was inserted Successfully.<br>
             <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
             </div>';
            } else {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
             <strong>Sorry!</strong>The data was not inserted Successfully.
             <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
             </div>';
            }
        }
    }

    ?>

    <div class="container mt-2">
        <h2 class="text-center">Add a Note</h2>
        <form action="notepad.php" method="post">
            <div class="mb-3">
                <label for="title" class="form-label">Note Title </label>
                <input type="text" required class="form-control" id="title" name="title" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Note Description</label>
                <div class="form-floating">
                    <textarea class="form-control" required placeholder="Leave a comment here" id="description" name="description" style="height: 100px"></textarea>

                </div>
            </div>

            <button type="submit" class="btn btn-success">Add Note</button>
        </form>
    </div>

    <div class="container my-5">

        <table id="myTable" class="table mt-4">
            <thead>
                <tr>
                    <th scope="col">S.No</th>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php


                $sql = "SELECT * FROM $table";

                $result = mysqli_query($conn, $sql);
                //Find the number of records returned
                $num = mysqli_num_rows($result);
                //Display the rows returned by the Query
                if ($num > 0) {
                    $a = 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "    <tr>
        <th scope='row'>" . $a . "</th>
        <td>" . $row["title"] . "</td>
        <td>" . $row["description"] . "</td>
        <td>
        <a class='edit btn btn-success btn-sm' id=" . $row["sno"] . ">Edit</a>
        <a class='delete btn btn-success btn-sm' id=d" . $row["sno"] . ">Delete</a>
         </td>
      </tr>";
                        $a += 1;
                    }
                } else {
                    echo "No result Found in database";
                }
                ?>

            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script>
        edits = document.getElementsByClassName('edit');
        Array.from(edits).forEach((element) => {

            element.addEventListener("click", (e) => {

                console.log("edit", );
                tr = e.target.parentNode.parentNode;
                title = tr.getElementsByTagName("td")[0].innerText;
                description = tr.getElementsByTagName("td")[1].innerText;
                console.log(title, description);
                titleEdit.value = title;
                descriptionEdit.value = description;
                snoEdit.value = e.target.id;
                console.log(snoEdit);
                $('#editmodal').modal('toggle');
            })

        });

        deletes = document.getElementsByClassName('delete');
        Array.from(deletes).forEach((element) => {

            element.addEventListener("click", (e) => {

                console.log("edit", );
                sno = e.target.id.substr(1, );
                if (confirm("Are you sure you want to Delete !")) {
                    console.log("yes");
                    window.location = `notepad.php?delete=${sno}`;
                } else {
                    console.log("no");
                }
            })

        });
    </script>
</body>

</html>