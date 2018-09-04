<?php
session_start();
echo ' <p style="text-align:right" ><b>Welcome ' . $_SESSION['username'] . ',</b> ';
echo '<a href="logout.php">logout </a>';
echo '</p>' ;
echo ' <p style="text-align:left" >';
echo '<a href="ansible.php">BACK </a>';
echo '</p>' ;

if ($_SESSION['authuser'] !=11) {
	echo 'Sorry, but you don\'t have permission to view this page!';
	header( 'Location: index.html' ) ;
	exit();
}
?>

<html>
  <title>Ericsson Ansible Server</title>
</html>
<?php

function addNew($fileName, $line, $max) {
    // Remove Empty Spaces
    $file = array_filter(array_map("trim", file($fileName)));
    // Make Sure you always have maximum number of lines
    $file = array_slice($file, 0, $max);
    // Remove any extra line 
    count($file) >= $max and array_shift($file);
    // Add new Line
#    array_push($file, $line);
    array_unshift($file, $line);
    // Save Result
    file_put_contents($fileName, implode(PHP_EOL, array_filter($file)));
}

$user = $_SESSION['signum'] ;
$Pass = $_SESSION['userpass'];
$extra_args = '--extra-vars "ansible_ssh_user=' . $user . ' ansible_ssh_pass=' . $Pass . ' ansible_sudo_pass=' . $Pass . '"';

echo $_POST['command'] . '<br>';

$content = "=======================================================";

echo "======================================================= <br>" ;
echo "Command Output: <br>";
if (isset($_POST['command']))
{
	chdir("files/$user");
	#
	// The file must exist with at least 2 lines on it
	$max = 100;
	$file = "commands.logs";

	if(!file_exists($file))
	{
        	#touch($filename);
		$fp = fopen("$file","wb");
		fwrite($fp,$content);
		fclose($fp);
	}
	$txt = $_POST['command'];
	addNew($file, $txt, $max);
	$txt = trim($txt);
	$check_ansible_command = explode(" ", $txt);
	if (strpos($check_ansible_command[0], 'ansible') !== false) {
 		$ans_command = $txt . ' ' . $extra_args ;
	}
	else {
	       	$ans_command = $txt ;
	}

	## Print on screen
	while (@ ob_end_flush()); // end all output buffers if any

		$proc = popen($ans_command, 'r');
		echo '<pre>';
		while (!feof($proc))
		{
		    echo fread($proc, 4096);
		    @ flush();
		}
	echo '</pre>';

}
?>
