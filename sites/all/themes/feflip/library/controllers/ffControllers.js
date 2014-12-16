


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
		
		ffAppControllers.controller('NavCtrl',function($scope){
			
			var _nav       = $('nav[role="main-navigation"]');
			var _o         = _nav.find('div.wrapper > ul > li');
			var heightRef  = 480;
			var navOptions = _o.toArray();
			
			// | i | Dropdown effects...
			
			angular.forEach(navOptions,function(_l){
				if(!angular.isUndefined(_l.children[1])){
					
					var _target = $(_l.children[1]);
					var stClass = 'on';
					
					$(_l).on({
						mouseenter: function(){
							_target.toggleClass(stClass);
							/*_target
							.removeClass()
							.toggleClass(stClass)
							.addClass('animated fadeInUp');*/
  						}, 
  						mouseleave: function(){
  							/*_target.addClass('fadeOutDown').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend',function(){
	  							_target.removeClass();
  							});*/
  							_target.toggleClass(stClass);
  						}
					});
				}
			});
			
			// | i | Sticky navigation trigger...
			
			$(window).scroll(function(){
				if($(this).scrollTop() >= heightRef){
					_nav.addClass('sticky');
				}else
					_nav.removeClass('sticky');
			});
		});
		
		/* ~ Body ~ */
		/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */
		
		ffAppControllers.controller('BodyCtrl',function($scope){
			
			$scope.user;
		
		});
			
		/* ~ Booking ~ */
		/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */
			
		ffAppControllers.controller('BookingEngineCtrl',function($scope){
			
			$scope.path       = globalPartialPath + 'booking-engine-flow/';
			$scope.state      = 0;
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
		
		});
        
        /* ~ Map ~ */
		/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */
		
		ffAppControllers.controller('MapCtrl',function($scope,$http){
			
			L.mapbox.accessToken = 'pk.eyJ1Ijoibm9sb2d5IiwiYSI6IkFBdm5aVEkifQ.ItKi4oQ1-kPhJhedS4QmNg';
			
			var map  = L.mapbox.map('map','nology.k0cicjhd',{
				zoomControl: false,
				attributionControl: false,
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
			
		});
		
		ffAppControllers.controller('WeatherWidgetCtrl',function($scope,$element,$http){
			// http://openweathermap.org/api 
			// ae91d7c77096ad3ad172e7859bab4c06
			// http://api.openweathermap.org/data/2.5/weather?q=London,uk
			// http://api.openweathermap.org/data/2.5/group?id=524901,703448,2643743&units=metric
		});
		
		/* ~ Blog ~ */
		/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */
		
		ffAppControllers.controller('BlogCtrl',function($scope,$element){
			
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
		});
		
		/* ~ Messenger ~ */
		/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */
		
		ffAppControllers.controller('MessengerCtrl',function($scope,$element){
			
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
		});
		
		/* ~ Sign-up ~ */
		/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */
		
		ffAppControllers.controller('RegistrationCtrl',function($scope,$http){
			
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
		});
		
		/* ~ Newsletter ~ */
		/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */
		
		ffAppControllers.controller('NewsletterCtrl',function($scope,$element,$http){
			
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
			
		});
		
		/* ~ Gallery ~ */
		/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */
		
		ffAppControllers.controller('SlideshowCtrl',function($scope,$element){
			
			$scope.galleryId = 1;
			
			var galleryFrame = $('#miss-slideshow');
			
			switch($scope.galleryId){
				case 1:
					galleryFrame.sly({
						horizontal    : true,
						itemNav       : 'basic',
						smart         : true,
						startAt       : 0,
						scrollBy      : 1,
						speed         : 300,
						elasticBounds : 1,
						next          : galleryFrame.find('*[rel="right"]'),
						prev          : galleryFrame.find('*[rel="left"]')
					});
				break;
				case 2:
				break;
			}
			
			/*var sly = new Sly('.gallery-wrapper',{
			    horizontal: true, // Switch to horizontal mode.
			
			    // Item based navigation
			    itemNav:        null,  // Item navigation type. Can be: 'basic', 'centered', 'forceCentered'.
			    itemSelector:   null,  // Select only items that match this selector.
			    smart:          false, // Repositions the activated item to help with further navigation.
			    activateOn:     null,  // Activate an item on this event. Can be: 'click', 'mouseenter', ...
			    activateMiddle: false, // Always activate the item in the middle of the FRAME. forceCentered only.
			
			    // Scrolling
			    scrollSource: null,  // Element for catching the mouse wheel scrolling. Default is FRAME.
			    scrollBy:     0,     // Pixels or items to move per one mouse scroll. 0 to disable scrolling.
			    scrollHijack: 300,   // Milliseconds since last wheel event after which it is acceptable to hijack global scroll.
			    scrollTrap:   false, // Don't bubble scrolling when hitting scrolling limits.
			
			    // Dragging
			    dragSource:    null,  // Selector or DOM element for catching dragging events. Default is FRAME.
			    mouseDragging: false, // Enable navigation by dragging the SLIDEE with mouse cursor.
			    touchDragging: false, // Enable navigation by dragging the SLIDEE with touch events.
			    releaseSwing:  false, // Ease out on dragging swing release.
			    swingSpeed:    0.2,   // Swing synchronization speed, where: 1 = instant, 0 = infinite.
			    elasticBounds: false, // Stretch SLIDEE position limits when dragging past FRAME boundaries.
			    interactive:   null,  // Selector for special interactive elements.
			
			    // Scrollbar
			    scrollBar:     null,  // Selector or DOM element for scrollbar container.
			    dragHandle:    false, // Whether the scrollbar handle should be draggable.
			    dynamicHandle: false, // Scrollbar handle represents the ratio between hidden and visible content.
			    minHandleSize: 50,    // Minimal height or width (depends on sly direction) of a handle in pixels.
			    clickBar:      false, // Enable navigation by clicking on scrollbar.
			    syncSpeed:     0.5,   // Handle => SLIDEE synchronization speed, where: 1 = instant, 0 = infinite.
			
			    // Pagesbar
			    pagesBar:       null, // Selector or DOM element for pages bar container.
			    activatePageOn: null, // Event used to activate page. Can be: click, mouseenter, ...
			    pageBuilder:          // Page item generator.
			        function (index) {
			            return '<li>' + (index + 1) + '</li>';
			        },
			
			    // Navigation buttons
			    forward:  null, // Selector or DOM element for "forward movement" button.
			    backward: null, // Selector or DOM element for "backward movement" button.
			    prev:     null, // Selector or DOM element for "previous item" button.
			    next:     null, // Selector or DOM element for "next item" button.
			    prevPage: null, // Selector or DOM element for "previous page" button.
			    nextPage: null, // Selector or DOM element for "next page" button.
			
			    // Automated cycling
			    cycleBy:       null,  // Enable automatic cycling by 'items' or 'pages'.
			    cycleInterval: 5000,  // Delay between cycles in milliseconds.
			    pauseOnHover:  false, // Pause cycling when mouse hovers over the FRAME.
			    startPaused:   false, // Whether to start in paused sate.
			
			    // Mixed options
			    moveBy:        300,     // Speed in pixels per second used by forward and backward buttons.
			    speed:         0,       // Animations speed in milliseconds. 0 to disable animations.
			    easing:        'swing', // Easing for duration based (tweening) animations.
			    startAt:       0,       // Starting offset in pixels or items.
			    keyboardNavBy: null,    // Enable keyboard navigation by 'items' or 'pages'.
			
			    // Classes
			    draggedClass:  'dragged', // Class for dragged elements (like SLIDEE or scrollbar handle).
			    activeClass:   'active',  // Class for active items and pages.
			    disabledClass: 'disabled' // Class for disabled navigation elements.
			});*/
		});
		
		
		
		