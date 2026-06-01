<?php

// Function for uploading the selected image
function upload_file($category)
{
    // Check if a file was uploaded
    if (!isset($_FILES['photo']))
    {
        return null;
    }

    $upload = $_FILES['photo'];

    // Check if user actually selected a file
    if ($upload['error'] == UPLOAD_ERR_NO_FILE)
    {
        echo "No file selected.";
        return null;
    }

    // Create category folder path
    $targetDir = __DIR__ . "/uploads/" . $category . "/";

    // Create folder if it does not exist
    if (!is_dir($targetDir))
    {
        mkdir($targetDir, 0777, true);
    }

    // Get uploaded filename
    $filename = basename($upload['name']);

    // Full server path
    $targetFile = $targetDir . $filename;

    // Path used for displaying image in browser
    $fileURL = "uploads/" . $category . "/" . $filename;

    // Move uploaded file into folder
    if (move_uploaded_file($upload['tmp_name'], $targetFile))
    {
        return $fileURL;
    }

    return null;
}

// Creates a download link
function show_download($fileURL)
{
    return '<a href="' . htmlspecialchars($fileURL) . '" download class="btn btn-success">
                Download Image
            </a>';
}

// Receive form data
$participantName = $_POST['participantName'] ?? '';
$contestTitle = $_POST['contestTitle'] ?? '';
$category = $_POST['category'] ?? '';
$description = $_POST['description'] ?? '';

// Upload image
$imagePath = upload_file($category);

?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="UTF-8">

    <title>Submission Result</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

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

<div class="container mt-5">

    <div class="card bg-secondary text-light">

        <div class="card-body">

            <h2 class="text-center">
                Contest Entry Submitted
            </h2>

            <hr>

            <!-- Display submitted information -->

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

            // Display uploaded image if upload succeeded
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