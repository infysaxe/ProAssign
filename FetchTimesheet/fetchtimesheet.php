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
		<h1>Assignment Details</h1> 
			<!-- Feedback message zone -->
			<div id="message"></div>

	        <div id="toolbar">
                <select id="filter" name="filter" style="width:30%;">
            <option value="ProEmployee">Select Employee to fetch details</option>
            <?php
            require_once('config.php');
            $link=mysql_connect($config['db_host'],$config['db_user'],$config['db_password']) or die ("Error connecting to mysql server: ".mysql_error());

            mysql_select_db($config['db_name'], $link) or die ("Error selecting specified database on mysql server: ".mysql_error());

            $projectquery="SELECT id,Employee FROM EmployeeData order by Employee asc";
            $projectresult=mysql_query($projectquery) or die ("Query to get data from firsttable failed: ".mysql_error());

            while ($projectrow=mysql_fetch_array($projectresult)) {
            $cdproject=$projectrow["id"];
            $cdEmployee=$projectrow["Employee"];
                echo "<option value='$cdproject'> $cdEmployee - $cdproject</option>";
            }

            ?>

            </select>
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
                    <script src="js/demofetch.js" ></script>

		<script type="text/javascript">
		
            var datagrid = new DatabaseGrid();
			window.onload = function() { 

                // key typed in the filter field
                $("#filter").change(function() {
                    datagrid.editableGrid.filter($(this).val());
                    if ($(this).val() != 'ProEmployee'){
                    $('#iediv').load('Effortmonth.php', {eid: $(this).val()});
                    }
                    else
                    {
                    $('#iediv').empty();
                    }

                    // To filter on some columns, you can set an array of column index 
                    //datagrid.editableGrid.filter( $(this).val(), [0,3,5]);
                  });



        
			}; 
		</script>

        <!-- simple form, used to add a new row -->



        <div id='iediv' align='right'>
        </div>

        </body>

</html>
