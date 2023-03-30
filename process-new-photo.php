<?php

    require_once 'common-top.php';

    echo '<section>';

    echo '<h2>Uploading Your Photo...</h2>';

    $title       = $_POST['title'];
    $description = $_POST['description'];

    $photo       = $_FILES['photo'];

    $user        = $_SESSION['userID'];


    // Upload the image to the server and get the new randomised filename
    $fileLocation = uploadImage( $photo, 'uploads', true );

    showStatus( 'Image uploaded', 'success' );

    // Setup query
    $sql = 'INSERT INTO photos (user, file, title, description)
            VALUES (?, ?, ?, ?)';

    // Send data to server
    modifyRecords( $sql, 'isss',
                   [$user, $fileLocation, $title, $description] );

    showStatus( 'Photo posted', 'success' );

    echo '</section>';

    addRedirect( 2000, 'index.php' );

    require_once 'common-bottom.php';
?>
