<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style2.css">

    <title>Student Dashboard</title>
    <style>
        #timetable,
        #timetable th,
        #timetable td {
            border: 1.5px solid black;
            border-collapse: collapse;
        }

        #timetable th {
            background-color: lightblue;
        }

        #timetable td {
            text-align: center;
        }
    </style>
</head>

<body>
    <?php
    // Student Main Page
    session_start();
    if (isset($_SESSION['userID']) && $_SESSION['userLevel'] == 3) {

        // Connect to database
        $con = mysqli_connect('localhost', 'root', '', 'smartetuition') or die(mysqli_error($con));

        /*while ($r = mysqli_fetch_assoc($result)) {
            echo "<tr><td>" . $r['classTime'] . "</td><td>" . $r['classSubject'] . "</td><td>" . $r['classDay'] . "</td></tr>";
        }*/
    }

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
                    $result = mysqli_query($con, $q);
                    $num = mysqli_num_rows($result);

                    if ($result) {
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
                            //mysqli_free_result($result);
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
                <span style="color:#192e59">
                    Student
                </span>
                -->
            </div>

            <!-- ======================= Cards ================== -->
            <div class="cardBox">
                <div class="card">
                    <div>
                        <div class="numbers">Welcome</div>
                        <div class="cardName">
                            <?php
                            $q = "select userName from user where userID=" . $_SESSION['userID'];
                            $result = mysqli_query($con, $q);
                            $r = mysqli_fetch_assoc($result);
                            echo "<i>" . $r['userName'] . "</i>";
                            ?>
                        </div>
                    </div>
                    <div class="iconBx">
                        <script src="https://cdn.lordicon.com/xdjxvujz.js"></script>
                        <lord-icon src="https://cdn.lordicon.com/becxqsdr.json" trigger="loop" delay="750" colors="primary:#192e59" state="hover" style="width:80px;height:80px">
                        </lord-icon>
                    </div>
                </div>

                <div class="card">
                    <div>
                        <div class="numbers">1</div>
                        <div class="cardName">
                            <i>Class Taken</i>

                        </div>
                    </div>

                    <div class="iconBx">
                        <script src="https://cdn.lordicon.com/xdjxvujz.js"></script>
                        <lord-icon src="https://cdn.lordicon.com/stxtcyyo.json" trigger="loop" colors="primary:#192e59" state="loop" style="width:70px;height:70px">
                        </lord-icon>
                    </div>
                </div>

                <div class="card">
                    <div>
                        <div class="numbers">Approved</div>
                        <div class="cardName"><i>Verification Status</i></div>
                    </div>

                    <div class="iconBx">
                        <script src="https://cdn.lordicon.com/xdjxvujz.js"></script>
                        <lord-icon src="https://cdn.lordicon.com/hjeefwhm.json" trigger="loop" delay="750" colors="primary:#192e59" state="hover" style="width:70px;height:70px">
                        </lord-icon>
                    </div>
                </div>

                <div class="card">
                    <div>
                        <div class="numbers">Contact Us</div>
                        <div class="cardName">
                            <i>
                                Via ‎
                                <a href="mailto:smartetuition@gmail.com">
                                    <ion-icon name="mail-outline"></ion-icon> <b><u>E-mail</u></b>
                                </a>‎
                                <a href="https://wa.link/cuxs3j" target=_blank">
                                    <ion-icon name="logo-whatsapp"></ion-icon> <b><u>WhatsApp</u></b>
                                </a>
                            </i>
                        </div>
                    </div>

                    <div class="iconBx">
                        <script src="https://cdn.lordicon.com/xdjxvujz.js"></script>
                        <lord-icon src="https://cdn.lordicon.com/cnyeuzxc.json" trigger="loop" delay="750" colors="primary:#192e59" state="morph-phone-signal-start" style="width:70px;height:70px">
                        </lord-icon>
                    </div>
                </div>
            </div>

            <!-- ================ TimeTable  ================= -->
            <div class="details">
                <div class="recentOrders">
                    <div class="cardHeader">
                        <h2><?php
                            $q = "select userName from user where userID=" . $_SESSION['userID'];
                            $result = mysqli_query($con, $q);
                            $r = mysqli_fetch_assoc($result);
                            echo $r['userName'];
                            ?> 's Tuition Timetable</h2>
                    </div>
                    <?php
                        // Construct and run query to display timetable
                        $q = "SELECT userID, classSubject, classDay, classTime, registerApproval FROM user u, class c, register r WHERE userID=" . $_SESSION['userID'] . " AND u.userID=r.stuID AND r.classID=c.classID AND r.registerApproval=1";
                        $result = mysqli_query($con, $q);
                    ?>
                    <table>
                        <thead>
                            <tr>
                                <td>Time</td>
                                <td>Saturday</td>
                                <td>Sunday</td>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td>8:00 a.m. - 9:00 a.m.</td>
                                <td>
                                    <?php $r = mysqli_fetch_assoc($result);
                                    if ($r === NULL) { ?>
                                        <span class="status return">No Class</span>
                                        <?php 
                                        echo "</td>";
                                        echo "<td>"; 
                                        ?>
                                        <span class="status return">No Class</span>
                                        <?php
                                    } else {
                                        if ($r != NULL && $r['classTime'] == "08:00:00" && $r['classDay'] == "Saturday") { ?>
                                            <span class="status delivered">
                                                <?php echo $r['classSubject']; ?>
                                            </span>
                                            <?php
                                            $r = mysqli_fetch_assoc($result);
                                        } else { ?>
                                            <span class="status return">No Class</span> <?php
                                        }
                                        echo "</td>";
                                        echo "<td>"; 
                                        if ($r != NULL && $r['classTime'] == "08:00:00" && $r['classDay'] == "Sunday") { ?>
                                            <span class="status delivered">
                                                <?php echo $r['classSubject']; ?>
                                            </span>
                                            <?php
                                            $r = mysqli_fetch_assoc($result);
                                        } else { ?>
                                            <span class="status return">No Class</span> <?php
                                        }
                                    }
                                    echo "</td>"; ?>
                            </tr>

                            <tr>
                                <td>9:00 a.m. - 10:00 a.m.</td>
                                <td>
                                    <?php
                                    if ($r === NULL) {?>
                                        <span class="status return">No Class</span>
                                        <?php 
                                        echo "</td>";
                                        echo "<td>";?>
                                        <span class="status return">No Class</span>
                                        <?php 
                                    } else {
                                        if ($r != NULL && $r['classTime'] == "09:00:00" && $r['classDay'] == "Saturday") {?>
                                            <span class="status delivered">
                                                <?php echo $r['classSubject']; ?>
                                            </span>
                                            <?php
                                            $r = mysqli_fetch_assoc($result);
                                        } else {?>
                                        <span class="status return">No Class</span>
                                        <?php 
                                        }
                                        echo "</td>";
                                        echo "<td>";
                                        if ($r != NULL && $r['classTime'] == "09:00:00" && $r['classDay'] == "Sunday") {?>
                                            <span class="status delivered">
                                                <?php echo $r['classSubject']; ?>
                                            </span>
                                            <?php
                                            $r = mysqli_fetch_assoc($result);
                                        } else {?>
                                        <span class="status return">No Class</span>
                                        <?php 
                                        }
                                    }
                                    echo "</td>
                                            </tr>"
                                    ?>
                            </tr>

                            <tr>
                                <td>1:00 p.m. - 2:00 p.m.</td>
                                <td>
                                    <?php
                                    if ($r === NULL) {?>
                                        <span class="status return">No Class</span>
                                        <?php 
                                        echo "</td>";
                                        echo "<td>";?>
                                        <span class="status return">No Class</span>
                                        <?php 
                                    } else {
                                        if ($r != NULL && $r['classTime'] == "13:00:00" && $r['classDay'] == "Saturday") {?>
                                            <span class="status delivered">
                                                <?php echo $r['classSubject']; ?>
                                            </span>
                                            <?php
                                            $r = mysqli_fetch_assoc($result);
                                        } else {?>
                                        <span class="status return">No Class</span>
                                        <?php 
                                        }
                                        echo "</td>";
                                        echo "<td>";
                                        if ($r != NULL && $r['classTime'] == "13:00:00" && $r['classDay'] == "Sunday") {?>
                                            <span class="status delivered">
                                                <?php echo $r['classSubject']; ?>
                                            </span>
                                            <?php
                                            $r = mysqli_fetch_assoc($result);
                                        } else {?>
                                        <span class="status return">No Class</span>
                                        <?php 
                                        }
                                    }
                                    echo "</td>
                                        </tr>"
                                    ?>

                            <tr>
                                <td>2:00 p.m. - 3:00 p.m.</td>
                                <td>
                                    <?php
                                    if ($r === NULL) {?>
                                        <span class="status return">No Class</span>
                                        <?php 
                                        echo "</td>";
                                        echo "<td>";?>
                                        <span class="status return">No Class</span>
                                        <?php 
                                    } else {
                                        if ($r != NULL && $r['classTime'] == "14:00:00" && $r['classDay'] == "Saturday") {?>
                                            <span class="status delivered">
                                                <?php echo $r['classSubject']; ?>
                                            </span>
                                            <?php
                                            $r = mysqli_fetch_assoc($result);
                                        } else {?>
                                        <span class="status return">No Class</span>
                                        <?php 
                                        }
                                        echo "</td>";
                                        echo "<td>";
                                        if ($r != NULL && $r['classTime'] == "14:00:00" && $r['classDay'] == "Sunday") {?>
                                            <span class="status delivered">
                                                <?php echo $r['classSubject']; ?>
                                            </span>
                                            <?php
                                            $r = mysqli_fetch_assoc($result);
                                        } else {?>
                                        <span class="status return">No Class</span>
                                        <?php 
                                        }
                                    }
                                    echo "</td>
                                    </tr>";
                                    ?>

                            <tr>
                                <td>3:00 p.m. - 4:00 p.m.</td>
                                <td>
                                    <?php
                                    if ($r === NULL) {?>
                                        <span class="status return">No Class</span>
                                        <?php 
                                        echo "</td>";
                                        echo "<td>";?>
                                        <span class="status return">No Class</span>
                                        <?php 
                                    } else {
                                        if ($r != NULL && $r['classTime'] == "15:00:00" && $r['classDay'] == "Saturday") {?>
                                            <span class="status delivered">
                                                <?php echo $r['classSubject']; ?>
                                            </span>
                                            <?php
                                            $r = mysqli_fetch_assoc($result);
                                        } else {?>
                                        <span class="status return">No Class</span>
                                        <?php 
                                        }
                                        echo "</td>";
                                        echo "<td>";
                                        if ($r != NULL && $r['classTime'] == "15:00:00" && $r['classDay'] == "Sunday") {?>
                                            <span class="status delivered">
                                                <?php echo $r['classSubject']; ?>
                                            </span>
                                            <?php
                                            $r = mysqli_fetch_assoc($result);
                                        } else {?>
                                        <span class="status return">No Class</span>
                                        <?php 
                                        }
                                    }
                                    echo "</td>
                                    </tr>";
                                    ?>
                        </tbody>
                    </table>
                    <?php //mysqli_free_result($result);
                    ?>
                </div>

                <!-- ================= Student's Details ================ -->
                <div class="recentCustomers">
                    <div class="cardHeader">
                        <h2>My Details</h2>
                    </div>

                    <table>
                        <tr>
                            <td width="60px">
                            </td>
                            <td>
                                <h4>
                                    Name<br />
                                    <span>
                                        <?php
                                            $q = "select userName from user where userID=" . $_SESSION['userID'];
                                            $result = mysqli_query($con, $q);
                                            $r = mysqli_fetch_assoc($result);
                                            echo $r['userName']; 
                                        ?>
                                    </span>
                                </h4>
                            </td>
                        </tr>

                        <tr>
                            <td width="60px">
                            </td>
                            <td>
                                <h4>
                                    Phone<br />
                                    <span>
                                        <?php
                                            $q = "select userPhone from user where userID=" . $_SESSION['userID'];
                                            $result = mysqli_query($con, $q);
                                            $r = mysqli_fetch_assoc($result);
                                            echo $r['userPhone']; 
                                        ?>
                                    </span>
                                </h4>
                            </td>
                        </tr>

                        <tr>
                            <td width="60px">
                            </td>
                            <td>
                                <h4>
                                    Email<br />
                                    <span>
                                        <?php
                                            $q = "select userEmail from user where userID=" . $_SESSION['userID'];
                                            $result = mysqli_query($con, $q);
                                            $r = mysqli_fetch_assoc($result);
                                            echo $r['userEmail']; 
                                        ?>
                                    </span>
                                </h4>
                            </td>
                        </tr>

                        <tr>
                            <td width="60px">
                            </td>
                            <td>
                                <h4>
                                    Birthdate<br />
                                    <span>
                                        <?php
                                            $q = "select userBirthdate from user where userID=" . $_SESSION['userID'];
                                            $result = mysqli_query($con, $q);
                                            $r = mysqli_fetch_assoc($result);
                                            echo $r['userBirthdate']; 
                                        ?>
                                    </span>
                                </h4>
                            </td>
                        </tr>

                        <tr>
                            <td width="60px">
                            </td>
                            <td>
                                <h4>
                                    Gender<br />
                                    <span>
                                        <?php
                                            $q = "select userGender from user where userID=" . $_SESSION['userID'];
                                            $result = mysqli_query($con, $q);
                                            $r = mysqli_fetch_assoc($result);
                                            if ($r['userGender'] == 1) // 1 == Male, 2 == Female
                                                $gender = "Male";
                                            else if ($r['userGender'] == 2)
                                                $gender = "Female";
                                            echo $gender ;
                                        ?>
                                    </span>
                                </h4>
                            </td>
                        </tr>

                        <tr>
                            <td width="60px">
                            </td>
                            <td>
                                <h4>
                                    Address<br />
                                    <span>
                                        <?php
                                            $q = "select userAddress from user where userID=" . $_SESSION['userID'];
                                            $result = mysqli_query($con, $q);
                                            $r = mysqli_fetch_assoc($result);
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

    <!-- =========== Scripts =========  -->
    <script src="../js/dash.js"></script>

    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
<?php


                        mysqli_close($con);
                        mysqli_free_result($result);
                    } else {
                        header("Location: login.php");
                    }
?>
</body>

</html>