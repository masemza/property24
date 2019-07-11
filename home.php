<?php
require 'core/init.php';
$general->logged_out_protect();
$admin_id   = htmlentities($user['admin_id']); // storing the user's username after clearning for any html tags. 

$view_admin = $admin->admin_data($id);

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

</ol>

<h1></h1>

</body>
</html>