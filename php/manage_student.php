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

    <title>User Details</title>
</head>

<body>
    <?php
    session_start();

    // Connect to database
    $con = mysqli_connect('localhost', 'root', '', 'smartetuition') or die(mysqli_error($con));

    /*while ($r = mysqli_fetch_assoc($res)) {
            echo "<tr><td>" . $r['userEmail'] . "</td><td>" . $r['userUname'] . "</td><td>" . $r['userPhone'] . "</td></tr>";
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
                        <a href="manage_student.php">
                            <span class="icon">
                                <ion-icon name="document-text-outline"></ion-icon>
                            </span>
                            <span class="title">Student Details</span>
                        </a>
                    </li>

                    <li>
                        <a href="manage_tutor.php">
                            <span class="icon">
                                <ion-icon name="document-text-outline"></ion-icon>
                            </span>
                            <span class="title">Tutor Details</span>
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

            <!-- Student Part -->
            <div class="details" style="display: inline-block;">
                <div class="recentOrders">
                    <div class="cardHeader">
                        <h2>Student Details:</h2>
                    </div>
                    <br>
                    <div class="search">
                        <label>
                            <input type="text" placeholder="Search by user details" />
                        </label>
                    </div>
                    <?php
                    // Construct and run query to list all classes registration
                    $q = "SELECT * FROM user WHERE userLevel='3'";
                    $res = mysqli_query($con, $q);

                    // Construct and run query to check for existing class
                    $num = mysqli_num_rows($res);
                    if ($res) {
                        if ($num > 0) {
                    ?>
                            <table style="width: 100%;">
                                <thead>
                                    <tr>
                                        <!-- <td style="text-align: center;">ID</td> -->
                                        <!-- <td style="text-align: left;">Username</td> -->
                                        <td>Full Name</td>
                                        <td>Gender</td>
                                        <td>Phone</td>
                                        <td>Email</td>
                                        <td>Birthdate</td>
                                        <td style="text-align: center;">Address</td>
                                        <td style="text-align: end;">Action (Save)</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    while ($r = mysqli_fetch_assoc($res)) {
                                        // Output all classes in a table
                                        echo    "<form method='POST' action='manage_user_save.php'>";
                                        echo    "<tr>
                                                    <input type='hidden' name='userID' style='text-align:center; color: var(--red);' size='1' value='" . $r['userID'] . "'readonly>
                                                    <input type='hidden' name='userLevel' style='text-align:center; color: var(--red);' size='1' value='" . $r['userLevel'] . "'readonly>
                                                    <!-- <td style='text-align: left;'><input type='text' name='userUname' style='text-align:center;' size='10' value='" . $r['userUname'] . "'></td> -->
                                                    <td style='text-align: left;'><input type='text' name='userName' style='text-align:center;' size='20' value='" . $r['userName'] . "'></td>
                                                    <td style='text-align: left;'>";

                                        if ($r['userGender'] == 1) {
                                            echo "
                                                        <select name='userGender'>
                                                            <option selected value='1'>Male</option>
                                                            <option value='2'>Female</option>
                                                        </select>";
                                        }
                                        if ($r['userGender'] == 2) {
                                            echo "
                                                            <select name='userGender'>
                                                                <option value='1'>Male</option>
                                                                <option selected value='2'>Female</option>
                                                            </select>";
                                        }
                                        echo "
                                                    </td>
                                                    <td style='text-align: left;'><input type='text' name='userPhone' style='text-align:center;' size='10' value='" . $r['userPhone'] . "'></td>
                                                    <td style='text-align: left;'><input type='text' name='userEmail' style='text-align:center;' size='20' value='" . $r['userEmail'] . "'></td>
                                                    
                                                    <td style='text-align: left;'><input type='date' name='userBirthdate' style='text-align:center;' size='5' value='" . $r['userBirthdate'] . "'></td>
                                                    <td style='text-align: left;'>
                                                        <textarea type='text' name='userAddress' style='text-align:center;' rows='3' cols='35'>" . $r['userAddress'] . "</textarea>
                                                    </td>
                                                    <td style='text-align: end;'>
                                                    <button style='padding: 0; border: none; background: none;' type='submit' name='saveUserButton'>
                                                        <script src='https://cdn.lordicon.com/xdjxvujz.js'></script>
                                                        <lord-icon
                                                            src='https://cdn.lordicon.com/hjeefwhm.json'
                                                            trigger='loop'
                                                            colors='primary:#eac143'
                                                            delay='750'
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