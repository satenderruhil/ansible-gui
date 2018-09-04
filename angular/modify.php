<!DOCTYPE html>
<html>
<link rel="stylesheet" href="w31.css">
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
<body ng-app="myApp" ng-controller="userCtrl">

<div class="w3-container">

<h3>Jump Servers</h3>

<table class="w3-table w3-bordered w3-striped">
  <tr>
    <th>Jumper Name </th>
    <th>Jump Server Hostname</th>
    <th>Port Used </th>
    <th>Satus </th>
    <th>Edit</th>
    <th>Delete </th>
  </tr>
  <tr ng-repeat="user in users">
    <td>{{ user.fName }}</td>
    <td>{{ user.lName }}</td>
    <td> </td>
    <td>
      <button class="w3-btn w3-ripple" ng-click="editUser(user.id)">&#9998; Edit</button>
    </td>
    <td>
      <button class="w3-btn w3-ripple" ng-click="editUser(user.id)">&#9998; Delete</button>
    </td>
  </tr>
</table>
<br>
<button class="w3-btn w3-green w3-ripple" ng-click="editUser('new')">&#9998; Add New JumpServer</button>

<form ng-hide="hideform">
  <h3 ng-show="edit">Add server:</h3>
  <h3 ng-hide="edit">Edit Jumper:</h3>
    <label>Jump serer:</label>
    <input class="w3-input w3-border" type="text" ng-model="jName" ng-disabled="edit" placeholder="Jumper Name">
  <br>
    <label>Jump Server Host Name:</label>
    <input class="w3-input w3-border" type="text" ng-model="sHostName" ng-disabled="edit" placeholder="Server Hostname">
  <br>
    <label>Login ID:</label>
    <input class="w3-input w3-border" type="text" ng-model="loginid" placeholder="username">
  <br>
    <label>Password:</label>
    <input class="w3-input w3-border" type="password" ng-model="passw1" placeholder="Password">
  <br>
  <button class="w3-btn w3-green w3-ripple" ng-disabled="error || incomplete">&#10004; Save Changes</button>
</form>

</div>

<script src= "myUsers.js"></script>

</body>
</html>
