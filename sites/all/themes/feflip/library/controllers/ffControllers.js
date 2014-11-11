


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
		}]);
        
        /* ~ Map ~ */
		/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */
		
		ffAppControllers.controller('MapCtrl',['$scope','$element',function($scope,$element){
			
			//var theMap       = kartograph.map('#map');
			//var worldMapPath = '/feather-and-flip/media/map/map-usa.svg';
			//var destinations = $('.pin').toArray();
			
			// | i | Aside menu...
			
			$scope.displayMenu = function(){
				$('#map-it aside').toggleClass('on');
			}
			
			// | i | Map functionality...
			
			$scope.setMap = function(){}
			
			//theMap.loadMap(worldMapPath,function(){
			//});
		
		}]);
		
		/* ~ Blog ~ */
		/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */
		
		ffAppControllers.controller('BlogCtrl',['$scope','$element',function($scope,$element){
		}]);
		
		/* ~ Gallery ~ */
		/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */
		
		ffAppControllers.controller('SlideshowCtrl',['$scope','$element',function($scope,$element){
			
			//var wSize  = [$(window).width(),$(window).height()];
			//var header = $('body > header');
			
			//var gItems = $element[4].children;
			//console.log($element);
			
			// | i | Resize slideshow to match screen height...
			
			//if(header.height() > wSize[1]) 
			//	header.transition({height:$(window).height()});
			
			// | i | Resize image to fit in screen...
			
			/*var imgSize = [1280,800];
    		var winCoef = $(window).width()/imgSize[0];
    		var _image  = $('.gallery-container img');
    			        	
        	if(winCoef * imgSize[1] < $(window).height()){
        	
        		var newWidth = imgSize[0] * ($(window).height()/imgSize[1]) + 'px';
        		
	        	_image.css({
		        	width      : imgSize[0] * ($(window).height()/imgSize[1]) + 'px',
		        	height     : $(window).height() + 'px',
		        	marginLeft : - (newWidth - $(window).width())/2 + 'px' 
	        	});
	        }else{
	        	_image.css({
		        	width  : $(window).width() + 'px',
		        	height : 'auto'
	        	});
        	}
        	
        	$('#landing-gallery, .gallery-container').css({
	        	height : (size[1] + 10) + 'px'
        	});*/
        	
		}]);
		
		
		
		