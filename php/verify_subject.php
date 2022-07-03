<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verification Page</title>
    <!-- Image beside title -->
    <link rel="icon" href="../images/icon.ico" />
    <!-- Font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <style>
        /* Style the Image Used to Trigger the Modal */
        /* Style the Image Used to Trigger the Modal */
        .img-thumbnail {
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
        }

        .img-thumbnail:hover {
            opacity: 0.7;
        }

        /* The Modal (background) */
        .modal {
            display: none;
            /* Hidden by default */
            position: fixed;
            /* Stay in place */
            z-index: 1;
            /* Sit on top */
            padding-top: 100px;
            /* Location of the box */
            left: 0;
            top: 0;
            width: 100%;
            /* Full width */
            height: 100%;
            /* Full height */
            overflow: auto;
            /* Enable scroll if needed */
            background-color: rgb(0, 0, 0);
            /* Fallback color */
            background-color: rgba(0, 0, 0, 0.9);
            /* Black w/ opacity */
        }

        /* Modal Content (Image) */
        .modal-content {
            margin: auto;
            display: block;
            width: 80%;
            max-width: 700px;
        }

        /* Caption of Modal Image (Image Text) - Same Width as the Image */
        #caption {
            margin: auto;
            display: block;
            width: 80%;
            max-width: 700px;
            text-align: center;
            color: #ccc;
            padding: 10px 0;
            height: 150px;
        }

        /* Add Animation - Zoom in the Modal */
        .modal-content,
        #caption {
            animation-name: zoom;
            animation-duration: 0.6s;
        }

        @keyframes zoom {
            from {
                transform: scale(0)
            }

            to {
                transform: scale(1)
            }
        }

        /* The Close Button */
        .close {
            position: absolute;
            top: 15px;
            right: 35px;
            color: #f1f1f1;
            font-size: 40px;
            font-weight: bold;
            transition: 0.3s;
        }

        .close:hover,
        .close:focus {
            color: #bbb;
            text-decoration: none;
            cursor: pointer;
        }

        /* 100% Image Width on Smaller Screens */
        @media only screen and (max-width: 700px) {
            .modal-content {
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <?php
    session_start();
    if (isset($_SESSION['userID']) && $_SESSION['userLevel'] == 1) {

        // Connect to database
        $con = mysqli_connect('localhost', 'root', '', 'smartetuition') or die(mysqli_error($con));

        // Construct and run query to display username
        $q = "SELECT userName FROM user WHERE userID=" . $_SESSION['userID'];
        $res = mysqli_query($con, $q);
        $r = mysqli_fetch_assoc($res);
        echo "<br><h2>Welcome to Students' Registration Verificiation Page, admin " . $r['userName'] . "</h2><a href=admin.php>Go back to admin dashboard</a><br><br>";

        // Construct and run query to list all pending subjects registration
        $q = "SELECT * FROM user u, register r, class c WHERE u.userID=r.stuID AND r.classID=c.classID AND registerApproval=3 ORDER BY r.stuID ASC";
        $res = mysqli_query($con, $q);

        // Pending
        echo    "<br><h3>Students' Registration Table (Pending):</h3>";
        echo    "<table border='1' style='text-align:center;'>";
        echo    "<tr>
                    <th>Subject</th>
                    <th>Student Name</th>
                    <th>Registration Date</th>
                    <th>Proof of Payment</th>
                    <th>Registration Status</th>
                    <th>Action</th>
                </tr>";
        if (mysqli_num_rows($res) > 0) {
            while ($r = mysqli_fetch_assoc($res)) {
                // Register text for 1-3 (from database)
                if ($r['registerApproval'] == 1)
                    $registerText = "Accepted";
                else if ($r['registerApproval'] == 2)
                    $registerText = "Declined";
                else if ($r['registerApproval'] == 3)
                    $registerText = "Pending";

                $image = $r['proofPayment'];

                // Output all registration in a table
                echo    "<form method='post' action='verify_subject_action.php'>";
                echo    "<tr>
                        <input type='hidden' name='classID' value=" . $r['classID'] . ">
                        <input type='hidden' name='stuID' value=" . $r['stuID'] . ">
                        <td>" . $r['classSubject'] . "</td>
                        <td>" . $r['userName'] . "</td>
                        <td>" . $r['registerDate'] . "</td>
                        <td> 
                            <!-- Trigger the Modal -->
                            <img id='myImg' src='$image' class='img-thumbnail' alt='Proof of Payment' style='width:100%;max-width:100px; max-height:100px;'>
            
                            <!-- The Modal -->
                            <div id='myModal' class='modal'>
                                <!-- The Close Button -->
                                <span class='close'>&times;</span>

                                <!-- Modal Content (The Image) -->
                                <img class='modal-content' id='img01'>

                                <!-- Modal Caption (Image Text) -->
                                <div id='caption'></div>
                            </div>
                        </td>
                        <td>" . $registerText . " </td>
                        <td>
                            <select name='action' required>
                                <option value='1'>Approve</option>
                                <option value='2'>Decline</option>
                            </select>
                            <button type='submit' name='updateButton'>Update</button>
                        </td>
                    </tr>";
                echo "</form>";
            }
        }
        echo "</table>";
    }
    ?>
    <script>
        // Get the modal (picture popup)
        var modal = document.getElementById('myModal');

        // Get the images and bind an onclick event on each to insert it inside the modal
        // use its "alt" text as a caption
        var images = document.querySelectorAll(".img-thumbnail");
        var modalImg = document.getElementById("img01");
        var captionText = document.getElementById("caption");
        for (let i = 0; i < images.length; i++) {
            images[i].onclick = function() {
                modal.style.display = "block";
                modalImg.src = this.src;
                captionText.innerHTML = this.alt;
            }
        }

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }
    </script>
    <?php
    // Clear results and close the connection
    mysqli_free_result($res);
    mysqli_close($con);
    ?>
</body>

</html>