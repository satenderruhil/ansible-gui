<?php
session_start();
$ini_array = parse_ini_file('config/release-config.ini');
$domain = explode('.',$ini_array['active_server']);
$_SESSION['authuser'] = 0;
$_SESSION['signum'] = $_POST['user'];
if ( $_POST['user'] == $ini_array['admin_user'] ){
	$_SESSION['username'] = $_POST['user'];
}
else {
	if ( $domain[2] == NULL ){
	$_SESSION['username'] = $_POST['user'];
	}
	else {
	$_SESSION['username'] = "$domain[2]\\".$_POST['user'];
	}
}
#$_SESSION['username'] = "$domain[1]\\".$_POST['user'];
$_SESSION['userpass'] = $_POST['pass'];

if ( $_POST['user'] == NULL OR $_POST['pass'] == NULL ) {
	echo "You are not authorized";
	header( 'Location: index.html' ) ;
	exit;
}
$ldap = ldap_connect($ini_array['active_server']);
if ( $_SESSION['username'] == $ini_array['admin_user'] && $_SESSION['userpass'] == $ini_array['admin_password']) {
	$_SESSION['authuser'] = 12;
	header( 'Location: modify.php' ) ;
	} 
	elseif ($bind = ldap_bind($ldap, $_SESSION['username'], $_SESSION['userpass'])) {
	// log them in!
	$_SESSION['authuser'] = 11;
	header( 'Location: ansible.php' ) ;
	}
	 else {
	// error message
	echo "Sorry, you are not authorized";
	header( 'Location: index.html' ) ;
	}
?>
