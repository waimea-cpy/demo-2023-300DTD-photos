<?php

    require_once 'common-top.php';

    echo '<section>';

    echo '<h2>Adding New Comment...</h2>';

    // Get submitted data
    $photo   = $_POST['photo'];
    $author  = $_POST['author'];
    $comment = $_POST['comment'];

    // Add new user to the DB
    $sql = 'INSERT INTO comments (photo, author, comment)
            VALUES (?, ?, ?)';

    modifyRecords( $sql, 'iis', [$photo, $author, $comment] );

    // Inform the user of success and head back to home page
    showStatus( 'New comment posted successfully', 'success' );

    addRedirect( 2000, 'show-photo.php?id='.$photo );

    echo '</section>';

    require_once 'common-bottom.php';
?>
