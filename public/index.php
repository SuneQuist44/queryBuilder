<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
        require_once $_SERVER['DOCUMENT_ROOT'] . '/queryBuilder/core/misc/autoload.inc.php';
        $result = new account();
    ?>

    <form action="<?php $result->addname(); ?>" method="post">
        <input type="text" placeholder="Name" name="name" />
        <button type="submit" name="name-submit">Create</button>
    </form>

    <form action="<?php $result->updatename(); ?>" method="post">
        <input type="text" placeholder="Update" name="update" />
        <button type="submit" name="update-submit">Update</button>
    </form>

    <form action="<?php $result->deletename(); ?>" method="post">
        <button type="submit" name="delete-submit">Delete</button>
    </form>

    <?php 
        echo $result->getname();
    ?>
</body>
</html>