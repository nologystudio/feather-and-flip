


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
        
        /* ~ Global ~ */
		/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */
        
        var globalPartialPath = (window.location.host == 'localhost:8888') ? '/feather-and-flip/library/partials/' : '/sites/all/themes/feflip/library/partials/';
        var formSubmit        = 'http://54.164.51.183/sites/all/themes/feflip/forms_controller/admin_forms_submit.php';
        
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
							_target
							.removeClass()
							.toggleClass(stClass)
							.addClass('animated fadeInUp');
  						}, 
  						mouseleave: function(){
  							_target.addClass('fadeOutDown').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend',function(){
	  							_target.removeClass();
  							});
  						}
					});
				}
			});
		}]);
		
		/* ~ Body ~ */
		/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */
		
		ffAppControllers.controller('BodyCtrl',['$scope',function($scope){
			
			$scope.user;
		
		}]);
			
		/* ~ Booking ~ */
		/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */
			
		ffAppControllers.controller('BookingEngineCtrl',['$scope',function($scope){
			
			$scope.path       = globalPartialPath + 'booking-engine-flow/';
			$scope.state      = 1;
			$scope.booking    = globalPartialPath + 'booking-engine.tpl.html';
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
			
			L.mapbox.accessToken = 'pk.eyJ1Ijoibm9sb2d5IiwiYSI6IkFBdm5aVEkifQ.ItKi4oQ1-kPhJhedS4QmNg';
			
			var map  = L.mapbox.map('map','nology.k0cicjhd',{
				zoomControl: false,
			    tileLayer: {
			        continuousWorld: false,
			        noWrap: false
			    }
			}).setView([40,0],2);
			
			$scope.destinations = {};
			
			// | i | Retrieve destinations...
			
			$scope.retrieveDestinations = function(){
				$http({
	                method : 'POST',
	                url    : formSubmit,
	                data   : $.param({formID:'getDestinations'}),
	                headers : { 
	            		'Content-Type' : 'application/x-www-form-urlencoded'
					},
					transformRequest: angular.identity
	            }).
	            success(function(_data){
		            $scope.destinations = _data;
		            $scope.addDestinations();
	            }).
	            error(function(_data,_status){
	            });
            }
            
            // | i | Add destination markers to map...
			
			$scope.addDestinations = function(){
				angular.forEach($scope.destinations,function(_d){
					L.marker([_d.latitude,_d.longitude], {
					    icon: L.mapbox.marker.icon({
					        'marker-size'   : 'large',
					        'marker-symbol' : '',
					        'marker-color'  : '#000'
					    })
					}).addTo(map);
				});
			};
			
			// | i | Aside menu...
			
			$scope.displayMenu = function(){
				$('#map-it aside').toggleClass('on');
			}
			
			$scope.retrieveDestinations();
			
		}]);
		
		/* ~ Blog ~ */
		/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */
		
		ffAppControllers.controller('BlogCtrl',['$scope','$element',function($scope,$element){
			
			var grid    = $('.feed-wrapper');
			var entries = $('#travel-journal').find('a.quick-entry').toArray();
			
			angular.forEach(entries,function(_e){
				
				if(!angular.isUndefined($(_e).data('size'))){
				
					var _data  = $(_e).data('size');
					var _eSize = _data.split('x')
					var _w     = $(_e).width(); 
					var _h     = (_eSize[1]*_w)/_eSize[0];
					
					$(_e).css({
						width  : _w +'px',
						height : _h+'px'
					});
				}
			});
			
			grid.shuffle({
				itemSelector: '.quick-entry'
			});
		}]);
		
		/* ~ Messenger ~ */
		/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */
		
		ffAppControllers.controller('MessengerCtrl',['$rootScope','$scope','$element',function($root,$scope,$element){
			
			var messageType     = ['hidden','signup','loading'];
			
			$scope.messenger    = globalPartialPath + 'messenger.tpl.html';
			$scope.overlay      = $('.call-to-action');
			$scope.isLoggedIn   = $scope.$parent.user; // | i | This comes from BodyCtrl...
			$scope.triggerState = messageType[0];
			$scope.display      = false;
			
			$scope.triggerOverlay = function(){
				switch($scope.triggerState){
					case 'hidden':
						$scope.display = false;
					break;
					default:
						$scope.display = true;
					break;
				}
			}
			
			// | i | Watch user login...
			
			$scope.$watch('isLoggedIn',function(_v){
				if(!_v){
					$scope.triggerState = messageType[1];
					$scope.triggerOverlay();
				}
			});
		}]);
		
		/* ~ Sign-up ~ */
		/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */
		
		ffAppControllers.controller('SignUpCtrl',['$scope',function($scope){
			
			$scope.response = ['success','error'];
			$scope.types    = ['sign-up','sign-in','response']; // * formID: signin / signup 
			
			$scope.type     = $scope.types[0];
			$scope.rMessage = $scope.response[0];
			
			// | i | Close lighwindow...
			
			$scope.close = function(){
				$('div.call-to-action').remove();
			}
			
			// | i | Switch bettwen forms...
			
			$scope.switcher = function(_state){
				$scope.type = 'sign-' + _state;
			}
			
			// | i | Submit form...
			
			$scope.submit = function(){
				$http({
	                method : 'POST',
	                url    : _form,
	                data   : $.param({}),
	                headers : { 
	            		'Content-Type' : 'application/x-www-form-urlencoded'
					},
					transformRequest: angular.identity
	            }).
	            success(function(){
		        }).
	            error(function(){
		        });
			}
			
			// | i | Sign-up form...
			// | i | Sign-in form...
			// | i | Password recovery...
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
		
		
		
		