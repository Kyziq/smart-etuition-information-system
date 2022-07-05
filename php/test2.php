<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    $userUname = $_GET['username'];
    // Connect to database
    $con = mysqli_connect('localhost', 'root', '', 'smartetuition') or die(mysqli_error($con));
    // Construct and run query to check if username is taken
    $q = "SELECT * FROM user WHERE userUname='$userUname'";
    $res = mysqli_query($con, $q);
    $rows = mysqli_num_rows($res);
    ?>
    <script>
        var row = "<?php echo json_encode($rows); ?>";
        if (row != 0) {
            // Fail popup
            document.write("failed");

            //window.location.href = 'register.php';
        }
    </script>
</body>

</html>