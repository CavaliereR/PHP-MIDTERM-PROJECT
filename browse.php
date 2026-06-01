<?php
// Get selected category from URL
$category = $_GET['category'] ?? 'All';

// List of valid categories
$folders = ['Nature', 'Portrait', 'Street'];
?>

<html>
    <head>
        <title>Browse Conteset Entries</title>
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
        <div class="container mt-4">

            <h2 class="text-center">Browse Contest Photos</h2>

            <!-- Category Filter Buttons -->
            <form method="get" class="text-center mb-4">

                <select name="category" class="form-select w-25 mx-auto">

                    <option value="All">All</option>
                    <option value="Nature">Nature</option>
                    <option value="Portrait">Portrait</option>
                    <option value="Street">Street</option>

                </select>

                <br>

                <button class="btn btn-primary">
                    Filter
                </button>
            </form>

            <div class="row">
                <?php
                //Show ALL images

                if ($category === 'All') {
                    foreach ($folders as $folder) {
                        $images = glob("uploads/$folder/*");

                        foreach ($images as $img) {
                            echo "            
                            <div class='col-md-3 mb-3'>
                            <div class='card bg-secondary text-light'>
                                <img src='$img' class='card-img-top'>
                                        <div class='card-body text-center'>
                                        <a href='$img' download class='btn btn-success btn-sm'>
                                        Download
                        </a>

                    </div>

                </div>

            </div>
                            ";
                        }
                    }
                }

                // Show images from selected category
                else {
                    $images = glob("uploads/$category/*");

                    foreach ($images as $img) {
                                echo "
        <div class='col-md-3 mb-3'>

            <div class='card bg-secondary text-light'>

                <img src='$img' class='card-img-top'>

                <div class='card-body text-center'>

                    <a href='$img' download class='btn btn-success btn-sm'>
                        Download
                    </a>

                </div>

            </div>

        </div>
        ";
                    }
                }
                ?>

        </div>
                

    </body>
</html>