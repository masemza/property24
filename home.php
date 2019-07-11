<?php
require 'core/init.php';
$general->logged_out_protect();
$admin_id   = htmlentities($user['admin_id']); // storing the user's username after clearning for any html tags. 

$view_admin = $admin->admin_data($admin_id);

?>
<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>

<h1>Welcome</h1>

<?php echo $admin_id ?>

<p>What do you want to do ?</p>
<ol>
    <li><a href="logout.php">Logout</a></li>
	<li><a href="addProvince.php">Add Province</a></li>
	<li><a href="addCity.php">Add City</a></li>
	<li><a href="addSuburb.php">Add Suburb</a></li>

</ol>

<h1></h1>

</body>
</html>