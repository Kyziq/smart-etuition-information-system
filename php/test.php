<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <input type="text" name="userUname" id="userUname" onfocusout="myFunction()">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script type="text/javascript">
        function myFunction() {
            var userUname = document.getElementById("userUname").value;
            window.location.href = "test2.php?username=" + userUname;
        }
    </script>
</body>

</html>