<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Basic CRUD App</title>
    <link rel="stylesheet" href="./css/datatables.min.css"/>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>

    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light py-3">
            <div class="container">
                <a class="navbar-brand" href="<?= htmlentities($_SERVER['PHP_SELF']) ?>/../index.php"><img src="./images/logo.png" class="w-75" alt="logo" /></a>
                <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="collapsibleNavId">
                    <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                        <li class="nav-item <?php if ($currentPage === 'home') echo 'active'; ?>">
                            <a class="nav-link" href="<?= htmlentities($_SERVER['PHP_SELF']) ?>/../index.php">Home</a>
                        </li>
                        <li class="nav-item <?php if ($currentPage === 'about') echo 'active'; ?>">
                            <a class="nav-link" href="<?= htmlentities($_SERVER['PHP_SELF']) ?>/../about.php">About Us</a>
                        </li>
                        <li class="nav-item <?php if ($currentPage === 'contact') echo 'active'; ?>">
                            <a class="nav-link" href="<?= htmlentities($_SERVER['PHP_SELF']) ?>/../contact.php">Contact Us</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>