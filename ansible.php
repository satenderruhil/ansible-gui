<?php
session_start();
echo ' <p style="text-align:right" ><b>Welcome ' . $_SESSION['username'] . ',</b> ';
echo '<a href="logout.php">logout </a>';
echo '</p>' ;

if ($_SESSION['authuser'] !=11) {
echo 'Sorry, but you don\'t have permission to view this page!';
header( 'Location: index.html' ) ;
exit();
}
?>

<html>
  <title>Ericsson Ansible Server</title>
  <body>
    <form action="ansible.php" method="post" enctype="multipart/form-data">
    <p>Upload your files like inventory, ansible.cfg, playbook.yml, etc: </p>
          <input type="file" name="fileToUpload" id="fileToUpload">
          <input type="submit" value="Upload file" name="submit"> <br>
	  <p><strong>Note:</strong> max allowed size is 2 MB.</p>
    </form>
    <form action="ansible-run.php" method="post">
       Enter Command: <input type="text" name="command">
       <input type="submit" name="Submit">
       <p>You can also clone your code from git repository</p>
    </form>
  </body>
</html>
<?php
$user = $_SESSION['signum'] ;
### Upload functionality

if(!empty($_FILES['fileToUpload']))
  {
    $path = "files/$user/";
    $path = $path . basename( $_FILES['fileToUpload']['name']);
    if(move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $path)) {
      echo "The file ".  basename( $_FILES['fileToUpload']['name']). 
      " has been uploaded";
    } else{
        echo "There was an error uploading the file, please try again!";
    }
  }

## Display contents of user directory
echo "======================================================= <br>" ;
echo "files available: <br>";
if (!file_exists("files/$user")) {
    mkdir("files/$user", 0777, true);
}
$output = shell_exec("ls -lart files/$user | awk -F\" \" '{print $1 \" \" $6 \" \" $7 \" \" $8 \" \" $9}'");
echo "<pre>$output</pre>";

# Display Commands run
echo "======================================================= <br>" ;
echo "Command History: <br>";
#$output = shell_exec("tac files/$user/commands.logs");
$output = shell_exec("cat files/$user/commands.logs");
echo "<pre>$output</pre>";

?>
