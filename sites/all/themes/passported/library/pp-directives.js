


		/* ----------------------------------------------------------------------------------------------------------------
		    
	    * Project     : Passported
	    * Document    : pp-directives.js  
	    * Created on  : Jul 22, 2.015
	    * Version     : 1.0 
	    * Author      : Aday Henriquez
	    * Description : Directive JS file
	    
	    -------------------------------------------------------------------------------------------------------------------
	       *          This code has been developed by NOLOGY. in the awesome Canaries - www.nologystudio.com           *
	    -------------------------------------------------------------------------------------------------------------------
	   
	    * Log * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
        -------------------------------------------------------------------------------------------------------------------
        *  
        ---------------------------------------------------------------------------------------------------------------- */
        
        'use strict';
        
        var ppComponents = angular.module('ppComponents',[]);
		var ppTools      = angular.module('ppTools',[]);
		
		ppComponents.directive('ppFilter',function(){
			return {
		    	restrict  : 'EA',
		    	replace   : false,
		    	scope     : {
	                state : "=filterState"
	            },
	            controller: function($scope,$rootScope){
		           $scope.filter = function(_id){
			           $rootScope.$emit('filter',[_id.toLowerCase()]);
		           };
	            },
				link : function($scope,$element,_attrs){
					
					if($scope.state) $element.find('span').addClass('on');
					
					$element.on('click',function(){
						
						$(this).find('span').toggleClass('on');
						$scope.state != $scope.state;
						
						if($scope.state)
							$scope.filter(_attrs.id);
					});
				}
			}
		});
		
		ppComponents.directive('ppHotelGallery',function(){
			return {
		    	restrict  : 'EA',
		    	replace   : false,
		    	controller: function($scope){
		        },
				link : function($scope,$element,_attrs){
					$element.sly({
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
						activatePageOn: 'click'
						//prevPage      : lBtn,
						//nextPage      : rBtn
					});
				}
			}
		});
