<?php

function upload_file($category)
{
    if (!isset($_FILES['photo']))
    {
        return null;
    }

    $upload = $_FILES['photo'];

    if ($upload['error'] == UPLOAD_ERR_NO_FILE)
    {
        echo "No file selected.";
        return null;
    }

    $targetDir = __DIR__ . "/uploads/" . $category . "/";

    if (!is_dir($targetDir))
    {
        mkdir($targetDir, 0777, true);
    }

    $filename = basename($upload['name']);

    $targetFile = $targetDir . $filename;

    $fileURL = "uploads/" . $category . "/" . $filename;

    if (move_uploaded_file($upload['tmp_name'], $targetFile))
    {
        return $fileURL;
    }

    return null;
}

function show_download($fileURL)
{
    return '<a href="' . htmlspecialchars($fileURL) . '" download class="btn btn-success">
                Download Image
            </a>';
}

$participantName = $_POST['participantName'] ?? '';
$contestTitle = $_POST['contestTitle'] ?? '';
$category = $_POST['category'] ?? '';
$description = $_POST['description'] ?? '';

$imagePath = upload_file($category);

?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="UTF-8">

    <title>Submission Result</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
</head>
<body class="bg-dark text-light">

<nav class="navbar navbar-dark bg-black">
    <div class="container">

        <span class="navbar-brand">
            Photo Contest Portal
        </span>

        <div>
            <a href="browse.php"
               class="btn btn-outline-light me-2">
                Browse Entries
            </a>

            <a href="index.php"
               class="btn btn-outline-light me-2">
                Submit Entry
            </a>

            <a href="logout.php"
               class="btn btn-danger">
                Logout
            </a>
        </div>

    </div>
</nav>

<div class="container mt-5">

    <div class="card bg-secondary text-light">

        <div class="card-body">

            <h2 class="text-center">
                Contest Entry Submitted
            </h2>

            <hr>

            <p>
                <strong>Participant:</strong>
                <?php echo htmlspecialchars($participantName); ?>
            </p>

            <p>
                <strong>Contest Title:</strong>
                <?php echo htmlspecialchars($contestTitle); ?>
            </p>

            <p>
                <strong>Category:</strong>
                <?php echo htmlspecialchars($category); ?>
            </p>

            <p>
                <strong>Description:</strong>
                <?php echo htmlspecialchars($description); ?>
            </p>

            <?php

            if ($imagePath != null)
            {
                echo "<h4>Uploaded Image</h4>";

                echo '<img src="' .
                     htmlspecialchars($imagePath) .
                     '" class="img-fluid rounded mb-3"
                     style="max-height:400px;">';

                echo "<br>";

                echo show_download($imagePath);
            }
            else
            {
                echo "<p>Image upload failed.</p>";
            }

            ?>

            <hr>

            <a href="index.php" class="btn btn-primary">
                Submit Another Entry
            </a>

            <a href="browse.php" class="btn btn-warning">
                Browse Photos
            </a>

        </div>

    </div>

</div>

</body>

</html>