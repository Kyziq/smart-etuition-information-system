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

    <title>Registration Page</title>
</head>

<body>
    <?php
    session_start();
    // Student's
    if (isset($_SESSION['userID']) && $_SESSION['userLevel'] == 3) {

        // Connect to database
        $con = mysqli_connect('localhost', 'root', '', 'smartetuition') or die(mysqli_error($con));

        /*while ($r = mysqli_fetch_assoc($res)) {
            echo "<tr><td>" . $r['classTime'] . "</td><td>" . $r['classSubject'] . "</td><td>" . $r['classDay'] . "</td></tr>";
        }*/
    ?>
        <!-- =============== Navigation ================ -->
        <div class="container">
            <div class="navigation">
                <ul>
                    <li>
                        <a href="student.php">
                            <span class="icon">
                                <img src="../images/logocircle.png" alt="Logo Let Us Score!" id="logoLUS" />
                            </span>
                            <!-- <span class="title">Let Us Score</span> -->
                        </a>
                    </li>
                    <li>
                        <a href="student.php">
                            <span class="icon">
                                <ion-icon name="home-outline"></ion-icon>
                            </span>
                            <span class="title">Dashboard</span>
                        </a>
                    </li>

                    <li>
                        <a href="edit_details.php">
                            <span class="icon">
                                <ion-icon name="options-outline"></ion-icon>
                            </span>
                            <span class="title">Update Details</span>
                        </a>
                    </li>

                    <li>
                        <?php
                        // Construct and run query to check for existing subject registration
                        $q = "SELECT * FROM user u, register r WHERE u.userID=r.stuID AND userID=" . $_SESSION['userID'];
                        $res = mysqli_query($con, $q);
                        $num = mysqli_num_rows($res);

                        if ($res) {
                            if ($num <= 0) {
                                // Will display subject registration option if student does not register yet
                        ?>
                                <a href=register_subject.php>
                                    <span class="icon">
                                        <ion-icon name="person-add-outline"></ion-icon>
                                    </span>
                                    <span class="title">Register Subject(s)</span>
                                </a>
                            <?php
                                mysqli_free_result($res);
                            }
                            ?>
                    </li>

                    <li>
                        <a href="view_class_student.php">
                            <span class="icon">
                                <ion-icon name="document-text-outline"></ion-icon>
                            </span>
                            <span class="title">Class Details</span>
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

            <!-- Main -->
            <div class="main">
                <div class="topbar">
                    <!-- Options menu toggle -->
                    <div class="toggle">
                        <script src="https://cdn.lordicon.com/xdjxvujz.js"></script>
                        <lord-icon src="https://cdn.lordicon.com/xhebrhsj.json" trigger="loop-on-hover" colors="primary:#121331" state="hover" style="width:45px;height:45px">
                        </lord-icon>
                    </div>

                    <!-- Time update (every 1s) on top -->
                    <span>
                        <div style="position: absolute; right: 500px; top: 5px;">
                            <script src="https://cdn.lordicon.com/xdjxvujz.js"></script>
                            <lord-icon src="https://cdn.lordicon.com/drtetngs.json" trigger="loop-on-hover" colors="primary:#192e59" style="width:50px;height:50px">
                            </lord-icon>
                        </div>
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
                <div class="details" style="display: inline-block;">
                    <div class="recentOrders">
                        <div class="cardHeader">
                            <h2>
                                <?php
                                $q = "SELECT userName FROM user WHERE userID=" . $_SESSION['userID'];
                                $res = mysqli_query($con, $q);
                                $r = mysqli_fetch_assoc($res);
                                echo $r['userName'];
                                ?>
                                's Subject Registration
                            </h2>
                        </div>
                        <div style="text-align: justify; line-height: 30px;">
                            <br>
                            Select the course(s) from the list below for your SPM journey in Let Us Score. You may either take only one, some, or include them all. It would cost <b>RM50</b> for each individual class.
                            <br>
                            <br>
                            <p><b>Transfer to:</b>
                                <br>Let Us Score Sdn. Bhd.
                                <br>7062122458 CIMB Bank
                            </p>
                        </div>

                        <br>
                        <form id="subjectForm" method="post" action="register_subject_save.php" enctype="multipart/form-data">
                            <table style="width: 70%;">
                                <thead>
                                    <tr>
                                        <td style="width: 300px;">Subject</td>
                                        <td style="width: 300px;">Time</td>
                                        <td style="width: 300px; text-align: end;">Saturday | Slots</td>
                                        <td style="width: 300px;">Sunday | Slots</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Mathematics</td>
                                        <td>8:00 a.m. - 9:00 a.m.</td>
                                        <td style="text-align: end;">
                                            <?php
                                            // Query for total student
                                            $q = "SELECT totalStudent FROM class WHERE classID='1'";
                                            $res = mysqli_query($con, $q);
                                            $row = mysqli_fetch_assoc($res);

                                            if ($row['totalStudent'] != 10) {
                                            ?>
                                                <input type="radio" name="Mathematics" value="1"> |
                                            <?php
                                            } else {
                                            ?>
                                                <input type="radio" name="Mathematics" value="1" disabled> |
                                            <?php
                                            }
                                            echo implode(",", $row);
                                            ?>
                                            / 10
                                        </td>
                                        <td>
                                            <?php
                                            // Query for total student
                                            $q = "SELECT totalStudent FROM class WHERE classID='2'";
                                            $res = mysqli_query($con, $q);
                                            $row = mysqli_fetch_assoc($res);

                                            if ($row['totalStudent'] != 10) {
                                            ?>
                                                <input type="radio" name="Mathematics" value="2"> |
                                            <?php
                                            } else {
                                            ?>
                                                <input type="radio" name="Mathematics" value="2" disabled> |
                                            <?php
                                            }
                                            echo implode(",", $row);
                                            ?>
                                            / 10
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Additional Mathematics</td>
                                        <td>9:00 a.m. - 10:00 a.m.</td>
                                        <td style="text-align: end;">
                                            <?php
                                            // Query for total student
                                            $q = "SELECT totalStudent FROM class WHERE classID='3'";
                                            $res = mysqli_query($con, $q);
                                            $row = mysqli_fetch_assoc($res);

                                            if ($row['totalStudent'] != 10) {
                                            ?>
                                                <input type="radio" name="AddMaths" value="3"> |
                                            <?php
                                            } else {
                                            ?>
                                                <input type="radio" name="AddMaths" value="3" disabled> |
                                            <?php
                                            }
                                            echo implode(",", $row);
                                            ?>
                                            / 10
                                        </td>
                                        <td>
                                            <?php
                                            // Query for total student
                                            $q = "SELECT totalStudent FROM class WHERE classID='4'";
                                            $res = mysqli_query($con, $q);
                                            $row = mysqli_fetch_assoc($res);

                                            if ($row['totalStudent'] != 10) {
                                            ?>
                                                <input type="radio" name="AddMaths" value="4"> |
                                            <?php
                                            } else {
                                            ?>
                                                <input type="radio" name="AddMaths" value="4" disabled> |
                                            <?php
                                            }
                                            echo implode(",", $row);
                                            ?>
                                            / 10
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Physics</td>
                                        <td>1:00 p.m. - 2:00 p.m.</td>
                                        <td style="text-align: end;">
                                            <?php
                                            // Query for total student
                                            $q = "SELECT totalStudent FROM class WHERE classID='5'";
                                            $res = mysqli_query($con, $q);
                                            $row = mysqli_fetch_assoc($res);

                                            if ($row['totalStudent'] != 10) {
                                            ?>
                                                <input type="radio" name="Physics" value="5"> |
                                            <?php
                                            } else {
                                            ?>
                                                <input type="radio" name="Physics" value="5" disabled> |
                                            <?php
                                            }
                                            echo implode(",", $row);
                                            ?>
                                            / 10
                                        </td>
                                        <td>
                                            <?php
                                            // Query for total student
                                            $q = "SELECT totalStudent FROM class WHERE classID='6'";
                                            $res = mysqli_query($con, $q);
                                            $row = mysqli_fetch_assoc($res);

                                            if ($row['totalStudent'] != 10) {
                                            ?>
                                                <input type="radio" name="Physics" value="6"> |
                                            <?php
                                            } else {
                                            ?>
                                                <input type="radio" name="Physics" value="6" disabled> |
                                            <?php
                                            }
                                            echo implode(",", $row);
                                            ?>
                                            / 10
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Chemistry</td>
                                        <td>2:00 p.m. - 3:00 p.m.</td>
                                        <td style="text-align: end;">
                                            <?php
                                            // Query for total student
                                            $q = "SELECT totalStudent FROM class WHERE classID='7'";
                                            $res = mysqli_query($con, $q);
                                            $row = mysqli_fetch_assoc($res);

                                            if ($row['totalStudent'] != 10) {
                                            ?>
                                                <input type="radio" name="Chemistry" value="7"> |
                                            <?php
                                            } else {
                                            ?>
                                                <input type="radio" name="Chemistry" value="7" disabled> |
                                            <?php
                                            }
                                            echo implode(",", $row);
                                            ?>
                                            / 10
                                        </td>
                                        <td>
                                            <?php
                                            // Query for total student
                                            $q = "SELECT totalStudent FROM class WHERE classID='8'";
                                            $res = mysqli_query($con, $q);
                                            $row = mysqli_fetch_assoc($res);

                                            if ($row['totalStudent'] != 10) {
                                            ?>
                                                <input type="radio" name="Chemistry" value="8"> |
                                            <?php
                                            } else {
                                            ?>
                                                <input type="radio" name="Chemistry" value="8" disabled> |
                                            <?php
                                            }
                                            echo implode(",", $row);
                                            ?>
                                            / 10
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Biology</td>
                                        <td>3:00 p.m. - 4:00 p.m.</td>
                                        <td style="text-align: end;">
                                            <?php
                                            // Query for total student
                                            $q = "SELECT totalStudent FROM class WHERE classID='9'";
                                            $res = mysqli_query($con, $q);
                                            $row = mysqli_fetch_assoc($res);

                                            if ($row['totalStudent'] != 10) {
                                            ?>
                                                <input type="radio" name="Biology" value="9"> |
                                            <?php
                                            } else {
                                            ?>
                                                <input type="radio" name="Biology" value="9" disabled> |
                                            <?php
                                            }
                                            echo implode(",", $row);
                                            ?>
                                            / 10
                                        </td>
                                        <td>
                                            <?php
                                            // Query for total student
                                            $q = "SELECT totalStudent FROM class WHERE classID='10'";
                                            $res = mysqli_query($con, $q);
                                            $row = mysqli_fetch_assoc($res);

                                            if ($row['totalStudent'] != 10) {
                                            ?>
                                                <input type="radio" name="Biology" value="10"> |
                                            <?php
                                            } else {
                                            ?>
                                                <input type="radio" name="Biology" value="10" disabled> |
                                            <?php
                                            }
                                            echo implode(",", $row);
                                            ?>
                                            / 10
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <br><br>
                            <b>Payment Proof:</b> <br><br>
                            <script src="https://cdn.lordicon.com/xdjxvujz.js"></script>
                            <lord-icon src="https://cdn.lordicon.com/diyeocup.json" trigger="loop" delay="750" colors="primary:#192e59" state="hover-1" style="width:50px;height:50px">
                            </lord-icon>

                            &nbsp;&nbsp;&nbsp;&nbsp;<input type="file" name="fileToUpload" id="fileToUpload" required>
                            <br><br>

                            <p>
                                The file type must be <b>.png, .jpg, .jpeg, or .pdf</b>, and the file size must not exceed <b>5MB</b>.
                            </p>

                            <br>

                            <button type="submit" class="btn" name="subjectButton" value="Submit">
                                <span class="btnText"> Submit </span>
                            </button>

                            &nbsp;&nbsp;&nbsp;

                            <button type="reset" class="btn">
                                <span class="btnText"> Reset </span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
<?php
                        }
                    } else {
                        header("Location: login.php");
                    }
?>
<!-- JS scripts -->
<script src="../js/dash.js"></script>
<script src="../js/script.js"></script>
<!-- ionicons -->
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

<?php
// Clear results and close the connection
mysqli_free_result($res);
mysqli_close($con);
?>
</body>

</html>