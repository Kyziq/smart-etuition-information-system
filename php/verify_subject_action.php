
<?php
session_start();
if (isset($_SESSION['userID']) && $_SESSION['userLevel'] == 1) {

    // For verifying
    if (isset($_POST['updateButton'])) {
        // Get all the posted items
        $classID = $_POST['classID'];
        $stuID = $_POST['stuID'];
        $regApproval = $_POST['action'];
        $adminID = $_SESSION['userID'];

        // Check if null action is updated
        if ($regApproval == 0)
            header("Location: verify_subject.php");

        // Connect to database 
        $con = mysqli_connect('localhost', 'root', '', 'smartetuition') or die(mysqli_error($con));
        // echo $classID, $stuID, $regApproval, $adminID;

        // Construct and run query to update register database
        $q = "UPDATE register SET registerApproval=$regApproval, adminID=$adminID WHERE stuID=$stuID AND classID=$classID";
        $res = mysqli_query($con, $q);

        // Add and minus student count (totalStudent) in class database
        function mysqli_result($res, $row, $field = 0)
        {
            $res->data_seek($row);
            $datarow = $res->fetch_array();
            return $datarow[$field];
        }
        $totalStu = mysqli_result(mysqli_query($con, ("SELECT totalStudent FROM class WHERE classID=$classID")), 0);
        if ($totalStu >= 0) {
            if ($regApproval == 1)
                $totalStu++;
            else if ($regApproval == 2 || $regApproval == 3)
                if ($totalStu > 0)
                    $totalStu--;
        }
        $q = "UPDATE class SET totalStudent=$totalStu WHERE classID=$classID";
        mysqli_query($con, $q);

        // Update who (admin) verify subject
        $q = "UPDATE register SET adminID=" . $_SESSION['userID'] . " WHERE stuID=$stuID AND classID=$classID";
        mysqli_query($con, $q);

        // Success popup
        /*echo
        "
            <script>
                alert('Class registration succesful!');
                window.location.href='verify_subject.php';
            </script>
        ";*/
        header("Location: verify_subject.php");
    }
    // For deletion
    else if (isset($_POST['deleteVerifyButton'])) {
        // Connect to database 
        include_once 'dbcon.php';
        // Get the posted item
        $classID = $_POST['classID'];
        $stuID = $_POST['stuID'];

        // Construct and run query delete payment file
        $q = "SELECT proofPayment FROM register WHERE classID='$classID' AND stuID='$stuID'";
        $res = mysqli_query($con, $q);
        $r = mysqli_fetch_assoc($res);
        $file_pointer = $r['proofPayment'];
        unlink($file_pointer);

        // Construct and run query to delete register row
        $q = "DELETE FROM register WHERE classID='$classID' AND stuID='$stuID'";
        $res = mysqli_query($con, $q);

        // Minus student count (totalStudent) in class database
        function mysqli_result($res, $row, $field = 0)
        {
            $res->data_seek($row);
            $datarow = $res->fetch_array();
            return $datarow[$field];
        }
        $totalStu = mysqli_result(mysqli_query($con, ("SELECT totalStudent FROM class WHERE classID=$classID")), 0);
        if ($totalStu > 0)
            $totalStu--;
        $q = "UPDATE class SET totalStudent=$totalStu WHERE classID=$classID";
        mysqli_query($con, $q);

        // Success popup
        /*echo
        "
            <script>
                alert('Deletion of the registered class succesful!');
                window.location.href='verify_subject.php';
            </script>
        ";*/
        header("Location: verify_subject.php");
    }
    // Clear results and close the connection
    //mysqli_free_result($res);
    mysqli_close($con);
} else {
    header("Location: verify_subject.php");
}
