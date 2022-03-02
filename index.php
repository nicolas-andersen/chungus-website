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


select {
  background-color: black;
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


$selected_stat = "z:mined";
$user = array();
$stat_value = array();

if (isset($_POST["stats"])) {
	$selected_stat = $_POST["stats"];
}

$result = mysqli_query($connection, "SELECT * FROM My_Stats.stats ORDER BY val DESC");
while ($row = mysqli_fetch_array($result)) {
	if ($row["stat"] == $selected_stat) {
		$stat_value[count($stat_value)] = $row["val"];
		$user[count($user)] = get_username($connection, $row["uuid"]);
	}
}
?>


<table>
<tr>
<th>Spiller</th>
<th>
<form id="stat_form" action="index.php" method="post">
<select name="stats" onchange="this.form.submit()">
<option>Vælg statistik</option>
<option value="z:mined">Klodser minet</option>
<option value="z:placed">Klodser placeret</option>
<option value="DEATHS">Gange død</option>
</select>
</form>
</th>
</tr>
<?php
for ($i = 0; $i < count($user); $i++) {
	if ($i > 10) {
		break;
	}

	echo "<tr>";
	echo "<td>" . $user[$i] . "</td>";
	echo "<td>" . $stat_value[$i] . "</td>";
	echo "</tr>";	
}
?>
</table>
</div>
</div>
</body> 
</html>

