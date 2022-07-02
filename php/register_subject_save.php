<?php
session_start();
// Check user session and student (3)
if (isset($_SESSION['userID']) && $_SESSION['userLevel'] == 3) {
    // Check if submit button is clicked
    if (isset($_POST['subjectButton'])) {
        // Must choose at least one subject
        if ((!empty($_POST["Mathematics"])) || (!empty($_POST["AddMaths"])) || (!empty($_POST["Physics"])) || (!empty($_POST["Chemistry"])) || (!empty($_POST["Biology"]))) {
            // Connect to database
            $con = mysqli_connect('localhost', 'root', '', 'smartetuition') or die(mysqli_error($con));

            // Query
            $query = "SELECT * FROM user, class WHERE userID=" . $_SESSION['userID'];
            $res = mysqli_query($con, $query);
            $r = mysqli_fetch_assoc($res);

            $stuID = $r['userID'];
            $stuUname = $r['userUname'];
            $registerApproval = 3; // 1- approved 2- declined  3- pending
            date_default_timezone_set('Asia/Singapore');
            $date = date('d-m-y');

            // Upload image (where file name is username-date.extension)
            $extension  = pathinfo($_FILES["fileToUpload"]["name"], PATHINFO_EXTENSION);
            $target_dir = "../user/paymentProof/";
            $file_name = $stuUname . "-" . $date . "." . $extension;
            $target_file = $target_dir . $file_name;
            $source = $_FILES["fileToUpload"]["tmp_name"];

            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION)); // file type to lowercase
            $check = getImageSize($source);

            /*if ($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }

            // Check if file already exists
            if (file_exists($target_file)) {
                echo "Sorry, file already exists.";
                $uploadOk = 0;
            }*/
            // Check file size
            if ($_FILES["fileToUpload"]["size"] > 5000000) {
                echo "Sorry, your file is too large.";
                $uploadOk = 0;
            }
            // Allow certain file formats
            if ($imageFileType != "pdf" && $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
                echo "Sorry, only PDF, JPG, JPEG and PNG files are allowed.";
                $uploadOk = 0;
            }
            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                echo "Sorry, your file was not uploaded.";
                header("Location: register_subject.php");
                // if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($source, $target_file)) {
                    echo "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.";

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

                    // Insert into database for each subject
                    if (isset($_POST['Mathematics'])) {
                        $q = "INSERT INTO register(classID, stuID, adminID, proofPayment, registerApproval) VALUES ('$maths', '$stuID', 1, '$target_file', '$registerApproval')";
                        mysqli_query($con, $q);
                    }
                    if (isset($_POST['AddMaths'])) {
                        $q = "INSERT INTO register(classID, stuID, adminID, proofPayment, registerApproval) VALUES ('$addmaths', '$stuID', 1, '$target_file', '$registerApproval')";
                        mysqli_query($con, $q);
                    }
                    if (isset($_POST['Physics'])) {
                        $q = "INSERT INTO register(classID, stuID, adminID, proofPayment, registerApproval) VALUES ('$physics', '$stuID', 1, '$target_file', '$registerApproval')";
                        mysqli_query($con, $q);
                    }
                    if (isset($_POST['Chemistry'])) {
                        $q = "INSERT INTO register(classID, stuID, adminID, proofPayment, registerApproval) VALUES ('$chemistry', '$stuID', 1, '$target_file', '$registerApproval')";
                        mysqli_query($con, $q);
                    }
                    if (isset($_POST['Biology'])) {
                        $q = "INSERT INTO register(classID, stuID, adminID, proofPayment, registerApproval) VALUES ('$biology', '$stuID', 1, '$target_file', '$registerApproval')";
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
                } else {
                    echo "Sorry, there was an error uploading your file.";
                    header("Location: register_subject.php");
                }
            }

            // Clear results and close the connection
            mysqli_free_result($res);
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
