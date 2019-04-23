<?php
session_start();
echo ' <p style="text-align:right" ><b>Welcome ' . $_SESSION['username'] . ',</b> ';
echo '<a href="logout.php">logout </a>';
echo '</p>' ;

if ($_SESSION['authuser'] !=12) {
echo 'Sorry, but you don\'t have permission to view this page!';
header( 'Location: index.html' ) ;
exit();
}
?>
<html>
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
  <title>Ansible Admin</title>
  <body>
   <div ng-app="">
 
     <p>Input something in the input box:</p>
     <p>Name : <input type="text" ng-model="name" placeholder="Enter name here"></p>
     <h1>Hello {{name}}</h1>

   </div>

	<script>
	var app = angular.module("jumpServerList", []); 
	app.controller("myCtrl", function($scope) {
	    $scope.products = ["Seki", "Seli", "Seln"];
	});
	</script>

	<div ng-app="jumpServerList" ng-controller="myCtrl">
	    <ul>
	        <li ng-repeat="x in products">{{x}}</li>
	    </ul>
	</div>

   <h1 style="text-align:center"> Welcome to Ansible server </h1> 
    <form action="domain.php" method="post">
       <p> Domain name#    Domain controller hostname# </p>  <p> <input type="text" name="domain_name" placeholder="example.com">
       <input type="text" name="domain_host" placeholder="adcontrollerhost.example.com">
       <input type="submit" name="Submit"> </p>
    </form>
    <form action="jumpserver.php" method="post">
       Name for Jump Server: <p><input type="text" name="jump_name"> 
       Jump Server hostname: <input type="text" name="jump_hostname">
       <input type="submit" name="Submit"> </p>
    </form>
  </body>
</html>
