(function () {
    'use strict';

    angular
        .module('app')
        .controller('RegisterController', RegisterController);

    RegisterController.$inject = ['UserService', '$location', '$rootScope', 'FlashService', '$http'];
    function RegisterController(UserService, $location, $rootScope, FlashService, $http) {
        var vm = this;

        vm.register = register;

        function register() {
            vm.dataLoading = true;
            /*UserService.Create(vm.user)
                .then(function (response) {
                    if (response.success) {
                        FlashService.Success('Registration successful', true);
                        $location.path('/login');
                    } else {
                        FlashService.Error(response.message);
                        vm.dataLoading = false;
                    }
                });
                */
			          $http.post('http://localhost/omega-vt-angjs/services/member/create_member', { firstName : "firstName", lastName : "lastName"
			        	  , username : "username", password : "password"}
			).success(function(response) {
				//callback(response);
				 if (response.success) {
                     FlashService.Success('Registration successful', true);
                     $location.path('/login');
                 } else {
                     FlashService.Error(response);
                     vm.dataLoading = false;
                 }
			});
        }
    }

})();
