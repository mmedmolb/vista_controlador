<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title><?php echo $book->title; ?></title>
</head>
<body>
<h1><?php echo $book->isbn; ?></h1>
<div>
    <span class="label">Title:</span>
    <?php echo $book->title; ?>
</div>
<div>
    <span class="label">Author:</span>
    <?php echo $book->author; ?>
</div>
<div>
    <span class="label">Country:</span>
    <?php echo $book->country; ?>
</div>
<a href="index.php">Go Back</>
</body>
</html>
