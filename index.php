<?php

    require_once 'common-top.php';

    $sql = 'SELECT photos.id,
                   photos.file,
                   photos.title,
                   photos.description,
                   photos.timestamp,
                   users.forename,
                   users.surname,
                   users.username
            FROM photos
            LEFT JOIN users ON photos.user = users.id
            ORDER BY photos.timestamp DESC';

    $photos = getRecords( $sql );

    echo '<section id="photos-list" class="columns">';

    foreach( $photos as $photo ) {
        echo '<a class="card photo" href="show-photo.php?id='.$photo['id'].'">';
        echo   '<img src="'.$photo['file'].'" alt="Photo of '.$photo['title'].'">';
        echo   '<h3>'.$photo['title'].'</h3>';
        // echo   '<p>'.$photo['description'].'</p>';
        echo   '<p>By '.$photo['forename'].' '.$photo['surname'].'</p>';
        echo '</a>';
    }

    echo '</section>';

    require_once 'common-bottom.php';

?>

