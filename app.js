(function () {
    'use strict';

    angular
        .module('app', ['ngRoute', 'ngCookies'])
        .config(config)
        .run(run);

    config.$inject = ['$routeProvider', '$locationProvider'];
    function config($routeProvider, $locationProvider) {
        $routeProvider
            .when('/', {
                controller: 'LandingController',
                templateUrl: 'landing/landing.view.html',
                controllerAs: 'vm'
            })
            .when('/home', {
                controller: 'HomeController',
                templateUrl: 'home/home.view.html',
                controllerAs: 'vm'
            })
            .when('/login', {
                controller: 'LoginController',
                templateUrl: 'login/login.view.html',
                controllerAs: 'vm'
            })
            .when('/register', {
                controller: 'RegisterController',
                templateUrl: 'register/register.view.html',
                controllerAs: 'vm'
            })
            
		  .when('/store', {
			templateUrl: 'partials/store.htm',
			controller: storeController 
		  }).
		  when('/products/:productSku', {
			templateUrl: 'partials/product.htm',
			controller: storeController
		  }).
		  when('/cart', {
			templateUrl: 'partials/shoppingCart.htm',
			controller: storeController
		  })

			
            .otherwise({ redirectTo: '/' });
    }

    run.$inject = ['$rootScope', '$location', '$cookieStore', '$http','$window'];
    function run($rootScope, $location, $cookieStore, $http, $window) {
		
		$window.fbAsyncInit = function() {
			FB.init({ 
			  appId: '1564484997178485',
			  status: true, 
			  cookie: true, 
			  xfbml: true,
			  version: 'v2.4'
			});
		};
		
        // keep user logged in after page refresh
        $rootScope.globals = $cookieStore.get('globals') || {};
        if ($rootScope.globals.currentUser) {
            $http.defaults.headers.common['Authorization'] = 'Basic ' + $rootScope.globals.currentUser.authdata; // jshint ignore:line
        }

        $rootScope.$on('$locationChangeStart', function (event, next, current) {
            // redirect to login page if not logged in and trying to access a restricted page
            var restrictedPage = $.inArray($location.path(), ['/', '/login', '/register']) === -1;
            var loggedIn = $rootScope.globals.currentUser;
            if (restrictedPage && !loggedIn) {
                $location.path('/');
            }
        });
    }

})();