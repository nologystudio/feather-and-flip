


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
				}else _nav.removeClass('sticky');
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
		
		ffAppControllers.controller('MapCtrl',function($scope,$http,$timeout){
			
			L.mapbox.accessToken = 'pk.eyJ1Ijoibm9sb2d5IiwiYSI6IkFBdm5aVEkifQ.ItKi4oQ1-kPhJhedS4QmNg';
			
			var map  = L.mapbox.map('map','nology.k0cicjhd',{
				zoomControl: false,
				attributionControl: false,
			    tileLayer: {
			        continuousWorld: false,
			        noWrap: false
			    }
			}).setView([40,0],2);
			
			//map.dragging.disable();
			map.touchZoom.disable();
			map.doubleClickZoom.disable();
			map.scrollWheelZoom.disable();
			// | i | Disable tap handler, if present.
			if(map.tap) map.tap.disable();
			
			var destLayer  = L.mapbox.featureLayer().addTo(map);
			var geoJson    = [];
			
			var gFrame = $('#weather-carrousel');
			var lBtn   = gFrame.find('*[rel="left"]');
			var rBtn   = gFrame.find('*[rel="right"]');
			
			$scope.destinations = {};
			$scope.weatherSpots = {};
			
			// | i | Retrieve destinations...
			// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
			
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
		            $scope.getWeatherData();
		        }).
	            error(function(_data,_status){
	            });
            }
            
            // | i | Add destination markers to map...
            // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
			
			$scope.addDestinations = function(){
				
				var markerType = {
				    type     : "Feature",
				    geometry : {
				        type        : "Point",
				        coordinates : [0,0]
				    },
				    properties: {
				        title : "",
				        icon  : {
				            iconUrl     : "",
				            iconSize    : [38,47], // size of the icon
				            iconAnchor  : [19,47], // point of the icon which will correspond to marker's location
				            popupAnchor : [0,-10], // point from which the popup should open relative to the iconAnchor
				            className   : "ff-Pin"
				        }
				    }
				}
				
				angular.forEach($scope.destinations,function(_d){
					
					var newMarker = angular.copy(markerType);
					
					newMarker.geometry.coordinates[0] = _d.longitude;
					newMarker.geometry.coordinates[1] = _d.latitude;
					newMarker.properties.title        = _d.destination;
					newMarker.properties.icon.iconUrl = '/sites/all/themes/feflip/media/icons/destination-map-pin.png';
					newMarker.properties.image        = _d.image.url;
					newMarker.properties.description  = _d.description;
					newMarker.properties.url          = _d.maptourl;
					
					console.log(_d);
					
					geoJson.push(newMarker);
				});
				
				destLayer.on('layeradd', function(_e){
				    
				    var marker       = _e.layer,
				        feature      = marker.feature,
						popupContent = '<a href="'+feature.properties.url+'" class="expanded-destination-pin"><figure><img src="'+feature.properties.image+'"/></figure><p>'+feature.properties.description+'</p><small>more...</small></a>';
					
				    marker.setIcon(L.icon(feature.properties.icon));
				    
				    marker.bindPopup(popupContent,{
				        closeButton  : false,
				        minWidth     : 300,
				        zoomAnimation: true,
				        keepInView   : true,
				        autoPan      : true
				    });
				});
				
				$('*[rel="zoom-in"').on('click',function(_e){
					map.zoom(10,true);
				});
				
				$('*[rel="zoom-out"').on('click',function(_e){
				    map.zoom(20,true);
				});
				
				destLayer.setGeoJSON(geoJson);
			};
			
			// | i | Weather widget...
			// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
			
			$scope.getWeatherData = function(){
				if(gFrame.size() > 0){
		            $http({
		                method : 'GET',
		                url    : 'http://api.openweathermap.org/data/2.5/group',
		                params : {id:'5412230,4164138,5134295,4568127,4004293,3521342,2986160'}
		            }).
		            success(function(_data){
			            if(_data.cnt > 0){
				            $scope.weatherSpots = _data.list;
				            $timeout(function(){ 
					            $scope.setWeatherGallery();
			                },100,false);
				            
				        }else gFrame.hide();
		            }).
		            error(function(){
			            gFrame.hide();
		            });
				}
			}
			
			$scope.setWeatherGallery = function(){
				gFrame.sly({
					horizontal    : true,
					itemNav       : 'basic',
					activateOn    : 'click',
					mouseDragging : 1,
					touchDragging : 1,
					smart         : 1,
					startAt       : 0,
					scrollBy      : 1,
					speed         : 300,
					elasticBounds : 1,
					activatePageOn: 'click',
					prevPage      : lBtn,
					nextPage      : rBtn
				});
			}
			
			// | i | Aside menu...
			// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
			
			$scope.displayMenu = function(){
				$('#map-it aside').toggleClass('on');
			}
			
			$scope.retrieveDestinations();
			
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
		
		ffAppControllers.controller('SlideshowCtrl',function($scope,$element,$http){
			
			var gFrame = $('#'+$element[0].id);
			var lBtn   = gFrame.find('*[rel="left"]');
			var rBtn   = gFrame.find('*[rel="right"]');
			
			switch(gFrame.hasClass('one-item')){
				case false:
					gFrame.sly({
						horizontal    : true,
						itemNav       : 'basic',
						activateOn    : 'click',
						mouseDragging : 1,
						touchDragging : 1,
						smart         : 1,
						startAt       : 0,
						scrollBy      : 1,
						speed         : 300,
						elasticBounds : 1,
						activatePageOn: 'click',
						prevPage      : lBtn,
						nextPage      : rBtn
					});
				break;
				case true:
				
					// | i | This resizes the images within the main gallery...
					/* ------------------------------------------------------------------------------------------------- */
					if(gFrame.hasClass('main')) 
						gFrame.find('li').css({'width':$(window).width()+'px'});
					/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */
					
					gFrame
					.find('li')
					.delay(300)
					.transit({opacity:1},function(){
						gFrame.sly({
						horizontal     : 1,
						itemNav        : 'forceCentered',
						smart          : 1,
						activateMiddle : 1,
						mouseDragging  : 1,
						touchDragging  : 1,
						releaseSwing   : 1,
						startAt        : 0,
						scrollBy       : 1,
						speed          : 500,
						elasticBounds  : 1,
						cycleBy        : 'items',  
						cycleInterval  : 7000,
						pauseOnHover   : true,
						startPaused    : false, 
						prev           : lBtn,
						next           : rBtn
						});
					});
				break;
			}
		});
		
		
		
		