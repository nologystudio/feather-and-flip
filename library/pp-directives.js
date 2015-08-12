


		/* ----------------------------------------------------------------------------------------------------------------
		    
	    * Project     : NEMO
	    * Document    : nemo-directives.js  
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
        
        var nemoComponents = angular.module('nemoComponents',[]);
		var nemoTools      = angular.module('nemoTools',[]);
		
		nemoComponents.directive('nemoCampaignTimeline',function(){
			return {
		    	restrict  : 'EA',
		    	replace   : true,
		    	scope     : {
	                start : "=cStartDate",
	                end   : "=cEndDate"
	            },
	            template : '<div></div>',
	            controller: function($scope){
	            },
				link : function($scope,$element,_attrs){
					/*<div id="campaign-1">
					<div class="line">campaña 1</div>
					</div>*/
				}
			}
		});
		
		nemoComponents.directive('nemoStatusControl',function(){
			return {
		    	restrict  : 'A',
		    	replace   : true,
		    	scope     : {
	                state : "=state"
	            },
	            template : '<div class="status active" ng-class="{off:isActive}"><div></div><small>on</small></div>',
	            controller: function($scope){
	            },
				link : function($scope,$element,_attrs){
				}
			}
		});
			
        
        
        
