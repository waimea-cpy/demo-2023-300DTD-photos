
<section>
    <form method="POST" action="process-new-comment.php">

        <header>
            <h2>Add a New Comment</h2>
        </header>

        <input name="author" type="hidden" value=<?= $_SESSION['userID'] ?>>

        <input name="photo" type="hidden" value=<?= $photoID ?>>

        <label>Comment</label>
        <textarea name="comment" required></textarea>

        <input type="submit" value="Submit Comment">
    </form>
</section>
