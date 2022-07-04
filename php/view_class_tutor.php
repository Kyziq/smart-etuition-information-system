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

    <title>Class Details</title>
</head>

<body>
    <?php
    session_start();
    // Student's
    if (isset($_SESSION['userID']) && $_SESSION['userLevel'] == 2) {

        // Connect to database
        $con = mysqli_connect('localhost', 'root', '', 'smartetuition') or die(mysqli_error($con));
    ?>
        <!-- =============== Navigation ================ -->
        <div class="container">
            <div class="navigation">
                <ul>
                    <li>
                        <a href="tutor.php">
                            <span class="icon">
                                <img src="../images/logocircle.png" alt="Logo Let Us Score!" id="logoLUS" />
                            </span>
                            <!-- <span class="title">Let Us Score</span> -->
                        </a>
                    </li>
                    <li>
                        <a href="tutor.php">
                            <span class="icon">
                                <ion-icon name="home-outline"></ion-icon>
                            </span>
                            <span class="title">Dashboard</span>
                        </a>
                    </li>

                    <li>
                        <a href="edit_details.php">
                            <span class="icon">
                                <ion-icon name="document-text-outline"></ion-icon>
                            </span>
                            <span class="title">User Data</span>
                        </a>
                    </li>

                    <li>
                        <a href="view_class_tutor.php">
                            <span class="icon">
                                <ion-icon name="document-text-outline"></ion-icon>
                            </span>
                            <span class="title">Class Details</span>
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
        </div>

        <!-- ========================= Main ==================== -->
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
            <!-- ================ Classes List ================= -->
            <div class="details" style="display: inline-block;">
                <div class="cardHeader">
                    <h2>
                        <?php
                        $q = "SELECT userName FROM user WHERE userID=" . $_SESSION['userID'];
                        $res = mysqli_query($con, $q);
                        $r = mysqli_fetch_assoc($res);
                        echo $r['userName'];
                        ?>
                        's Classes
                        <br>
                        <br>
                    </h2>
                </div>
                <div class="recentOrders">
                    <?php
                    // Construct and run query to check for existing class
                    $q = "  SELECT c.classID, c.classSubject, c.classTime, c.classLink, c.classDay, c.totalStudent 
                            FROM user u, class c 
                            WHERE c.tutorID=u.userID AND u.userID= " . $_SESSION['userID'];
                    $res = mysqli_query($con, $q);
                    $num = mysqli_num_rows($res);

                    if ($res) {
                        if ($num > 0) {
                    ?>
                            <table style="width: 100%;">
                                <thead>
                                    <tr>
                                        <td>ID</td>
                                        <td>Subject</td>
                                        <td>Day</td>
                                        <td>Time</td>
                                        <td>Link</td>
                                        <td>Total Student(s)</td>
                                        <td>Action (Save)</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <?php
                                        // Construct and run query to list user's classes
                                        while ($r = mysqli_fetch_assoc($res)) {
                                        ?>
                                    <tr>
                                        <td> <?php echo $r["classID"] ?></td>
                                        <td> <?php echo $r["classSubject"] ?></td>
                                        <td> <?php echo $r["classDay"] ?></td>
                                        <td>
                                            <?php
                                            // Class Time Checker
                                            if ($r["classTime"] == "08:00:00")
                                                $time = "8.00 a.m. - 9.00 a.m.";
                                            else if ($r["classTime"] == "09:00:00")
                                                $time = "9.00 a.m. - 10.00 a.m.";
                                            else if ($r["classTime"] == "13:00:00")
                                                $time = "1.00 p.m. - 2.00 p.m.";
                                            else if ($r["classTime"] == "14:00:00")
                                                $time = "2.00 p.m. - 3.00 p.m.";
                                            else if ($r["classTime"] == "15:00:00")
                                                $time = "3.00 p.m. - 4.00 p.m.";
                                            echo $time
                                            ?>
                                        </td>
                                        <td style='text-align: left;'><input type='text' name='link' style='text-align:center;' size='30' value='<?php echo $r['classLink'] ?>'></td>
                                        <td> <?php echo $r["totalStudent"] ?></td>
                                        <td>
                                            <button style='padding: 0; border: none; background: none;' type='submit' name='saveClassButton'>
                                                <script src='https://cdn.lordicon.com/xdjxvujz.js'></script>
                                                <lord-icon src='https://cdn.lordicon.com/hjeefwhm.json' trigger='loop' delay='750' colors='primary:#eac143' style='width:40px;height:40px'>
                                                </lord-icon>
                                            </button>
                                        </td>
                                    </tr>
                                    </tr>
                                <?php
                                        }
                                ?>
                                </tr>
                                </tbody>
                            </table>
                    <?php
                        }
                    }
                    ?>
                </div>
            </div>

            <!-- -->

            <div class="details" style="display: inline-block;">
                <div style='text-align:center'>
                    <button>Saturday</button>
                    <button>Sunday</button>
                    <br><br>
                </div>

                <div class="recentOrders">
                    <div class="cardHeader">
                        <h2>
                            Students
                        </h2>
                    </div>
                    <?php
                    // Construct and run query to display student details
                    $q = "SELECT u.userID, u.userLevel, u.userName, u.userPhone, u.userEmail, u.userGender, u.userBirthdate, u.userAddress 
                        FROM user tutor, user u, class c, register r 
                        WHERE u.userLevel='3' AND r.registerApproval='1' AND u.userID=r.stuID AND r.classID=c.classID AND tutor.userID=c.tutorID AND tutor.userID=" . $_SESSION['userID'];
                    $res = mysqli_query($con, $q);
                    $num = mysqli_num_rows($res);

                    if ($res) {
                        if ($num > 0) {
                    ?>
                            <table style="width: 100%;">
                                <thead>
                                    <tr>
                                        <td>ID</td>
                                        <td>Name</td>
                                        <td>Phone</td>
                                        <td>E-mail</td>
                                        <td>Gender</td>
                                        <td>Birthdate</td>
                                        <td>Address</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <?php
                                        // Construct and run query to list user's classes
                                        while ($r = mysqli_fetch_assoc($res)) {
                                        ?>
                                    <tr>
                                        <td> <?php echo $r["userID"] ?></td>
                                        <td> <?php echo $r["userName"] ?></td>
                                        <td> <?php echo $r["userPhone"] ?></td>
                                        <td> <?php echo $r["userEmail"] ?></td>
                                        <td> <?php echo $r["userGender"] ?></td>
                                        <td> <?php echo $r["userBirthdate"] ?></td>
                                        <td> <?php echo $r["userAddress"] ?></td>
                                    </tr>
                                <?php
                                        }
                                ?>
                                </tr>
                                </tbody>
                            </table>
                    <?php
                        }
                    }
                    ?>
                </div>
            </div>

        </div>
    <?php
    } else {
        header("Location: login.php");
    }

    ?>
    <!-- JS scripts -->
    <script src=" ../js/dash.js"></script>
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