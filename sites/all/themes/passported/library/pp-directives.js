


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
		            $scope.filter = function(_hotel,_filters){
			        	
			        	var _classes = _filters.split(' ');
			        	var _target  = (_hotel) ? $('#hotel-block article.hotel') : $('#guide li.address-book');
			        	
			        	_target.each(function(){
				        	
				        	var _t = $(this);
				        	var isElement = true;
				        	
				        	_.map(_classes,function(_class){
					        	if(isElement) isElement = _t.hasClass(_class);
				        	});
				        	
				        	switch($scope.state){
					        	case true:
					        		if(!isElement) _t.hide();
					        		else _t.show();
					        	break;
					        	case false:
					        		_t.show();
					        	break;
							}
						});
		            };
	            },
				link : function($scope,$element,_attrs){
					
					if($scope.state) 
						$element.find('span').addClass('on');
					
					$element.on('click',function(){
						
						$(this).find('span').toggleClass('on');
						$scope.state = !$scope.state;
						$scope.filter($element.hasClass('hotel'),_attrs.filters);
					});
				}
			}
		});
		
		ppComponents.directive('ppPromotedItinerary',function(){
			return {
				restrict : 'EA',
		    	replace : true,
		    	scope: {
		            itinerary: '@'
		        },
		    	template : '<a href="{{itinerary.url}}"><figure><img ng-src="{{itinerary.primary_image.small_itinerary.url}}"/></figure><footer><h4>{{itinerary.name}}</h4></footer></a>',
		    	controller: function($scope,$resource){
			    	$scope.getItinerary = function(_id){
				    	
				    	var itSrc = $resource('https://gostage.passported.com/api/v2/itinerary');
				    	
						itSrc.get({'id':_id},function(_data){
							if(!_.isNull(_data.itinerary))
								$scope.itinerary = _data.itinerary;
							else console.log(_data);
						});
			    	}
	            },
				link : function($scope,$element,_attrs){
					$scope.getItinerary(_attrs.id);
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
		
		
		
		
		
