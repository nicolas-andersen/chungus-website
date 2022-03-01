<!DOCTYPE html>
<html>
<head>  
	<title>Chungus</title>
<style>
* {
	font-family: Arial;
	color: white;
}

body {
	background-color: black;
}

table {
	border-collapse: collapse;
	border-spacing: 10px;
	height: 15px;
	width: 400px;
}

th, td {
	padding: 8px;
	text-align: left;
	border-bottom: 1px solid #DDD;
}

.container {
	display: flex;
	flex-direction: row;
	width: 100%;
	margin: 15px;
}
</style>
</head>
<body> 
<center>
	<h1>Chungus Server!!</h1>
</center>
<div class="container">
<div class="container">
	<iframe src="http://172.16.1.224:2386" width="100%" height="600">
		<p>Your browser does not support iframes!</p>
	</iframe>
</div>
<div class="container">
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function get_username(mysqli $connection, string $uuid) {
	$result = mysqli_query($connection, "SELECT * FROM My_Stats.player");
	while ($row = mysqli_fetch_array($result)) {
		if ($row["uuid"] == $uuid) {
			return $row["name"];
		}
	}
}

$connection = mysqli_connect("localhost", "zstats", "@Zstats123");
if (!$connection) {
	die("Epic embed fail!");
}


$user = array();
$mined = array();

$result = mysqli_query($connection, "SELECT * FROM My_Stats.stats ORDER BY val DESC");
while ($row = mysqli_fetch_array($result)) {
	if ($row["stat"] == "z:mined") {
		$mined[count($mined)] = $row["val"];
		$user[count($user)] = get_username($connection, $row["uuid"]);
	}
}

echo "<table><tr><th>Spiller</th> <th>Klodser minet</th></tr>"; 
for ($i = 0; $i < count($user); $i++) {
	echo "<tr>";
	echo "<td>" . $user[$i] . "</td>";
	echo "<td>" . $mined[$i] . "</td>";
	echo "</tr>";	
}
echo "</table>";
?>
</div>
</div>
</body> 
</html>

