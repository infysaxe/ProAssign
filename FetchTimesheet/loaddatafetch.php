<?php     


/*
 * examples/mysql/loaddata.php
 * 
 * This file is part of EditableGrid.
 * http://editablegrid.net
 *
 * Copyright (c) 2011 Webismymind SPRL
 * Dual licensed under the MIT or GPL Version 2 licenses.
 * http://editablegrid.net/license
 */
                              


/**
 * This script loads data from the database and returns it to the js
 *
 */
       
require_once('config.php');      
require_once('EditableGrid.php');            

/**
 * fetch_pairs is a simple method that transforms a mysqli_result object in an array.
 * It will be used to generate possible values for some columns.
*/
function fetch_pairs($mysqli,$query){
	if (!($res = $mysqli->query($query)))return FALSE;
	$rows = array();
	while ($row = $res->fetch_assoc()) {
		$first = true;
		$key = $value = null;
		foreach ($row as $val) {
			if ($first) { $key = $val; $first = false; }
			else { $value = $val; break; } 
		}
		$rows[$key] = $value;
	}
	return $rows;
}


// Database connection
$mysqli = mysqli_init();
$mysqli->options(MYSQLI_OPT_CONNECT_TIMEOUT, 5);
$mysqli->real_connect($config['db_host'],$config['db_user'],$config['db_password'],$config['db_name']); 
                    
// create a new EditableGrid object
$grid = new EditableGrid();

/* 
*  Add columns. The first argument of addColumn is the name of the field in the databse. 
*  The second argument is the label that will be displayed in the header
*/
$grid->addColumn('empid', 'EmployeeID', 'integer',null,false);
$grid->addColumn('employee', 'Employee', 'string',null,false);
$grid->addColumn('projectid', 'Project', 'string',null,false);
$grid->addColumn('projecttype', 'Type', 'string',null,false);
$grid->addColumn('January', 'Jan', 'decimal',null,false);
$grid->addColumn('February', 'Feb', 'decimal',null,false);
$grid->addColumn('March', 'Mar', 'decimal',null,false);
$grid->addColumn('April', 'Apr', 'decimal',null,false);
$grid->addColumn('May', 'May', 'decimal',null,false);
$grid->addColumn('June', 'Jun', 'decimal',null,false);
$grid->addColumn('July', 'Jul', 'decimal',null,false);
$grid->addColumn('August', 'Aug', 'decimal',null,false);
$grid->addColumn('September', 'Sept', 'decimal',null,false);
$grid->addColumn('October', 'Oct', 'decimal',null,false);
$grid->addColumn('November', 'Nov', 'decimal',null,false);
$grid->addColumn('December', 'Dec', 'decimal',null,false);
//$grid->addColumn('action', 'Action', 'html', NULL, false, 'id');


$mydb_tablename = (isset($_GET['db_tablename'])) ? stripslashes($_GET['db_tablename']) : 'EffortDetails';
                                                                       
$result = $mysqli->query('SELECT * FROM EffortDetails order by employee,projectid,projecttype asc');
$mysqli->close();

// send data to the browser
$grid->renderJSON($result);

