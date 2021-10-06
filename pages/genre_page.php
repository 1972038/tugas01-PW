<?php
$command = filter_input(INPUT_GET, 'tok');
if (isset($command) && $command == 'del') {
    $deletedId = filter_input(INPUT_GET, 'did');
    if (isset($deletedId)) {
        $link = new PDO("mysql:host=localhost; dbname=library", "root", "");
        $link->setAttribute(PDO::ATTR_AUTOCOMMIT, false);
        $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = "DELETE FROM genre WHERE id = ?";

        $stmt = $link->prepare($query);

        $stmt->bindParam(1, $deletedId, PDO::PARAM_INT);
        $link->beginTransaction();
        if ($stmt->execute()) {
            $link->commit();
        } else {
            $link->rollBack();
        }
        $link = null;
    }
}

$submitted = filter_input(INPUT_POST, 'btnSubmit');
if ($submitted) {
    $name = filter_input(INPUT_POST, 'txtName');
    $link = new PDO("mysql:host=localhost; dbname=library", "root", "");
    $link->setAttribute(PDO::ATTR_AUTOCOMMIT, false);
    $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query = "INSERT INTO genre(name) VALUES(?)";
    $stmt = $link->prepare($query);
    $stmt->bindParam(1, $name, PDO::PARAM_STR);
    $link->beginTransaction();
    if ($stmt->execute()) {
        $link->commit();
    } else {
        $link->rollBack();
    }
    $link = null;
}
?>

<h1> Genre Page </h1>
<form action="" method="POST">
    <label for="nameId">Name</label>
    <input type="text" id="nameId" name="txtName" placeholder="New Genre Name" maxlength="100">
    <input type="submit" value="Submit" name="btnSubmit">
</form>

<table >
    <thead>
        <th>Id</th>
        <th>NAME</th>
        <th>Action</th>
    </thead>
    <tbody>
        <?php
        $link = new PDO("mysql:host=localhost; dbname=library", "root", "");
        $link->setAttribute(PDO::ATTR_AUTOCOMMIT, false);
        $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = "SELECT id, name FROM genre ORDER BY id";
        $genres = $link->query($query);
        foreach ($genres as $genre) {
            echo "<tr>";
            echo "<td>" . $genre['id'] . "</td>";
            echo "<td>" . $genre['name'] . "</td>";
            echo '<td><button onclick="editGenre(' . $genre['id'] . ')">Edit</button>
            <button onclick="deleteGenre(' . $genre['id'] . ')">Delete</button></td>';
            echo "<tr>";
        }

        $link = null;
        ?>
    </tbody>
</table>