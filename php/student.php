<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS -->
    <link rel="stylesheet" href="../css/style2.css">
    <!-- Title -->
    <link rel="icon" href="../images/icon.ico" />
    <title>Student Dashboard</title>
</head>

<body>
    <?php
    // Student Dashboard
    session_start();
    if (isset($_SESSION['userID']) && $_SESSION['userLevel'] == 3)
        // Connect to database 
        include_once 'dbcon.php';
    else
        header("Location: login.php");
    ?>
    <!-- Student Navigation -->
    <div class="container">
        <div class="navigation">
            <!-- Dashboard List -->
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
                    // Data

                    // Construct and run query to check for existing subject registration
                    $q = "SELECT * FROM user u, register r WHERE u.userID=r.stuID AND userID=?";
                    // Created a prepared statement
                    $stmt = mysqli_stmt_init($con);
                    // Prepare the prepared statement
                    if (!mysqli_stmt_prepare($stmt, $q))
                        echo "SQL statement failed";
                    else {
                        // Bind parameters to the placeholder
                        mysqli_stmt_bind_param($stmt, "i", $_SESSION['userID']);
                        // Run parameters inside database
                        mysqli_stmt_execute($stmt);
                        $res = mysqli_stmt_get_result($stmt);
                        $r = mysqli_fetch_assoc($res);
                        $num = mysqli_num_rows($res);
                    }
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
                            //mysqli_free_result($res);
                        }
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
                <!-- Menu toggle -->
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
            </div>

            <!-- Cards -->
            <div class="cardBox">
                <!-- Student name -->
                <div class="card">
                    <div>
                        <div class="numbers">Student</div>
                        <div class="cardName">
                            <?php
                            // Construct and run query
                            $q = "SELECT userName, userGender FROM user WHERE userID=" . $_SESSION['userID'];
                            $res = mysqli_query($con, $q);
                            $r = mysqli_fetch_assoc($res);
                            echo "<i>" . $r['userName'] . "</i>";
                            ?>
                        </div>
                    </div>
                    &nbsp;&nbsp;
                    <div class="iconBx">
                        <?php
                        // Male Icon
                        if ($r['userGender'] == 1) { ?>
                            <script src="https://cdn.lordicon.com/xdjxvujz.js"></script>
                            <lord-icon src="https://cdn.lordicon.com/eszyyflr.json" trigger="loop" delay="300" colors="primary:#192e59,secondary:#192e59" stroke="80" style="width:80px;height:80px">
                            </lord-icon>
                        <?php
                            // Female Icon
                        } else if ($r['userGender'] == 2) { ?>
                            <script src="https://cdn.lordicon.com/xdjxvujz.js"></script>
                            <lord-icon src="https://cdn.lordicon.com/bwnhdkha.json" trigger="loop" delay="300" colors="primary:#192e59,secondary:#192e59" stroke="80" style="width:80px;height:80px">
                            </lord-icon>
                        <?php
                        }
                        ?>
                    </div>
                </div>

                <!-- Total class taken -->
                <div class="card">
                    <div>
                        <div class="numbers">
                            <?php
                            // Construct and run query to check for total classes
                            $q = "SELECT count(c.classID) AS total FROM user u, register r,class c WHERE r.registerApproval=1 AND r.classID=c.classID AND u.userID=r.stuID AND u.userID=" . $_SESSION['userID'];
                            $res = mysqli_query($con, $q);
                            $r = mysqli_fetch_assoc($res);
                            echo $r['total'];
                            ?>
                        </div>
                        <div class="cardName">
                            <?php
                            if ($r['total'] <= 1)
                                echo "Class taken";
                            else if ($r['total'] > 1)
                                echo "Classes taken";
                            ?>
                        </div>
                    </div>
                    &nbsp;&nbsp;
                    <div class="iconBx">
                        <script src="https://cdn.lordicon.com/xdjxvujz.js"></script>
                        <lord-icon src="https://cdn.lordicon.com/stxtcyyo.json" trigger="loop" colors="primary:#192e59" state="loop" style="width:70px;height:70px">
                        </lord-icon>
                    </div>
                </div>

                <!-- Verification status -->
                <div class="card">
                    <div>
                        <div class="numbers">
                            <?php
                            // Construct and run query to check class registration status
                            $q = "SELECT registerApproval FROM register r, user u WHERE r.stuID=" . $_SESSION['userID'] . " AND u.userID=" . $_SESSION['userID'];
                            $res = mysqli_query($con, $q);
                            if ($res != NULL)
                                $r = mysqli_fetch_assoc($res);
                            if ($r != NULL and $r['registerApproval'] == 1)
                                echo "Approved";
                            else if ($r != NULL and $r['registerApproval'] == 2)
                                echo "Declined";
                            else if ($r != NULL and $r['registerApproval'] == 3)
                                echo "Pending";
                            else
                                echo "Invalid";
                            ?>
                        </div>
                        <div class="cardName"><i>Verification Status</i></div>
                    </div>
                    &nbsp;&nbsp;
                    <div class="iconBx">
                        <script src="https://cdn.lordicon.com/xdjxvujz.js"></script>
                        <lord-icon src="https://cdn.lordicon.com/aixyixpa.json" trigger="loop" delay="750" colors="primary:#192e59" state="hover" style="width:70px;height:70px">
                        </lord-icon>
                    </div>
                </div>

                <!-- Contact information -->
                <div class="card">
                    <div>
                        <div class="numbers">Contact</div>
                        <div class="cardName">
                            <i>
                                <a href="mailto:smartetuition@gmail.com">
                                    <ion-icon name="mail-outline"></ion-icon> <b><u>E-mail</u></b>
                                </a>&nbsp;&nbsp;
                                <br>
                                <a href="https://wa.link/cuxs3j" target=_blank">
                                    <ion-icon name="logo-whatsapp"></ion-icon> <b><u>WhatsApp</u></b>
                                </a>
                            </i>
                        </div>
                    </div>
                    &nbsp;&nbsp;
                    <div class="iconBx">
                        <script src="https://cdn.lordicon.com/xdjxvujz.js"></script>
                        <lord-icon src="https://cdn.lordicon.com/uvextprq.json" trigger="loop" delay="750" colors="primary:#192e59" state="hover" style="width:70px;height:70px">
                        </lord-icon>
                    </div>
                </div>
            </div>

            <!-- Student Timetable -->
            <div class="details">
                <div class="recentOrders">
                    <div class="cardHeader">
                        <?php
                        $q = "SELECT userName FROM user WHERE userID = " . $_SESSION['userID'];
                        $res = mysqli_query($con, $q);
                        ?>
                        <h2>My Tuition Timetable</h2>
                    </div>
                    <?php
                    // Construct and run query to display timetable
                    $q =    "SELECT userID, classSubject, classDay, classTime, registerApproval 
                                FROM user u, class c, register r 
                                WHERE userID=" . $_SESSION['userID'] . " AND u.userID=r.stuID AND r.classID=c.classID AND r.registerApproval=1";
                    $res = mysqli_query($con, $q);
                    ?>
                    <table>
                        <thead>
                            <tr>
                                <td>Time</td>
                                <td style="text-align: end;">Saturday</td>
                                <td style="text-align: end;">Sunday</td>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Mathematics -->
                            <tr>
                                <td>8:00 a.m. - 9:00 a.m.</td>
                                <td style="text-align: end;">
                                    <?php
                                    $r = mysqli_fetch_assoc($res);
                                    if ($r === NULL) { ?>
                                        <span class="status return">No Class</span>
                                        <?php
                                        echo "</td>";
                                        echo "<td>";
                                        ?>
                                        <span class="status return">No Class</span>
                                        <?php
                                    } else {
                                        if ($r != NULL && $r['classTime'] == "08:00:00" && $r['classDay'] == "Saturday") {
                                        ?>
                                            <span class="status delivered">
                                                <?php echo $r['classSubject']; ?>
                                            </span>
                                        <?php
                                            $r = mysqli_fetch_assoc($res);
                                        } else {
                                        ?>
                                            <span class="status return">No Class</span>
                                        <?php
                                        }
                                        echo "</td>";
                                        echo "<td>";
                                        if ($r != NULL && $r['classTime'] == "08:00:00" && $r['classDay'] == "Sunday") {
                                        ?>
                                            <span class="status delivered">
                                                <?php echo $r['classSubject']; ?>
                                            </span>
                                        <?php
                                            $r = mysqli_fetch_assoc($res);
                                        } else {
                                        ?>
                                            <span class="status return">No Class</span>
                                    <?php
                                        }
                                    } ?>
                                </td>
                            </tr>
                            <!-- Add. Mathematics -->
                            <tr>
                                <td>9:00 a.m. - 10:00 a.m.</td>
                                <td style="text-align: end;">
                                    <?php
                                    if ($r === NULL) { ?>
                                        <span class="status return">No Class</span>
                                        <?php
                                        echo "</td>";
                                        echo "<td>";
                                        ?>
                                        <span class="status return">No Class</span>
                                        <?php
                                    } else {
                                        if ($r != NULL && $r['classTime'] == "09:00:00" && $r['classDay'] == "Saturday") {
                                        ?>
                                            <span class="status delivered">
                                                <?php echo $r['classSubject']; ?>
                                            </span>
                                        <?php
                                            $r = mysqli_fetch_assoc($res);
                                        } else {
                                        ?>
                                            <span class="status return">No Class</span>
                                        <?php
                                        }
                                        echo "</td>";
                                        echo "<td>";
                                        if ($r != NULL && $r['classTime'] == "09:00:00" && $r['classDay'] == "Sunday") {
                                        ?>
                                            <span class="status delivered">
                                                <?php echo $r['classSubject']; ?>
                                            </span>
                                        <?php
                                            $r = mysqli_fetch_assoc($res);
                                        } else {
                                        ?>
                                            <span class="status return">No Class</span>
                                    <?php
                                        }
                                    } ?>
                                </td>
                            </tr>
                            <!-- Physics -->
                            <tr>
                                <td>1:00 p.m. - 2:00 p.m.</td>
                                <td style="text-align: end;">
                                    <?php
                                    if ($r === NULL) { ?>
                                        <span class="status return">No Class</span>
                                        <?php
                                        echo "</td>";
                                        echo "<td>";
                                        ?>
                                        <span class="status return">No Class</span>
                                        <?php
                                    } else {
                                        if ($r != NULL && $r['classTime'] == "13:00:00" && $r['classDay'] == "Saturday") {
                                        ?>
                                            <span class="status delivered">
                                                <?php echo $r['classSubject']; ?>
                                            </span>
                                        <?php
                                            $r = mysqli_fetch_assoc($res);
                                        } else {
                                        ?>
                                            <span class="status return">No Class</span>
                                        <?php
                                        }
                                        echo "</td>";
                                        echo "<td>";
                                        if ($r != NULL && $r['classTime'] == "13:00:00" && $r['classDay'] == "Sunday") {
                                        ?>
                                            <span class="status delivered">
                                                <?php echo $r['classSubject']; ?>
                                            </span>
                                        <?php
                                            $r = mysqli_fetch_assoc($res);
                                        } else {
                                        ?>
                                            <span class="status return">No Class</span>
                                    <?php
                                        }
                                    } ?>
                                </td>
                            </tr>
                            <!-- Chemistry -->
                            <tr>
                                <td>2:00 p.m. - 3:00 p.m.</td>
                                <td style="text-align: end;">
                                    <?php
                                    if ($r === NULL) { ?>
                                        <span class="status return">No Class</span>
                                        <?php
                                        echo "</td>";
                                        echo "<td>";
                                        ?>
                                        <span class="status return">No Class</span>
                                        <?php
                                    } else {
                                        if ($r != NULL && $r['classTime'] == "14:00:00" && $r['classDay'] == "Saturday") {
                                        ?>
                                            <span class="status delivered">
                                                <?php echo $r['classSubject']; ?>
                                            </span>
                                        <?php
                                            $r = mysqli_fetch_assoc($res);
                                        } else {
                                        ?>
                                            <span class="status return">No Class</span>
                                        <?php
                                        }
                                        echo "</td>";
                                        echo "<td>";
                                        if ($r != NULL && $r['classTime'] == "14:00:00" && $r['classDay'] == "Sunday") {
                                        ?>
                                            <span class="status delivered">
                                                <?php echo $r['classSubject']; ?>
                                            </span>
                                        <?php
                                            $r = mysqli_fetch_assoc($res);
                                        } else {
                                        ?>
                                            <span class="status return">No Class</span>
                                    <?php
                                        }
                                    } ?>
                                </td>
                            </tr>
                            <!-- Biology -->
                            <tr>
                                <td>3:00 p.m. - 4:00 p.m.</td>
                                <td style="text-align: end;">
                                    <?php
                                    if ($r === NULL) { ?>
                                        <span class="status return">No Class</span>
                                        <?php
                                        echo "</td>";
                                        echo "<td>";
                                        ?>
                                        <span class="status return">No Class</span>
                                        <?php
                                    } else {
                                        if ($r != NULL && $r['classTime'] == "15:00:00" && $r['classDay'] == "Saturday") {
                                        ?>
                                            <span class="status delivered">
                                                <?php echo $r['classSubject']; ?>
                                            </span>
                                        <?php
                                            $r = mysqli_fetch_assoc($res);
                                        } else {
                                        ?>
                                            <span class="status return">No Class</span>
                                        <?php
                                        }
                                        echo "</td>";
                                        echo "<td>";
                                        if ($r != NULL && $r['classTime'] == "15:00:00" && $r['classDay'] == "Sunday") {
                                        ?>
                                            <span class="status delivered">
                                                <?php echo $r['classSubject']; ?>
                                            </span>
                                        <?php
                                            $r = mysqli_fetch_assoc($res);
                                        } else {
                                        ?>
                                            <span class="status return">No Class</span>
                                    <?php
                                        }
                                    } ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <?php //mysqli_free_result($res);
                    ?>
                </div>

                <!-- Student details -->
                <div class="recentCustomers">
                    <div class="cardHeader">
                        <h2>My Details</h2>
                    </div>
                    <?php
                    // Data

                    // Construct and run query to check for user details
                    $q = "SELECT * FROM user WHERE userID=?";
                    // Created a prepared statement
                    $stmt = mysqli_stmt_init($con);
                    // Prepare the prepared statement
                    if (!mysqli_stmt_prepare($stmt, $q))
                        echo "SQL statement failed";
                    else {
                        // Bind parameters to the placeholder
                        mysqli_stmt_bind_param($stmt, "i", $_SESSION['userID']);
                        // Run parameters inside database
                        mysqli_stmt_execute($stmt);
                        $res = mysqli_stmt_get_result($stmt);
                        $r = mysqli_fetch_assoc($res);
                    }
                    ?>
                    <table>
                        <tr>
                            <td>
                                <h4>
                                    Name<br />
                                    <span>
                                        <?php
                                        echo $r['userName'];
                                        ?>
                                    </span>
                                </h4>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h4>
                                    Phone<br />
                                    <span>
                                        <?php
                                        echo $r['userPhone'];
                                        ?>
                                    </span>
                                </h4>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h4>
                                    Email<br />
                                    <span>
                                        <?php
                                        echo $r['userEmail'];
                                        ?>
                                    </span>
                                </h4>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h4>
                                    Birthdate<br />
                                    <span>
                                        <?php
                                        echo $r['userBirthdate'];
                                        ?>
                                    </span>
                                </h4>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h4>
                                    Gender<br />
                                    <span>
                                        <?php
                                        if ($r['userGender'] == 1) // 1 == Male, 2 == Female
                                            $gender = "Male";
                                        else if ($r['userGender'] == 2)
                                            $gender = "Female";
                                        echo $gender;
                                        ?>
                                    </span>
                                </h4>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h4>
                                    Address<br />
                                    <span>
                                        <?php
                                        echo $r['userAddress'];
                                        ?>
                                    </span>
                                </h4>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
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