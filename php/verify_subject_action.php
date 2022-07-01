
<?php
session_start();
if (isset($_SESSION['userID']) && $_SESSION['userLevel'] == 1) {
    if (isset($_POST['updateButton'])) {

        // Get all the posted items
        $classID = $_POST['classID'];
        $stuID = $_POST['stuID'];
        $regApproval = $_POST['action'];
        $adminID = $_SESSION['userID'];

        // Connect to database 
        $con = mysqli_connect('localhost', 'root', '', 'smartetuition') or die(mysqli_error($con));

        // Construct and run query to update register database
        $q = "UPDATE register SET registerApproval=$regApproval, adminID=$adminID WHERE stuID=$stuID AND classID=$classID";
        $res = mysqli_query($con, $q);

        // Add student count (totalStudent) in class database
        if ($regApproval == 1) {
            function mysqli_result($res, $row, $field = 0)
            {
                $res->data_seek($row);
                $datarow = $res->fetch_array();
                return $datarow[$field];
            }
            $totalStu = mysqli_result(mysqli_query($con, ("SELECT totalStudent FROM class WHERE classID=$classID")), 0);
            $totalStu++;
            $q = "UPDATE class SET totalStudent=$totalStu WHERE classID=$classID";
            mysqli_query($con, $q);
        }
        // Success popup
        echo
        "
            <script>
            alert('Subject verification success!');
            window.location.href='verify_subject.php';
            </script>
        ";

        // Clear results and close the connection
        mysqli_free_result($res);
        mysqli_close($con);
    } else {
        header("Location: verify_subject.php");
    }
}
