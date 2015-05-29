var app = angular.module("gm",
    ['smart-table',
     'inform',
     'ngAnimate']);

app.config(['$httpProvider', function($httpProvider) {
    $httpProvider.defaults.headers.common["X-Requested-With"] = 'XMLHttpRequest';
    $httpProvider.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded';
}]);

app.directive('formelementerrors', function() {
  return {
    restrict: 'E',
    scope: {
        elementScope: '=elementScope'
    },
    templateUrl: '/GamingManagement/public/javascript/templates/errors.html',
    link: function(scope, element, attrs) {
      var formElement = angular.element('#' + attrs.elementId);
      scope.minLength = formElement.attr('ng-minlength');
      scope.elemName = formElement.attr('name');
      scope.elemDifferent = formElement.attr('different');
      
    }
  }
});