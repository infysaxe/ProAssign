<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">

<!--
/*
 * examples/mysql/index.html
 * 
 * This file is part of EditableGrid.
 * http://editablegrid.net
 *
 * Copyright (c) 2011 Webismymind SPRL
 * Dual licensed under the MIT or GPL Version 2 licenses.
 * http://editablegrid.net/license
 */
-->
<?php
//include('TotalProject.php');
?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<link rel="stylesheet" href="css/style.css" type="text/css" media="screen">
		<link rel="stylesheet" href="css/responsive.css" type="text/css" media="screen">

        <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/smoothness/jquery-ui.css" />
		<link rel="stylesheet" href="css/font-awesome-4.1.0/css/font-awesome.min.css" type="text/css" media="screen">
        	</head>
	
	<body>
		<div id="wrap">
		<h1>Project Forecast</h1> 
			<!-- Feedback message zone -->
			<div id="message"></div>

            <div id="toolbar">
              <input type="text" id="filter" name="filter" placeholder="Filter :type any text here"  />
              <a id="showaddformbutton" class="button green"><i class="fa fa-plus"></i> Add new row</a>
            </div>
			<!-- Grid contents -->
			<div id="tablecontent"></div>
		
			<!-- Paginator control -->
			<div id="paginator"></div>
	       </div>	
		<script src="js/editablegrid-2.1.0-b25.js"></script>   
		<script src="js/jquery-1.11.1.min.js" ></script>
        <!-- EditableGrid test if jQuery UI is present. If present, a datepicker is automatically used for date type -->
        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
                    <script src="js/demoprojects.js" ></script>

		<script type="text/javascript">
		
            var datagrid = new DatabaseGrid();
			window.onload = function() { 
                 
                // key typed in the filter field
                $("#filter").keyup(function() {
                    datagrid.editableGrid.filter( $(this).val());

                    // To filter on some columns, you can set an array of column index 
                    //datagrid.editableGrid.filter( $(this).val(), [0,3,5]);
                  });

                $("#showaddformbutton").click( function()  {
                  showAddForm();
                });
                $("#cancelbutton").click( function() {
                  showAddForm();
                });

                $("#addbutton").click(function() {
                  datagrid.addRow();
                });

        
			}; 
		</script>

        <!-- simple form, used to add a new row -->
        <div id="addform">
<form name="myform" id="myform">
            <div class="row">
                <input type="text" id="name" name="name" style="width:300px;" placeholder="Enter in Format ProjectId-Name" />
            </div>

             <div class="row">
             <select id="firstname" name="firstname" style="color:#a5a5a5;width:320px;height:28px;" placeholder="Project Type">
             <option value="">Select Project Type</option>
             <?php
            require_once('config.php');
            $link=mysql_connect($config['db_host'],$config['db_user'],$config['db_password']) or die ("Error connecting to mysql server: ".mysql_error());

            mysql_select_db($config['db_name'], $link) or die ("Error selecting specified database on mysql server: ".mysql_error());

            $typequery="SELECT type FROM ProjectType order by type asc";
            $typeresult=mysql_query($typequery) or die ("Query to get data from firsttable failed: ".mysql_error());

            while ($typerow=mysql_fetch_array($typeresult)) {
            $cdtype=$typerow["type"];
                echo "<option value='$cdtype'>$cdtype</option>";
            }

            ?>

            </select>
             </div>
<div class="row">
<?PHP
$connection=mysql_connect ("localhost", "mso_usr", "mso_usr") or die ("I cannot connect to the database.");
$db=mysql_select_db ("TestGrid", $connection) or die (mysql_error());
$query = "SELECT id,Employee FROM EmployeeData ORDER BY Employee asc";
$sql_result = mysql_query($query, $connection) or die (mysql_error());
        $i=1;
        echo '<table style="width:700px;">';
        while ($row = mysql_fetch_array($sql_result)) {
        $type = $row["id"];
        $htext = $row["Employee"];
 if ($i == 1) {
 echo '<tr><td>';
}
                if ($i > 1)
                echo '</td><td>';
                else if ($i)
                echo '';
                ++$i;
                echo "<input style='font-size:8px' name='type[]' type='checkbox' value='$type'><span style='color:#000;'>$htext</span></input>";
if ($i % 5 ==0)
{
echo '</td></tr><tr>';
}
}
echo '</table>';
?>
</div>
</form>
            <div class="row tright">
              <a id="addbutton" class="button green" ><i class="fa fa-save"></i> Apply</a>
              <a id="cancelbutton" class="button delete">Cancel</a>
            </div>
        </div>
        
	</body>

</html>
