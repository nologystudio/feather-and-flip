


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
		
		 /* ~ Home ~ */
		/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */
		
		ffAppControllers.controller('HomeCtrl',['$scope',function($scope){
		}]);
        
        /* ~ Map ~ */
		/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */
		
		ffAppControllers.controller('MapCtrl',['$scope','$element',function($scope,$element){
			
			var theMap       = kartograph.map('#map');
			var worldMapPath = '/feather-and-flip/media/map/map-usa.svg';
			var destinations = $('.pin').toArray();
			
			// | i | Aside navigation...
			
			// | i | Map functionality...
			
			$scope.setMap = function(){}
			
			theMap.loadMap(worldMapPath,function(){
			});
		
		}]);
		
		/* ~ Gallery ~ */
		/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */
		
		ffAppControllers.controller('SlideshowCtrl',['$scope','$element',function($scope,$element){
			
			var wSize  = [$(window).width(),$(window).height()];
			var header = $('body > header');
			//var gItems = $element[4].children;
			
			console.log($element);
			
			// | i | Resize slideshow to match screen height...
			if(header.height() > wSize[1]) 
				header.transition({height:$(window).height()});
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
		
		
		
		