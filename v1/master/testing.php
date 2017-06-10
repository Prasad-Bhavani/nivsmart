<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.23/angular.min.js"></script>
<script src="//cdn.jsdelivr.net/angular.ngtable/0.3.3/ng-table.min.js"></script>
<link rel="stylesheet" href="//cdn.jsdelivr.net/angular.ngtable/0.3.3/ng-table.css" />

<div ng-app="tableApp" ng-controller="MyCtrl">
  <table ng-table="tableParams" show-filter="true" class="table">
        <tr ng-repeat="user in $data">
            <td data-title="'Name'" filter="{ 'Name': 'text' }" sortable="'Name'">
                {{user.Name}}
            </td>
            <td data-title="'Date'" filter="{ 'Date': 'text' }" sortable="'Date'">
                {{user.Date}}
            </td>
        </tr>
    </table>
</div>

<script type="text/javascript">
         angular.module("tableApp", ['ngTable'])

.filter('customUserDateFilter', function($filter) {
    return function(values, dateString) {
     var filtered = [];
  
      if(typeof values != 'undefined' && typeof dateString != 'undefined') {
        angular.forEach(values, function(value) {
            if($filter('date')(value.Date).indexOf(dateString) >= 0) {
              filtered.push(value);
            }
          });
      }
      
      return filtered;
    }
})

.controller("MyCtrl", function($scope, $filter, ngTableParams) {
  var data = [
    { Name: 'John', Date: new Date('1/1/2014') },
    { Name: 'Doe', Date: new Date('1/2/2014') },
    { Name: 'Jane', Date: new Date('2/1/2014') }
  ];
  
    $scope.tableParams = new ngTableParams({
        page: 1,            // show first page
        count: 10,          // count per page
    }, {
        total: data.length, // length of data
        getData: function($defer, params) {
            // use build-in angular filter
            var filters = params.filter();
            var tempDateFilter;
            
            var orderedData = params.sorting() ?
                            $filter('orderBy')(data, params.orderBy()) :
                            data;

            if(filters) {
              if(filters.Date) {
                orderedData = $filter('customUserDateFilter')(orderedData, filters.Date);
                tempDateFilter = filters.Date;
                delete filters.Date;
              }
              orderedData = $filter('filter')(orderedData, filters); 
              filters.Date = tempDateFilter;
            }

            $scope.users = orderedData.slice((params.page() - 1) * params.count(), params.page() * params.count());

            params.total(orderedData.length); // set total for recalc pagination
            $defer.resolve($scope.users);
        }
    });
  })
     
</script>