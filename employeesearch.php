<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Search Employee</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, td, th {
            border: 1px solid black;
            padding: 5px;
        }

        th {
            text-align: left;
        }
    </style>
    <script>
        function showEmployee(str) {
            if (str.trim() == "") {
                document.getElementById("employee-details").innerHTML = "";
                return;
            } else {
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("employee-details").innerHTML = this.responseText;
                    }
                };
                xmlhttp.open("GET", "getemployee.php?q=" + str, true);
                xmlhttp.send();
            }
        }
    </script>
</head>
<body>
<h1>Search Employee</h1>
<form>
    Employee ID: <input type="text" onkeyup="showEmployee(this.value)">
</form>
<div id="employee-details"></div>
</body>
</html>

<?php
if (!isset($_GET['q']) || !ctype_digit($_GET['q'])) {
    echo "Please provide a valid employee ID.";
    exit;
}

$q = $_GET['q'];

$con = mysqli_connect('localhost', 'root', '', 'my_db');
if (!$con) {
    die('Could not connect to the database: ' . mysqli_connect_error());
}

$stmt = mysqli_prepare($con, "SELECT * FROM employees WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $q);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (!$result || mysqli_num_rows($result) == 0) {
    echo "No employee found with ID $q.";
    exit;
}

echo "<table> 
<tr> 
<th>Name</th> 
<th>Address</th> 
<th>Phone</th> 
</tr>"; 
while($row = mysqli_fetch_array($result)) { 
    echo "<tr>"; 
    echo "<td>" . $row['name'] . "</td>"; 
    echo "<td>" . $row['address'] . "</td>"; 
    echo "<td>" . $row['phone'] . "</td>"; 
    echo "</tr>"; 
} 
echo "</table>"; 
mysqli_close($con); 
?>
