<!DOCTYPE html> 
<html> 
<head> 
<style> 
table { 
    width: 100%; 
    border-collapse: collapse; 
} 
 
table, td, th { 
    border: 1px solid black; 
    padding: 5px; 
} 
 
th {text-align: left;} 
</style> 
</head> 
<body> 
<h1> AJAX RESPONSE </h1> 
<?php 
$q = $_GET['q']; 
 
$con = mysqli_connect('localhost','root','','mydb'); 
if (!$con) { 
    die('Could not connect: ' . mysqli_error($con)); 
} 
$sql="SELECT * FROM customers WHERE id = '".$q."'"; 
$result = mysqli_query($con,$sql); 
 
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
</body> 
</html>
