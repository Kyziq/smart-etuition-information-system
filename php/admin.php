<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS -->
    <link rel="stylesheet" href="../css/style2.css">
    <!-- ChartJS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.8.0/chart.min.js" integrity="sha512-sW/w8s4RWTdFFSduOTGtk4isV1+190E/GghVffMA9XczdJ2MDzSzLEubKAs5h0wzgSJOQTRYyaz73L3d6RtJSg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Title -->
    <link rel="icon" href="../images/icon.ico" />
    <title>Admin Dashboard</title>
</head>

<body>
    <?php
    // Admin Dashboard
    session_start();
    if (isset($_SESSION['userID']) && $_SESSION['userLevel'] == 1)
        // Connect to database 
        include_once 'dbcon.php';
    else
        header("Location: login.php");
    ?>
    <!-- Admin Navigation -->
    <div class="container">
        <div class="navigation">
            <!-- Dashboard List -->
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
                    <a href="manage_student.php">
                        <span class="icon">
                            <ion-icon name="document-text-outline"></ion-icon>
                        </span>
                        <span class="title">Manage Student</span>
                    </a>
                </li>
                <li>
                    <a href="manage_tutor.php">
                        <span class="icon">
                            <ion-icon name="document-text-outline"></ion-icon>
                        </span>
                        <span class="title">Manage Tutor</span>
                    </a>
                </li>
                <li>
                    <a href="manage_class.php">
                        <span class="icon">
                            <ion-icon name="document-text-outline"></ion-icon>
                        </span>
                        <span class="title">Manage Class</span>
                    </a>
                </li>
                <li>
                    <a href="verify_subject.php">
                        <span class="icon">
                            <ion-icon name="checkmark-outline"></ion-icon>
                        </span>
                        <span class="title">Class Verification</span>
                    </a>
                </li>
                <li>
                    <a href="view_class_admin.php">
                        <span class="icon">
                            <ion-icon name="search-outline"></ion-icon>
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
                <!-- Name -->
                <div class="card">
                    <div>
                        <div class="numbers">Admin</div>
                        <div class="cardName">
                            <?php
                            // Data
                            $userID = $_SESSION['userID'];
                            // Query 
                            $q = "SELECT userName FROM user WHERE userID=?";
                            // Created a prepared statement
                            $stmt = mysqli_stmt_init($con);
                            // Prepare the prepared statement
                            if (!mysqli_stmt_prepare($stmt, $q))
                                echo "SQL statement failed";
                            else {
                                // Bind parameters to the placeholder
                                mysqli_stmt_bind_param($stmt, "i", $userID);
                                // Run parameters inside database
                                mysqli_stmt_execute($stmt);
                                $res = mysqli_stmt_get_result($stmt);
                                $r = mysqli_fetch_assoc($res);
                            }
                            echo "<i>" . $r['userName'] . "</i>";
                            ?>
                        </div>
                    </div>
                    <div class="iconBx">
                        <script src="https://cdn.lordicon.com/xdjxvujz.js"></script>
                        <lord-icon src="https://cdn.lordicon.com/nobciafz.json" trigger="loop" delay="600" colors="primary:#121331,secondary:#192e59" stroke="80" style="width:80px;height:80px">
                        </lord-icon>
                    </div>
                </div>

                <!-- Total students -->
                <div class="card">
                    <div>
                        <div class="numbers">
                            <?php
                            // Data (Student)
                            $userLevel = 3;
                            // Construct and run query to check for total students
                            $q = "SELECT count(userID) AS total FROM user WHERE userLevel=?";
                            // Created a prepared statement
                            $stmt = mysqli_stmt_init($con);
                            // Prepare the prepared statement
                            if (!mysqli_stmt_prepare($stmt, $q))
                                echo "SQL statement failed";
                            else {
                                // Bind parameters to the placeholder
                                mysqli_stmt_bind_param($stmt, "i", $userLevel);
                                // Run parameters inside database
                                mysqli_stmt_execute($stmt);
                                $res = mysqli_stmt_get_result($stmt);
                                $r = mysqli_fetch_assoc($res);
                            }
                            echo $r['total'];
                            ?>
                        </div>
                        <div class="cardName">
                            <?php
                            if ($r['total'] <= 1)
                                echo "<i>Total student</i>";
                            else if ($r['total'] > 1)
                                echo "<i>Total students</i>";
                            ?>
                        </div>
                    </div>
                    <div class="iconBx">
                        <script src="https://cdn.lordicon.com/xdjxvujz.js"></script>
                        <lord-icon src="https://cdn.lordicon.com/stxtcyyo.json" trigger="loop" colors="primary:#192e59" state="loop" style="width:70px;height:70px">
                        </lord-icon>
                    </div>
                </div>

                <!-- Total tutors -->
                <div class="card">
                    <div>
                        <div class="numbers">
                            <?php
                            // Data (Tutor)
                            $userLevel = 2;
                            // Construct and run query to check for total tutors
                            $q = "SELECT count(userID) AS total FROM user WHERE userLevel=?";
                            // Created a prepared statement
                            $stmt = mysqli_stmt_init($con);
                            // Prepare the prepared statement
                            if (!mysqli_stmt_prepare($stmt, $q))
                                echo "SQL statement failed";
                            else {
                                // Bind parameters to the placeholder
                                mysqli_stmt_bind_param($stmt, "i", $userLevel);
                                // Run parameters inside database
                                mysqli_stmt_execute($stmt);
                                $res = mysqli_stmt_get_result($stmt);
                                $r = mysqli_fetch_assoc($res);
                            }
                            echo $r['total'];
                            ?>
                        </div>
                        <div class="cardName">
                            <?php
                            if ($r['total'] <= 1)
                                echo "<i>Total tutor</i>";
                            else if ($r['total'] > 1)
                                echo "<i>Total tutors</i>";
                            ?>
                        </div>
                    </div>
                    <div class="iconBx">
                        <script src="https://cdn.lordicon.com/xdjxvujz.js"></script>
                        <lord-icon src="https://cdn.lordicon.com/pvbjsfif.json" trigger="loop" delay="750" colors="primary:#192e59" state="hover" style="width:75px;height:75px">
                        </lord-icon>
                    </div>
                </div>

                <!-- Total pending class verification -->
                <div class="card">
                    <div>
                        <div class="numbers">
                            <?php
                            // Data (Pending)
                            $registerApproval = 3;
                            // Construct and run query to check for total pending class verification
                            $q = "SELECT count(classID) AS total FROM register WHERE registerApproval=?";
                            // Created a prepared statement
                            $stmt = mysqli_stmt_init($con);
                            // Prepare the prepared statement
                            if (!mysqli_stmt_prepare($stmt, $q))
                                echo "SQL statement failed";
                            else {
                                // Bind parameters to the placeholder
                                mysqli_stmt_bind_param($stmt, "i", $registerApproval);
                                // Run parameters inside database
                                mysqli_stmt_execute($stmt);
                                $res = mysqli_stmt_get_result($stmt);
                                $r = mysqli_fetch_assoc($res);
                            }
                            echo $r['total'];
                            ?>
                        </div>
                        <div class="cardName"><i>Pending class verification</i></div>
                    </div>
                    <div class="iconBx">
                        <script src="https://cdn.lordicon.com/xdjxvujz.js"></script>
                        <lord-icon src="https://cdn.lordicon.com/ndydpcaq.json" trigger="loop" colors="primary:#192e59" state="loop" style="width:75px;height:75px">
                        </lord-icon>
                    </div>
                </div>
            </div>

            <!-- ChartJS (total number of students enrolled in each subject) -->
            <div class="details">
                <div class="recentOrders">
                    <div class="cardHeader">
                        <div>
                            <canvas id="myChart" width="800;"></canvas>
                        </div>
                        <?php
                        // Construct and run query to check for verification status (1 - Accepted, 2 - Declined, 3 - Pending)
                        // Mathematics
                        $q = "SELECT * FROM register WHERE (classID=1 OR classID=2) AND registerApproval=1";
                        $result = mysqli_query($con, $q);
                        $m1 = mysqli_num_rows($result);

                        $q = "SELECT * FROM register WHERE (classID=1 OR classID=2) AND registerApproval=3";
                        $result = mysqli_query($con, $q);
                        $m2 = mysqli_num_rows($result);

                        $q = "SELECT * FROM register WHERE (classID=1 OR classID=2) AND registerApproval=2";
                        $result = mysqli_query($con, $q);
                        $m3 = mysqli_num_rows($result);

                        // Additional Mathematics
                        $q = "SELECT * FROM register WHERE (classID=3 OR classID=4) AND registerApproval=1";
                        $result = mysqli_query($con, $q);
                        $am1 = mysqli_num_rows($result);

                        $q = "SELECT * FROM register WHERE (classID=3 OR classID=4) AND registerApproval=3";
                        $result = mysqli_query($con, $q);
                        $am2 = mysqli_num_rows($result);

                        $q = "SELECT * FROM register WHERE (classID=3 OR classID=4) AND registerApproval=2";
                        $result = mysqli_query($con, $q);
                        $am3 = mysqli_num_rows($result);

                        // Physics
                        $q = "SELECT * FROM register WHERE (classID=5 OR classID=6) AND registerApproval=1";
                        $result = mysqli_query($con, $q);
                        $p1 = mysqli_num_rows($result);

                        $q = "SELECT * FROM register WHERE (classID=5 OR classID=6) AND registerApproval=3";
                        $result = mysqli_query($con, $q);
                        $p2 = mysqli_num_rows($result);

                        $q = "SELECT * FROM register WHERE (classID=5 OR classID=6) AND registerApproval=2";
                        $result = mysqli_query($con, $q);
                        $p3 = mysqli_num_rows($result);

                        // Chemistry
                        $q = "SELECT * FROM register WHERE (classID=7 OR classID=8) AND registerApproval=1";
                        $result = mysqli_query($con, $q);
                        $c1 = mysqli_num_rows($result);

                        $q = "SELECT * FROM register WHERE (classID=7 OR classID=8) AND registerApproval=3";
                        $result = mysqli_query($con, $q);
                        $c2 = mysqli_num_rows($result);

                        $q = "SELECT * FROM register WHERE (classID=7 OR classID=8) AND registerApproval=2";
                        $result = mysqli_query($con, $q);
                        $c3 = mysqli_num_rows($result);

                        //  Biology
                        $q = "SELECT * FROM register WHERE (classID=9 OR classID=10) AND registerApproval=1";
                        $result = mysqli_query($con, $q);
                        $b1 = mysqli_num_rows($result);

                        $q = "SELECT * FROM register WHERE (classID=9 OR classID=10) AND registerApproval=3";
                        $result = mysqli_query($con, $q);
                        $b2 = mysqli_num_rows($result);

                        $q = "SELECT * FROM register WHERE (classID=9 OR classID=10) AND registerApproval=2";
                        $result = mysqli_query($con, $q);
                        $b3 = mysqli_num_rows($result);
                        ?>

                        <script>
                            var ctx = document.getElementById("myChart").getContext("2d");
                            var myChart = new Chart(ctx, {
                                type: "bar",
                                data: {
                                    labels: [
                                        "Mathematics",
                                        "Additional Mathematics",
                                        "Physics",
                                        "Chemistry",
                                        "Biology",
                                    ],
                                    datasets: [{
                                            // Accepted
                                            data: [
                                                <?php
                                                echo $m1 . ',';
                                                echo $am1 . ',';
                                                echo $p1 . ',';
                                                echo $c1 . ',';
                                                echo $b1 . ',';
                                                ?>
                                            ],
                                            label: "Approved",
                                            borderColor: "#000000",
                                            backgroundColor: "#094074",
                                            borderWidth: 1,
                                        },
                                        {
                                            // Pending
                                            data: [
                                                <?php
                                                echo $m2 . ',';
                                                echo $am2 . ',';
                                                echo $p2 . ',';
                                                echo $c2 . ',';
                                                echo $b2 . ',';
                                                ?>
                                            ],
                                            label: "Pending",
                                            borderColor: "#000000",
                                            backgroundColor: "#1399c6",
                                            borderWidth: 1,
                                        },
                                        {
                                            // Declined
                                            data: [
                                                <?php
                                                echo $m3 . ',';
                                                echo $am3 . ',';
                                                echo $p3 . ',';
                                                echo $c3 . ',';
                                                echo $b3 . ',';
                                                ?>
                                            ],
                                            label: "Declined",
                                            borderColor: "#000000",
                                            backgroundColor: "#5ADBFF",
                                            borderWidth: 1,
                                        },
                                    ],
                                },
                                options: {
                                    plugins: {
                                        title: {
                                            display: true,
                                            text: "Total number of students enrolled in each subject",
                                            font: {
                                                size: 20,
                                            },
                                        },
                                    },
                                    responsive: true,
                                    maintainAspectRatio: false,
                                    scales: {
                                        x: {
                                            stacked: true,
                                        },
                                        y: {
                                            stacked: true,
                                        },
                                    },
                                },
                            });
                        </script>
                    </div>
                </div>

                <!-- Admin's Details -->
                <div class="recentCustomers">
                    <div class="cardHeader">
                        <h2>My Details</h2>
                    </div>
                    <?php
                    // Data (Pending)

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

    <!-- #Scripts -->
    <script src="../js/dash.js"></script>

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