<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css"> 
    <script src= "http://ajax.googleapis.com/ajax/libs/angularjs/1.3.16/angular.min.js"></script> 
</head>
<body ng-app="postApp" ng-controller="postController">
<div class="container">
<div class="col-sm-8 col-sm-offset-2">
    <div class="page-header"><h1>Post data using angularJS</h1></div>
    <!-- FORM -->
    <form ng-model="Formname" ng-submit="submitForm()">
        <input type="hidden" name="prod_id" ng-model="prod_id">
    <div class="form-group">
        <label>Name</label>
        <input type="text" class="form-control"  ng-model="name">
        <span ng-show="errorName">{{errorName}}</span>
    </div>
    <div class="form-group">
        <label>Username</label>
        <input type="text" class="form-control" ng-model="username">
        <span ng-show="errorUserName">{{errorUserName}}</span>
    </div>
    <div class="form-group">
        <label>Email</label>
        <input type="email" class="form-control" ng-model="email">
        <span ng-show="errorEmail">{{errorEmail}}</span>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
    
    <button type="button" class="btn btn-primary" value="Update" ng-click="update_product()">Update</button>
    </form>
    
    <br>
        <br>
            
    <table class="table table-condensed">
				<tr>
					<th>Name</th>
					<th>uesrname</th>
					<th>email</th>
                                        <th>Action</th>
					
				</tr>
  <tr ng-repeat="x in dbValue">
					<td><span ng-bind="x.name"></span> </td>
					<td><span ng-bind="x.username"></span> </td>
					<td><span ng-bind="x.email"></span> </td>
                                        <td>
				     <a  href="#" ng-click="edit(x.id)">edit</a> | 

                        <a href="#" ng-click="deleter(x.id)">delete</a></td>
				</tr>
    </table>
</div>
</div>
</body>
</html>

<script>
    var postApp = angular.module('postApp', []);
    postApp.controller('postController', function($scope, $http) {
        //$scope.user = {};
        //console.log($scope.user); new method of insert all the data in sigle values
        $scope.submitForm = function() {
        $http({
          method  : 'POST',
          url     : 'clone.php?action=add_mode',
          data    : {'name1':$scope.name,'username1':$scope.username,'email1':$scope.email},
          headers : {'Content-Type': 'application/x-www-form-urlencoded'} 
         })
          .success(function(data){
            $scope.dbValue = data;
           // console.log($scope.user);
            //alert($scope.name);
            //if (data=='true') {
            //    alert('successively');
            //                }
            //if (data.errors) {
            //  // Showing errors.
            //  $scope.errorName = data.errors.name;
            //  $scope.errorUserName = data.errors.username;
            //  $scope.errorEmail = data.errors.email;
            //} else {
            //  $scope.message = data.message;
            //}
          });
        };
        
        $scope.edit = function(userid) {
            
        $http({
          method  : 'POST',
          url     : 'clone.php?action=edit_product',
          data    : {'id':userid},
          headers : {'Content-Type': 'application/x-www-form-urlencoded'} 
         })
          .success(function(data){
            
            $scope.prod_id = data['id'];
            $scope.name = data[0]['name'];
            $scope.username = data[0]['username'];
            $scope.email = data[0]['email'];
            //$scope.name = data[0]['name'];
             // console.log(data['id']);
            //console.log($scope.name);
            //console.log(Updatevalues.id);
          });
            
        }
        
        $scope.update_product = function() {
            
        $http({
          method  : 'POST',
          url     : 'clone.php?action=Update',
          data    : {'name':$scope.name,'username':$scope.username,'email':$scope.email,'id':$scope.prod_id},
          headers : {'Content-Type': 'application/x-www-form-urlencoded'} 
         })
          .success(function(data){
            $scope.dbValue = data;
        //alert();
            //$scope.name = data[0]['name'];
              //console.log(data[0]['name']);
            //console.log($scope.name);
            //console.log(Updatevalues.id);
          });
            
        };
	
	 $scope.deleter = function(userid) {
            
        $http({
          method  : 'POST',
          url     : 'clone.php?action=delete_product',
          data    : {'id':userid},
          headers : {'Content-Type': 'application/x-www-form-urlencoded'} 
         })
          .success(function(data){
            
	    $scope.dbValue = data;
          });
            
        }
        
    });
</script>