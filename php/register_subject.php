<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style2.css">
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
                        <a href="studentdetails.html">
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
                        <a href="view_class.php">
                            <span class="icon">
                                <ion-icon name="create-outline"></ion-icon>
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

                    <li>
                        <a href=logout.php>
                            <span class="icon">
                                <ion-icon name="log-out-outline"></ion-icon>
                            </span>
                            <span class="title">Sign Out</span>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- ========================= Main ==================== -->
            <div class="main">
                <div class="topbar">
                    <div class="toggle">
                        <script src="https://cdn.lordicon.com/xdjxvujz.js"></script>
                        <lord-icon src="https://cdn.lordicon.com/xhebrhsj.json" trigger="loop-on-hover" colors="primary:#121331" state="hover" style="width:45px;height:45px">
                        </lord-icon>
                    </div>

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
                                $q = "select userName from user where userID=" . $_SESSION['userID'];
                                $res = mysqli_query($con, $q);
                                $r = mysqli_fetch_assoc($res);
                                echo $r['userName'];
                                ?>
                                's Subject Registration
                            </h2>

                        </div>
                        <p>Select the course(s) from the list below for your SPM journey in Let Us Score. You may either take only one, some, or include them all. It would cost RM50 for each individual class.</p>
                        <form id="subjectForm" method="post" action="register_subject_save.php" enctype="multipart/form-data">
                            <table>
                                <thead>
                                    <tr>
                                        <td style="width: 300px;">Subject</td>
                                        <td style="width: 200px;">Time</td>
                                        <td style="width: 400px;">Saturday | Slots</td>
                                        <td style="width: 150px;">Sunday | Slots</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Mathematics</td>
                                        <td>8:00 a.m. - 9:00 a.m.</td>
                                        <td>
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
                                            /10
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
                                            /10
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Additional Mathematics</td>
                                        <td>9:00 a.m. - 10:00 a.m.</td>
                                        <td>
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
                                            /10
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
                                            /10
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Physics</td>
                                        <td>1:00 p.m. - 2:00 p.m.</td>
                                        <td>
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
                                            /10
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
                                            /10
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Chemistry</td>
                                        <td>2:00 p.m. - 3:00 p.m.</td>
                                        <td>
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
                                            /10
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
                                            /10
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Biology</td>
                                        <td>3:00 p.m. - 4:00 p.m.</td>
                                        <td>
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
                                            /10
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
                                            /10
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <br>
                            <b>Payment Proof:</b> &nbsp;
                            <input type="file" name="fileToUpload" id="fileToUpload" required>
                            <br><br>

                            <button type="submit" class="btn" name="subjectButton" value="Submit">
                                <span class="btnText"> Submit </span>
                            </button>
                            <button type="reset" class="btn">
                                <span class="btnText"> Reset </span>
                            </button>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php
                        }
    ?>
    <!-- =========== Scripts =========  -->
    <script src="../js/dash.js"></script>

    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
<?php

        // Clear results and close the connection
        mysqli_close($con);
        mysqli_free_result($res);
    } else {
        header("Location: login.php");
    }
?>
</body>

</html>