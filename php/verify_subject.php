<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS -->
    <link rel="stylesheet" href="../css/style2.css">

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

    <title>Verification System</title>
</head>

<body>
    <?php
    session_start();


    // Connect to database
    $con = mysqli_connect('localhost', 'root', '', 'smartetuition') or die(mysqli_error($con));

    /*while ($r = mysqli_fetch_assoc($res)) {
            echo "<tr><td>" . $r['classTime'] . "</td><td>" . $r['classSubject'] . "</td><td>" . $r['classDay'] . "</td></tr>";
        }*/
    ?>
    <!-- =============== Navigation ================ -->
    <div class="container">
        <?php
        //Admin's navigation
        if (isset($_SESSION['userID']) && $_SESSION['userLevel'] == 1) { ?>
            <div class="navigation">
                <ul>
                    <li>
                        <a href="admin.php">
                            <span class="icon">
                                <img src="../images/logocircle.png" alt="Logo Let Us Score!" id="logoLUS" />
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="admin.php">
                            <span class="icon">
                                <ion-icon name="home-outline"></ion-icon>
                            </span>
                            <span class="title">Dashboard</span>
                        </a>
                    </li>

                    <li>
                        <a href=".php">
                            <span class="icon">
                                <ion-icon name="create-outline"></ion-icon>
                            </span>
                            <span class="title">User Data</span>
                        </a>
                    </li>

                    <li>
                        <a href="manage_class.php">
                            <span class="icon">
                                <ion-icon name="create-outline"></ion-icon>
                            </span>
                            <span class="title">Class Details</span>
                        </a>
                    </li>


                    <li>
                        <a href="verify_subject.php">
                            <span class="icon">
                                <ion-icon name="person-add-outline"></ion-icon>
                            </span>
                            <span class="title">Class Verification</span>
                        </a>
                    </li>

                    <li>
                        <a href=feedback.php>
                            <span class="icon">
                                <ion-icon name="help-outline"></ion-icon>
                            </span>
                            <span class="title">Feedback</span>
                        </a>
                    </li>

                    &nbsp;

                    <li>
                        <a href=logout.php>
                            <span class="icon" style="color:#ed2146;">
                                <ion-icon name="log-out-outline"></ion-icon>
                            </span>
                            <span class="title" style="color:#ed2146;">Sign Out</span>
                        </a>
                    </li>
                </ul>
            </div>
        <?php
        }
        ?>
        <!-- ========================= Main ==================== -->
        <div class="main">
            <div class="topbar">
                <div class="toggle">
                    <script src="https://cdn.lordicon.com/xdjxvujz.js"></script>
                    <lord-icon src="https://cdn.lordicon.com/xhebrhsj.json" trigger="loop-on-hover" colors="primary:#121331" state="hover" style="width:45px;height:45px">
                    </lord-icon>
                </div>

                <!-- Time update (every 1s) on top -->
                <span>
                    <script>
                        setInterval(function() {
                            document.getElementById('current-time').innerHTML = new Date().toString();
                        }, 1);
                    </script>
                    <div style='font-family: "Helvetica", sans-serif; font-size: 20px; font-weight: 500;' id='current-time'></div>
                </span>

                <!--
                <div class="search">
                    <label>
                        <input type="text" placeholder="Search here" />
                        <ion-icon name="search-outline"></ion-icon>
                    </label>
                </div>
                
                <div class="user">
                    <img src="../images/icons/user-solid.svg" alt="" />
                </div>
                -->
            </div>
            <!-- ================ Order Details List ================= -->
            <?php
            // Admin's
            if (isset($_SESSION['userID']) && $_SESSION['userLevel'] == 1) { ?>
                <div class="details" style="display: inline-block;">
                    <div class="recentOrders">
                        <!-- 1st -->
                        <div class="cardHeader">
                            <h2>Class Verification System</h2>
                        </div>
                        <br><br>
                        <h3> Students' Registration Table (Pending): </h3>
                        <br>
                        <?php
                        // Construct and run query to list all pending subjects registration
                        $q = "SELECT * FROM user u, register r, class c WHERE u.userID=r.stuID AND r.classID=c.classID AND registerApproval=3 ORDER BY r.stuID ASC";
                        $res = mysqli_query($con, $q);
                        // Construct and run query to check for existing class
                        $num = mysqli_num_rows($res);
                        if ($res) {
                            if ($num > 0) {
                        ?>
                                <table style="width: 1500px;">
                                    <thead>
                                        <tr>
                                            <td style="text-align: left;">Subject</td>
                                            <td style="text-align: left;">Student Name</td>
                                            <td style="text-align: left;">Registration Date</td>
                                            <td style="text-align: left;">Proof of Payment</td>
                                            <td style="text-align: left;">Registration Status</td>
                                            <td style="text-align: right;">Action</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        while ($r = mysqli_fetch_assoc($res)) {
                                            // Register text for 1-3 (from database)
                                            if ($r['registerApproval'] == 1)
                                                $registerText = "Approved";
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
                                                            <td style='text-align: left;'>" . $r['classSubject'] . "</td>
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
                                        ?>
                                    </tbody>
                                </table>
                        <?php
                            }
                        }
                        mysqli_free_result($res);
                        ?>
                    </div>
                </div>

                <!-- 2nd -->
                <div class="details" style="display: inline-block;">
                    <div class="recentOrders">
                        <!--
                        <div class="cardHeader">
                            <h2>Class Verification System</h2>
                        </div>
                        -->
                        <br><br>
                        <h3> Students' Registration Table (Approved and Declined): </h3>
                        <br>
                        <?php
                        // Construct and run query to list all pending subjects registration
                        $q = "SELECT * FROM user u, register r, class c WHERE u.userID=r.stuID AND r.classID=c.classID AND (registerApproval=1 OR registerApproval=2) ORDER BY r.stuID ASC";
                        $res = mysqli_query($con, $q);
                        // Construct and run query to check for existing class
                        $num = mysqli_num_rows($res);
                        if ($res) {
                            if ($num > 0) {
                        ?>
                                <table style="width: 1500px;">
                                    <thead>
                                        <tr>
                                            <td style="text-align: left;">Subject</td>
                                            <td style="text-align: left;">Student Name</td>
                                            <td style="text-align: left;">Registration Date</td>
                                            <td style="text-align: left;">Proof of Payment</td>
                                            <td style="text-align: left;">Registration Status</td>
                                            <td style="text-align: left;">Action</td>
                                            <td style="text-align: right;">Deletion</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        while ($r = mysqli_fetch_assoc($res)) {
                                            // Register text for 1-3 (from database)
                                            if ($r['registerApproval'] == 1)
                                                $registerText = "Approved";
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
                                                            <td style='text-align: left;'>" . $r['classSubject'] . "</td>
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
                                                                ";
                                            if ($r['registerApproval'] == 1) {
                                                echo "<select id='action' name='action' required>
                                                                    <option value hidden disabled selected>‎</option>
                                                                    <option value='2'>Decline</option>
                                                                    <option value='3'>Pending</option>
                                                                    </select>";
                                            } else if ($r['registerApproval'] == 2) {
                                                echo "<select id='action' name='action' required>
                                                                    <option value hidden disabled selected>‎</option>
                                                                    <option value='1'>Approve</option>
                                                                    <option value='3'>Pending</option>
                                                                    </select>";
                                            }
                                            echo "
                                                                <button type='submit' name='updateButton'>Update</button>
                                                            </td>
                                                            <td>
                                                                <button type='submit' name='deleteVerifyButton' onclick='deleteButton()'>
                                                                    <img src='../images/icons/trash-can-solid.svg' height='25px' />
                                                                </button>
                                                            </td>
                                                        </tr>";
                                            echo "</form>";
                                        }
                                        ?>

                                    </tbody>
                                </table>
                        <?php
                            }
                        }
                        ?>
                    </div>
                </div>
            <?php

            } else {
                header("Location: verify_subject.php");
            }
            ?>
            <!-- JS scripts -->
            <script src="../js/dash.js"></script>
            <script src="../js/script.js"></script>

            <script>
                // To change action to not disabled for delete button to work
                function deleteButton() {
                    document.getElementById("action").setAttribute("disabled", "");
                }
                // ------- Picture Popup
                // Get the modal
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
                } // Get the <span> element that closes the modal
                var span = document.getElementsByClassName("close")[0];

                // When the user clicks on <span> (x), close the modal
                span.onclick = function() {
                    modal.style.display = "none";
                }
            </script>

            <!-- ionicons -->
            <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
            <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

            <?php
            // Clear results and close the connection
            mysqli_close($con);
            mysqli_free_result($res);
            ?>
</body>

</html>