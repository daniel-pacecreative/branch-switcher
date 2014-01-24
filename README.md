Branch Switcher
===============
This folder contains *most* of the necessary changes to switch between the
branches of a git project via the web, on demand. Access is restricted by 
.htaccess with an IP whitelist, so make sure to update that.

index.php is in charge of displaying which branches are currently being tracked
on the server, and talking to change_branch.php

change_branch.php simply updates the session with the branch to display

The actual meat of switching branches needs to added manually to the site - 
it needs to be the very first thing executed on the site, and will work best 
with something like WordPress that has an index.php that does nothing but 
include the script to load the rest of the site. Any files that are requested 
before the switch gets made will obviously not reflect any of the changes on
the new branch. 

		/** START BRANCH CODE  */
		session_start();

		// look for branch set in session
		$branch = isset( $_SESSION['branch'] ) ? $_SESSION['branch'] : false;

		// fall back on master branch
		if( false !== $branch ) {
    
			// sanitize input
			$branch = escapeshellarg($branch);
			
			// run git commands
			shell_exec('git fetch');   
			shell_exec('git checkout '.$branch);
			shell_exec('git pull origin '.$branch);
		} else {    
			
			// run git commands
			shell_exec('git checkout master');
			shell_exec('git pull');
		}
		/** END BRANCH CODE */
