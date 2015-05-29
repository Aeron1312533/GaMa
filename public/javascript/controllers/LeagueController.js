app.controller("leagueController", function($scope, $http) {
    //attributes
    $scope.rowsLeagueTable =[];
    $scope.rowsMatches =[];
    
    //methods
    $scope.init = function() {
        $scope.table();
        $scope.matches();
    },
    $scope.table = function() {
        $scope.tableLoading = true;
        jQuery.post('../league/table')
        .success(function(data) {
            $scope.rowsLeagueTable = data;
        })
        .fail(function(){
            alert("Error occured during getting league table");
        })
        .always(function(){
            $scope.tableLoading = false;
            $scope.displayedCollection = [].concat($scope.rowsLeagueTable);
            $scope.$apply();
        });
    },
    $scope.matches = function() {
        $scope.matchesLoading = true;
        jQuery.post('../league/matches')
        .success(function(data) {
            $scope.rowsMatches = data;
        })
        .fail(function(){
            alert("Error occured during getting matches");
        })
        .always(function(){
            $scope.matchesLoading = false;
            $scope.displayedCollection2 = [].concat($scope.rowsMatches);
            $scope.$apply();
        });
    };
});