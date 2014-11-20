


		/* ----------------------------------------------------------------------------------------------------------------
		    
	    * Project     : F+F
	    * Document    : controllers.js  
	    * Created on  : Oct 20, 2.014
	    * Version     : 1.0 
	    * Author      : Aday Henriquez
	    * Description : angular controllers
	    
	    -------------------------------------------------------------------------------------------------------------------
	       *          This code has been developed by NOLOGY. in the awesome Canaries - www.nologystudio.com           *
	    -------------------------------------------------------------------------------------------------------------------
	   
	    * Log * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
        -------------------------------------------------------------------------------------------------------------------
        *  
        ---------------------------------------------------------------------------------------------------------------- */
        
        'use strict';
        
        /* ~ Controllers ~ */
		/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */
		
		var ffAppControllers = angular.module('ffControllers',[]);
		
		/* ~ Main navigation ~ */
		/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */
		
		ffAppControllers.controller('NavCtrl',['$scope',function($scope){
			
			var _o         = $('nav[role="main-navigation"] > div.wrapper > ul > li');
			var navOptions = _o.toArray();
			
			angular.forEach(navOptions,function(_l){
				if(!angular.isUndefined(_l.children[1])){
					
					var _target = $(_l.children[1]);
					var stClass = 'on';
					
					$(_l).on({
						mouseenter: function(){
							_target.toggleClass(stClass);
  						}, 
  						mouseleave: function(){
  							_target.toggleClass(stClass);
  						}
					});
				}
			});
		}]);
		
		/* ~ Sign-up ~ */
		/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */
		
		ffAppControllers.controller('SignUpCtrl',['$scope',function($scope){
			
			$scope.response = ['success','error'];
			$scope.types    = ['sign-up','sign-in','response'];
			
			$scope.type     = $scope.types[0];
			$scope.rMessage = $scope.response[0];
			
			// | i | Close lighwindow...
			
			$scope.close = function(){
				$('div.call-to-action').remove();
			}
			
			// | i | Switch bettwen forms...
			
			$scope.switcher = function(_state){
				$scope.type = "sign-" + _state;
			}
			
			// | i | Sign-up form...
			// | i | Sign-in form...
			// | i | Password recovery...
			
		}]);
		
		/* ~ Home ~ */
		/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */
		
		ffAppControllers.controller('HomeCtrl',['$scope',function($scope){
		}]);
		
		/* ~ Booking ~ */
		/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */
		
		ffAppControllers.controller('BookingEngineCtrl',['$scope',function($scope){
			
			$scope.globalPath = '/feather-and-flip/library/partials/';
			$scope.path       = $scope.globalPath + 'booking-engine-flow/';
			$scope.state      = 1;
			$scope.booking    = $scope.globalPath + 'booking-engine.tpl.html';
			$scope.searchTpl  = $scope.path + 'be-search.tpl.html';
			$scope.stepTpl    = {
				0 : '',
				// --> Landing
				1 : $scope.path + 'be-step-1.tpl.html',
				// --> Search results
				2 : $scope.path + 'be-step-2.tpl.html',
				// --> Hotel room detail 
				3 : $scope.path + 'be-step-3.tpl.html', 
				// --> Fill data
				4 : $scope.path + 'be-step-4.tpl.html',
				// --> Confirmation
				5 : $scope.path + 'be-step-5.tpl.html'
			}
			
			$scope.availableRooms = {0:'',1:''};
			
			$scope.booking = {
				dates    : {
					checkIn : '',
					checkOut: ''
				},
				adults   : {},
				children : {},
				babies   : {},
				rooms    : {}
			}
			
		/* ~ Step 1 ~ Home page selection */
		/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */
		
			$scope.guestManager = function(){
			}
			
			$scope.roomManager = function(){
			}
		
		/* ~ Step 2 ~ */
		/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */
		
		/* ~ Step 3 ~ */
		/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */
		
		/* ~ Step 4 ~ */
		/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */
		
		/* ~ Step 5 ~ */
		/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */
		
		}]);
        
        /* ~ Map ~ */
		/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */
		
		ffAppControllers.controller('MapCtrl',['$scope','$element','$http',function($scope,$element,$http){
			
			var endPoint = 'http://54.164.51.183/sites/all/themes/feflip/forms_controller/admin_forms_submit.php';
			var data     = {formID:'getDestinations'};
			
			$scope.destinations = {};
			
			$http({
                method : 'POST',
                url    : endPoint,
                data   : $.param({formID:'getDestinations'}),
                headers : { 
            		'Content-Type' : 'application/x-www-form-urlencoded'
				},
				transformRequest: angular.identity
            }).
            success(function(_data){
	            //$scope.destinations = _data;
            }).
            error(function(_data,_status){
            });
			
			// | i | Aside menu...
			
			$scope.displayMenu = function(){
				$('#map-it aside').toggleClass('on');
			}
			
		}]);
		
		/* ~ Blog ~ */
		/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */
		
		ffAppControllers.controller('BlogCtrl',['$scope','$element',function($scope,$element){
			
			console.log($element[0]);
			
			var grid = $('.feed-wrapper');
			

			grid.shuffle({
				itemSelector: '.quick-entry'
			});
			
		}]);
		
		/* ~ Messenger ~ */
		/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */
		
		ffAppControllers.controller('MessengerCtrl',['$scope','$element',function($scope,$element){
		}]);
		
		/* ~ Newsletter ~ */
		/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */
		
		ffAppControllers.controller('NewsletterCtrl',['$scope','$element','$http',function($scope,$element,$http){
			
			var mcService = '';
			var status    = ['still','success','error'];
			
			$scope.userEmail     = '';
			$scope.currentStatus = status[0];
						
			$scope.submit = function(){
				$http({
	                method : 'POST',
	                url    : mcService,
	                data   : $.param({email:$scope.userEmail}),
	                headers : { 
	            		'Content-Type' : 'application/x-www-form-urlencoded'
					},
					transformRequest: angular.identity
	            }).
	            success(function(){
		        	$scope.currentStatus = status[1];
	            }).
	            error(function(){
		            $scope.currentStatus = status[2];
	            });
			}
			
		}]);
		
		/* ~ Gallery ~ */
		/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */
		
		ffAppControllers.controller('SlideshowCtrl',['$scope','$element',function($scope,$element){
		}]);
		
		
		
		