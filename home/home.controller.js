(function () {
    'use strict';

    angular
        .module('app')
        .controller('HomeController', HomeController);

    HomeController.$inject = ['UserService', '$rootScope', '$http'];
    function HomeController(UserService, $rootScope, $http) {
        var vm = this;

        vm.user = null;
        vm.allUsers = [];
        vm.deleteUser = deleteUser;

        initController();

        function initController() {
            loadCurrentUser();
            loadAllUsers();
        }

        function loadCurrentUser() {
        	$http.get('http://localhost/omega-vt-angjs/services/member/get_by_username/' + $rootScope.globals.currentUser.username).success(function(response) {
        		vm.user = response.data[0];
			});
            /*UserService.GetByUsername($rootScope.globals.currentUser.username)
                .then(function (user) {
                    vm.user = user;
                });*/
        }

        function loadAllUsers() {
        	$http.get('http://localhost/omega-vt-angjs/services/member/get_all_user').success(function(response) {
        		vm.allUsers = response.data;
			});
				
            /*UserService.GetAll()
                .then(function (users) {
                    vm.allUsers = users;
                });*/
        	
        }

        function deleteUser(id) {
        	$http.get('http://localhost/omega-vt-angjs/services/member/delete_member/' + id).success(function(response) {
        		loadAllUsers();
			});
            /*UserService.Delete(id)
            .then(function () {
                loadAllUsers();
            });*/
        }
    }

})();