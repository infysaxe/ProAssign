<html>
<head>
<script src="js/jquery-1.11.1.min.js" ></script>
        <!-- EditableGrid test if jQuery UI is present. If present, a datepicker is automatically used for date type -->
        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {

    $('#empassign td').click(function() {
    var fempid = $(this).closest('tr').find('td:first').text();
    $('#fetchemp').show();
    $('#fetchemp').load('FetchEffortmonth.php', {eid: $(this).closest('tr').find('td:first').text()}); 
    $('#fetchemp').css({'background-color' : '#f6f6f6', 'position' : 'fixed', 'margin-left' : '-350px', 'margin-top' : '-250px', 'z-index' : '1000', 'width' : 'auto', 'height' : 'auto' , 'border-radius' : '20px','padding' : '20px', 'left' : '50%', 'top' : '50%'});
    });
$('#fetchemp').click(function() {
$('#fetchemp').hide('');
 });

});
</script>
<style>
#empassign tr:hover td {
 //font-weight:bold;
 //font-size: 100%;
 color:#2655ef;
 }
th {
color:#5A86BA;
}
</style>
</head>
<body onload="$('#fetchemp').hide();">
<?php
usleep(25000);
$db_host = 'localhost';
$db_user = 'mso_usr';
$db_pwd = 'mso_usr';

$database = 'TestGrid';
$table = 'ProjectDataTotal';
$pid = $_POST['pid'];
print ("<h2>Forecast / Assignment details for Project : $pid</h2> <br />");
print ("<img src='Effortfilter.jpg'>");
if (!mysql_connect($db_host, $db_user, $db_pwd))
    die("Can't connect to database");

if (!mysql_select_db($database))
    die("Can't select database");
$resultp = mysql_query("SELECT project_type,TotalForecast,January,February,March,April,May,June,July,August,September,October,November,December from ProjectData where projectid like '$pid%' order by project_type asc");
if (!$resultp) {
    die("Query to show fields from table failed");
}

$fields_nump = mysql_num_fields($resultp);

//echo "<h1>Monthly Overall Project Forecast</h1>";
echo "<table style='border: 1px solid black;border-collapse: collapse;'>";
echo "<tr border='1' bgcolor='#E5E5E5'><th style='border: solid 1px;width:200px;'></th><th style='border: solid 1px;'>Forecast</th><th style='border: solid 1px;'>January</th><th style='border: solid 1px;'>February</th><th style='border: solid 1px;'>March</th><th style='border: solid 1px;'>April</th><th style='border: solid 1px;'>May</th><th style='border: solid 1px;'>June</th><th style='border: solid 1px; width : auto;'>July</th><th style='border: solid 1px;'>August</th><th style='border: solid 1px;'>September</th><th style='border: solid 1px;'>October</th><th style='border: solid 1px;'>November</th><th style='border: solid 1px;'>December</th></tr>\n";

while($rowp = mysql_fetch_array($resultp, MYSQL_ASSOC))
{
    echo "<tr>";

    // $row is array... foreach( .. ) puts every element
    // of $row to $cell variable
    foreach($rowp as $cellp)
    {
    if ($cellp == 'CAPEX' || $cellp == 'OPEX' || $cellp == 'Overhead')
     {
     $cellp = "Forecast For ".$cellp;
     }    
    echo "<td align='right' width='60' style='border: 1px solid black;border-collapse: collapse;'>$cellp</td>";
    }
    echo "</tr>\n";
}
mysql_free_result($resultp);

// sending query
$result = mysql_query("SELECT project_type,TotalAvailable,PAVJanuary,PAVFebruary,PAVMarch,PAVApril,PAVMay,PAVJune,PAVJuly,PAVAugust,PAVSeptember,PAVOctober,PAVNovember,PAVDecember from ProjectData where projectid like '$pid%' order by project_type asc");
if (!$result) {
    die("Query to show fields from table failed");
}

$fields_num = mysql_num_fields($result);

//echo "<h1>Monthly Overall Project Forecast</h1>";
echo "<table style='border: 1px solid black;border-collapse: collapse;'>";
echo "<tr border='1' bgcolor='#E5E5E5'><th style='border: solid 1px;width:200px;'></th><th style='border: solid 1px;padding:2px;'>To Assign</th><th style='border: solid 1px;'>January</th><th style='border: solid 1px;'>February</th><th style='border: solid 1px;'>March</th><th style='border: solid 1px;'>April</th><th style='border: solid 1px;'>May</th><th style='border: solid 1px;'>June</th><th style='border: solid 1px; width : auto;'>July</th><th style='border: solid 1px;'>August</th><th style='border: solid 1px;'>September</th><th style='border: solid 1px;'>October</th><th style='border: solid 1px;'>November</th><th style='border: solid 1px;'>December</th></tr>\n";

