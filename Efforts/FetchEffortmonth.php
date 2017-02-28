<html>
<head>
<style>
#effassign tr:hover td {
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
$table = 'EmployeeData';
$eid = $_POST['eid'];
echo "<div align='right' style='color: blue;'>Click to Hide Details</div>";
print ("<b>Assignment for Employee $eid</b> <img src='FetchEffortmonth.jpg'>");
if (!mysql_connect($db_host, $db_user, $db_pwd))
    die("Can't connect to database");

if (!mysql_select_db($database))
    die("Can't select database");
$result1 = mysql_query("SELECT projectid,projecttype,Employee,January,February,March,April,May,June,July,August,September,October,November,December from EffortDetails where Employee like '%$eid%'");
if (!$result1) {
    die("Query to show fields from table failed");
}

$fields_num1 = mysql_num_fields($result1);

//echo "<h1>Monthly Overall Project Forecast</h1>";
echo "<table id='effassign' style='border: 1px solid black;border-collapse: collapse;'>";
echo "<tr><th style='border: solid 1px;'>Project</th><th style='border: solid 1px;'>Type</th><th style='border: solid 1px;'>Employee</th><th style='border: solid 1px;'>Jan</th><th style='border: solid 1px;'>Feb</th><th style='border: solid 1px;'>Mar</th><th style='border: solid 1px;'>Apr</th><th style='border: solid 1px;'>May</th><th style='border: solid 1px;'>Jun</th><th style='border: solid 1px; width : auto;'>Jul</th><th style='border: solid 1px;'>Aug</th><th style='border: solid 1px;'>Sep</th><th style='border: solid 1px;'>Oct</th><th style='border: solid 1px;'>Nov</th><th style='border: solid 1px;'>Dec</th></tr>\n";
// printing table headers
//for($i=0; $i<$fields_num1; $i++)
//{
  //  $field1 = mysql_fetch_field($result1);
    //echo "<td>{$field1->name}</td>";
//}
while($row1 = mysql_fetch_array($result1, MYSQL_ASSOC))
{
    echo "<tr>";
if ($row1['January'] >0 || $row1['February'] >0 || $row1['March'] >0 || $row1['April'] >0 || $row1['May'] >0 || $row1['June'] >0 || $row1['July'] >0 || $row1['August'] >0 || $row1['September'] >0 || $row1['October'] >0 || $row1['November'] >0 || $row1['December'] >0 )
{
$empcolor='#c1fc94';
}
else
{
$empcolor='#e3e8e4';
}
    // $row is array... foreach( .. ) puts every element
    // of $row to $cell variable
    foreach($row1 as $celli){
    if ($celli == 0)
{
$color='#e3e8e4';
}
if (($celli) > 0 && (!preg_match('/[A-Z]/', $celli)))
{
$color='#c1fc94';
}
if ($celli < 0)
{
$color='#fc9f53';
}
//if (strpos($celli, '-') !== false)
if (preg_match('/[A-Z]/', $celli))
{
$color=$empcolor;
}
    
    echo "<td align='right' bgcolor='$color' style='border: 1px solid black;border-collapse: collapse;'>$celli</td>";
}
    echo "</tr>\n";

}
mysql_free_result($result1);



?>


</body></html>
