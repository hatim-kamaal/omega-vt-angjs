﻿(function () {
    'use strict';

    angular
        .module('app')
		.factory("DataService", function () {

			// create store
			var myStore = new store();

			// create shopping cart
			var myCart = new shoppingCart("AngularStore");

			// enable PayPal checkout
			// note: the second parameter identifies the merchant; in order to use the 
			// shopping cart with PayPal, you have to create a merchant account with 
			// PayPal. You can do that here:
			// https://www.paypal.com/webapps/mpp/merchant
			myCart.addCheckoutParameters("PayPal", "paypaluser@youremail.com");

			// enable Google Wallet checkout
			// note: the second parameter identifies the merchant; in order to use the 
			// shopping cart with Google Wallet, you have to create a merchant account with 
			// Google. You can do that here:
			// https://developers.google.com/commerce/wallet/digital/training/getting-started/merchant-setup
			myCart.addCheckoutParameters("Google", "xxxxxxx",
				{
					ship_method_name_1: "UPS Next Day Air",
					ship_method_price_1: "20.00",
					ship_method_currency_1: "USD",
					ship_method_name_2: "UPS Ground",
					ship_method_price_2: "15.00",
					ship_method_currency_2: "USD"
				}
			);

			// enable Stripe checkout
			// note: the second parameter identifies your publishable key; in order to use the 
			// shopping cart with Stripe, you have to create a merchant account with 
			// Stripe. You can do that here:
			// https://manage.stripe.com/register
			myCart.addCheckoutParameters("Stripe", "pk_test_xxxx",
				{
					chargeurl: "https://localhost:1234/processStripe.aspx"
				}
			);

			// return data object with store and cart
			return {
				store: myStore,
				cart: myCart
			};
		})
		.factory('facebookService', function($q) {
			return {
				getMyLastName: function() {
					var deferred = $q.defer();
					FB.api('/me', {
						fields: 'last_name'
					}, function(response) {
						if (!response || response.error) {
							deferred.reject('Error occured');
						} else {
							deferred.resolve(response);
						}
					});
					return deferred.promise;
				}
			}
		});
})();