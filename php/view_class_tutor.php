<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS -->
    <link rel="stylesheet" href="../css/style2.css">
    <!-- Title -->
    <title>Student Details</title>
    <link rel="icon" href="../images/icon.ico" />
</head>

<body>
    <?php
    // Tutor
    session_start();
    if (isset($_SESSION['userID']) && $_SESSION['userLevel'] == 2)
        // Connect to database 
        include_once 'dbcon.php';
    else
        header("Location: login.php");
    ?>
    <!-- Navigation -->
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
                        <span class="title">My Details</span>
                    </a>
                </li>
                <li>
                    <a href="view_class_tutor.php">
                        <span class="icon">
                            <ion-icon name="document-text-outline"></ion-icon>
                        </span>
                        <span class="title">Student Details</span>
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
        <!--
            <div class="details" style="display: inline-block;">
                <div class="cardHeader">
                    <h2>
                        Students' Details
                        <br>
                        <br>
                    </h2>
                </div>
            </div>
            -->
        <br><br>

        <div class="details" style="display: inline-block;">
            <div style='text-align:center'>
                <form method="post" action="view_class_tutor.php">
                    <b>Choose your class day below to show student details:</b>
                    <br>
                    <button type="submit" name="saturday" class="btn">
                        <span class="btnText"> Saturday </span>
                    </button>
                    <button type="submit" name="sunday" class="btn">
                        <span class="btnText"> Sunday </span>
                    </button>
                </form>
                <br>
                <h2>
                    <?php
                    $q = "SELECT classSubject FROM class WHERE tutorID=" . $_SESSION['userID'];
                    $res = mysqli_query($con, $q);
                    $r = mysqli_fetch_assoc($res);
                    echo ($r["classSubject"]);
                    ?>
                </h2>
                <br>
            </div>
            <div class="recentOrders">
                <?php
                // Construct and run query to display student details
                $display = false;
                if (isset($_POST['saturday'])) {
                ?>
                    <div class="cardHeader">
                        <h2>
                            Student Details (Saturday)
                        </h2>
                    </div>
                <?php
                    $q = "SELECT u.userID, u.userLevel, u.userName, u.userPhone, u.userEmail, u.userGender, u.userBirthdate, u.userAddress, r.registerDate
                        FROM user tutor, user u, class c, register r 
                        WHERE u.userLevel='3' AND r.registerApproval='1' AND u.userID=r.stuID AND r.classID=c.classID AND c.classDay='Saturday' AND tutor.userID=c.tutorID AND tutor.userID=" . $_SESSION['userID'];
                    $res = mysqli_query($con, $q);
                    $num = mysqli_num_rows($res);
                    $display = true;
                } else if (isset($_POST['sunday'])) {
                ?>
                    <div class="cardHeader">
                        <h2>
                            Student Details (Sunday)
                        </h2>
                    </div>

                    <?php
                    $q = "SELECT u.userID, u.userLevel, u.userName, u.userPhone, u.userEmail, u.userGender, u.userBirthdate, u.userAddress, r.registerDate, c.classDay
                        FROM user tutor, user u, class c, register r 
                        WHERE u.userLevel='3' AND r.registerApproval='1' AND u.userID=r.stuID AND r.classID=c.classID AND c.classDay='Sunday' AND tutor.userID=c.tutorID AND tutor.userID=" . $_SESSION['userID'];
                    $res = mysqli_query($con, $q);
                    $num = mysqli_num_rows($res);
                    $display = true;
                }
                if ($display == true) {
                    if ($res) {
                        if ((mysqli_num_rows($res)) > 0) {
                    ?>
                            <table style="width: 100%;">
                                <thead>
                                    <tr>
                                        <td>Name</td>
                                        <td>Phone</td>
                                        <td>E-mail</td>
                                        <td>Gender</td>
                                        <td>Birthdate</td>
                                        <td>Registered Date</td>
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
                                        <td> <?php echo $r["userName"] ?></td>
                                        <td> <?php echo $r["userPhone"] ?></td>
                                        <td> <?php echo $r["userEmail"] ?></td>
                                        <td>
                                            <?php
                                            if ($r["userGender"] == 1)
                                                echo "Male";
                                            else if ($r["userGender"] == 2)
                                                echo "Female";
                                            ?>
                                        </td>
                                        <td> <?php echo $r["userBirthdate"] ?></td>
                                        <td> <?php echo $r["registerDate"] ?></td>
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
                }
                ?>
            </div>
        </div>

    </div>
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