<!DOCTYPE html>
<html>
	<head>
		<title>Notes</title>
		<meta charset='utf-8'>
		<link rel='icon' type='image/gif' sizes='16x16' href='data:image/gif;base64,R0lGODlhEAAQAIABAAAAAP///yH5BAEKAAEALAAAAAAQABAAAAIjhI8WG+m6EJsNxEMVllM/yjziSHJgh50opF5sa8JpW5X2WAAAOw=='>
		<style type='text/css'>
			textarea { width: 90%; font-family: Courier; font-weight: bold; font-size: 15px }
			body { text-align: center }
		</style>
		<script type='module' src='src/main.js'></script>
	</head>
	<body>
		<a href='#' onclick='addLine()'><img src='imgs/plus.png'></a>
		<a href='#' onclick='doSave()'><img src='imgs/save.png' id='saveIco'><img src='imgs/noSave.png' id='noSaveIco'></a>
		<a href='#' onclick='doReload()'><img src='imgs/reload.png'></a>
		<a href='#' onclick='doSort()'><img src='imgs/sortAZ.png'></a>
		<a href='#' onclick='doSort(true)'><img src='imgs/sortZA.png'></a>
		<a href='#' onclick='doUnique()'><img src='imgs/2.png'></a>
		<a href='#' onclick='doCase()'><img src='imgs/up.png'></a>
		<a href='#' onclick='doCase(false)'><img src='imgs/down.png'></a>
		<br>
		<font id='status'>status</font>
		<br>
		<textarea id='text'></textarea>
	</body>
</html>
