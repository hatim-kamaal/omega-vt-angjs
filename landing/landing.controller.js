(function () {
    'use strict';

    angular
        .module('app')
        .controller('LandingController', LandingController);

    LandingController.$inject = ['UserService', '$rootScope'];
    function LandingController(UserService, $rootScope) {
        var vm = this;
        
    }

})();