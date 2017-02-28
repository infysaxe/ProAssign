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
$table = 'ProjectDataTotal';
$pid = $_POST['pid'];
echo "<h3>Overall Employee Assignment</h3> <img src='EmployeeAssignment.jpg'>";
if (!mysql_connect($db_host, $db_user, $db_pwd))
    die("Can't connect to database");

if (!mysql_select_db($database))
    die("Can't select database");

$query = mysql_query("SELECT Employee,TotalAssigned,EAJanuary,EAFebruary,EAMarch,EAApril,EAMay,EAJune,EAJuly,EAAugust,EASeptember,EAOctober,EANovember,EADecember from EmployeeData order by Employee asc");
if (!$query) {
    die("Query to show fields from table failed");
}

$num_fields=mysql_num_fields($query);
$show_fields=mysql_num_fields($query);
$num_rows=mysql_num_rows($query);
$show_rows=mysql_num_rows($query);
$unassignedata = array(array());
$iunassign=0;
while($line = mysql_fetch_array($query)){

$unassignedata[$iunassign]=$line;
$iunassign++;
}
mysql_free_result($query);

$query = mysql_query("SELECT Employee,TotalForecast,January,February,March,April,May,June,July,August,September,October,November,December from EmployeeData order by Employee asc");
if (!$query) {
    die("Query to show fields from table failed");
}

$num_fields=mysql_num_fields($query);
$num_rows=mysql_num_rows($query);
$forecastdata = array(array());
$iforecast=0;
while($line = mysql_fetch_array($query)){

$forecastdata[$iforecast]=$line;
$iforecast++;
}
mysql_free_result($query);

//echo "<h1>Monthly Overall Project Forecast</h1>";
echo "<table id='employee' name='employee' style='border: 1px solid black;border-collapse: collapse;'>";
echo "<tr bgcolor='#8aa2f2'><th style='border: solid 1px;width:200px;'>Employee</th><th style='border: solid 1px;'>Total Assigned</th><th style='border: solid 1px;'>January</th><th style='border: solid 1px;'>February</th><th style='border: solid 1px;'>March</th><th style='border: solid 1px;'>April</th><th style='border: solid 1px;'>May</th><th style='border: solid 1px;'>June</th><th style='border: solid 1px; width : auto;'>July</th><th style='border: solid 1px;'>August</th><th style='border: solid 1px;'>September</th><th style='border: solid 1px;'>October</th><th style='border: solid 1px;'>November</th><th style='border: solid 1px;'>December</th></tr>";

for($i=0;$i<$show_rows;$i++)
{
echo "<tr>";
  for($j=0;$j<$show_fields;$j++)
  {
$color = '#e3e8e4';
$celli=$unassignedata[$i][$j];
if ($j > 0 && (($forecastdata[$i][$j] - $unassignedata[$i][$j]) < 0))
{
$color = '#fc9f53';
}
if ($j > 0 && (($forecastdata[$i][$j] - $unassignedata[$i][$j]) > 0))
{
$color = '#c1fc94';
}

if ($j == 0 && (($forecastdata[$i][1] - $unassignedata[$i][1]) > 0))
{
$color = '#c1fc94';
}

if ($j == 0 && (($forecastdata[$i][1] - $unassignedata[$i][1]) < 0))
{
$color = '#fc9f53';
}


echo "<td align='right' bgcolor='$color' width='60' style='border: 1px solid black;border-collapse: collapse;'>$celli</td>";
  }
echo "</tr>";
}


//DONT TOUCH BELOW

$query = mysql_query("SELECT sum(TotalAssigned),sum(EAJanuary),sum(EAFebruary),sum(EAMarch),sum(EAApril),sum(EAMay),sum(EAJune),sum(EAJuly),sum(EAAugust),sum(EASeptember),sum(EAOctober),sum(EANovember),sum(EADecember) from EmployeeData");

if (!$query) {
    die("Query to show fields from table failed");
}

$num_fields=mysql_num_fields($query);
$show_fields=mysql_num_fields($query);
$num_rows=mysql_num_rows($query);
$show_rows=mysql_num_rows($query);
$sumunassignedata = array();
while($line = mysql_fetch_array($query)){

$sumunassignedata[0]=$line;
}
mysql_free_result($query);

$query = mysql_query("SELECT sum(TotalForecast),sum(January),sum(February),sum(March),sum(April),sum(May),sum(June),sum(July),sum(August),sum(September),sum(October),sum(November),sum(December) from EmployeeData");

if (!$query) {
    die("Query to show fields from table failed");
}

$num_fields=mysql_num_fields($query);
$show_fields=mysql_num_fields($query);
$num_rows=mysql_num_rows($query);
$show_rows=mysql_num_rows($query);
$sumforecastdata = array();
while($line = mysql_fetch_array($query)){
$sumforecastdata[0]=$line;
}
mysql_free_result($query);

echo "<table id='employee' name='employee' style='border: 1px solid black;border-collapse: collapse;'>";
echo "<tr bgcolor='#8aa2f2'><th style='border: solid 1px;width:304px;'>Total Assigned</th><th style='border: solid 1px;'>January</th><th style='border: solid 1px;'>February</th><th style='border: solid 1px;'>March</th><th style='border: solid 1px;'>April</th><th style='border: solid 1px;'>May</th><th style='border: solid 1px;'>June</th><th style='border: solid 1px; width : auto;'>July</th><th style='border: solid 1px;'>August</th><th style='border: solid 1px;'>September</th><th style='border: solid 1px;'>October</th><th style='border: solid 1px;'>November</th><th style='border: solid 1px;'>December</th></tr>";
// printing table headers
//for($i=0; $i<$sfields_num; $i++)
//{
  //  $sfield = mysql_fetch_field($sresult);
    //echo "<td>{$sfield->name}</td>";
//}
for($i=0;$i<$show_rows;$i++)
{
echo "<tr>";
  for($j=0;$j<$show_fields;$j++)
  {
$celli=$sumunassignedata[$i][$j];
if (($sumforecastdata[$i][$j] - $sumunassignedata[$i][$j]) < 0)
{
$color = '#fc9f53';
}
if (($sumforecastdata[$i][$j] - $sumunassignedata[$i][$j]) > 0)
{
$color = '#c1fc94';
}


echo "<td align='right' bgcolor='$color' width='60' style='border: 1px solid black;border-collapse: collapse;'>$celli</td>";
  }
echo "</tr>";
}
echo "</table>";
mysql_free_result($sresult);
//DONT TOUCH ABOVE 
echo "<div id='employeefetch'>";
echo "</div>";
?>
</body>
</html>
