<?php
    $submitPressed = filter_input(INPUT_POST, "btnSubmit");
    if (isset($submitPressed)){
        $name = filter_input(INPUT_POST, "txtName");
        $link = mysqli_connect('localhost', 'root', '', 'library', '3306') 
        or die(mysqli_connect_error());
        $query = "INSERT INTO genre(name) VALUES(?)";
        mysqli_autocommit($link, false);

        if ($stmt = mysqli_prepare($link, $query)){
            mysqli_stmt_bind_param($stmt, 's', $name);
            mysqli_stmt_execute($stmt) or die(mysqli_error($link));
            mysqli_commit($link);
            mysqli_stmt_close($stmt);
        }
        mysqli_close($link);
        }
?>

    <form action="" method="POST">
        <label for="nameId">Name</label>
        <input type="text" id="nameId" name="txtName" placeholder="New Genre Name" maxlength="100">
        <input type="submit" value="Submit" name="btnSubmit">    
    </form>

    <table border=1>
        <thead>
            <th>ID</th>
            <th>NAME</th>
        </thead>
        <tbody>
            <?php
            $link = mysqli_connect('localhost', 'root', '', 'library', '3306')
                or die(mysqli_connect_error());
            $query = "SELECT * FROM genre ORDER BY name";
            if ($result = mysqli_query($link, $query) or die(mysqli_error($link))) {
                while ($row = mysqli_fetch_array($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['name'] . "</td>";
                    echo "</tr>";
                }
                mysqli_close($link);
            };
            ?>
        </tbody>
    </table>
