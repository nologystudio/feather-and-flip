


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
		        
		        $('#map').waypoint(function(){
			        
			        var _t = $(this);
			        
			        $log.info('The map is visible now');
			        triggerGoogleEvent('map');
			        
			        $timeout(function(){_t.find('*[data-animate="1"]').addClass('animated fadeIn')},200);
			        $timeout(function(){_t.find('*[data-animate="2"]').addClass('animated fadeInLeft')},400);
			        $timeout(function(){_t.find('*[data-animate="3"]').addClass('animated fadeInRight')},600);
			        
		        },{ offset: '10%' }); 
		        
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
		    
		    var mapID = 'passported';
		    var setMapHeight = function(){
			    $('#map').css({
				    height: ($(window).height() - 90) + 'px'
				});
		    }
		    
		    var initialize = function(){
			    
			    var mapOptions = {
					zoom: 10,
					center: new google.maps.LatLng(40.777422,-73.968887),
					panControl: true,
					zoomControl: true,
					mapTypeControl: false,
					scrollwheel: false,
					scaleControl: true,
					streetViewControl: true,
					overviewMapControl: false,
				    zoomControlOptions: {
				    	style: google.maps.ZoomControlStyle.SMALL,
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
			    switch(_id){
				    case 'destinations':
				    	_.map(_data,function(_d){
						    var destination = new google.maps.Marker({
								position: {
									lat: Number(_d.lat),
									lng: Number(_d.lon)
								},
								map: $scope.map,
								title: _d.name
								//icon: ''
							});
							
							destination.addListener('click',function(){
								$scope.map.setZoom(15);
								$scope.map.setCenter(marker.getPosition());
							});
					    });
				    break;
				    case 'guide':
				    	//console.log(_data);
				    	/*_.map(_data,function(_d){
						    var destination = new google.maps.Marker({
								position: {
									lat: Number(_d.lat),
									lng: Number(_d.lon)
								},
								map: $scope.map,
								title: _d.name
								//icon: ''
							});
							
							var infowindow = new google.maps.InfoWindow({
								content: _d.name
							});
							
							destination.addListener('click',function(){
								//$scope.map.setZoom(15);
								//$scope.map.setCenter(marker.getPosition());
								infowindow.open($scope.map,destination);
							});
							
					    });*/
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
		
		ppControllers.controller('ItineraryController',function($scope,$log,$timeout,$resource){
			
			var destSrc = $resource('https://www.passported.com/api/content/destinations.json');
			
			$scope.step = 1;
			$scope.showAside = true;
			$scope.pick;
			
			$scope.openAside = function(){
				$scope.showAside = !$scope.showAside;	
			}
			
			$scope.destinations = destSrc.query({},function(_data){
				console.log(_data);
				$scope.$parent.addMarkers('destinations',_data);
			});
			
			$scope.displayDestination = function(_d){
				console.log(_d);
				$scope.pick = _d;
				$scope.$parent.addMarkers('guide',_d);
				$scope.step = 2;
			}
		});
		
		/* ------------------------------------------------------------------------------------------------------------- */
	    
	    ppControllers.controller('BookingController',function($scope,$log,$timeout){
		   
		    $scope.showRightAside = false;
			
			$scope.openAside = function(){
				$scope.showAside = !$scope.showAside;	
			}
		});
		
		/* ------------------------------------------------------------------------------------------------------------- */
	    
	    ppControllers.controller('BlogController',function($scope,$log,$timeout){
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
	    
	    ppControllers.controller('SearchController',function($scope,$log,$timeout){
		});
		
		
		
	    
	    