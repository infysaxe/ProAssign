<html>
<head>
<style>
#fetchproject tr:hover td {
// font-weight:bold;
// font-size: 105%;
 color:#2655ef;
}
</style>
</head>
<body>
<?php
usleep(25000);
$db_host = 'localhost';
$db_user = 'mso_usr';
$db_pwd = 'mso_usr';
$database = 'TestGrid';
$pid = $_POST['pid'];
echo "<div align='right' style='color: blue;'>Click to Hide Details</div>";
print ("<b>Forecast for Project $pid</b>");
if (!mysql_connect($db_host, $db_user, $db_pwd))
    die("Can't connect to database");

if (!mysql_select_db($database))
    die("Can't select database");
$result1 = mysql_query("SELECT projectid,project_type,TotalForecast,TotalAssigned,January,February,March,April,May,June,July,August,September,October,November,December from ProjectData where projectid like '%$pid%'");
if (!$result1) {
    die("Query to show fields from table failed");
}

$fields_num1 = mysql_num_fields($result1);

//echo "<h1>Monthly Overall Project Forecast</h1>";
echo "<table id='fetchproject' style='border: 1px solid black;border-collapse: collapse;'>";
echo "<tr bgcolor='#8aa2f2'><th style='border: solid 1px;'>Project</th><th style='border: solid 1px;'>Type</th><th style='border: solid 1px;'>TotalForecast</th><th style='border: solid 1px;'>TotalAssigned</th><th style='border: solid 1px;'>Jan</th><th style='border: solid 1px;'>Feb</th><th style='border: solid 1px;'>Mar</th><th style='border: solid 1px;'>Apr</th><th style='border: solid 1px;'>May</th><th style='border: solid 1px;'>Jun</th><th style='border: solid 1px; width : auto;'>Jul</th><th style='border: solid 1px;'>Aug</th><th style='border: solid 1px;'>Sep</th><th style='border: solid 1px;'>Oct</th><th style='border: solid 1px;'>Nov</th><th style='border: solid 1px;'>Dec</th></tr>\n";
// printing table headers
//for($i=0; $i<$fields_num1; $i++)
//{
  //  $field1 = mysql_fetch_field($result1);
    //echo "<td>{$field1->name}</td>";
//}
while($row1 = mysql_fetch_array($result1, MYSQL_ASSOC))
{
    echo "<tr>";

    // $row is array... foreach( .. ) puts every element
    // of $row to $cell variable
    foreach($row1 as $celli){
    echo "<td align='right' style='border: 1px solid black;border-collapse: collapse;'>$celli</td>";
}
    echo "</tr>\n";

}
mysql_free_result($result1);



?>


</body></html>