// printing table headers
//for($i=0; $i<$fields_num; $i++)
//{
  //  $field = mysql_fetch_field($result);
    //echo "<td>{$field->name}</td>";
//}
//echo "</tr>\n";
// printing table rows
while($row = mysql_fetch_array($result, MYSQL_ASSOC))
{
if ($row['PAVJanuary'] < 0 || $row['PAVFebruary'] < 0 || $row['PAVMarch'] < 0 || $row['PAVApril'] < 0 || $row['PAVMay'] < 0 || $row['PAVJune'] < 0 || $row['PAVJuly'] < 0 || $row['PAVAugust'] < 0 || $row['PAVSeptember'] < 0 || $row['PAVOctober'] < 0 || $row['PAVNovember'] < 0 || $row['PAVDecember'] < 0)
{
$rcolor='#FAAC58';
}
else
{
$rcolor='#c1fc94';
}
    echo "<tr>";

    // $row is array... foreach( .. ) puts every element
    // of $row to $cell variable
    foreach($row as $cell)
{
if ($cell == 'CAPEX' || $cell == 'OPEX' || $cell == 'Overhead')
     {
     $cell = "Capacity left for  ".$cell;
     } 
if ($cell < 0)
{
$icolor='#fc9f53';
}
if ($cell > 0)
{
$icolor='#c1fc94';
}
if ($cell == 0)
{
$icolor='#e3e8e4';
}
if (preg_match('/[A-Z]/', $cell))
{
$icolor=$rcolor;
}

      echo "<td align='right' width='60' bgcolor='$icolor' style='border: 1px solid black;border-collapse: collapse;'>$cell</td>";
}
    echo "</tr>\n";
}
mysql_free_result($result);
$result1 = mysql_query("SELECT Employee,TotalAvailable,EAVJanuary,EAVFebruary,EAVMarch,EAVApril,EAVMay,EAVJune,EAVJuly,EAVAugust,EAVSeptember,EAVOctober,EAVNovember,EAVDecember from EmployeeData where id in (select distinct(empid) from EffortDetails where projectid like '$pid%') order by Employee asc");
if (!$result1) {
    die("Query to show fields from table failed");
}

$fields_num1 = mysql_num_fields($result1);

//echo "<h1>Monthly Overall Project Forecast</h1>";
echo "<table id='empassign' name='empassign' style='border: 1px solid black;border-collapse: collapse;'>";
echo "<tr bgcolor='#E5E5E5'><th style='border: solid 1px;width:200px;'>Availability of Employee</th><th style='border: solid 1px;'>Available</th><th style='border: solid 1px;'>January</th><th style='border: solid 1px;'>February</th><th style='border: solid 1px;'>March</th><th style='border: solid 1px;'>April</th><th style='border: solid 1px;'>May</th><th style='border: solid 1px;'>June</th><th style='border: solid 1px; width : auto;'>July</th><th style='border: solid 1px;'>August</th><th style='border: solid 1px;'>September</th><th style='border: solid 1px;'>October</th><th style='border: solid 1px;'>November</th><th style='border: solid 1px;'>December</th></tr>\n";
// printing table headers
//for($i=0; $i<$fields_num1; $i++)
//{
  //  $field1 = mysql_fetch_field($result1);
    //echo "<td>{$field1->name}</td>";
//}
while($row1 = mysql_fetch_array($result1, MYSQL_ASSOC))
{
    echo "<tr>";
if ($row1['EAVJanuary'] < 0 || $row1['EAVFebruary'] < 0 || $row1['EAVMarch'] < 0 || $row1['EAVApril'] < 0 || $row1['EAVMay'] < 0 || $row1['EAVJune'] < 0 || $row1['EAVJuly'] < 0 || $row1['EAVAugust'] < 0 || $row1['EAVSeptember'] < 0 || $row1['EAVOctober'] < 0 || $row1['EAVNovember'] < 0 || $row1['EAVDecember'] < 0)
{
$ecolor='#fc9f53';
}
else
{
if ($row1['TotalAvailable'] ==0)
{
$ecolor='#e3e8e4';
}
else
{
$ecolor='#c1fc94';
}
}

  

    // $row is array... foreach( .. ) puts every element
    // of $row to $cell variable
    foreach($row1 as $celli){
if ($celli == 0)
{
$color='#e3e8e4';
}
if ($celli > 0)
{
$color='#c1fc94';
}
if ($celli < 0)
{
$color='#fc9f53';
}
if (preg_match('/[A-Z]/', $celli))
{
$color=$ecolor;
}
    
    echo "<td align='right' width='60' bgcolor='$color' style='border: 1px solid black;border-collapse: collapse;'>$celli</td>";
}
    echo "</tr>\n";

}
mysql_free_result($result1);



echo "<div id='fetchemp'>";
echo "</div>";
?>
</body></html>
