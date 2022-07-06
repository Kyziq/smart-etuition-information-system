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

    <title>Class Details</title>
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
        //Admin's
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
                        <a href="manage_user.php">
                            <span class="icon">
                                <ion-icon name="document-text-outline"></ion-icon>
                            </span>
                            <span class="title">User Details</span>
                        </a>
                    </li>

                    <li>
                        <a href="manage_class.php">
                            <span class="icon">
                                <ion-icon name="document-text-outline"></ion-icon>
                            </span>
                            <span class="title">Class Details</span>
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
                <div class="cardHeader">
                    <h2>Classes Details:</h2>
                </div>
                <br>
                <div class="recentOrders">
                    <!-- 1st -->
                    <?php
                    // Construct and run query to list all classes registration
                    $q = "SELECT * FROM class";
                    $res = mysqli_query($con, $q);

                    // Construct and run query to check for existing class
                    $num = mysqli_num_rows($res);
                    if ($res) {
                        if ($num > 0) {
                    ?>
                            <table style="width: 100%;">
                                <thead>
                                    <tr>
                                        <td style="text-align: left;">ID</td>
                                        <td style="text-align: left;">Subject</td>
                                        <td style="text-align: left;">Link</td>
                                        <td style="text-align: left;">Day</td>
                                        <td style="text-align: left;">Time</td>
                                        <td style="text-align: left;">Fee</td>
                                        <td style="text-align: left;">Total Student</td>
                                        <td style="text-align: center;">Action (Save)</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    while ($r = mysqli_fetch_assoc($res)) {
                                        // Output all classes in a table
                                        echo    "<form method='POST' action='manage_class_save.php'>";
                                        echo    "<tr>
                                                    <td><input type='text' name='classID' style='text-align:center;  color: var(--red);' size='1' value='" . $r['classID'] . "'readonly></td>
                                                    <td style='text-align: left;'><input type='text' name='subject' style='text-align:center;' size='20' value='" . $r['classSubject'] . "'></td>
                                                    <td style='text-align: left;'><input type='text' name='link' style='text-align:center;' size='30' value='" . $r['classLink'] . "'></td>
                                                    <td><input type='text' name='day' style='text-align:center;' size='10' value='" . $r['classDay'] . "'></td>
                                                    <td><input type='text' name='time' style='text-align:center;' size='10' value='" . $r['classTime'] . "'></td>
                                                    <td style='text-align: center;'><input type='text' name='fee' style='text-align:center;' size='2' value='" . $r['classFee'] . "'></td>
                                                    <td style='text-align: center;'><input type='text' name='totalStu' style='text-align:center; color: var(--red);' size='1' value='" . $r['totalStudent'] . "'readonly></td>
                                                    <td style='text-align: center;'>
                                                    <button style='padding: 0; border: none; background: none;' type='submit' name='saveClassButton'>
                                                        <script src='https://cdn.lordicon.com/xdjxvujz.js'></script>
                                                        <lord-icon
                                                            src='https://cdn.lordicon.com/hjeefwhm.json'
                                                            trigger='loop'
                                                            delay='750'
                                                            colors='primary:#eac143'
                                                            style='width:40px;height:40px'>
                                                        </lord-icon>
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

            <!-- JS scripts -->
            <script src="../js/dash.js"></script>
            <script src="../js/script.js"></script>

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