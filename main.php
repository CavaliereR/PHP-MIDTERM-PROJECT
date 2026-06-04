<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Photo Contest</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

<?php
header("Location: login.php");
exit();
?></head>

<body class="bg-dark text-light">

<nav class="navbar navbar-dark bg-black">
    <div class="container">

        <span class="navbar-brand">
            Photo Contest Portal
        </span>

        <a href="browse.php"
           class="btn btn-outline-light">
            Browse Entries
        </a>


        <a href="index.php"
           class="btn btn-outline-light">
            Submit Entry
        </a>

    </div>
</nav>

<div class="container vh-100 d-flex justify-content-center align-items-center">



    <div class="card bg-secondary text-light shadow-lg p-4" style="width: 600px;">

        <h2 class="text-center mb-4">
            Online Photo Contest Submission Portal
        </h2>

        <form method="post"
              action="submit.php"
              enctype="multipart/form-data">

            <div class="mb-3">
                <label class="form-label">Participant Name</label>
                <input type="text"
                       class="form-control"
                       name="participantName"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">Contest Title</label>
                <input type="text"
                       class="form-control"
                       name="contestTitle"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">Category</label>

                <select class="form-select" name="category">
                    <option>Nature</option>
                    <option>Portrait</option>
                    <option>Street</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Upload Photo</label>
                <input type="file"
                       class="form-control"
                       name="photo"
                       accept="image/*"
                       required>
            </div>

            <button type="submit"
                    class="btn btn-primary w-100">
                Submit Entry
            </button>

        </form>

    </div>

</div>

</body>
</html>