<?php
    require_once 'common-top.php';
?>

<section>

    <form method="POST"
          action="process-new-photo.php"
          enctype="multipart/form-data">

        <header>
            <h2>Upload a Photo</h2>
        </header>

        <label>Image</label>
        <input name="photo" type="file" required>

        <label>Title</label>
        <input name="title" type="text" required>

        <label>Description</label>
        <textarea name="description"></textarea>

        <input type="submit" value="Upload Photo">
    </form>

</section>

<?php
    require_once 'common-bottom.php';
?>

