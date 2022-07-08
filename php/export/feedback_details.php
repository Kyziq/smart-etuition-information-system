<?php
// Export data to CSV
if (isset($_GET['exportFeedbackDetails'])) {
    include_once '../dbcon.php';
    // Fetch records from database 
    $query = $con->query("SELECT * FROM feedback");

    if ($query->num_rows > 0) {
        $delimiter = ",";
        $filename = "feedbackList " . date('Y-m-d') . ".csv";

        // Create a file pointer 
        $f = fopen('php://memory', 'w');

        // Set column headers 
        $fields = array('fbID', 'fbTitle', 'fbComment', 'fbDate');
        fputcsv($f, $fields, $delimiter);

        // Output each row of the data, format line as csv and write to file pointer 
        while ($row = $query->fetch_assoc()) {
            $lineData = array($row['fbID'], $row['fbTitle'], $row['fbComment'], $row['fbDate']);
            fputcsv($f, $lineData, $delimiter);
        }

        // Move back to beginning of file 
        fseek($f, 0);

        // Set headers to download file rather than displayed 
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '";');

        //output all remaining data on a file pointer 
        fpassthru($f);
    }
    exit;
}
