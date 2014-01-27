<?php
session_start();

    // check for what branches exist locally
    chdir('..');	
    $output = shell_exec('git branch');
    $branches = explode("\n",$output);
    	
    // trailing key is empty
    array_pop($branches);
		
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
<meta charset="UTF-8">
<title>Branches</title>
</head>
<body style="padding: 0 10px; font-family: Arial;">
<form action="change_branch.php" method="post" target="_blank">
    <h1>Branch Switcher</h1>
    <p>
	Use this page to switch between git branches on the server. The branch you select will be stored in your session, and will not interfere with any other users.
    </p>
    <p>
	<b>Tracked Branches</b><br />
	These are the branches already known by the server. If your branch is not listed here, use use the "New Branch" box below.	
    </p>
	<select name="branch">
		<option value="">-- select branch --</option>
	<?php 
		foreach($branches as $branch) {
		
		    // checked out branch
		    $selected = (false !== strpos($branch,'*'));

		    ?>
		    <option value="<?php echo trim($branch,' *') ?>"<?php echo $selected ? ' selected="selected"' : '' ?>><?php echo $branch ?></option>
		    <?php
		}
	?>
	</select>
	<input type="submit" value="go" />
</form>
<form action="change_branch.php" method="post">
    <p>
		<b>New Branch</b><br />
		Use the box below if you wish to add a branch that is on GitHub, but not listed in the Tracked Branches dropdown.
    </p>
    <input type="text" name="branch" value="" />
    <input type="submit" value="go" />
</form>

</body>
</html>