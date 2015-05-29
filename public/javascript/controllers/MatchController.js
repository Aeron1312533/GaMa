app.controller("matchController", function($scope, $http, inform) {
    //attributes
    $scope.formSending = false;
    
    //methods
    $scope.reset = function(form) {
        angular.copy({},form);
    },
    $scope.isDisabled = function(form) {
        switch (form.$name) {
            case "form_add_league_match":
               if (form.player1.$viewValue == form.player2.$viewValue) {
                   form.player1.$error.same = true;
                   form.player2.$error.same = true;
               } else {
                   delete form.player1.$error.same;
                   delete form.player2.$error.same;
               }
               
               return form.$invalid || form.player1.$viewValue == form.player2.$viewValue || $scope.formSending;
               break;
           default:
               return form.$invalid || $scope.formSending;
               break;
        }
    },
    $scope.add = function(form, event) {
        event.preventDefault();
        $scope.formSending = true;
        var action = '';

        if (form.isfriendly == undefined) {
            action = '../match/add-league-match';
        } else {
            action = '../match/add-friendly-match';
        }
        jQuery.post(action, form)
        .success(function(data) {
            result  = angular.fromJson(data);
            inform.add('Match successfulyl saved!', {
                ttl: 3000, type: 'info'
            });
            
            $scope.reset(form);
            $scope.$apply();
           
        })
        .fail(function(){
            inform.add('Match not saved!', {
                ttl: 3000, type: 'danger'
            });
        })
        .always(function(){
             $scope.formSending = false;     
        });
        
    };
});