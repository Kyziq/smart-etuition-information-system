<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS -->
    <link rel="stylesheet" href="../css/style2.css">
</head>

<body>
    <?php
    //fetch.php
    $con = mysqli_connect("localhost", "root", "", "smartetuition");
    $output = '';
    if (isset($_POST["query"])) {
        $search = mysqli_real_escape_string($con, $_POST["query"]);
        $query = "SELECT * FROM user WHERE userLevel='2' AND (userName LIKE '%" . $search . "%'
            OR userPhone LIKE '%" . $search . "%' 
            OR userEmail LIKE '%" . $search . "%' 
            OR userBirthdate LIKE '%" . $search . "%' 
            OR userAddress LIKE '%" . $search . "%')
    ";
    } else {
        $query = "SELECT * FROM user WHERE userLevel='2' ORDER BY userID";
    }
    $result = mysqli_query($con, $query);
    if (mysqli_num_rows($result) > 0) {
        $output .= '
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
            <tbody>';
        while ($row = mysqli_fetch_array($result)) {
            $output .= "
                    <form method='POST' action='manage_user_save.php' id='form123'>
                    <tr>
                        <input type='hidden' name='userID' style='text-align:center; color: var(--red);' size='1' value='" . $row['userID'] . "'readonly>
                        <!-- <td style='text-align: left;'><input type='text' name='userUname' style='text-align:center;' size='10' value='" . $row['userUname'] . "'></td> -->
                        <td style='text-align: left;'><input type='text' name='userName' style='text-align:center;' size='20' value='" . $row['userName'] . "'></td>
                        <td style='text-align: left;'>";
            if ($row['userGender'] == 1) {
                $output .= "
                            <select name='userGender'>
                                <option selected value='1'>Male</option>
                                <option value='2'>Female</option>
                            </select>";
            }
            if ($row['userGender'] == 2) {
                $output .= "<select name='userGender'>
                                <option value='1'>Male</option>
                                <option selected value='2'>Female</option>
                            </select>";
            }
            $output .= "</td>
                        <td style='text-align: left;'><input type='text' name='userPhone' style='text-align:center;' size='10' value='" . $row['userPhone'] . "'></td>
                        <td style='text-align: left;'><input type='text' name='userEmail' style='text-align:center;' size='20' value='" . $row['userEmail'] . "'></td>
                        <td style='text-align: left;'><input type='text' name='userBirthdate' style='text-align:center;' size='5' value='" . $row['userBirthdate'] . "'></td>
                        <td style='text-align: left;'>
                            <textarea type='text' name='userAddress' style='text-align:center;' rows='3' cols='40'>" . $row['userAddress'] . "</textarea>
                        </td>
                        <td style='text-align: end;'>
                        <button type='submit' style='padding: 0; border: none; background: none;' form='form123' name='saveUserButton'>
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
                    </tr>
                </form>
                ";
        }
        $output .=
            '</tbody> 
        </table>';
        echo $output;
    } else {
        echo 'Data Not Found';
    }
    ?>
</body>

</html>