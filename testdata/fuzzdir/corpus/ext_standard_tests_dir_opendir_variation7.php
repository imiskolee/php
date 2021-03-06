<?php
/* Prototype  : mixed opendir(string $path[, resource $context])
 * Description: Open a directory and return a dir_handle 
 * Source code: ext/standard/dir.c
 */

/*
 * Open a directory using opendir() with different directory permissions
 */

echo "*** Testing opendir() : usage variations ***\n";

// create the temporary directory
$file_path = dirname(__FILE__);
$dir_path = $file_path . "/opendir_variation7";
mkdir($dir_path);

/* different values for directory permissions */
$permission_values = array(
/*1*/  0477,  // owner has read only, other and group has rwx
       0677,  // owner has rw only, other and group has rwx

/*3*/  0444,  // all have read only
       0666,  // all have rw only

/*5*/  0400,  // owner has read only, group and others have no permission
       0600,   // owner has rw only, group and others have no permission

/*7*/  0470,  // owner has read only, group has rwx & others have no permission
       0407,  // owner has read only, other has rwx & group has no permission

/*9*/  0670,  // owner has rw only, group has rwx & others have no permission
/*10*/ 0607   // owner has rw only, group has no permission and others have rwx
);

// Open directory with different permission values, read and close, expected: none of them to succeed.

$iterator = 1;
foreach ($permission_values as $perm) {

	echo "\n-- Iteration $iterator --\n";
	// try to remove the dir if exists  & create
	if (is_dir($dir_path)){
		chmod ($dir_path, 0777); // change dir permission to allow all operation
		rmdir ($dir_path);
	}
	mkdir($dir_path);

	// change the dir permisson to test dir on it
	var_dump( chmod($dir_path, $perm) );

	var_dump($dh = opendir($dir_path));
	
	if (is_resource($dh)) {
		closedir($dh);
	}
	$iterator++;
}
?>
===DONE===
