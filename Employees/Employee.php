<html>
<head>
<script src="js/jquery-1.11.1.min.js" ></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
<script type="text/javascript">
$("a").click(function(e) {
  e.preventDefault();
  $("#femployee").attr("src", $(this).attr("href"));
  $("a").removeClass("active");
  $(this).addClass("active");
})
</script>
<link rel="stylesheet" href="../style.css" type="text/css" media="screen" />
<!--<style>
#iediv {
    height: 16%; 
    position: fixed; 
    bottom:0%;
    width:100%; 
    opacity: 1;
    vertical-align: top;
}
</style>
-->
</head>
<!--<body onload="$('#iediv').load('../Projects/TotalProject.php');">-->
<body>
<br>
<?php
//echo "<iframe id='f4' name='f4' style='display:inline' width=100%' height='10%' src='overview.php'</iframe>";
//echo "<iframe id='femployee' frameborder='0' name='femployee' style='display:inline' width=100%' height='90%' src='employees.html'></iframe>";
//echo "<div id='iediv'>";
//echo "<iframe id='f5' name='f5' width='100%' height='85%' src='Projects/TotalProject.php'></iframe>";
//echo "</div>";
?>
<div id="menu" align="right" style="border-bottom:1px solid #5B2D90;">
<ul id="nav">
    <li><a href="employees.html" target="femployee" class="mitem">Capacity</a></li>
    <li><a href="employeeAssignment.php" target="femployee" class="mitem">Assignment</a></li>
    <li><a href="EmployeesAvailability.php" target="femployee" class="mitem">Availability</a></li>
</ul>
</div>

<iframe id="femployee" name="femployee" width="100%" height="90%" frameborder="0" src="employees.html"></iframe>
</body>
</html>

