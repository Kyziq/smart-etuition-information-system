<?php
session_start();
// Export data to CSV
if (isset($_SESSION['userID']) && $_SESSION['userLevel'] == 1) {
    if (isset($_GET['exportStudentDetails'])) {
        include_once '../dbcon.php';
        // Fetch records from database 
        $query = $con->query("SELECT * FROM user WHERE userLevel='3'");

        if ($query->num_rows > 0) {
            $delimiter = ",";
            $filename = "studentList " . date('Y-m-d') . ".csv";

            // Create a file pointer 
            $f = fopen('php://memory', 'w');

            // Set column headers 
            $fields = array('userID', 'userName', 'userGender', 'userPhone', 'userEmail', 'userBirthdate', 'userAddress');
            fputcsv($f, $fields, $delimiter);

            // Output each row of the data, format line as csv and write to file pointer 
            while ($row = $query->fetch_assoc()) {
                $status = ($row['userGender'] == 1) ? 'Male' : 'Gender';
                $lineData = array($row['userID'], $row['userName'], $status, $row['userPhone'], $row['userEmail'], $row['userBirthdate'], $row['userAddress']);
                fputcsv($f, $lineData, $delimiter);
            }

            // Move back to beginning of file 
            fseek($f, 0);

            // Set headers to download file rather than displayed 
            header('Content-Type: text/csv');
            header('Content-Disposition: attachment; filename="' . $filename . '";');

            //output all remaining data on a file pointer 
            fpassthru($f);
        } else
            echo    "<script>
                        alert('No data available to export.');
                        window.location.href='../manage_student.php';
                    </script>";
    } else
        header("Location: ../login.php");
    exit;
}
