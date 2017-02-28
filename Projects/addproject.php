<?php
 
/*
 * 
 * http://editablegrid.net
 *
 * Copyright (c) 2011 Webismymind SPRL
 * Dual licensed under the MIT or GPL Version 2 licenses.
 * http://editablegrid.net/license
 */
      
require_once('config.php');         
$checktype = 0;
if(isset($_POST['type']))
{
$type = $_POST['type'];
$checktype = count($type);
}
// Database connection                                   
$mysqli = mysqli_init();
$mysqli->options(MYSQLI_OPT_CONNECT_TIMEOUT, 5);
$mysqli->real_connect($config['db_host'],$config['db_user'],$config['db_password'],$config['db_name']); 

// Get all parameter provided by the javascript
$name = $mysqli->real_escape_string(strip_tags($_POST['name']));
$firstname = $mysqli->real_escape_string(strip_tags($_POST['firstname']));

$return=false;
if ( $stmt = $mysqli->prepare("INSERT INTO ProjectData (projectid, project_type) VALUES (  ?, ?)")) {

	$stmt->bind_param("ss", $name, $firstname);
    $return = $stmt->execute();
	$stmt->close();
}             
if ($checktype != 0)
{
for($i=0; $i < count($type); $i++)
{
$valid=$type[$i];
$stmt = $mysqli->prepare("insert into EffortDetails (projectid,projecttype,empid) Values ('$name','$firstname',$valid)");
$stmt->execute();
$stmt->close();
}
}
$mysqli->close();
echo $return ? "ok" : "error";

      

