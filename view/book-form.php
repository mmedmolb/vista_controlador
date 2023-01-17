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
    <label for="isbn">Isbn: </label><br>
    <input type="text" isbn="isbn" value="<?php echo htmlentities($isbn); ?>">
    <br>
    <label for="title">Title: </label><br>
    <input type="text" isbn="title" value="<?php echo htmlentities($title); ?>">
    <br>
    <label for="author">Author: </label><br>
    <input type="text" isbn="author" value="<?php echo htmlentities($author); ?>">
    <br>
    <label for="country">Country: </label><br>
    <textarea isbn="country"><?php echo htmlentities($country); ?></textarea>
    <br>

    <input type="hidden" isbn="form-submitted" value="1">
    <input type="submit" value="Submit">
    <button type="button" onclick="location.href='index.php'">Cancel</button>
</form>
</body>
</html>