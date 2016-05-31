(function () {
    'use strict';

    angular
        .module('app')
        .controller('LandingController', LandingController);

    LandingController.$inject = ['UserService', '$rootScope', '$scope', '$facebook'];
    function LandingController(UserService, $rootScope, $scope, $facebook) {
        var vm = this;
        
        $scope.isLoggedIn = false;
        $scope.login = function() {
          $facebook.login().then(function() {
            refresh();
          });
        }
        function refresh() {
          $facebook.api("/me").then( 
            function(response) {
              $scope.welcomeMsg = "Welcome " + response.name;
              $scope.isLoggedIn = true;
            },
            function(err) {
              $scope.welcomeMsg = "Please log in";
            });
        }
        
        refresh();
    }

})();