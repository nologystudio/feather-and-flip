


		/* ----------------------------------------------------------------------------------------------------------------
		    
	    * Project     : Passported
	    * Document    : pp-controllers.js  
	    * Created on  : Ago 22, 2.015
	    * Version     : 1.0 
	    * Author      : Aday Henriquez
	    * Description : Global Passported App javascript file
	    
	    -------------------------------------------------------------------------------------------------------------------
	       *          This code has been developed by NOLOGY. in the awesome Canaries - www.nologystudio.com           *
	    -------------------------------------------------------------------------------------------------------------------
	   
	    * Log * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
        -------------------------------------------------------------------------------------------------------------------
        *  
        ---------------------------------------------------------------------------------------------------------------- */
        
        'use strict';
        
        var formSubmit = 'https://www.passported.com/api/forms'; //window.location.protocol + '//' + window.location.host + '/api/forms';
        var ppControllers = angular.module('ppControllers',[]);
        
        /* ------------------------------------------------------------------------------------------------------------- */
        
        ppControllers.controller('AppController',function($scope,$log,$timeout,$location){
	       
	    	/* Layout & Tools
	        - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */
	       
	        var triggerGoogleEvent = function(_s){
// 				ga('send','event','ux','scroll',_s);
	        }
	        
	        var scrolling = function(){
		        
		        $('body > header').waypoint(function(){
			        
			        var _t = $(this);
			        
			        $timeout(function(){_t.find('*[data-animate="1"]').addClass('animated fadeInDown')},200);
					$timeout(function(){_t.find('*[data-animate="2"]').addClass('animated fadeInDown')},400);
					$timeout(function(){_t.find('*[data-animate="3"]').addClass('animated fadeInDown')},600);
					$timeout(function(){_t.find('*[data-animate="4"]').addClass('animated fadeInDown')},800);
					$timeout(function(){_t.find('*[data-animate="5"]').addClass('animated fadeInDown')},1000);
					$timeout(function(){_t.find('*[data-animate="6"]').addClass('animated fadeInDown')},1200);
					$timeout(function(){_t.find('*[data-animate="7"]').addClass('animated fadeIn')},1400);
					$timeout(function(){_t.find('*[data-animate="8"]').addClass('animated fadeIn')},1600);
					
		        },{ offset: '0%' }); 
		        

		        $('#passported-intro').waypoint(function(){
			        
			        var _t = $(this);
			        
			        $timeout(function(){_t.find('*[data-animate="1"]').addClass('animated fadeInUp')},200);
					$timeout(function(){_t.find('*[data-animate="2"]').addClass('animated fadeInUp')},400);
					$timeout(function(){_t.find('*[data-animate="3"]').addClass('animated fadeInUp')},600);
					$timeout(function(){_t.find('*[data-animate="4"]').addClass('animated fadeInUp')},800);
					$timeout(function(){_t.find('*[data-animate="5"]').addClass('animated fadeInUp')},1000);
					$timeout(function(){_t.find('*[data-animate="6"]').addClass('animated fadeInUp')},1200);
					$timeout(function(){_t.find('*[data-animate="7"]').addClass('animated fadeInUp')},1400);
					
		        },{ offset: '0%' });  
		        
		        $('#inspiration').waypoint(function(){
			        
			        var _t = $(this);
			        
			        $timeout(function(){_t.find('*[data-animate="1"]').addClass('animated fadeIn')},200);
					$timeout(function(){_t.find('*[data-animate="2"]').addClass('animated fadeIn')},600);
					
		        },{ offset: '75%' });  
		        
		        $('#inspiration').waypoint(function(){
			        
			       /* var _t = $(this);
			        
			        _t.toggleClass('fixed');
			        
			        $(window).scroll(function(){
				        if(_t.hasClass('fixed')){
					        var _h = $(this).scrollTop() - 620; 
					        if(_h > 180) _t.addClass('compressed'); 
				        }
			        });*/
			        
			    },{ offset: '90px' });  
		        
		        $('#how-it-works').waypoint(function(){
			        
			        var _t = $(this);
			        
			        $timeout(function(){_t.find('*[data-animate="1"]').addClass('animated fadeInUp')},200);
					$timeout(function(){_t.find('*[data-animate="2"]').addClass('animated fadeIn')},400);
					$timeout(function(){_t.find('*[data-animate="3"]').addClass('animated fadeIn')},600);
					$timeout(function(){_t.find('*[data-animate="4"]').addClass('animated fadeIn')},800);
					$timeout(function(){_t.find('*[data-animate="5"]').addClass('animated fadeIn')},1000);
					$timeout(function(){_t.find('*[data-animate="6"]').addClass('animated fadeIn')},1200);
					$timeout(function(){_t.find('*[data-animate="7"]').addClass('animated fadeIn')},1400);
					$timeout(function(){_t.find('*[data-animate="8"]').addClass('animated fadeIn')},1600);
					$timeout(function(){_t.find('*[data-animate="9"]').addClass('animated fadeIn')},1800);
					$timeout(function(){_t.find('*[data-animate="10"]').addClass('animated fadeIn')},2000);
					
		        },{ offset: '50%' });  
		        
		        $('#newsletter').waypoint(function(){
			        
			        var _t = $(this);
			        
			        $timeout(function(){_t.find('*[data-animate="1"]').addClass('animated fadeInUp')},200);
					$timeout(function(){_t.find('*[data-animate="2"]').addClass('animated fadeInUp')},600);
					
		        },{ offset: '75%' });  
		        
		        $('#map').waypoint(function(){
			        
			        var _t = $(this);
			        
			        $log.info('The map is visible now');
			        triggerGoogleEvent('map');
			        
			        $timeout(function(){_t.find('*[data-animate="1"]').addClass('animated fadeIn')},200);
			        $timeout(function(){_t.find('*[data-animate="2"]').addClass('animated fadeInLeft')},400);
			        $timeout(function(){_t.find('*[data-animate="3"]').addClass('animated fadeInRight')},600);
			        
		        },{ offset: '30%' }); 
		        
		        $('#travel-journal').waypoint(function(){
			        
			        var _t = $(this);
			        
			        $log.info('The blog is visible now');
					triggerGoogleEvent('travel-journal');
					
			    	$timeout(function(){_t.find('*[data-animate="1"]').addClass('animated fadeInUp')},200);
			    	$timeout(function(){_t.find('*[data-animate="2"]').addClass('animated fadeIn')},400);
			    	$timeout(function(){_t.find('*[data-animate="3"]').addClass('animated fadeIn')},600);
			    	$timeout(function(){_t.find('*[data-animate="4"]').addClass('animated fadeIn')},800);
			    	$timeout(function(){_t.find('*[data-animate="5"]').addClass('animated fadeIn')},1000);
			    	$timeout(function(){_t.find('*[data-animate="6"]').addClass('animated fadeIn')},1200);
			    	$timeout(function(){_t.find('*[data-animate="7"]').addClass('animated fadeIn')},1400);
			    	$timeout(function(){_t.find('*[data-animate="8"]').addClass('animated fadeIn')},1600);
			    	$timeout(function(){_t.find('*[data-animate="9"]').addClass('animated fadeIn')},1800);
			    	
			    },{ offset: '75%' });
		        
		        $('#press').waypoint(function(){
			        
			        var _t = $(this);
			        
			        $log.info('The press block is visible now');
					triggerGoogleEvent('press');
					
			        $timeout(function(){_t.find('*[data-animate="1"]').addClass('animated fadeInDown')},200);
			        $timeout(function(){_t.find('*[data-animate="2"]').addClass('animated fadeInDown')},400);
			        $timeout(function(){_t.find('*[data-animate="3"]').addClass('animated fadeInDown')},600);
			        $timeout(function(){_t.find('*[data-animate="4"]').addClass('animated fadeInDown')},800);
			        $timeout(function(){_t.find('*[data-animate="5"]').addClass('animated fadeInDown')},1000);
			        $timeout(function(){_t.find('*[data-animate="6"]').addClass('animated fadeInDown')},1200);
			        $timeout(function(){_t.find('*[data-animate="7"]').addClass('animated fadeInDown')},1400);
			        $timeout(function(){_t.find('*[data-animate="8"]').addClass('animated fadeInDown')},1600);
			        
		        },{ offset: '75%' });   
		        
		        $('body > footer').waypoint(function(){
			        
			        var _t = $(this);
			        
			        $log.info('The footer is visible now');
			        $timeout(function(){_t.find('*[data-animate="1"]').addClass('animated fadeInDown')},200);
			        
		        },{ offset: '75%' });
			}
	        
	        var navManager = function(){
		        
		        var _t 			= $('div.dropdown-wrapper');
		        var _a			= _t.find('div.arrow');
		        var _n 			= $('#city-guides-list');
		        var _s 			= $('#search-block');
		        var _d          = 300;
		        var wHeight     = ($(window).height() - 90);
		        var userControl = false;
		        
		        var cityGuideAnimation = function(){
			        $timeout(function(){_t.find('*[data-animate="1"]').addClass('animated fadeInUp')},200);
			        $timeout(function(){_t.find('*[data-animate="2"]').addClass('animated fadeInUp')},400);
			        $timeout(function(){_t.find('*[data-animate="3"]').addClass('animated fadeInUp')},600);
			        $timeout(function(){_t.find('*[data-animate="4"]').addClass('animated fadeInUp')},800);
		        }
		        
		        var searchAnimation = function(){
			    }
			    
			    $('div.dropdown-wrapper').on({
			    	mouseover: function(){
				    	userControl = true;
				    }
				});
		        
		        $('header > nav a.subnav').on({
			    	mouseover: function(){
				    	
				    	var middlePoint = $(this).offset().left + 30 - 10 + $(this).width()/2;
				    	var _element;
				    	
				    	userControl = true;
				    	
				    	switch($(this).attr('id')){
					    	case 'city-guides':
					    		_t.removeClass('light');
					    		_element = 'city-guides';
					    	break;
					    	case 'search':
					    		_t.addClass('light');
					    		_element = 'search';
					    	break;
				    	}
				    	
				    	setTimeout(function(){
					    	if(userControl){
						    	//_t.show().transition({height:wHeight + 'px'});
						    	_a.css({left:middlePoint+'px'}).addClass('on');
						    	// 1. City Guides
						    	if(_element == 'city-guides'){ 
							    	_t.show().transition({height:wHeight + 'px'});
						    		_n.show().transition({opacity:1});
						    		_s.hide();
						    	}
						    	// 2. Search
						    	if(_element == 'search'){ 
							    	_t.show().transition({height:260 + 'px'});
						    		_s.show().transition({opacity:1});
						    		_n.hide();
						    	}
						    }
				    	},_d);
			    	}
		        });
		        
		        $('header > nav a.subnav, div.dropdown-wrapper').on({
			    	mouseout: function(){
				    	
				    	userControl = false;
				    	
				    	setTimeout(function(){
					    	if(!userControl){
						    	_a.removeClass('on');
						    	// Dropdown...
						    	_t.transition({height:0},function(){
							    	_t.hide();
						    	});
						    	// City Guide...
						    	_n.transition({opacity:0},function(){
							    	_n.hide();
						    	});
						    	// Search..
						    	_s.transition({opacity:0},function(){
							    	_s.hide();
						    	});
						    }
				    	},_d);
			    	}
			    });
	        }
	        
	        var waitForImages = function(){
		        $('body').imagesLoaded().always(function(_e){
			        $('body').transit({opacity:1},function(){
				    	scrolling();
				    	navManager();	    
			        });
				});
	        }
	        
	        /* Scope 
	        - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */
	        
	        $scope.state = $location.path().replace('/','');
	        
	        $scope.goTo = function(_l){
		        $scope.state = _l;
		        $location.path(_l);
	        }
	        
	        $timeout(function(){
				waitForImages();
			},200);
	    });
	    
	    /* ------------------------------------------------------------------------------------------------------------- */
	    
	    ppControllers.controller('MapController',function($scope,$log,$timeout){
		    
		    $scope.map;
		    $scope.lat = 40.777422;
		    $scope.lon = -73.968887;
		    
		    var mapID = 'passported';
		    var setMapHeight = function(){
			    $('#map').css({
				    height: ($(window).height() - 90) + 'px'
				});
		    }
		    
		    var initialize = function(){
			    
			    var mapOptions = {
					zoom: 10,
					center: new google.maps.LatLng($scope.lat,$scope.lon),
					panControl: true,
					zoomControl: true,
					mapTypeControl: false,
					scrollwheel: false,
					scaleControl: true,
					streetViewControl: true,
					overviewMapControl: false,
					panControl: false,
					panControlOptions: {
						position: google.maps.ControlPosition.TOP_RIGHT
					},
				    zoomControlOptions: {
				    	style: google.maps.ZoomControlStyle.SMALL,
				    	position: google.maps.ControlPosition.RIGHT_TOP
				    },
				    mapTypeControlOptions: {
						mapTypeIds: [google.maps.MapTypeId.ROADMAP,mapID]
					},
					mapTypeId: mapID
	        	};
			    
			    var ppMapStyle = [
					{
						stylers: [
							{ hue: '#D8DCDB' },
							{ visibility: 'simplified' },
							{ gamma: 0 },
							{ weight: 0.50 }
						]
					},{
						elementType: 'labels',
						stylers: [
							{ visibility: 'on' },
							{ color: '#AAAAAA' }
						]
					},{
						featureType: 'water',
						stylers: [
							{ color: '#BBCAD0' }
						]
					},{
						featureType: 'road',
						stylers: [
							{ color: '#D8DCDB' }
						]
					},{
						featureType: 'transit',
						elementType: 'geometry',
						stylers: [
							{ color: '#D8DCDB' }
						]
					},{
						featureType: 'landscape',
						elementType: 'geometry',
						stylers: [
							{ color: '#F0F2F1' }
						]
					},{
						featureType: 'poi',
						elementType: 'geometry',
						stylers: [
							{ color: '#F0F2F1' }
						]
					}
				];
				
				var styledMapOptions = {
				    name: 'Passported'
				};
			    
				$scope.map = new google.maps.Map(document.getElementById('google-maps-container'),mapOptions);
			    $scope.map.mapTypes.set(mapID,new google.maps.StyledMapType(ppMapStyle,styledMapOptions));
			}
		    
		    $scope.addMarkers = function(_id,_data){
			    
			    var _path = '/sites/all/themes/passported/media/icons/';
			    
			    switch(_id){
				    case 'destinations':
				    	console.log(_data);
				    	_.map(_data,function(_d){
						    var destination = new google.maps.Marker({
								position: {
									lat: Number(_d.lat),
									lng: Number(_d.lon)
								},
								map: $scope.map,
								title: _d.name,
								icon: _path + 'map-pin-icon.svg'
							});
							
							destination.addListener('click',function(){
								$scope.map.setZoom(15);
								$scope.map.setCenter(destination.getPosition());
							});
					    });
				    break;
				    case 'guide':
				    
				    	var zoom   = (_data.zoom_level.length == 0) ? 12 : Number(_data.zoom_level);
						var latLng = (_data.addressbook_reference.length == 0) ? [_data.lat,_data.lon] : [_data.addressbook_reference.lat,_data.addressbook_reference.lon];
						var detail = [_data.guide,_data.hotels];
					    
				    	_.map(detail,function(_d){
					    	_.map(_d,function(_p){
						    	
						    	console.log(_p);
						    	
						    	var pin = new google.maps.Marker({
									position: {
										lat: Number(_p.lat),
										lng: Number(_p.lon)
									},
									map: $scope.map,
									title: _p.title,
									icon: _path + 'map-pin-icon.svg'
								});
								
								var infowindow = new google.maps.InfoWindow({
									content: '<div class="in-map"><h1>'+_p.title+'</h1><h2>'+_p.short_review+'</h2></div>',
									maxWidth: 200
								});
								
								pin.addListener('click',function(){
									$scope.map.setZoom(16);
									$scope.map.setCenter(pin.getPosition());
									infowindow.open($scope.map,pin);
								});
							});
					    });
						
					    $scope.map.setCenter(new google.maps.LatLng(Number(latLng[0]),Number(latLng[1])));
					    $scope.map.setZoom(zoom);
					    
				    break;
			    }
		    }
		    
		    $timeout(function(){
				setMapHeight(); 
				initialize();
			},0);
			
			$(window).on('resize',function(){
				setMapHeight();    
			});
		});
		
		ppControllers.controller('ItineraryController',function($scope,$log,$timeout,$resource,$rootScope){
			
			var destSrc  = $resource('https://www.passported.com/api/content/destinations.json');
			var abookSrc = $resource('https://www.passported.com/api/content/address-books.json');
			var hotelSrc = $resource('https://www.passported.com/api/content/hotels.json');
			var itSrc    = $resource('https://gostage.passported.com/api/v2/location');
			
			//GET https://gostage.passported.com/api/v2/location?name=Paris
			//This will return a list of itineraries for New York:
			//GET https://gostage.passported.com/api/v2/location?name=New+York+City
			//This will return a single itinerary based on id:
			//GET https://gostage.passported.com/api/v2/itinerary?id=64
			
			$scope.cityGuideID;
			$scope.step = (_.isUndefined($scope.cityGuideID)) ? 1 : 2;
			$scope.showAside = true;
			$scope.pick;
			
			// Tools
			
			$scope.check = {
				phone: function(_p){
					return _.isArray(_p);
				},
				features: function(_d){
					return _.isArray(_d);
				},
				icon: function(_icon){
					
					var _i = _icon.toLowerCase();
				
					switch(_i){
						case 'basics': case'bedtime':
							_i = 'icon-passported-imago';
						break;
						case 'do': case'shop': case 'eat': case 'noteworthy':
							_i = 'icon-passported-imago';
						break;
					}
					
					return _i;
				}
			}
			
			/* Open/Close panel
	        - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */
			
			$scope.openAside = function(){
				$scope.showAside = !$scope.showAside;	
			}
			
			$scope.goTo = function(_state){
				$scope.step = _state;
			}
			
			/* Destinations
	        - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */
			
			$scope.displayDestination = function(_d){
				
				$scope.pick = _d;
				
				// 1. Bonvoyaging Itinerary...
				
				if(window.location.host == 'stage.passported.com' || window.location.host == 'www.passported.com'){
					itSrc.query({'name':_d.name.replace(' ','+')},function(_data){
						console.log(_data);
					});
				}
				
				// 2. Address Books
				
				abookSrc.query({'destination':_d.id},function(_data){
					
					$scope.pick.guide = _data;
				
					// 3. Hotels
			
					hotelSrc.query({'destination':_d.id},function(_data){
						$scope.pick.hotels = _data;
						$scope.$parent.addMarkers('guide',_d);
						console.log($scope.pick);
					});
				});
				
				$scope.step = 2;
				$('#step-2').delay(2000).transition({opacity:1},'slow');
			}
			
			if(_.isUndefined($scope.cityGuideID)){
				$scope.destinations = destSrc.query({},function(_data){
					$scope.$parent.addMarkers('destinations',_data);
				});
			}else{
				$scope.pick = destSrc.query({id:$scope.cityGuideID},function(_data){
					$scope.displayDestination(_data[0]);
				});
			}
			
			/* Books
			- - - - - - - - - - - - - - - - - - - - - - - - - - - - - */
			
			$scope.book = function(_hotel){
				$rootScope.$emit('open-booking',[_hotel]);
			}
			
			$rootScope.$on('filter',function(_d){
			});
		});
		
		/* ------------------------------------------------------------------------------------------------------------- */
	    
	    ppControllers.controller('BookingController',function($scope,$log,$timeout,$http,$rootScope){
		   
			var bookingData = {
			    formID: 'bookHotel',
			    destination: '',
			    hotel: '',
			    name: undefined,
			    last: undefined,
			    email: undefined,
			    start_date: undefined,
			    end_date: undefined,
			    adults: 0,
			    children: 0,
			    budget: undefined,
			    specific_budget: undefined,
			    message: undefined
		    }
		    
		    $scope.showRightAside = false;
		    $scope.booking = angular.copy(bookingData);
			
			$scope.openAside = function(){
				
				$scope.showRightAside = !$scope.showRightAside;	
				
				// Reset object...
				
				if(!$scope.showRightAside)
					$scope.booking = angular.copy(bookingData);
			}
			
			$scope.setter = {
				checkButtons: function(){
					$('*.budget-check').on('click',function(){
						$(this).find('span').toggleClass('on');
					});
				},
				date: function(){
				},
				budget: function(_price){
					$scope.booking.budget = _price;
				}
			}
			
			$scope.submit = function(){
				
				console.log($scope.booking);
				
				$('aside.right #step-1 ul li').transition({opacity:0},function(){
					$(this).hide();
				});
				
				$http({
	                method  : 'POST',
	                url     : formSubmit,
	                data    : $.param($scope.booking),
	                headers : { 
	            		'Content-Type' : 'application/x-www-form-urlencoded'
					},
					transformRequest: angular.identity
	            }).
	            success(function(_data){
		            console.log(_data);
		            $('#booking-message').show().transition({opacity:1});
	            }).
	            error(function(){});
			}
			
			$rootScope.$on('open-booking',function(_e,_data){
				$scope.showRightAside = true;
				$scope.booking.destination = _data[0].destination;
				$scope.booking.hotel = _data[0].name;
				console.log(_data[0]);
			});
			
			$timeout(function(){
				$scope.setter.checkButtons();
			},0);
		});
		
		/* ------------------------------------------------------------------------------------------------------------- */
	    
	    ppControllers.controller('BlogController',function($scope,$log,$timeout){
		    
		    var grid    = $('.grid-wrapper');
			var entries = $('*.quick-entry').toArray();
			
			$timeout(function(){
				//grid.shuffle({
				//	itemSelector: '.quick-entry'
				//});
			},0);
		});
	    
	    ppControllers.controller('PromotedController',function($scope,$log,$timeout,$resource){
		});
		
		/* ------------------------------------------------------------------------------------------------------------- */
	    
	    ppControllers.controller('NewsletterController',function($scope,$log,$timeout){
		    
		    var mcService = '';
			var status    = ['still','success','error'];
			
			$scope.currentStatus = status[0];
			$scope.signUpData    = {
				userEmail : ''
			}
			
			// Input checker...
			
			$scope.checkChangedInput = function(_i){
				
				var displayWarning = function(_id,_state){
					
					var _t = $('*[name$="-'+_id.split('user')[1].toLowerCase()+'"]');
					var _c = 'warning';
					
					if(_state) _t.addClass(_c);
					else _t.removeClass(_c);
				}
				
				angular.forEach($scope.data,function(_v,_id){
					displayWarning(_id,angular.isUndefined(_v));
				});
			}
			
			// Submit form...
			
			$scope.regSubmit = function(){
				if($scope.signUpData.userEmail != ''){
					$http({
		                method : 'POST',
		                url    : formSubmit,
		                data   : $.param({formID:'newsletterForm','userEmail':$scope.signUpData.userEmail}),
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
			}
		});
	    
	    /* ------------------------------------------------------------------------------------------------------------- */
	    
	    ppControllers.controller('SearchController',function($scope,$log,$http,$timeout){
		    
		    var timer;
		    
		    $scope.userSearch = '';
			$scope.destinations;
			$scope.hotels;
			$scope.showResult = false;
			$scope.noResult   = false;
			
			$scope.reset = function(){
				//$scope.result      = {}; 
				//$scope.noResult    = false;
				$scope.userSearch = '';
				$scope.$apply();
			};
			
			$scope.searchSubmit = function(){
				
				var searchAction = function(){
					
					console.log($scope.userSearch);
					
					$http({
		                method  : 'POST',
		                url     : formSubmit,
			            data    : $.param({formID:'customSearch',key:$scope.userSearch}),
		                headers : { 
		            		'Content-Type' : 'application/x-www-form-urlencoded'
						},
						transformRequest: angular.identity
		            }).
		            success(function(_data){
			            if(_data.destinations.length > 0 || _data.hotels.length > 0){
				            $scope.showResult   = true;
				            $scope.destinations = _data.destinations;
							$scope.hotels       = _data.hotels;
				        }
			            else if($scope.userSearch.split('').length > 0){
				            $scope.showResult   = true;
				            $scope.noResult     = true;
				        }
			            else{
				           
				        	$scope.showResult   = false; 
							$scope.noResult     = false;
			            }
		            }).
		            error(function(){
		            });
				}
				
				if(timer) clearTimeout(timer);
				
				timer = setTimeout(function(){
					searchAction();
				},500); 
			}
		});
		
		ppControllers.controller('InspirationController',function($scope,$log,$http,$timeout){
		});
		
		/* ------------------------------------------------------------------------------------------------------------- */
		
		ppControllers.controller('ContactController',function($scope,$http){
			
			$scope.data = {
				userName       : '',
				userLast       : '',
				userEmail      : '',
				userDepartment : '',
				userSubject    : '',
				userMessage    : ''
			}
			
			$scope.success = false;
			
			$scope.submitContact = function(){
				
				var formData = {
					formID    : 'contact',
					firstName : $scope.data.userName,
					lastName  : $scope.data.userLast,
					email     : $scope.data.userEmail,
					department: $scope.data.userDepartment,
					subject   : $scope.data.userSubject,
					message   : $scope.data.userMessage
				}
				
				$http({
	                method : 'POST',
	                url    : formSubmit,
	                data   : $.param(formData),
	                headers : { 
	            		'Content-Type' : 'application/x-www-form-urlencoded'
					},
					transformRequest: angular.identity
	            }).
	            success(function(_data){
		           	$('#contact-form').transition({opacity:0},function(){
			             $scope.success = true;
			             $scope.$apply();
		            });
		        }).
	            error(function(){
	            });
			};
		});
		
		
		
		
	    
	    