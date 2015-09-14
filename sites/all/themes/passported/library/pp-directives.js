


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
		
		ppComponents.directive('ppPromotedItinerary',function(){
			return {
				restrict : 'E',
		    	replace : true,
		    	template : '<a href=""><figure><img /></figure><footer><h4></h4><time></time></footer></a>',
		    	controller: function($scope,$resource){
			    	
			    	//$scope.itinerary;
			    	
			    	//$scope.getItinerary = function(_id){
				    	
				    	//var itSrc = $resource('https://gostage.passported.com/api/v2/location');
				    	
						/*
				    	itSrc.get({'name':},function(_data){
							console.log(_data);
						});
						*/
						
				    	//console.log(_id);
			    	//}
	            },
				link : function($scope,$element,_attrs){
					//$scope.getItinerary($element.data('id')):
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
					
					var lBtn = $element.find('*[rel="left"]');
					var rBtn = $element.find('*[rel="right"]');
					
					setTimeout(function(){
						$element.imagesLoaded(function(_d){
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
								activatePageOn: 'click',
								prevPage      : lBtn,
								nextPage      : rBtn
							});
							$element.transition({opacity:1});
						});
					},500);
				}
			}
		});
		
		ppComponents.directive('ppSocialMediaLink',function(){
			return {
				restrict : 'A',
			    replace  : false,
			    scope    : {
				    media : '=ppSocialMediaImage',
				    description : '=ppSocialMediaDesc'
				},
			    link : function($scope,$element,_attrs){
				    
				    var _url = host + window.location.pathname;
				    
				    switch(_attrs.rel){
						case 'facebook':
							// | i | http://www.facebook.com/sharer.php?u=URL
							_attrs.$set('href','http://www.facebook.com/sharer.php?u='+_url);
						break;
						case 'twitter':
							// | i | https://twitter.com/share?url=URL&text=TITLE&via=USER
							_attrs.$set('href','https://twitter.com/share?url='+_url);
						break;
						case 'pinterest':
							// | i | http://pinterest.com/pin/create/button/?url=URL&media=MEDIA&description=DESC
							_attrs.$set('href','http://pinterest.com/pin/create/button/?url='+_url+'&media='+$scope.media+'&description='+$scope.description);
						break;
						case 'google-plus':
							// | i | https://plus.google.com/share?url=URL
							_attrs.$set('href','https://plus.google.com/share?url='+_url);
						break;
						case 'mail':
							// | i | Share through email
						break;
					}
				}
			}
		});
		
		ppComponents.directive('ppInspirationSelect',function(){
			return {
		    	restrict  : 'EA',
		    	replace   : false,
		    	controller: function($scope,$cookies){
			    	$scope.setChoice = function(_id,_value){
				    	switch(_id){
					    	case 'place-select':
					    		$scope.search.place = _value;
					    	break;
					    	case 'season-select':
					    		$scope.search.season = _value;
					    	break;
				    	}
				    	$scope.$apply();
			    	}
			    },
				link : function($scope,$element,_attrs){
					
					var options = $element.data('options').split('|');
					var optWrapper = '<ul id="options"></ul>';
					var state = false;
					var _o;
					
					var setter = function(){
						
						// Append list of options and get the reference...
					
						$element.append(optWrapper);
						_o = $element.find('#options');
						
						// Add all available options...
						
						_.map(options,function(_v){
							_o.append('<li data-value="'+_v+'">'+_v+'</li>');
						});
					}
					
					var binders = {
						global : function(){
							$element.on('click',function(){
								_o.show().transition({opacity:1},'fast');
								$(this).unbind('click');
								setTimeout(function(){
									_o.transition({opacity:0},'fast',function(){
										_o.hide();
										binders.global();
									});
								},3000);
							});
						},
						list : function(){
							_o.find('li').on('click',function(){
								$element.find('h5').text($(this).data('value'));
								$scope.setChoice(_attrs.id,$(this).data('value'));
								_o.transition({opacity:0},'fast',function(){
									_o.hide();
									binders.global();
								});
							});
						},
						close : function(){
						}
					}
					
					setter();
					binders.global();
					binders.list();
				}
			}
		});
		
		
		
		
		
