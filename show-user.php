<?php

    require_once 'common-top.php';

    if( !isset( $_GET['id'] ) || empty( $_GET['id'] ) ) showErrorAndDie( 'Missing user ID' );

    $userID = $_GET['id'];

    $sql = 'SELECT username,
                   forename,
                   surname
            FROM users
            WHERE id = ?';

    $users = getRecords( $sql, 'i', $userID );

    if( count( $users ) == 0 ) showErrorAndDie( 'Invalid user ID' );

    $user = $users[0];

    $sql = 'SELECT id,
                   file,
                   title
            FROM photos
            WHERE user = ?
            ORDER BY timestamp DESC';

    $photos = getRecords( $sql, 'i', $userID );

    $sql = 'SELECT comments.id AS cid,
                   comments.comment,
                   photos.id AS pid,
                   photos.title
            FROM comments
            JOIN photos ON comments.photo = photos.id
            WHERE comments.author = ?
            ORDER BY comments.timestamp DESC';

    $comments = getRecords( $sql, 'i', $userID );

    echo '<section id="user-details" class="columns">';
    echo   '<header>';
    echo     '<h1>'.$user['forename'].' '.$user['surname'].'</h1>';
    echo   '</header>';

    echo   '<ul>';
    echo     '<li>Username: <strong>'.$user['username'].'</strong>';
    echo     '<li>Forename: <strong>'.$user['forename'].'</strong>';
    echo     '<li>Surname: <strong>'.$user['surname'].'</strong>';
    echo   '</ul>';
    echo '</section>';


    echo '<section id="photos-list" class="columns">';

    echo   '<header>';
    echo     '<h3>Photos by this user...</h3>';
    echo   '</header>';

    if( count( $photos ) > 0 ) {
        foreach( $photos as $photo ) {
            echo '<a class="card photo" href="show-photo.php?id='.$photo['id'].'">';
            echo   '<img src="'.$photo['file'].'" alt="Photo of '.$photo['title'].'">';
            echo   '<h3>'.$photo['title'].'</h3>';
            echo '</a>';
        }
    }
    else {
        echo '<div>No photos by the user</div>';
    }

    echo '</section>';

    echo '<section id="comments-list" class="columns">';

    echo   '<header>';
    echo     '<h3>Comments by this user...</h3>';
    echo   '</header>';
    echo   '<ul>';

    if( count( $comments ) > 0 ) {
        foreach( $comments as $comment ) {
            echo '<li>';
            echo   'Commented, <span class="accent">"'.$comment['comment'].'"</span> on ';
            echo   '<a href="show-photo.php?id='.$comment['pid'].'">';
            echo     $comment['title'];
            echo   '</a>';
        }
    }
    else {
        echo '<div>No comments by the user</div>';
    }

    echo   '</ul>';
    echo '</section>';

    require_once 'common-bottom.php';

?>

