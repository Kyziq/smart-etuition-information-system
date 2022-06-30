<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subject Registration Saving </title>
</head>

<body>
    <?php
    session_start();
    // Check user session and student (3)
    if (isset($_SESSION['userID']) && $_SESSION['userLevel'] == 3) {
        // Check if submit button is clicked
        if (isset($_POST['subjectButton'])) {
            // Must choose at least one subject
            if (!empty($_GET["Mathematics"]) || !empty($_GET["AddMaths"]) || !empty($_GET["Physics"]) || !empty($_GET["Chemistry"]) || !empty($_GET["Biology"])) {
                // Upload image
                $target_dir = "../user/paymentProof/";
                $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
                $uploadOk = 1;
                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                $check = getImageSize($_FILES["fileToUpload"]["tmp_name"]);
                if ($check !== false) {
                    echo "File is an image - " . $check["mime"] . ".";
                    $uploadOk = 1;
                } else {
                    echo "File is not an image.";
                    $uploadOk = 0;
                }
                /*
                // Check if file already exists
                if (file_exists($target_file)) {
                    echo "Sorry, file already exists.";
                    $uploadOk = 0;
                }*/
                // Check file size
                if ($_FILES["fileToUpload"]["size"] > 500000) {
                    echo "Sorry, your file is too large.";
                    $uploadOk = 0;
                }
                // Allow certain file formats
                if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
                    echo "Sorry, only JPG, JPEG and PNG files are allowed.";
                    $uploadOk = 0;
                }
                // Check if $uploadOk is set to 0 by an error
                if ($uploadOk == 0) {
                    echo "Sorry, your file was not uploaded.";
                    // if everything is ok, try to upload file
                } else {
                    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                        echo "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.";
                    } else {
                        echo "Sorry, there was an error uploading your file.";
                    }
                }


                // Get all the posted items
                if (isset($_POST['Mathematics']))
                    $maths = $_POST['Mathematics'];
                if (isset($_POST['AddMaths']))
                    $addmaths = $_POST['AddMaths'];
                if (isset($_POST['Physics']))
                    $physics = $_POST['Physics'];
                if (isset($_POST['Chemistry']))
                    $chemistry = $_POST['Chemistry'];
                if (isset($_POST['Biology']))
                    $biology = $_POST['Biology'];

                // Connect to database
                $con = mysqli_connect('localhost', 'root', '', 'smartetuition') or die(mysqli_error($con));

                $query = "SELECT * FROM user, class WHERE userID=" . $_SESSION['userID'];
                $result = mysqli_query($con, $query);
                $r = mysqli_fetch_assoc($result);
                $stuID = $r['userID'];
                $registerApproval = 3; // 1- approved 2- declined  3- pending

                // Insert into database for each subject
                if (isset($_POST['Mathematics'])) {
                    $q = "INSERT INTO register(classID, stuID, proofPayment, registerApproval) VALUES ('$maths', '$stuID', '$target_file', '$registerApproval')";
                    mysqli_query($con, $q);
                }
                if (isset($_POST['AddMaths'])) {
                    $q = "INSERT INTO register(classID, stuID, proofPayment, registerApproval) VALUES ('$addmaths', '$stuID', '$target_file', '$registerApproval')";
                    mysqli_query($con, $q);
                }
                if (isset($_POST['Physics'])) {
                    $q = "INSERT INTO register(classID, stuID, proofPayment, registerApproval) VALUES ('$physics', '$stuID', '$target_file', '$registerApproval')";
                    mysqli_query($con, $q);
                }
                if (isset($_POST['Chemistry'])) {
                    $q = "INSERT INTO register(classID, stuID, proofPayment, registerApproval) VALUES ('$chemistry', '$stuID', '$target_file', '$registerApproval')";
                    mysqli_query($con, $q);
                }
                if (isset($_POST['Biology'])) {
                    $q = "INSERT INTO register(classID, stuID, proofPayment, registerApproval) VALUES ('$biology', '$stuID', '$target_file', '$registerApproval')";
                    mysqli_query($con, $q);
                }

                // Success popup
                echo
                "
                <script>
                    alert('Subject(s) registration successful');
                    window.location.href='student.php';
                </script>
                ";

                // Clear results and close the connection
                // mysqli_free_result($res);
                mysqli_close($con);
            } else {
                header("Location: register_subject.php");
            }
        } else {
            header("Location: student.php");
        }
    } else {
        header("Location: login.php");
    }
    ?>
</body>

</html>