<?php

    require_once 'common-top.php';

    if( !isset( $_GET['id'] ) || empty( $_GET['id'] ) ) showErrorAndDie( 'Missing photos ID' );

    $photoID = $_GET['id'];

    $sql = 'SELECT photos.title,
                   photos.description,
                   photos.file,
                   photos.timestamp,
                   users.id AS userID,
                   users.username,
                   users.forename,
                   users.surname
            FROM photos
            JOIN users ON photos.user = users.id
            WHERE photos.id = ?';

    $photos = getRecords( $sql, 'i', $photoID );

    if( count( $photos ) == 0 ) showErrorAndDie( 'Invalid photo ID' );

    $photo = $photos[0];

    $sql = 'SELECT comments.comment,
                   comments.timestamp,
                   users.id AS userID,
                   users.username,
                   users.forename,
                   users.surname
            FROM comments
            JOIN users ON comments.author = users.id
            WHERE photo = ?
            ORDER BY timestamp ASC';

    $comments = getRecords( $sql, 'i', $photoID );

    echo '<section id="photo">';
    echo   '<header>';
    echo     '<img src="'.$photo['file'].'" alt="Photo of '.$photo['title'].'">';
    echo   '</header>';

    echo   '<h2>'.$photo['title'].'</h2>';
    echo   '<p>'.text2paras( $photo['description'] ).'</p>';

    echo   '<footer>';
    echo     '<p>Photographer: ';
    echo       '<a href="show-user.php?id='.$photo['userID'].'">';
    echo         '<strong>'.$photo['forename'].' '.$photo['surname'].'</strong>';
    echo       '</a></p>';
    echo     '<p>Uploaded on '.niceDate( $photo['timestamp'] ).' at '.niceTime( $photo['timestamp'] ).'</p>';
    echo   '</footer>';
    echo '</section>';


    echo '<section id="photo-comments">';
    echo   '<header>';
    echo     '<h3>Comments</h3>';
    echo   '</header>';

    if( count( $comments ) > 0 ) {
        foreach( $comments as $comment ) {
            echo '<div class="comment">';
            echo   text2paras( $comment['comment'] );

            echo   '<footer>';
            echo     '<p>Posted by ';
            echo       '<a href="show-user.php?id='.$comment['userID'].'">';
            echo         '<strong>'.$comment['forename'].' '.$comment['surname'].'</strong>';
            echo       '</a></p>';
            echo     '<p>'.daysFromToday( $comment['timestamp'] ).' at '.niceTime( $comment['timestamp'] ).'</p>';
            echo   '</footer>';
            echo '</div>';
        }
    }
    else {
        echo '<div>No comments</div>';
    }

    echo '</section>';

    if( $loggedIn ) {
        include 'form-new-comment.php';
    }

    require_once 'common-bottom.php';

?>

