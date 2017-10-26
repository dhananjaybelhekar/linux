<html ng-app="todoApp">
<head>
<base href="/">
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-102173434-2"></script>
<script>   
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-102173434-2');
</script>
<title><?php echo $title; ?></title>
<!-- <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.6.1/angular.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.6.1/angular-animate.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.6.1/angular-sanitize.js"></script>
    <script src="//angular-ui.github.io/bootstrap/ui-bootstrap-tpls-2.5.0.js"></script>
    
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"> -->


<style>
  .typeahead-demo .custom-popup-wrapper {
    position: absolute;
    top: 100%;
    left: 0;
    z-index: 1000;
    display: none;
    background-color: #f9f9f9;
  }

  .typeahead-demo .custom-popup-wrapper > .message {
    padding: 10px 20px;
    border-bottom: 1px solid #ddd;
    color: #868686;
  }

  .typeahead-demo .custom-popup-wrapper > .dropdown-menu {
    position: static;
    float: none;
    display: block;
    min-width: 160px;
    background-color: transparent;
    border: none;
    border-radius: 0;
    box-shadow: none;
  }
</style>
<script src="/public/js/vendor.js"></script>
 <link rel="stylesheet" href="/public/style/vendor.css">
<script>
    angular.module('todoApp', ['ui.bootstrap','ngResource','ngAnimate','ngSanitize'])
  .controller('TodoListController', function($resource,$scope) {
      
    var todoList = this;
    $scope.states=[];
    $scope.stateChange= function(){
      location.replace('/'+$scope.selected);
    }
    $scope.modelOptions = {
    debounce: {
      default: 500,
      blur: 250
    },
    getterSetter: true
  };
  $scope.ngModelOptionsSelected = function(value) {
    if (arguments.length) {
      _selected = value;
    } else {
      return _selected;
    }
  };
    $scope.$watch('selected', function(value, ov) {
        
        var zzz = $resource('/api/:id',null,{ 'get':{method:'GET',isArray: true}});
        if(value != '' && value != undefined)
        {
          
           zzz.get({'id':value}).$promise.then(function(res){
            console.log($scope.selected,'_',res);
            $scope.states = res;
          })
        }
        else
        $scope.states=[];
});
    
});

</script>
<?php 
$arr = "";
if(count($data) > 0)
{
         echo $data[0]['head'];
}
 ?>
</head>
<body ng-controller="TodoListController as todoList">
<div class="container">
<center>
  <div class="row">
  <div class="col-md-2"></div>
     <div class="col-md-8">         
         <input type="text"
         ng-model="selected"
         uib-typeahead="state for state in states | filter:$viewValue | limitTo:8"
         class="form-control">
        <button type="submit" class="btn btn-primary" ng-click="stateChange()">search</button>
        
    </div>
    <div class="col-md-2"></div>
  
  </div>
  </center>
</div>
    
<?php 	
$arr = "";
if(count($data) > 0)
{
    foreach ($data as $value) {
        $arr  =$arr . $value['body'];
    }
echo "<div class='container'>".$arr."</div>";

}
else
    echo json_encode($data);
?>
</body>
</html>