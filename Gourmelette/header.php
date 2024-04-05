<html>
    <head>
        <title>Database Connection Gourmelette</title>
    </head>
    <body>
        <?php
        //connect to server
        $connect = mysqli_connect("localhost", "root", "", "gourmelette");

        if (!$connect)
        {
            die('ERROR:' .mysqli_connect());
        }
        //echo 'successful connect';
        ?>
    </body>
</html>