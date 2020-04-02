<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    

<?php
    echo '<h1>Hello world</h1>'
?>

    <form action="index.php" method="get">
        Password: <input type="text" name="password" value="">
        <input type="submit" value="Submit">
    </form><br>

    <?php $passIndex = $_GET['password']; ?>

    <a href="/export.php?password=<?php echo $_GET['password']; ?>">/export.php?password=<?php echo $_GET['password']; ?></a>
    <br>


</body>
</html>
