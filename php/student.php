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

        // Construct and run query to list user details
        $q = "select userUname, userName, userPhone, userEmail, userGender, userBirthdate, userAddress from user where userID=" . $_SESSION['userID'];
        $result = mysqli_query($con, $q);
        $r = mysqli_fetch_assoc($result);
        echo "<br><h2>Welcome " . $r['userUname'] . "</h2><a href=logout.php>Logout</a>";
        echo "<h3>Name: " . $r['userName'] . "</h3>";
        echo "<h3>Phone Number: " . $r['userPhone'] . "</h3>";
        echo "<h3>Email: " . $r['userEmail'] . "</h3>";

        if ($r['userGender'] == 1) // 1 == Male, 2 == Female
            $gender = "Male";
        else if ($r['userGender'] == 2)
            $gender = "Female";
        echo "<h3>Gender: " . $gender . "</h3>";

        echo "<h3>Birthdate: " . $r['userBirthdate'] . "</h3>";
        echo "<h3>Address: " . $r['userAddress'] . "</h3>";

        // Construct and run query to display timetable
        $q = "SELECT userName FROM user WHERE userID=" . $_SESSION['userID'];
        $result = mysqli_query($con, $q);
        echo "<table id='timetable'> <caption>" . $r['userName'] . "'s Tuition Timetable</caption>"; // Table title
        echo "
            <tr>
                <th>Time</th>
                <th>Saturday</th>
                <th>Sunday</th>
            </tr>";

        /*while ($r = mysqli_fetch_assoc($result)) {
            echo "<tr><td>" . $r['classTime'] . "</td><td>" . $r['classSubject'] . "</td><td>" . $r['classDay'] . "</td></tr>";
        }*/

        $q = "SELECT userID, classSubject, classDay, classTime, registerApproval FROM user u, class c, register r WHERE userID=" . $_SESSION['userID'] . " AND u.userID=r.stuID AND r.classID=c.classID AND r.registerApproval=1";
        $result = mysqli_query($con, $q);
        echo "          
            <tr>
            <td>8:00 a.m. - 9:00 a.m.</td>
            <td>";
        $r = mysqli_fetch_assoc($result);
        if ($r === NULL) {
            echo "No class";
            echo "</td>";
            echo "<td>";
            echo "No class";
        } else {
            if ($r != NULL && $r['classTime'] == "08:00:00" && $r['classDay'] == "Saturday") {
                echo $r['classSubject'];
                $r = mysqli_fetch_assoc($result);
            } else {
                echo "No class";
            }
            echo "</td>";
            echo "<td>";
            if ($r != NULL && $r['classTime'] == "08:00:00" && $r['classDay'] == "Sunday") {
                echo $r['classSubject'];
                $r = mysqli_fetch_assoc($result);
            } else {
                echo "No class";
            }
        }

        echo "</td>
            </tr>
    
            <tr>
            <td>9:00 a.m. - 10:00 a.m.</td>
            <td>";
        if ($r === NULL) {
            echo "No class";
            echo "</td>";
            echo "<td>";
            echo "No class";
        } else {
            if ($r != NULL && $r['classTime'] == "09:00:00" && $r['classDay'] == "Saturday") {
                echo $r['classSubject'];
                $r = mysqli_fetch_assoc($result);
            } else {
                echo "No class";
            }
            echo "</td>";
            echo "<td>";
            if ($r != NULL && $r['classTime'] == "09:00:00" && $r['classDay'] == "Sunday") {
                echo $r['classSubject'];
                $r = mysqli_fetch_assoc($result);
            } else {
                echo "No class";
            }
        }
        echo "</td>
            </tr>
    
            <tr>
            <td>1:00 p.m. - 2:00 p.m.</td>
            <td>";
        if ($r === NULL) {
            echo "No class";
            echo "</td>";
            echo "<td>";
            echo "No class";
        } else {
            if ($r != NULL && $r['classTime'] == "13:00:00" && $r['classDay'] == "Saturday") {
                echo $r['classSubject'];
                $r = mysqli_fetch_assoc($result);
            } else {
                echo "No class";
            }
            echo "</td>";
            echo "<td>";
            if ($r != NULL && $r['classTime'] == "13:00:00" && $r['classDay'] == "Sunday") {
                echo $r['classSubject'];
                $r = mysqli_fetch_assoc($result);
            } else {
                echo "No class";
            }
        }
        echo "</td>
            </tr>
    
            <tr>
            <td>2:00 p.m. - 3:00 p.m.</td>
            <td>";
        if ($r === NULL) {
            echo "No class";
            echo "</td>";
            echo "<td>";
            echo "No class";
        } else {
            if ($r != NULL && $r['classTime'] == "14:00:00" && $r['classDay'] == "Saturday") {
                echo $r['classSubject'];
                $r = mysqli_fetch_assoc($result);
            } else {
                echo "No class";
            }
            echo "</td>";
            echo "<td>";
            if ($r != NULL && $r['classTime'] == "14:00:00" && $r['classDay'] == "Sunday") {
                echo $r['classSubject'];
                $r = mysqli_fetch_assoc($result);
            } else {
                echo "No class";
            }
        }
        echo "</td>
            </tr>
    
            <tr>
            <td>3:00 p.m. - 4:00 p.m.</td>
            <td>";
        if ($r === NULL) {
            echo "No class";
            echo "</td>";
            echo "<td>";
            echo "No class";
        } else {
            if ($r != NULL && $r['classTime'] == "15:00:00" && $r['classDay'] == "Saturday") {
                echo $r['classSubject'];
                $r = mysqli_fetch_assoc($result);
            } else {
                echo "No class";
            }
            echo "</td>";
            echo "<td>";
            if ($r != NULL && $r['classTime'] == "15:00:00" && $r['classDay'] == "Sunday") {
                echo $r['classSubject'];
                $r = mysqli_fetch_assoc($result);
            } else {
                echo "No class";
            }
        }
        echo "</td>
            </tr>";

        echo "</table>";
        // Clear results and close the connection
        mysqli_free_result($result);
    } else {
        header("Location: login.php");
    }

    // Construct and run query to check for existing subject registration
    $q = "SELECT * FROM user u, register r WHERE u.userID=r.stuID AND userID=" . $_SESSION['userID'];
    $result = mysqli_query($con, $q);
    $num = mysqli_num_rows($result);

    if ($result) {
        if ($num <= 0) {
            // Will display subject registration option if student does not register yet
            echo "<a href=register_subject.php><h3>Subject Registration</h3></a>";
            mysqli_free_result($result);
        }
    }
    echo "<a href=feedback.php><h3>Submit Feedback</h3></a>";

    mysqli_close($con);
    ?>
    <!-- =============== Navigation ================ -->
        <div class="container">
            <div class="navigation">
                <ul>
                    <li>
                        <a href="student.html">
                            <span class="icon">
                                <ion-icon name="logo-apple"></ion-icon>
                            </span>
                            <span class="title">Let Us Score</span>
                        </a>
                    </li>

                    <li>
                        <a href="student.html">
                            <span class="icon">
                                <ion-icon name="home-outline"></ion-icon>
                            </span>
                            <span class="title">Dashboard</span>
                        </a>
                    </li>

                    <li>
                        <a href="studentdetails.html">
                            <span class="icon">
                                <ion-icon name="home-outline"></ion-icon>
                            </span>
                            <span class="title">User Details</span>
                        </a>
                    </li>

                    <li>
                        <a href="registersub.html">
                            <span class="icon">
                                <ion-icon name="people-outline"></ion-icon>
                            </span>
                            <span class="title">Register Subject</span>
                        </a>
                    </li>

                    <li>
                        <a href="classdetails.html">
                            <span class="icon">
                                <ion-icon name="chatbubble-outline"></ion-icon>
                            </span>
                            <span class="title">Class Details</span>
                        </a>
                    </li>

                    <li>
                        <a href="feedback.html">
                            <span class="icon">
                                <ion-icon name="help-outline"></ion-icon>
                            </span>
                            <span class="title">Feedback</span>
                        </a>
                    </li>

                    <li>
                        <a href="#">
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
                        <ion-icon name="menu-outline"></ion-icon>
                    </div>

                    <div class="search">
                        <label>
                            <input type="text" placeholder="Search here" />
                            <ion-icon name="search-outline"></ion-icon>
                        </label>
                    </div>

                    <div class="user">
                        <img src="assets/imgs/customer01.jpg" alt="" />
                    </div>
                </div>

                <!-- ======================= Cards ================== -->
                <div class="cardBox">
                    <div class="card">
                        <div>
                            <div class="numbers">1,504</div>
                            <div class="cardName">Daily Views</div>
                        </div>

                        <div class="iconBx">
                            <ion-icon name="eye-outline"></ion-icon>
                        </div>
                    </div>

                    <div class="card">
                        <div>
                            <div class="numbers">80</div>
                            <div class="cardName">Sales</div>
                        </div>

                        <div class="iconBx">
                            <ion-icon name="cart-outline"></ion-icon>
                        </div>
                    </div>

                    <div class="card">
                        <div>
                            <div class="numbers">284</div>
                            <div class="cardName">Comments</div>
                        </div>

                        <div class="iconBx">
                            <ion-icon name="chatbubbles-outline"></ion-icon>
                        </div>
                    </div>

                    <div class="card">
                        <div>
                            <div class="numbers">$7,842</div>
                            <div class="cardName">Earning</div>
                        </div>

                        <div class="iconBx">
                            <ion-icon name="cash-outline"></ion-icon>
                        </div>
                    </div>
                </div>

                <!-- ================ Order Details List ================= -->
                <div class="details">
                    <div class="recentOrders">
                        <div class="cardHeader">
                            <h2>Class Timetable</h2>
                        </div>

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
                                    <td>Paid</td>
                                    <td>
                                        <span class="status delivered"
                                            >Delivered</span
                                        >
                                    </td>
                                </tr>

                                <tr>
                                    <td>9:00 a.m. - 10:00 a.m.</td>
                                    <td>Due</td>
                                    <td>
                                        <span class="status pending"
                                            >Pending</span
                                        >
                                    </td>
                                </tr>

                                <tr>
                                    <td>1:00 p.m. - 2:00 p.m.</td>
                                    <td>Paid</td>
                                    <td>
                                        <span class="status return"
                                            >Return</span
                                        >
                                    </td>
                                </tr>

                                <tr>
                                    <td>2:00 p.m. - 3:00 p.m.</td>
                                    <td>Due</td>
                                    <td>
                                        <span class="status inProgress"
                                            >In Progress</span
                                        >
                                    </td>
                                </tr>

                                <tr>
                                    <td>3:00 p.m. - 4:00 p.m.</td>
                                    <td>Paid</td>
                                    <td>
                                        <span class="status delivered"
                                            >Delivered</span
                                        >
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- ================= New Customers ================ -->
                    <div class="recentCustomers">
                        <div class="cardHeader">
                            <h2>Recent Customers</h2>
                        </div>

                        <table>
                            <tr>
                                <td width="60px">
                                    <div class="imgBx">
                                        <img
                                            src="assets/imgs/customer02.jpg"
                                            alt=""
                                        />
                                    </div>
                                </td>
                                <td>
                                    <h4>
                                        David <br />
                                        <span>Italy</span>
                                    </h4>
                                </td>
                            </tr>

                            <tr>
                                <td width="60px">
                                    <div class="imgBx">
                                        <img
                                            src="assets/imgs/customer01.jpg"
                                            alt=""
                                        />
                                    </div>
                                </td>
                                <td>
                                    <h4>
                                        Amit <br />
                                        <span>India</span>
                                    </h4>
                                </td>
                            </tr>

                            <tr>
                                <td width="60px">
                                    <div class="imgBx">
                                        <img
                                            src="assets/imgs/customer02.jpg"
                                            alt=""
                                        />
                                    </div>
                                </td>
                                <td>
                                    <h4>
                                        David <br />
                                        <span>Italy</span>
                                    </h4>
                                </td>
                            </tr>

                            <tr>
                                <td width="60px">
                                    <div class="imgBx">
                                        <img
                                            src="assets/imgs/customer01.jpg"
                                            alt=""
                                        />
                                    </div>
                                </td>
                                <td>
                                    <h4>
                                        Amit <br />
                                        <span>India</span>
                                    </h4>
                                </td>
                            </tr>

                            <tr>
                                <td width="60px">
                                    <div class="imgBx">
                                        <img
                                            src="assets/imgs/customer02.jpg"
                                            alt=""
                                        />
                                    </div>
                                </td>
                                <td>
                                    <h4>
                                        David <br />
                                        <span>Italy</span>
                                    </h4>
                                </td>
                            </tr>

                            <tr>
                                <td width="60px">
                                    <div class="imgBx">
                                        <img
                                            src="assets/imgs/customer01.jpg"
                                            alt=""
                                        />
                                    </div>
                                </td>
                                <td>
                                    <h4>
                                        Amit <br />
                                        <span>India</span>
                                    </h4>
                                </td>
                            </tr>

                            <tr>
                                <td width="60px">
                                    <div class="imgBx">
                                        <img
                                            src="assets/imgs/customer01.jpg"
                                            alt=""
                                        />
                                    </div>
                                </td>
                                <td>
                                    <h4>
                                        David <br />
                                        <span>Italy</span>
                                    </h4>
                                </td>
                            </tr>

                            <tr>
                                <td width="60px">
                                    <div class="imgBx">
                                        <img
                                            src="assets/imgs/customer02.jpg"
                                            alt=""
                                        />
                                    </div>
                                </td>
                                <td>
                                    <h4>
                                        Amit <br />
                                        <span>India</span>
                                    </h4>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- =========== Scripts =========  -->
        <script src="assets/js/main.js"></script>

        <!-- ====== ionicons ======= -->
        <script
            type="module"
            src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"
        ></script>
        <script
            nomodule
            src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"
        ></script>
</body>

</html>