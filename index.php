<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="David Adinatha Effendi">
    <script src="js/cmd_script.js"></script>
</head>
<body>
    <a href="?mn=home">Home</a>
    <a href="?mn=genre">Genre Page</a>
    
    <?php
        $menu = filter_input(INPUT_GET, "mn");
        switch($menu){
            case "home":
                include_once 'pages/home.php';
                break;
            case "genre":
                include_once 'pages/genre_page.php';
                break;
            case "genre_update":
                include_once 'pages/genre_edit_page.php';
                break;
            default:
                include_once 'pages/home.php';
        }
    ?>

</body>
</html>