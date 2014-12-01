


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
			};
			
			// | i | Room info detail...
			
			$scope.roomUnit = {
				adults : {
					number : 0
				},
				children : {
					number : 0
				}
			};
			
			$scope.bookingInfo = {
				dates    : {
					checkIn : '',
					checkOut: ''
				},
				rooms    : {
					number : 1,
					info   : [angular.copy($scope.roomUnit)] // | i | The array is populated with first room...
				}
			};
			
		/* ~ Step 0 ~ Set-up triggers */
		/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */

			$('*[rel="destination"]').click(function(_e){
				if($scope.state == 0){
					$scope.state++;
					$scope.$apply();
				}
				_e.preventDefault();
			});
			
		/* ~ Step 1 ~ Home page selection */
		/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */
		
			var setNumber = function(_m){
				//_m++;
			}
			
			$scope.guestManager = function(_index,_a){
				switch(_a){
					case '+':
					break;
					case '-':
					break;
				}
			}
			
			$scope.roomManager = function(_a){
				switch(_a){
					case '+':
						
						$scope.bookingInfo.rooms.number++;
						$scope.bookingInfo.rooms.info.push(angular.copy($scope.roomUnit));
						console.log($scope.bookingInfo.rooms.info);
						
					break;
					case '-':
						if($scope.bookingInfo.rooms.number > 1){
							$scope.bookingInfo.rooms.number--;
						}
					break;
				}
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
		
		ffAppControllers.controller('MapCtrl',['$scope','$http',function($scope,$http){
			
			L.mapbox.accessToken = 'pk.eyJ1Ijoibm9sb2d5IiwiYSI6IkFBdm5aVEkifQ.ItKi4oQ1-kPhJhedS4QmNg';
			
			var map  = L.mapbox.map('map','nology.k0cicjhd',{
				zoomControl: false,
			    tileLayer: {
			        continuousWorld: false,
			        noWrap: false
			    }
			}).setView([40,0],2);
			
			map.dragging.disable();
			map.touchZoom.disable();
			map.doubleClickZoom.disable();
			map.scrollWheelZoom.disable();
			// | i | Disable tap handler, if present.
			if (map.tap) map.tap.disable();
			
			//var destLayer  = L.mapbox.featureLayer().addTo(map);
			//var geoJson    = [];
			/*var markerType = {
			    "type": "Feature",
			    "geometry": {
			        "type": "Point",
			        "coordinates": [-75.00, 40]
			    },
			    "properties": {
			        "title": "Small astronaut",
			        "icon" : {
			            "iconUrl"     : "/mapbox.js/assets/images/astronaut1.png",
			            "iconSize"    : [50, 50], // size of the icon
			            "iconAnchor"  : [25, 25], // point of the icon which will correspond to marker's location
			            "popupAnchor" : [0, -25], // point from which the popup should open relative to the iconAnchor
			            "className"   : "dot"
			        }
			    }
			}*/
			
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
					L.marker([_d.latitude,_d.longitude],{
					    icon: L.mapbox.marker.icon({
					        'marker-size'   : 'large',
					        'marker-symbol' : '',
					        'marker-color'  : '#000'
					    })
					}).addTo(map);
				});
				//myLayer.setGeoJSON(geoJson);
			};
			
			// | i | Aside menu...
			
			$scope.displayMenu = function(){
				$('#map-it aside').toggleClass('on');
			}
			
			$scope.retrieveDestinations();
			
		}]);
		
		ffAppControllers.controller('WeatherWidgetCtrl',['$scope','$element','$http',function($scope,$element,$http){
			// http://openweathermap.org/api 
			// ae91d7c77096ad3ad172e7859bab4c06
			// http://api.openweathermap.org/data/2.5/weather?q=London,uk
			// http://api.openweathermap.org/data/2.5/group?id=524901,703448,2643743&units=metric
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
						width  : _w + 'px',
						height : _h + 'px'
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
		
		ffAppControllers.controller('RegistrationCtrl',['$scope','$http',function($scope,$http){
			
			$scope.response = ['success','error','error-in-login'];
			$scope.types    = ['sign-up','sign-in','response']; // * formID: signin / signup 
			
			$scope.type     = $scope.types[0];
			$scope.rMessage = '';
			$scope.data     = {
				userName       : '',
				userLast       : '',
				userEmail      : '',
				userPassword   : '',
				userRePassword : ''
			}
			$scope.isValid  = true;
			
			// | i | Switch bettwen forms...
			
			$scope.switcher = function(_state){
				$scope.type = 'sign-' + _state;
			}
			
			// | i | Input checker...
			
			$scope.checkChangedInput = function(_i){
				
				var displayWarning = function(_id,_state){
					
					var _t = $('*[name$="-'+_id.split('user')[1].toLowerCase()+'"');
					var _c = 'warning';
					
					if(_state) _t.addClass(_c);
					else _t.removeClass(_c);
				}
				
				angular.forEach($scope.data,function(_v,_id){
					displayWarning(_id,angular.isUndefined(_v));
				});
			}
			
			// | i | Submit form...
			
			$scope.regSubmit = function(_id){
				$http({
	                method  : 'POST',
	                url     : formSubmit,
	                data    : $.param(angular.extend({formID:'sign'+_id},$scope.data)),
	                headers : { 
	            		'Content-Type' : 'application/x-www-form-urlencoded'
					},
					transformRequest: angular.identity
	            }).
	            success(function(_data){
		            if(_data.result) window.location.href = 'http://' + window.location.host + '';
		            else{
			            console.log(_data);
			            $scope.currentStatus = status[1];
			        }
	            }).
	            error(function(){
		            console.log('Sign-' + _id + ' Error');
		            $scope.rMessage = $scope.response[1];
	            });
			}
			
			// | i | Sign-up form...
			// | i | Sign-in form...
			// | i | Password recovery...
		}]);
		
		/* ~ Newsletter ~ */
		/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */
		
		ffAppControllers.controller('NewsletterCtrl',['$scope','$element','$location','$http',function($scope,$element,$http){
			
			var mcService = '';
			var status    = ['still','success','error'];
			
			$scope.currentStatus = status[0];
			$scope.signUpData    = {
				list      : '',
				userEmail : ''
			}
			
			// | i | Input checker...
			
			$scope.checkChangedInput = function(_i){
				
				var displayWarning = function(_id,_state){
					
					var _t = $('*[name$="-'+_id.split('user')[1].toLowerCase()+'"');
					var _c = 'warning';
					
					if(_state) _t.addClass(_c);
					else _t.removeClass(_c);
				}
				
				angular.forEach($scope.data,function(_v,_id){
					displayWarning(_id,angular.isUndefined(_v));
				});
			}
			
			// | i | Submit form...
			
			$scope.regSubmit = function(){
				$http({
	                method : 'POST',
	                url    : mcService,
	                data   : $.param($scope.signUpData),
	                headers : { 
	            		'Content-Type' : 'application/x-www-form-urlencoded'
					},
					transformRequest: angular.identity
	            }).
	            success(function(_data){
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
		
		
		
		