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
require_once('config.php');
if (isset($_SERVER['HTTP_COOKIE'])) {
    $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
    foreach($cookies as $cookie) {
        $parts = explode('=', $cookie);
        $name = trim($parts[0]);
        setcookie($name, '', 1);
        setcookie($name, '', 1, '/');
    }
}
?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<link rel="stylesheet" href="css/style.css" type="text/css" media="screen">
		<link rel="stylesheet" href="css/responsive.css" type="text/css" media="screen">
        <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/smoothness/jquery-ui.css" />
		<link rel="stylesheet" href="css/font-awesome-4.1.0/css/font-awesome.min.css" type="text/css" media="screen">
        <style>
#ipdiv {
    height: 40%;
    position: relative;
    bottom:0%;
    width:100%;
    opacity: 1;
    vertical-align: top;
}
</style>
	
         </head>
	
	<body>
		<div id="wrap">
		<h1>Workforce Assignment</h1> 
			<!-- Feedback message zone -->
			<div id="message"></div>

	        <div id="toolbar">
                <select id="filter" name="filter" style="width:30%;">
            <option value="ProSelect">Select Project</option>
            <?php
            require_once('config.php');
            $link=mysql_connect($config['db_host'],$config['db_user'],$config['db_password']) or die ("Error connecting to mysql server: ".mysql_error());

            mysql_select_db($config['db_name'], $link) or die ("Error selecting specified database on mysql server: ".mysql_error());

            $projectquery="SELECT distinct(projectid) FROM ProjectData order by projectid asc";
            $projectresult=mysql_query($projectquery) or die ("Query to get data from firsttable failed: ".mysql_error());

            while ($projectrow=mysql_fetch_array($projectresult)) {
            $cdproject=$projectrow["projectid"];
                echo "<option value='$cdproject'>$cdproject</option>";
            }

            ?>

            </select>
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
                    <script src="js/demoefforts.js" ></script>

		<script type="text/javascript">
		
            var datagrid = new DatabaseGrid();
			window.onload = function() { 

                // key typed in the filter field
                $("#filter").change(function() {
                    datagrid.editableGrid.filter($(this).val());
                    if ($(this).val() != 'ProSelect'){
                    $('#ipdiv').load('Effortfilter.php', {pid: $(this).val()});
                    $('#fetchemp').hide();
                    }
                    else
                    {
                    $('#ipdiv').empty();
                    }
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

            <div class="row">
                        <select id="name" name="name" style="width:100%;">
            <option value="">Select Project</option>
            <?php
            require_once('config.php');
            $link=mysql_connect($config['db_host'],$config['db_user'],$config['db_password']) or die ("Error connecting to mysql server: ".mysql_error());

            mysql_select_db($config['db_name'], $link) or die ("Error selecting specified database on mysql server: ".mysql_error());

            $projectquery="SELECT distinct(projectid) FROM ProjectData order by projectid asc";
            $projectresult=mysql_query($projectquery) or die ("Query to get data from firsttable failed: ".mysql_error());

            while ($projectrow=mysql_fetch_array($projectresult)) {
            $cdproject=$projectrow["projectid"];
                echo "<option value='$cdproject'>$cdproject</option>";
            }

            ?>

            </select>
            </div>

             <div class="row">
            <select id="firstname" name="firstname" style="width:100%;">
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
            <select id="secondname" name="secondname" style="width:100%;">
            <option value="">Select Employee</option>
            <?php
            require_once('config.php');
            $link=mysql_connect($config['db_host'],$config['db_user'],$config['db_password']) or die ("Error connecting to mysql server: ".mysql_error());

            mysql_select_db($config['db_name'], $link) or die ("Error selecting specified database on mysql server: ".mysql_error());

            $cdquery="SELECT id,Employee FROM EmployeeData order by Employee asc";
            $cdresult=mysql_query($cdquery) or die ("Query to get data from firsttable failed: ".mysql_error());

            while ($cdrow=mysql_fetch_array($cdresult)) {
            $cdid=$cdrow["id"];
            $cdTitle=$cdrow["Employee"];
                echo "<option value='$cdid'>$cdTitle</option>";
            }

            ?>

        </select>

            </div>


            <div class="row tright">
              <a id="addbutton" class="button green" ><i class="fa fa-save"></i> Apply</a>
              <a id="cancelbutton" class="button delete">Cancel</a>
            </div>
        </div>
	<div id='ipdiv'>
        </div>

        </body>

</html>
