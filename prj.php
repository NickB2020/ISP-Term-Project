<html>
<head>
    <title> Database Programming with PHP </title>
    <style type = "text/css">
    td, th, table {border: thin solid black;}
    </style>
</head>
<body>

<?php

// Get input data
    $id = $_POST["id"];
    $type = $_POST["type"];
    $points= $_POST["points"];
    $action = $_POST["action"];


    // If any of numerical values are blank, set them to zero
    if ($id == "") $id = 0;

// Connect to MySQL
$db = mysqli_connect("localhost:3306", "root", "","isp");
//$db = mysqli_connect("db1.cs.uakron.edu:3306", "xiaotest", "wpdb","xiaotest");
if (!$db) {
     print "Error - Could not connect to MySQL";
     exit;
}

// Select the database
$er = mysqli_select_db($db,"isp");
if (!$er) {
    print "Error - Could not select the database";
    exit;
}

// print "<b> The action is: </b> $action <br />";


if ($action == "insert")
    $query = "insert into score values('$id', '$type', '$points')";
else if ($action == "delete")
    $query = "delete from score where score_id = $id";

if($query != ""){
    trim($query);
    $query_html = htmlspecialchars($query);
    print "<b> The query is: </b> " . $query_html . "<br />";

// Don't remove or comment out the line below untill you switched to your own database. VIOLATORS WILL BE SEVERELY PUNISHED!!! :-).
  //  $query = "SELECT * FROM score";

    $result = mysqli_query($db,$query);
    //if (!$result) {
      //  print "Error - the query could not be executed";
       // $error = mysqli_error();
        //print "<p>" . $error . "</p>";
   // }
}
// Final Display of All Entries
$query = "SELECT * FROM score";
$result = mysqli_query($db,$query);
if (!$result) {
    print "Error - the query could not be executed";
    $error = mysqli_error();
    print "<p>" . $error . "</p>";
    exit;
}
// Get the number of rows in the result, as well as the first row
//  and the number of fields in the rows
$num_rows = mysqli_num_rows($result);
//print "Number of rows = $num_rows <br />";

print "<table><caption> <h2> Scores ($num_rows) </h2> </caption>";
print "<tr align = 'center'>";

$row = mysqli_fetch_array($result);
$num_fields = mysqli_num_fields($result);

// Produce the column labels
$keys = array_keys($row);
for ($index = 0; $index < $num_fields; $index++)
    print "<th>" . $keys[2 * $index + 1] . "</th>";
print "</tr>";

// Output the values of the fields in the rows
for ($row_num = 0; $row_num < $num_rows; $row_num++) {
    print "<tr align = 'center'>";
    $values = array_values($row);
    for ($index = 0; $index < $num_fields; $index++){
        $value = htmlspecialchars($values[2 * $index + 1]);
        print "<th>" . $value . "</th> ";
    }
    print "</tr>";
    $row = mysqli_fetch_array($result);
}
print "</table>";
?>
<button onclick="window.location.href='http://localhost/isp/prj/prj.html'">Back To Game</button>
</body>
</html>
