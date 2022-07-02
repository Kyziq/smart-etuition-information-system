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
                            mysqli_free_result($result);
                        }
                        ?>
                </li>

                <li>
                    <a href="classdetails.html">
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

            <!-- ================ Order Details List ================= -->
            <div class="detailsReg">
                <div class="recentOrders">
                    <div class="cardHeader">
                        <h2>
                            <?php
                            $q = "select userName from user where userID=" . $_SESSION['userID'];
                            $result = mysqli_query($con, $q);
                            $r = mysqli_fetch_assoc($result);
                            echo $r['userName'];
                            ?>
                            's Subject Registration
                        </h2>
                    </div>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce commodo lorem ut metus vestibulum, maximus blandit lorem elementum. Maecenas nec lacus dignissim arcu consectetur auctor. Nam sollicitudin purus at mi luctus elementum. Phasellus quam risus, porta in faucibus ut, eleifend nec elit. Nullam vitae lorem vel enim pulvinar fringilla nec id leo. Ut vestibulum malesuada euismod. Proin fringilla varius dui ut tristique. Quisque egestas mi porttitor enim vehicula sodales. Aliquam posuere porta elementum. Vivamus et varius lectus. Praesent justo urna, volutpat eu nisl pharetra, gravida imperdiet libero. Sed hendrerit ultrices lorem eu interdum. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam neque nulla, blandit imperdiet posuere at, consequat sed neque. Suspendisse potenti. Donec enim eros, vestibulum et sapien accumsan, auctor ultrices nibh.

                        Morbi consequat ipsum at ligula posuere, fringilla viverra lectus egestas. Ut turpis magna, mattis vitae faucibus sed, varius id justo. Donec sit amet sagittis sem. Mauris sed mollis felis. Aliquam ac lorem lectus. Aliquam hendrerit nibh ac lectus mollis, et accumsan dui scelerisque. Cras eu turpis arcu. Nam non tortor sed libero convallis aliquam. Phasellus eget lorem hendrerit, mollis diam ac, dapibus turpis.

                        Suspendisse potenti. Integer iaculis aliquet pharetra. Ut iaculis massa a tristique pulvinar. Suspendisse hendrerit lobortis aliquam. Fusce vitae lacus nunc. Morbi efficitur turpis nulla, mollis rutrum diam vehicula nec. Integer bibendum, erat vel sagittis pulvinar, tortor diam egestas massa, in blandit mi arcu non nibh. Donec sed elit sollicitudin, interdum justo id, sodales justo. Aliquam eu arcu in enim tempus dapibus.

                        Suspendisse blandit ex ligula, et suscipit magna ornare eget. Curabitur sed mi ac tortor ultrices vehicula. Integer vulputate interdum orci eget ultricies. Donec rhoncus justo a auctor lacinia. Aenean consequat sollicitudin bibendum. In pellentesque felis at ante malesuada finibus. Nam laoreet vitae urna at vestibulum. Duis tristique, felis ut elementum pulvinar, tortor augue commodo ipsum, sed consequat magna orci et risus. Aliquam quis orci nec augue mattis convallis vitae eu magna. Donec cursus ipsum non placerat consectetur. Donec vestibulum lectus vel elit pretium sodales. Pellentesque consectetur ligula tortor, et pretium tortor imperdiet a.

                        Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Mauris eu lectus ultricies velit semper pharetra vel ac nisl. Maecenas ut luctus erat, a eleifend mauris. Proin eros nisl, tempus quis mollis eu, molestie quis nulla. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Maecenas ullamcorper et sem finibus lobortis. Vivamus commodo eget purus ut rutrum. Pellentesque tempor scelerisque nunc a posuere. Vivamus eleifend lacus vel arcu tincidunt fringilla. Integer mattis sed ex malesuada facilisis.

                    </p>
                    <?php
                        // Construct and run query to display timetable
                        $q = "SELECT userID, classSubject, classDay, classTime, registerApproval FROM user u, class c, register r WHERE userID=" . $_SESSION['userID'] . " AND u.userID=r.stuID AND r.classID=c.classID AND r.registerApproval=1";
                        $result = mysqli_query($con, $q);
                    ?>

                    <?php mysqli_free_result($result);
                    ?>
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