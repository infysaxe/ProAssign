<html>
<head>
<meta http-equiv="refresh" content="60" > 
<script src="js/jquery-1.11.1.min.js" ></script>
        <!-- EditableGrid test if jQuery UI is present. If present, a datepicker is automatically used for date type -->
        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {

    $('#employee td').click(function() {
    var fempid = $(this).closest('tr').find('td:first').text();
    //$('#employeefetch').show();
    $('#employeefetch').load('FetchEmployeeForecast.php', {eid: $(this).closest('tr').find('td:first').text()}).hide().fadeIn('normal');
    $('#employeefetch').css({'background-color' : '#f6f6f6', 'position' : 'fixed', 'margin-left' : '-450px', 'margin-top' : '-150px', 'z-index' : '1000', 'width' : 'auto', 'height' : 'auto' , 'border-radius' : '20px','padding' : '20px', 'left' : '50%', 'top' : '50%'});
    });
$('#employeefetch').click(function() {
$('#employeefetch').hide('');
 });

});
</script>
<style>
tr:hover td {
 //font-weight:bold;       
 //font-size: 101%;
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
$eid = $_POST['eid'];
echo "<h3>Overall Employee Availability</h3> <img src='EmployeeAvailability.jpg'>";
if (!mysql_connect($db_host, $db_user, $db_pwd))
    die("Can't connect to database");

if (!mysql_select_db($database))
    die("Can't select database");

$result1 = mysql_query("SELECT Employee,TotalAvailable,EAVJanuary,EAVFebruary,EAVMarch,EAVApril,EAVMay,EAVJune,EAVJuly,EAVAugust,EAVSeptember,EAVOctober,EAVNovember,EAVDecember from EmployeeData order by Employee asc");
if (!$result1) {
    die("Query to show fields from table failed");
}

$fields_num1 = mysql_num_fields($result1);

//echo "<h1>Monthly Overall Project Forecast</h1>";
echo "<table id='employee' name='employee' style='border: 1px solid black;border-collapse: collapse;'>";
echo "<tr bgcolor='#8aa2f2'><th style='border: solid 1px;width:200px;'>Employee</th><th style='border: solid 1px;'>Total Available</th><th style='border: solid 1px;'>January</th><th style='border: solid 1px;'>February</th><th style='border: solid 1px;'>March</th><th style='border: solid 1px;'>April</th><th style='border: solid 1px;'>May</th><th style='border: solid 1px;'>June</th><th style='border: solid 1px; width : auto;'>July</th><th style='border: solid 1px;'>August</th><th style='border: solid 1px;'>September</th><th style='border: solid 1px;'>October</th><th style='border: solid 1px;'>November</th><th style='border: solid 1px;'>December</th></tr>";
// printing table headers
//for($i=0; $i<$fields_num1; $i++)
//{
  //  $field1 = mysql_fetch_field($result1);
    //echo "<td>{$field1->name}</td>";
//}
while($row1 = mysql_fetch_array($result1, MYSQL_ASSOC))
{

    echo "<tr>";
if ($row1['TotalAvailable'] > 0)
{
$empcolor='#c1fc94';
}
if ($row1['TotalAvailable'] < 0)
{
$empcolor='#fc9f53';
}
if ($row1['TotalAvailable'] == 0)
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
else
{
$color='#c1fc94';
}
if ($celli < 0)
{
$color='#fc9f53';
}
if (preg_match('/[A-Z]/', $celli))
{
$color=$empcolor;
}
echo "<td align='right' bgcolor='$color' width='60' style='border: 1px solid black;border-collapse: collapse;'>$celli</td>";
}
    echo "</tr>";

}
echo "</table>";
mysql_free_result($result1);

$sresult = mysql_query("SELECT sum(TotalAvailable),sum(EAVJanuary),sum(EAVFebruary),sum(EAVMarch),sum(EAVApril),sum(EAVMay),sum(EAVJune),sum(EAVJuly),sum(EAVAugust),sum(EAVSeptember),sum(EAVOctober),sum(EAVNovember),sum(EAVDecember) from EmployeeData");
if (!$sresult) {
    die("Query to show fields from table failed");
}

$sfields_num = mysql_num_fields($sresult);


echo "<table id='employee' name='employee' style='border: 1px solid black;border-collapse: collapse;'>";
echo "<tr bgcolor='#8aa2f2'><th style='border: solid 1px;width:306px;'>Total Available</th><th style='border: solid 1px;'>January</th><th style='border: solid 1px;'>February</th><th style='border: solid 1px;'>March</th><th style='border: solid 1px;'>April</th><th style='border: solid 1px;'>May</th><th style='border: solid 1px;'>June</th><th style='border: solid 1px; width : auto;'>July</th><th style='border: solid 1px;'>August</th><th style='border: solid 1px;'>September</th><th style='border: solid 1px;'>October</th><th style='border: solid 1px;'>November</th><th style='border: solid 1px;'>December</th></tr>";
// printing table headers
//for($i=0; $i<$sfields_num; $i++)
//{
  //  $sfield = mysql_fetch_field($sresult);
    //echo "<td>{$sfield->name}</td>";
//}
while($srow = mysql_fetch_array($sresult, MYSQL_ASSOC))
{

    echo "<tr>";

    // $row is array... foreach( .. ) puts every element
    // of $row to $cell variable
    foreach($srow as $scell){
if ($scell == 0)
{
$color='#e3e8e4';
}
else
{
$color='#c1fc94';
}
if ($scell < 0)
{
$color='#fc9f53';
}
echo "<td align='right' bgcolor='$color' width='60' style='border: 1px solid black;border-collapse: collapse;'>$scell</td>";
}
    echo "</tr>";

}
echo "</table>";
mysql_free_result($sresult);

echo "<div id='employeefetch'>";
echo "</div>";

?>
</body>
</html>
