<?php 

require_once 'model/generatePDF.php';

if (isset($_POST['pdf'])) {

    generatePDF();

}

?>
<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Books</title>
    <style type="text/css">
        table.books {
            width: 100%;
        }

        table.books thead {
            background-color: #eee;
            text-align: left;

        }

        table.books thead th {
            border: solid 1px #fff;
            padding: 3px;
        }

        table.books tbody td {
            border: solid 1px #eee;
            padding: 3px;
        }

        a, a:hover, a:active, a:visited {
            color: blue;
            text-decoration: underline;
        }
    </style>
</head>
<body>
<h3>CRUD OOP with MVC</h3>
<div><a href="index.php?op=new">Add new book</a></div>
<br>
<table class="books" border="0" cellpadding="0" cellspacing="0">
    <thead>
    <tr>
        <th><a href="?orderby=isbn">ISBN</a></th>
        <th><a href="?orderby=title">Title</a></th>
        <th><a href="?orderby=author">Author</a></th>
        <th><a href="?orderby=country">Country</a></th>
        <th>&nbsp</th>
        <th>&nbsp</th>
    </tr>
    </thead>

    <tbody>
    <?php foreach ($books as $book) : ?>
        <tr>
            <td>
                <a href="index.php?op=show&id=<?php echo $book->id; ?>"><?php echo htmlentities($book->isbn); ?></a>
            </td>
            <td><?php echo htmlentities($book->title); ?></td>
            <td><?php echo htmlentities($book->author); ?></td>
            <td><?php echo htmlentities($book->country); ?></td>
            <td><a href="index.php?op=edit&id=<?php echo $book->id; ?>">edit</a></td>
            <td><a href="index.php?op=delete&id=<?php echo $book->id; ?>"
                   onclick="return confirm('Are you sure you want to delete?');">delete</a></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<br>
<form method = "post">
<input type="submit" name="pdf" value ="Generar PDF" action="books.php"></input>
</form>
</body>
</html>