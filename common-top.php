<?php
    require_once 'common-session.php';
    require_once 'common-functions.php';

    // Check if user is logged in
    // i.e. we have valid credentials in session
    $loggedIn = isset( $_SESSION['userID'] );
?>


<!doctype html>

<html>

<head>
    <title>Phlickr</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="css/simple.css">
    <link rel="stylesheet" href="css/styles.css">
</head>

<body class="dark">
    <header>

        <h1><a href="./">Phlickr</a></h1>

<?php
    if( $loggedIn ) {
        echo '<div class="user">';
        echo   $_SESSION['forename'].' '.$_SESSION['surname'].' ';
        echo   '('.$_SESSION['username'].')';
        echo '</div>';
    }
?>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
<?php
    if( $loggedIn ) {
        echo '<li><a href="form-new-photo.php">Upload Photo</a></li>';
        echo '<li><a href="process-logout.php">Logout</a></li>';
    }
    else {
        echo '<li><a href="form-login.php">Login</a></li>';
        echo '<li><a href="form-new-user.php">Create Account</a></li>';
    }
?>
            </ul>
        </nav>


    </header>

    <?php showDebugInfo(); ?>

    <main>

