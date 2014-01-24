<?php
session_start();

// see what branch we want to look at
$branch = isset( $_POST['branch'] ) ? $_POST['branch'] : false;

// default to master
if( $branch ) {       
    $_SESSION['branch'] = trim($branch);
} else {    
    $_SESSION['branch'] = 'master';
}

header("Location: /index.php");
exit;