<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title></title>
<script type='text/javascript' src='jquery-1.2.3.min.js'></script>
<script type='text/javascript' src='menu.js'></script>
<script>
function ResizeIframe(iframe) {
    var iframeBody = (iframe.contentDocument) ? iframe.contentDocument.body : iframe.contentWindow.document.body;
    var height = (iframeBody.scrollHeight < iframeBody.offsetHeight) ? iframeBody.scrollHeight : iframeBody.offsetHeight;
    height = height + 10;
    $(iframe).height(height);
}
</script>
<link rel="stylesheet" href="style.css" type="text/css" media="screen" />

</head>

<body>
<div id="menu">
<ul id="nav">
    <li><a href="Projects/Project.php" target="iframe_a" class="mitem">Projects</a></li>
    <li><a href="Employees/Employee.php" target="iframe_a" class="mitem">Employees</a></li>
    <li><a href="Efforts/efforts.php" target="iframe_a" class="mitem">Assignment</a></li>
    <li><a href="FetchTimesheet/fetchtimesheet.php" target="iframe_a" class="mitem">Fetch Your Timesheet</a></li>  
</ul>
</div>
<div id="logo" style="position:absolute;top:0;right:0;">
<img src="Proassign.png" alt="Mountain View">
</div>
<iframe width="100%" height="720px" src="Projects/Project.php" border="0" name="iframe_a" id="iframe_a"></iframe>
</body>
</html>
