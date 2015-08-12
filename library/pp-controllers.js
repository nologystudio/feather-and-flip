


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
			        
			        $location.path('');
			        $timeout(function(){_t.find('*[data-animate="1"]').addClass('animated fadeInUp')},200);
					$timeout(function(){_t.find('*[data-animate="2"]').addClass('animated fadeInUp')},400);
					$timeout(function(){_t.find('*[data-animate="3"]').addClass('animated fadeInUp')},600);
					$timeout(function(){_t.find('*[data-animate="4"]').addClass('animated fadeInUp')},800);
					$timeout(function(){_t.find('*[data-animate="5"]').addClass('animated fadeInUp')},1000);
					$timeout(function(){_t.find('*[data-animate="6"]').addClass('animated fadeInUp')},1200);
					$timeout(function(){_t.find('*[data-animate="7"]').addClass('animated fadeInUp')},1400);
					
		        },{ offset: '0%' });  
		        
		        $('#map').waypoint(function(){
			        
			        var _t = $(this);
			        
			        $log.info('The map is visible now');
			        $location.path('map');
			        triggerGoogleEvent('map');
			        
			        $timeout(function(){_t.find('*[data-animate="1"]').addClass('animated fadeIn')},200);
			        $timeout(function(){_t.find('*[data-animate="2"]').addClass('animated fadeInLeft')},400);
			        $timeout(function(){_t.find('*[data-animate="3"]').addClass('animated fadeInRight')},600);
			        
		        },{ offset: '50%' }); 
		        
		        $('#travel-journal').waypoint(function(){
			        
			        var _t = $(this);
			        
			        $log.info('The blog is visible now');
			        $location.path('travel-journal');
					triggerGoogleEvent('travel-journal');
					
			    	$timeout(function(){_t.find('*[data-animate="1"]').addClass('animated fadeInUp')},200);
			    	$timeout(function(){_t.find('*[data-animate="2"]').addClass('animated fadeIn')},400);
			    	
			    },{ offset: '75%' });
		        
		        $('#press').waypoint(function(){
			        
			        var _t = $(this);
			        
			        $log.info('The press block is visible now');
			        $location.path('press');
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
			        $location.path('');
			        
			        $timeout(function(){_t.find('*[data-animate="1"]').addClass('animated fadeInDown')},200);
			        
		        },{ offset: '75%' });
			}
	        
	        var navManager = function(){
		        
		        var _t 			= $('div.dropdown-wrapper');
		        var _a			= _t.find('div.arrow');
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
				    	
				    	userControl = true;
				    	
				    	switch($(this).attr('id')){
					    	case 'city-guides':
					    		_t.removeClass('light');
					    	break;
					    	case 'search':
					    		_t.addClass('light');
					    	break;
				    	}
				    	
				    	setTimeout(function(){
					    	if(userControl){
						    	_t.show().transition({height:wHeight + 'px'});
						    	_a.css({left:middlePoint+'px'}).addClass('on');
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
						    	_t.transition({height:0},function(){
							    	_t.hide();
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
					zoom: 2,
					center: new google.maps.LatLng(40.455127,-3.677942),
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
							{ color: '#D8DCDB' }
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
				
			    /*
$scope.map = new google.maps.Map(document.getElementById('map'),mapOptions);
			    $scope.map.mapTypes.set(mapID,new google.maps.StyledMapType(ppMapStyle,styledMapOptions));
*/
			}
		    
		    $timeout(function(){
				setMapHeight(); 
				initialize();
			},0);
			
			$(window).on('resize',function(){
				setMapHeight();    
			});
		});
		
		ppControllers.controller('ItineraryController',function($scope,$log,$timeout){
			
			$scope.showAside = false;
			
			$scope.openAside = function(){
				$scope.showAside = !$scope.showAside;	
			}
		});
		
		/* ------------------------------------------------------------------------------------------------------------- */
	    
	    ppControllers.controller('BookingController',function($scope,$log,$timeout){
		   
		    $scope.showAside = false;
			
			$scope.openAside = function(){
				$scope.showAside = !$scope.showAside;	
			}
		});
		
		/* ------------------------------------------------------------------------------------------------------------- */
	    
	    ppControllers.controller('BlogController',function($scope,$log,$timeout){
		});
		
		/* ------------------------------------------------------------------------------------------------------------- */
	    
	    ppControllers.controller('NewsletterController',function($scope,$log,$timeout){
		});
		
		
	    
	    