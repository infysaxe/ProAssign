<html>
<head>
<meta http-equiv="refresh" content="60" > 
<script src="js/jquery-1.11.1.min.js" ></script>
        <!-- EditableGrid test if jQuery UI is present. If present, a datepicker is automatically used for date type -->
        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {

    $('#asspro td').click(function() {
    var fempid = $(this).closest('tr').find('td:first').text();
    //$('#projectfetch').show();
    $('#projectfetch').load('FetchProject.php', {pid: $(this).closest('tr').find('td:first').text()}).hide().fadeIn('normal');
    $('#projectfetch').css({'background-color' : '#f6f6f6', 'position' : 'fixed', 'margin-left' : '-450px', 'margin-top' : '-150px', 'z-index' : '1000', 'width' : 'auto', 'height' : 'auto' , 'border-radius' : '20px','padding' : '20px', 'left' : '50%', 'top' : '50%'});
    });
$('#projectfetch').click(function() {
$('#projectfetch').hide('');
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
echo "<h3>Unassigned effort for Projects</h3> <img src='ProjectAvailability.jpg'>";
if (!mysql_connect($db_host, $db_user, $db_pwd))
    die("Can't connect to database");

if (!mysql_select_db($database))
    die("Can't select database");

$result1 = mysql_query("SELECT projectid,project_type,(TotalForecast-TotalAssigned) as TotalUnassigned,PAVJanuary,PAVFebruary,PAVMarch,PAVApril,PAVMay,PAVJune,PAVJuly,PAVAugust,PAVSeptember,PAVOctober,PAVNovember,PAVDecember from ProjectData order by projectid,project_type asc");
if (!$result1) {
    die("Query to show fields from table failed");
}

$fields_num1 = mysql_num_fields($result1);

//echo "<h1>Monthly Overall Project Forecast</h1>";
echo "<table id='asspro' name='asspro' style='border: 1px solid black;border-collapse: collapse;'>";
echo "<tr bgcolor='#8aa2f2'><th style='border: solid 1px;width:200px;'>Project</th><th style='border: solid 1px;'>Type</th><th style='border: solid 1px;'>Total Unassigned</th><th style='border: solid 1px;'>January</th><th style='border: solid 1px;'>February</th><th style='border: solid 1px;'>March</th><th style='border: solid 1px;'>April</th><th style='border: solid 1px;'>May</th><th style='border: solid 1px;'>June</th><th style='border: solid 1px; width : auto;'>July</th><th style='border: solid 1px;'>August</th><th style='border: solid 1px;'>September</th><th style='border: solid 1px;'>October</th><th style='border: solid 1px;'>November</th><th style='border: solid 1px;'>December</th></tr>";
// printing table headers
//for($i=0; $i<$fields_num1; $i++)
//{
  //  $field1 = mysql_fetch_field($result1);
    //echo "<td>{$field1->name}</td>";
//}
while($row1 = mysql_fetch_array($result1, MYSQL_ASSOC))
{
if ($row1['TotalUnassigned'] > 0)
{
$empcolor='#c1fc94';
}
if ($row1['TotalUnassigned'] < 0)
{
$empcolor='#fc9f53';
}
if ($row1['TotalUnassigned'] == 0)
{
$empcolor='#e3e8e4';
}
    echo "<tr>";

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
echo "<td align='right' bgcolor='$color' width='auto' style='border: 1px solid black;border-collapse: collapse;'>$celli</td>";
}
    echo "</tr>";

}
echo "</table>";
mysql_free_result($result1);
echo "<div id='projectfetch'>";
echo "</div>";
?>
</body>
</html>
