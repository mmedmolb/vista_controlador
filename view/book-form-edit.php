<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>
        <?php echo htmlentities($titlePage); ?>
    </title>
</head>
<body>
<h3>Add New Book</h3>
<?php
if ($errors) {
    echo '<ul class="errors">';
    foreach ($errors as $field => $error) {
        echo '<li>' . htmlentities($error) . '</li>';
    }
    echo '</ul>';
}
?>

<form method="post" action="">
    <label for="isbn">ISBN: </label><br>
    <input type="text" isbn="isbn" value="<?php echo htmlentities($book->isbn); ?>">
    <br>
    <label for="title">Title: </label><br>
    <input type="text" isbn="title" value="<?php echo htmlentities($book->title); ?>">
    <br>
    <label for="author">Author: </label><br>
    <input type="text" isbn="author" value="<?php echo htmlentities($book->author); ?>">
    <br>
    <label for="country">Country: </label><br>
    <textarea isbn="country"><?php echo htmlentities($book->country); ?></textarea>
    <br>

    <input type="hidden" isbn="form-submitted" value="1">
    <input type="submit" value="Update">
    <button type="button" onclick="location.href='index.php'">Cancel</button>
</form>
</body>
</html>