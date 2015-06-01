


		/* ----------------------------------------------------------------------------------------------------------------
		    
	    * Project     : F+F
	    * Document    : controllers.js  
	    * Created on  : Oct 20, 2.014
	    * Version     : 1.0 
	    * Author      : Aday Henriquez
	    * Description : angular controllers for desktop
	    
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
		var formSubmit        = window.location.protocol + '//' + window.location.host + '/api/forms';
        
        /* ~ Controllers ~ */
		/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */
		
		var ffAppControllers = angular.module('ffControllers',[]);
		
		/* ~ Main navigation ~ */
		/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */
		
		ffAppControllers.controller('NavCtrl',function($scope,$timeout){
			
			var _nav       = $('nav[role="main-navigation"]');
			var _eng       = $('*[id="get-rates"]');
			var _o         = _nav.find('div.wrapper > ul > li');
			var heightRef  = 480;
			var navOptions = _o.toArray();
			var increments 
			
			// | i | Dropdown effects...
			
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
			
			$scope.setNavigation = function(){
				
				var hoteInc  = (_nav.hasClass('sticky')) ? 65 : 35;
				var guideInc = (_nav.hasClass('sticky')) ? 50 : 20;
				
				$('#hotel-list').css({
					width : $(window).width()+'px',
					marginLeft  : -$('#hotel-reviews').offset().left + 'px',
					backgroundPosition: ($('#hotel-reviews').offset().left+hoteInc) +'px top'
				});
				$('#city-guides-list').css({
					width : $(window).width()+'px',
					marginLeft  : -$('#city-guides').offset().left + 'px',
					backgroundPosition: ($('#city-guides').offset().left+guideInc) +'px top'
				});
			}
			
			// | i | Sticky navigation trigger...
			
			if(!_nav.hasClass('sticky')){
				$(window).scroll(function(){
					if($(this).scrollTop() >= heightRef){
						_nav.addClass('sticky');
						//_eng.addClass('sticky').css({top:($(this).scrollTop()-540)+'px'});					
					}else{
						_nav.removeClass('sticky');
						//_eng.removeClass('sticky').css({top:0});	
					}
					$scope.setNavigation();
				});
			}
			
			setTimeout(function(){
				$scope.setNavigation();
			},1000);
		});
		
		/* ~ Body ~ */
		/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */
		
		ffAppControllers.controller('BodyCtrl',function($scope){
			
			$scope.user;
			$scope.loading = false;
			$scope.error = false;
			$scope.resetPassword = false;
			
			if($('section#hotel-reviews').size() > 0)
				$('li#hotel-reviews > a').addClass('on');
			
			if($('section#map').size() > 0)
				$('li#city-guides > a').addClass('on');
				
			if($('section#travel-journal').size() > 0)
				$('li#travel-journal > a').addClass('on');
				
			$('li#hotel-reviews > a, li#city-guides > a').on('click',function(){
				return false;
			});
		});
		
		/* ~ Calendar ~ */
		/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */
		
		ffAppControllers.controller('CalendarCtrl',function($scope){
			
			var aFrame  = $('#arrival-gallery');
			var dFrame  = $('#departure-gallery');
			
			$scope.year = [];
			
			$scope.getMonth = function(_m,_y){
				
				var _year     = _y;
				var start     = new Date(_year,_m,1);
				var end       = new Date(_year,_m,moment(_year+"-"+(_m+1),"YYYY-MM").daysInMonth());
				var yearRange = moment().range(start,end);
				var month     = {
					start : (start.getDay() == 0) ? 6 : start.getDay()-1,
					days  : {}
				};
				
				yearRange.by('days',function(_m){
					month.days[moment(_m._d).format('DD')] = moment(_m._d).format('MM/DD/YYYY');
				});

				return month;
			}
			
			$scope.buildYear = function(){
				
				var year  = moment().get('year');
				var month = moment().get('month');
				var start = new Date(year,month,1);
				var end   = new Date(year+1,month,moment((year+1)+"-"+month,"YYYY-MM").daysInMonth());
				var range = moment().range(start,end);
				var theYear = [];
				
				range.by('months',function(_m){
					
					var _month = moment(_m._d).get('month');
					var _year  = moment(_m._d).get('year');
					
					$scope.year.push({
						name  : moment(_m._d).format('MMMM') + ' ' + _year,
						order : $scope.getMonth(_month,_year)
					});
				});
			}
			
			$scope.buildYear();
			
			setTimeout(function(){
				aFrame.sly({
					horizontal     : 1,
					itemNav        : 'forceCentered',
					smart          : 1,
					activateMiddle : 1,
					mouseDragging  : 1,
					touchDragging  : 0,
					releaseSwing   : 1,
					startAt        : 0,
					scrollBy       : 1,
					speed          : 500,
					elasticBounds  : 1, 
					prev           : aFrame.find('*[rel="prev"]'),
					next           : aFrame.find('*[rel="next"]')
				});
				dFrame.sly({
					horizontal     : 1,
					itemNav        : 'forceCentered',
					smart          : 1,
					activateMiddle : 1,
					mouseDragging  : 1,
					touchDragging  : 0,
					releaseSwing   : 1,
					startAt        : 0,
					scrollBy       : 1,
					speed          : 500,
					elasticBounds  : 1, 
					prev           : dFrame.find('*[rel="prev"]'),
					next           : dFrame.find('*[rel="next"]')
				});
				
				aFrame.find('*[rel="prev"]').on('click',function(){
					dFrame.find('*[rel="prev"]').trigger('click');
				});
				
				aFrame.find('*[rel="next"]').on('click',function(){
					dFrame.find('*[rel="next"]').trigger('click');
				});
				
			},1000);
			
		});
			
		/* ~ Booking ~ */
		/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */
			
		ffAppControllers.controller('BookingEngineCtrl',function($scope,$http){
			
			$scope.path          = globalPartialPath + 'booking-engine-flow/';
			$scope.state         = 0;
			$scope.stepOne       = 1;
			$scope.loading       = false;
			$scope.dateIsValid   = true;
			$scope.booking       = globalPartialPath + 'booking-engine.tpl.html';
			$scope.bookingSearch = globalPartialPath + 'booking-engine-search.tpl.html';
			$scope.searchTpl     = $scope.path + 'be-search.tpl.html';
			$scope.bookingError  = '';
			$scope.stepTpl       = {
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
		/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */
			
			$scope.roomUnit = {
				adults   : 1,
				children : {
					number : 0,
					ages   : []
				}
			}
			
		// | i | Booking...
		/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */
			
			$scope.bookingInfo = {
				destination : undefined,
				internalId  : undefined,
				hotelId     : undefined,
				service     : undefined,
				available   : true,
				checkIn     : moment(new Date()).add(3,'days').format('MM/DD/YYYY'),
				checkOut    : moment(new Date()).add(10,'days').format('MM/DD/YYYY'),
				rooms       : {
					number: 1,
					info  : [angular.copy($scope.roomUnit)]
				}
			};
			
			$scope.nightlyIsArray = false;
			$scope.roomSelection = {};
			
			$scope.customer = {
				name 	     : '',
				last 	     : '',
				email        : '',
				phone        : '',
				address      : '',
				postalCode   : '',
				provinceCode : '',
				stateCode    : '',
				cityCode     : '',
				countryCode  : '',
				cardCode     : '',
				cardCodeName : '',
				cardNumber   : '', 
				cardMonth    : '', 
				cardYear     : '',
				cardId       : '', 
				legal        : false
			}
			
			/*$scope.customer = {
				name 	     : 'Aday',
				last 	     : 'Henriquez',
				email        : 'adayhm@gmail.com',
				phone        : '123456789',
				address      : 'Avenida Federico Garcia Lorca 10',
				postalCode   : '35011',
				provinceCode : 'Las Palmas',
				stateCode    : 'Las Palmas',
				cityCode     : 'Las Palmas de Gran Canaria',
				countryCode  : 'España',
				cardCode     : 'VI',
				cardCodeName : '',
				cardNumber   : '4111111111111111', 
				cardMonth    : '06',  // mm
				cardYear     : '2016',// yyyy
				cardId       : '737',  // CSV o CVV
				legal        : false
			}*/
			
			$scope.allowPayments;
		
		// | i | Available Rooms...	
		/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */
			
			$scope.availableRooms = {};
			$scope.service        = '';
			
		/* ~ Checker */
		/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */
		
			$scope.checkStepOne = function(){
				
				var isValid  = true;
				var _top     = $('#step-'+$scope.state).offset().top - 120; // | i | Sticky navigation height;
				var _sHeight = 60;
				
				switch($scope.stepOne){
					case 1: // | i | Calendar level
					
						var _h = $('#dates').height() + 60;
						
						$scope.scroll(_top);
						$scope.resize($('#booking-engine'),_h);
						
					break;
					case 2: // | i | Room level
						
						var _h = $('#dates').height() + $('#rooms').height() + 120;
						
						$scope.scroll(_top + $('#dates').height() + 120);
						$scope.resize($('#booking-engine'),_h);
						
					break;
					case 3: // | i | Guest level
					
						var _h = $('#dates').height() + $('#rooms').height() + ($scope.bookingInfo.rooms.number * 348) + $('#confirmation').height() + 140;
						
						$scope.scroll(_top + $('#dates').height() + $('#rooms').height() + 180);
						$('#booking-engine').transition({height:_h},500,function(){
							$(this).css({'height':'auto'});
						});;
						
					break;
				}
				
				if(isValid) $scope.stepOne++;
			}
			
			$scope.triggerOverlay = function(){
				
				var message = 'Away we go...';
				var loading = $('<div class="status-overlay animated fadeIn"><div class="content animated bounceIn"><small>'+message+'</small></div></div');
				
				loading.appendTo($('body'));
			}
			
		/* ~ Scroll animation */
		/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */

			$scope.scroll = function(_y){
				$('html,body').delay(250).animate({scrollTop:_y},500);
			}
			
			$scope.resize = function(_target,_h){
				_target.transition({height:_h},500);
			}
			
		/* ~ Change dates */
		/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */

			$scope.changeCheckin  = function(_op){
				switch(_op){
					case '+':
						$scope.bookingInfo.checkIn =  moment($scope.bookingInfo.checkIn).add(1,'days').format('MM/DD/YYYY');
					break;
					case '-':
						$scope.bookingInfo.checkIn =  moment($scope.bookingInfo.checkIn).subtract(1,'days').format('MM/DD/YYYY');
					break;
				}
			}
			
			$scope.changeCheckout = function(_op){
				switch(_op){
					case '+':
						$scope.bookingInfo.checkOut =  moment($scope.bookingInfo.checkOut).add(1,'days').format('MM/DD/YYYY');
					break;
					case '-':
						$scope.bookingInfo.checkOut =  moment($scope.bookingInfo.checkOut).subtract(1,'days').format('MM/DD/YYYY');
					break;
				}
			}
			
		/* ~ Step 0 ~ Set-up triggers */
		/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */
			
			$scope.dateValidation = function(){
				
				var _dates = $('#arrival button[data-date="'+$scope.bookingInfo.checkIn+'"],#departure button[data-date="'+$scope.bookingInfo.checkOut+'"]');
				
				$scope.dateIsValid = moment($scope.bookingInfo.checkIn).isBefore($scope.bookingInfo.checkOut);
				$scope.$apply();
				
				if(!$scope.dateIsValid) _dates.addClass('warning');
				else _dates.removeClass('warning');
				
				return $scope.dateIsValid;
			}
			
			$scope.calendarSetter = function(){
				
				$('#arrival button[data-date="'+$scope.bookingInfo.checkIn+'"]').addClass('on');
				$('#departure button[data-date="'+$scope.bookingInfo.checkOut+'"]').addClass('on');
				
				$('#arrival button[data-date]').on('click',function(_e){
					$scope.bookingInfo.checkIn = $(this).data('date');
					$('#arrival button[data-date]').removeClass();
					$(this).addClass('on');
					$scope.dateValidation();
				});
				$('#departure button[data-date]').on('click',function(_e){
					$scope.bookingInfo.checkOut = $(this).data('date');
					$('#departure button[data-date]').removeClass();
					$(this).addClass('on');
					$scope.dateValidation();
				});
			}
			
			$('*[rel="destination"],*[id^="destination"]').click(function(_e){
				
				var _t = $(this).attr('id');
				
				// | i | Uncheck none-selected items...
				$('*[rel="destination"],*[id^="destination"]').each(function(){
					if($(this).attr('id') == _t) $(this).addClass('on');
					else $(this).removeClass('on');
				});
				// | i | Save Destination id...
				$scope.bookingInfo.destination = _t.split('-')[1];
				// | i | Move forward in case the user is on step 0...
				if($scope.state == 0){
					$scope.state++;
					$scope.$apply();
					$scope.checkStepOne();
					$scope.calendarSetter();
				}
				_e.preventDefault();
			});
			
			$('#get-rates').on('click',function(_e){
				// | i | Move forward in case the user is on step 0...
				if($scope.state == 0){
					$scope.state++;
					$scope.$apply();
					$scope.checkStepOne();
					$scope.calendarSetter();
				}
				_e.preventDefault();
			});
			
		/* ~ Step 1 ~ Home page selection */
		/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */
		
			$scope.guestManager = function(_type,_index,_a){
				switch(_a){
					case '+':
						if(_type == 'adults')
							$scope.bookingInfo.rooms.info[_index].adults++;
							
						if(_type == 'children'){
							$scope.bookingInfo.rooms.info[_index].children.number++;
							$scope.bookingInfo.rooms.info[_index].children.ages.push(0);
							//console.log($scope.bookingInfo.rooms.info[_index].children.ages);
						}
					break;
					case '-':
						if(_type == 'adults' && $scope.bookingInfo.rooms.info[_index].adults > 0)
							$scope.bookingInfo.rooms.info[_index].adults--;
						
						if(_type == 'children' && $scope.bookingInfo.rooms.info[_index].children.number > 0){
							$scope.bookingInfo.rooms.info[_index].children.number--;
							$scope.bookingInfo.rooms.info[_index].children.ages.shift();
						}
					break;
				}
			}
			
			$scope.roomManager = function(_a){
				switch(_a){
					case '+':
						$scope.bookingInfo.rooms.number++;
						$scope.bookingInfo.rooms.info.push(angular.copy($scope.roomUnit));
					break;
					case '-':
						if($scope.bookingInfo.rooms.number > 1){
							$scope.bookingInfo.rooms.number--;
							$scope.bookingInfo.rooms.info.shift();
						}
					break;
				}
			}
			
			$scope.ageManager = function(_model,_a){
				switch(_a){
					case '+':
						_model = _model + 1;
					break;
					case '-':
						//console.log(_model);
					break;
				}
			}
			
			$scope.getRates = function(){
				
				var isHotelPage = $('body').hasClass('hotel');
				
				if($scope.dateValidation()){
					// | i | Trigger loading page...
					$scope.triggerOverlay();
					// | i | Post based on the page...
					switch(isHotelPage){
						case true:
							$http({
				                method : 'POST',
				                url    : formSubmit,
				                data   : $.param({
					                formID      : 'hotelDescription',
					                service     : $scope.bookingInfo.service,
					                hotelId     : $scope.bookingInfo.hotelId,
					                internalId  : $scope.bookingInfo.internalId,
					                destination : $scope.bookingInfo.destination,
					                checkIn     : $scope.bookingInfo.checkIn,
					                checkOut    : $scope.bookingInfo.checkOut,
					                rooms       : $scope.bookingInfo.rooms
					            }),
				                headers : { 
				            		'Content-Type' : 'application/x-www-form-urlencoded'
								},
								transformRequest: angular.identity
				            }).
				            success(function(_data){
					            window.location.href = 'http://' + window.location.host + '/' + _data;
					        }).
				            error(function(_data,_status){
					             //console.log(_data);
				            });
						break;
						case false:
						
							// | i | Set a request...
							
							var isCollection = $('section[id="hotel-reviews"]').data('collection');
							var requestInfo;
							
							if(!_.isUndefined(isCollection)){
									
								var hotelIds = [];
								
								$('a.item').each(function(){
									hotelIds.push($(this).data('internalid'));
								});
								
								requestInfo = {
									formID       :'collectionsRates',
					                hotelsId     : hotelIds,
					                collectionId : isCollection,
					                checkIn      : $scope.bookingInfo.checkIn,
					                checkOut     : $scope.bookingInfo.checkOut,
					                rooms        : $scope.bookingInfo.rooms
								}
							}
							else{
								requestInfo = {
									formID      :'hotelRates',
					                destination : $scope.bookingInfo.destination,
					                checkIn     : $scope.bookingInfo.checkIn,
					                checkOut    : $scope.bookingInfo.checkOut,
					                rooms       : $scope.bookingInfo.rooms
								}
							}	
							
							// | i | Post a request...
							
							$http({
				                method : 'POST',
				                url    : formSubmit,
				                data   : $.param(requestInfo),
				                headers : { 
				            		'Content-Type' : 'application/x-www-form-urlencoded'
								},
								transformRequest: angular.identity
				            }).
				            success(function(_data){
					        	window.location.href = 'http://' + window.location.host + '/' + _data;
					        }).
				            error(function(_data,_status){});
				            
						break;
					}
				}
			}
			
		/* ~ Step 2 ~ Hotel review selection */
		/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */
		
			$scope.init = function(_obj,_state){
				if(!_.isEmpty(_obj)) $scope.bookingInfo = _obj;
				$scope.state = _state;
			}
			
			$scope.initRate = function(_state,_dest,_id){
				$scope.state = _state;
				$scope.bookingInfo.destination = _dest;
				$scope.bookingInfo.internalId  = _id;
			}
			
			$('#hotel-reviews a.item').click(function(_e){
				
				var sabreService      = $(this).data('sabre');
				var expediaService    = $(this).data('expedia');
				var needsBothServices = (!_.isUndefined(sabreService) && !_.isUndefined(expediaService)) ? true : false;
				var serviceOverlay    = $('.service-overlay');   
				var theService        = $(this).data('service');
				var theHotelId        = $(this).data('hotelid');
				var theInternalId     = $(this).data('internalid');
				
				var setter = function(){
					// | i | Trigger loading page...
					$scope.triggerOverlay();
					// | i | Http request...
					$http({
		                method : 'POST',
		                url    : formSubmit,
		                data   : $.param({
			                formID      :'hotelDescription',
			                service     : theService,
			                hotelId     : theHotelId,
			                internalId  : theInternalId,
			                destination : $scope.bookingInfo.destination,
			                checkIn     : $scope.bookingInfo.checkIn,
			                checkOut    : $scope.bookingInfo.checkOut,
			                rooms       : $scope.bookingInfo.rooms
			            }),
		                headers : { 
		            		'Content-Type' : 'application/x-www-form-urlencoded'
						},
						transformRequest: angular.identity
		            }).
		            success(function(_data){
			            window.location.href = 'http://' + window.location.host + '/' + _data;
			        }).
		            error(function(_data,_status){
			             //console.log(_data);
		            });
				}
				// | i | Check result to see if the overlay is needed...
				switch(needsBothServices){
					case true:
					
						var sabreData   = sabreService.split('|');
						var expediaData = expediaService.split('|');
						
						// | i | Price setter...
						serviceOverlay.find('#sabre-service h4').text(sabreData[0]);
						serviceOverlay.find('#expedia-service h4').text(expediaData[0]);
						// | i | Fade in overlay...
						serviceOverlay.show().transition({opacity:1},function(){
							$(this).find('button[rel="close"]').on('click',function(){
								$(this).unbind();
								serviceOverlay.transition({opacity:0},function(){
									$(this).hide();
								});
							});
						});
						// | i | Http request...
						serviceOverlay.find('div[id]').on('click',function(){
							
							theService = $(this).attr('id').split('-')[0];
							
							if(theService == 'expedia') theHotelId = expediaData[1];
							else theHotelId = sabreData[1];
							
							setter();
						});
					break;
					case false:
						if(!_.isUndefined(theService) && !_.isUndefined(theHotelId)) setter();
					break;
				}
				// | i | Block link..
				if(!_.isUndefined(theService)) _e.preventDefault();
			});
		
		/* ~ Step 3 ~ Hotel room page */
		/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */
		
			$scope.getRoomInfo = function(){
				
				var _s         = $('article[id="hotel"]');
				var _result    = _s.data('result');
				
				$scope.service = _s.data('service');
				
				switch($scope.service){
					case 'expedia':
						$scope.availableRooms = _result.HotelRoomAvailabilityResponse;
						if(!_.isArray($scope.availableRooms.HotelRoomResponse))
							$scope.availableRooms.HotelRoomResponse = [$scope.availableRooms.HotelRoomResponse];
					break;
					case 'sabre':
						$scope.availableRooms = _result.RoomStay;
					break;
				}
				
				//console.log('Available Rooms');
				//console.log($scope.availableRooms);
			};
		
		/* ~ Step 4 ~ Check-out*/
		/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */
		
			$scope.parseDate = function(_d){
				return moment(_d).format("dddd, MMMM Do YYYY");
			};
			
			$scope.getDateRange = function(_ci,_co){
				return Math.abs(moment(_ci).diff(moment(_co),'days'));
			};

			// | i | Check credit card info...
			/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */
						
			$scope.checkCreditCardNumber = function(){
				
				//if(/[^0-9-\s]+/.test(_n)) return false;
				
				// | i | The Luhn Algorithm...
				/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */
				
				var _n     = $scope.customer.cardNumber,
					nCheck = 0, 
					nDigit = 0, 
					bEven  = false,
					field  = $('*[name="user-cardnumber"]'),
					lhError= $('#lh-error');
					
				//if(!_.isUndefined(_n)){
					
					//_n = _n.replace(/\D/g,"");
	 
					for(var n = _n.length - 1; n >= 0; n--){
						var cDigit = _n.charAt(n),
							nDigit = parseInt(cDigit, 10);
				 
						if(bEven){
							if((nDigit *= 2) > 9) nDigit -= 9;
						}
				 
						nCheck += nDigit;
						bEven  = !bEven;
					}
				
				// | i | User message
				/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */
				
					if((nCheck % 10) == 0 || /[^0-9-\s]+/.test(_n)){
						field.removeClass('warning');
						lhError.hide();
					}
					else{
						field.addClass('warning');
						lhError.show();
					}
				//}
				
				// | i | Credit Card Type: http://developer.ean.com/general-info/valid-credit-card-types/
				/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */
				
				/*
					VI = Visa
					AX = American Express
					BC = BC Card
					MC = MasterCard
					IK = MasterCard Alaska
					CA = MasterCard Canada
					CB = Carte Blanche
					CU = China Union Pay
					DS = Discover
					DC = Diners Club
					T  = Carta Si
					R  = Carte Bleue
					N  = Dankort
					L  = Delta
					E  = Electron
					JC = Japan Credit Bureau
					TO = Maestro
					S  = Switch
					O  = Solo
				*/
				
				if(/^4[0-9]{6,}$/.test(_n)){
					$scope.customer.cardCodeName = "VISA";
					$scope.customer.cardCode = "VI";
				}
				else if(/^5[1-5][0-9]{5,}$/.test(_n)){
					$scope.customer.cardCodeName = "MASTERCARD";
					$scope.customer.cardCode = "MC";
				}
				else if(/^3[47][0-9]{5,}$/.test(_n)){
					$scope.customer.cardCodeName = "AMERICAN EXPRESS";
					$scope.customer.cardCode = "AX";
				}
				else if(/^3(?:0[0-5]|[68][0-9])[0-9]{4,}$/.test(_n)){
					$scope.customer.cardCodeName = "DINERS CLUB";
					$scope.customer.cardCode = "DC";
				}
				else if(/^6(?:011|5[0-9]{2})[0-9]{3,}$/.test(_n)){
					$scope.customer.cardCodeName = "DISCOVER";
					$scope.customer.cardCode = "DS";
				}
				else if(/^(?:2131|1800|35[0-9]{3})[0-9]{3,}$/.test(_n)){
					$scope.customer.cardCodeName = "JCB";
					$scope.customer.cardCode = "JC";
				}
				else{
					$scope.customer.cardCode = "x";
					$scope.customer.cardCodeName = "JCB";
				}
				
				if($('#'+$scope.customer.cardCode).size() > 0){
					$('*.credit-card').removeClass('on');
					$('#'+$scope.customer.cardCode).addClass('on');
					$('#pm-error').hide();
				}
				else{
					$('*.credit-card').removeClass('on');
					$('#pm-error').show();
				}
			};
			
			$scope.checkCreditCardExpiration = function(){
				
				var _ex = $('*[name="user-cardyear"],*[name="user-cardmonth"]'),
					_er = $('#ex-error');
				
				if(moment($scope.customer.cardYear+'-'+$scope.customer.cardMonth+'-01').isBefore(moment(),'year')){
					_ex.addClass('warning');
					_er.show();
				}else{
					_ex.removeClass('warning');
					_er.hide();
				}
			}
			
			// | i | Room selection...
			/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */
			
			$scope.selectThis = function(_room){
				
				var scrollPosition   = $('#step-3').height() + $('#step-3').offset().top - 48;
				$scope.state         = 4;	
				$scope.roomSelection = _room;	
				$scope.nightlyIsArray= _.isArray($scope.roomSelection.RateInfos.RateInfo.ChargeableRateInfo.NightlyRatesPerRoom.NightlyRate);
				
				//console.log('Room');
				//console.log($scope.roomSelection);	
				
				// | i | Scroll down to the checkout...
				$('html,body').delay(300).animate({scrollTop:scrollPosition},600);
				// | i | Get Payment types...
				if($scope.service == 'expedia'){
					$http({
		                method : 'POST',
		                url    : formSubmit,
		                data   : $.param({
			                formID       : 'paymentTypes',
			                hotelId      : $scope.availableRooms.hotelId,
			                supplierType : $scope.roomSelection.supplierType,
			                rateType     : $scope.roomSelection.RateInfos.RateInfo.rateType
			                
			            }),
		                headers : { 
		            		'Content-Type' : 'application/x-www-form-urlencoded'
						},
						transformRequest: angular.identity
		            }).
		            success(function(_data){
			            $scope.allowPayments = _data;
			            //console.log($scope.allowPayments);
			        }).
		            error(function(_data,_status){
		            });
	            }
			}
			
			$scope.expandRoom = function(_i){
				$('#expedia-room-'+_i+' #room-rates').show();
				$('#sabre-room-'+_i+' #room-rates').show();
			}
			
			$scope.checkCustomerInfo = function(){
				return true;
			}
			
			$scope.getAdultNumber = function(){
				
				var adults = 0;
				
				angular.forEach($scope.bookingInfo.rooms.info,function(_r){
					adults += parseInt(_r.adults);
				});
				
				return adults;
			}
			
			$scope.confirmBooking = function(){
				
				var finalBooking = {
	                formID :'hotelBooking'
	            }
	            
	            var roomInfo = {};
				
				switch($scope.service){
					case 'expedia':
						_.extend(finalBooking,{
							firstName     		  : $scope.customer.name,
							lastName      		  : $scope.customer.last,
							email         		  : $scope.customer.email,
							phone         		  : $scope.customer.phone,
							service       		  : $scope.service,
							roomCode      		  : $scope.roomSelection.RoomType['@roomCode'],
							rateCode      	      : $scope.roomSelection.rateCode,
							hotelId       		  : $scope.availableRooms.hotelId,
							hotelAddress          : $scope.availableRooms.hotelAddress,
							hotelPhone            : $.trim($('li[id="phone"]').text()),
							checkIn       		  : $scope.availableRooms.arrivalDate,
							checkOut     	      : $scope.availableRooms.departureDate,
							rooms         		  : $scope.bookingInfo.rooms,
							rateKey       		  : $scope.roomSelection.RateInfos.RateInfo.RoomGroup.rateKey,
							supplierType  		  : $scope.roomSelection.supplierType,
							taxRate               : $scope.roomSelection.RateInfos.RateInfo.taxRate,
							chargeableRate 		  : $scope.roomSelection.RateInfos.RateInfo.ChargeableRateInfo['@total'],
							nightlyRates          : $scope.roomSelection.RateInfos.RateInfo.ChargeableRateInfo.NightlyRatesPerRoom.NightlyRate,
							cancellationPolicy    : $scope.roomSelection.RateInfos.RateInfo.cancellationPolicy,
							userAddress           : $scope.customer.address,
							userPostalCode        : $scope.customer.postalCode,
							userCountryCode       : $scope.customer.countryCode,
							userCityCode          : $scope.customer.cityCode,
							userStateProvinceCode : $scope.customer.stateCode,
							creditCardCode        : $scope.customer.cardCode,
							creditCardNumber      : $scope.customer.cardNumber,
							creditCardIdentifier  : $scope.customer.cardId,
							creditCardExpireDate  : $scope.customer.cardYear + '-' + $scope.customer.cardMonth
						});
						console.log(finalBooking);
					break;
					case 'sabre':
					
						var guarantee = ($scope.roomSelection.GuaranteeSurchargeRequired != 'G') ? 'GDPST' : 'G';
						
						_.extend(finalBooking,{
							firstName    		  : $scope.customer.name,
							lastName     		  : $scope.customer.last,
							email        		  : $scope.customer.email,
							phone        		  : $scope.customer.phone,
							service      		  : $scope.service,
							roomCode     		  : $scope.roomSelection.RPH, 
							rooms        		  : $scope.bookingInfo.rooms,
							numUnit      		  : $scope.bookingInfo.rooms.number,
							guaranteeType		  : guarantee, 
							checkIn      		  : $scope.availableRooms.TimeSpan.Start,
							checkOut     		  : $scope.availableRooms.TimeSpan.End,
							taxRate               : $scope.roomSelection.Rates.Rate.HotelTotalPricing.TotalTaxes.Amount,
							chargeableRate 		  : $scope.roomSelection.Rates.Rate.HotelTotalPricing.Amount,
							nightlyRates          : $scope.roomSelection.Rates.Rate.HotelTotalPricing.RateRange,
							userAddress           : $scope.customer.address,
							userPostalCode        : $scope.customer.postalCode,
							userCountryCode       : $scope.customer.countryCode,
							userCityCode          : $scope.customer.cityCode,
							userStateProvinceCode : $scope.customer.stateCode,
							creditCardCode        : $scope.customer.cardCode,
							creditCardNumber      : $scope.customer.cardNumber,
							creditCardIdentifier  : $scope.customer.cardId,
							creditCardExpireDate  : $scope.customer.cardYear + '-' + $scope.customer.cardMonth
						});
					break;
				}
				
				if($scope.checkCustomerInfo()){
					// | i | Add customer info to the booking...
					_.extend(finalBooking,$scope.customer);
					// | i | Trigger loading page...
					$scope.triggerOverlay();
					$http({
		                method  : 'POST',
		                url     : formSubmit,
		                data    : $.param(finalBooking),
		                headers : { 
		            		'Content-Type' : 'application/x-www-form-urlencoded'
						},
						transformRequest: angular.identity
		            }).
		            success(function(_data){
			            
			            var _s = 'http://' + window.location.host + '/booking-info/';
			            var _e = 'http://' + window.location.host + '/booking-error';
			            
			            //console.log(_data);
						
						switch($scope.service){
							case 'expedia':
								if(!_.isUndefined(_data)){
									if(!_.isUndefined(_data.HotelRoomReservationResponse.EanWsError)){
										if(_data.HotelRoomReservationResponse.EanWsError.handling == 'RECOVERABLE'){
											$scope.bookingError = _data.HotelRoomReservationResponse.EanWsError.presentationMessage;
											$('.status-overlay').remove();
										}else window.location.href = _e;
									}
									else window.location.href = _s + _data.HotelRoomReservationResponse.itineraryId;
								}
								else window.location.href = _e;
							break;
							case 'sabre':
								if(!_.isUndefined(_data.Hotel))
									window.location.href = _s + _data.Hotel.BasicPropertyInfo.ConfirmationNumber;
								else 
									window.location.href = _e;
							break;
						}
			        }).
		            error(function(_data,_status){
			            //console.log(_data);
		            });
				}
			};
			
		/* ~ Step 5 ~ Confirmation */
		/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */
		
		/* ~ Watcher */
		/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */
		
			$scope.$watch('state',function(_s){
				switch(_s){
					case 3:
						$scope.getRoomInfo();
					break;
				}
			});
			
		/* ~ Cancel Booking */
		/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */
		
			$scope.cancel = function(_state){
				
				var _overlay   = $('.cancel-confirmation-overlay');
				var confirmBtn = _overlay.find('#confirm-cancellation');
				var cancelBtn  = _overlay.find('#not-confirm-cancellation');
				var data       = _overlay.data('cancellation').split('|');
				
				switch(_state){
					case 'confirm':
						// | i | Trigger overlay...
						_overlay.show().transition({opacity:1},function(){
							confirmBtn.on('click',function(){
								$scope.cancel();
							});
							cancelBtn.on('click',function(){
								$scope.cancel('close');
							})
						});
					break;
					case 'close':
						// | i | Hide overlay...
						_overlay.transition({opacity:0},function(){
							$(this).hide();
							confirmBtn.unbind('click');
							cancelBtn.unbind('click');
						});
					break;
					default:
						// | i | Animate transition...
						_overlay.find('small,button').transition({opacity:0},function(){
							if($(this).is('small')){
								_overlay.find('div.content').addClass('animated bounceIn activate');
								$(this)
								.text('Away we go...')
								.transition({opacity:1});
							}else $(this).hide();
						});
						// | i | Data: email|itineraryId|confirmationNumber|service
						$http({
			                method : 'POST',
			                url    : formSubmit,
			                data   : $.param({
				                formID             : 'cancelBooking',
				                userEmail          : data[0], 
				                itineraryId        : data[1],
				                confirmationNumber : data[2],
				                service            : data[3]
				            }),
			                headers : { 
			            		'Content-Type' : 'application/x-www-form-urlencoded'
							},
							transformRequest: angular.identity
				        }).
			            success(function(_data){
				            switch(_data.error.toLowerCase()){
					            case '': 
									// Response: Success
									window.location.reload();
					            break;
					            case 'missing parameters':
					            case 'method not implemented (sabre)':
					            case 'something went wrong':
					            case 'booking service not passed':
					            	$scope.cancel('close');
					            break;
				            }	
				        }).
			            error(function(_data,_status){
			            });
					break;
				}
			}
		});
        
        /* ~ Map ~ */
		/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */
		
		ffAppControllers.controller('MapCtrl',function($scope,$http,$timeout){
			
			L.mapbox.accessToken = 'pk.eyJ1Ijoibm9sb2d5IiwiYSI6IkFBdm5aVEkifQ.ItKi4oQ1-kPhJhedS4QmNg';
			
			var map  = L.mapbox.map('map','nology.k0cicjhd',{
				zoomControl: true,
				attributionControl: false,
			    tileLayer: {
			        continuousWorld: false,
			        noWrap: false
			    }
			}).setView([50.402,5.801],4);
			
			//map.dragging.disable();
			map.touchZoom.disable();
			//map.doubleClickZoom.disable();
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
		            //console.log(_data);
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
				
				destLayer.setGeoJSON(geoJson);
			};
			
			// | i | Weather widget...
			// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
			
			$scope.getWeatherData = function(){
				/*if(gFrame.size() > 0){
		            $http({
		                method  : 'GET',
		                url     : 'http://api.openweathermap.org/data/2.5/group',
		                params  : {id:'5412230,4164138,5134295,4568127,4004293,3521342,2986160,5779451,4140963'},
		                headers : { 
		            		'Content-Type' : 'application/x-www-form-urlencoded'
						},
						transformRequest: angular.identity
		            }).
		            success(function(_data){
			            //console.log(_data);
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
				}*/
			}
			
			$scope.setWeatherGallery = function(){
				
				var widgetWdith = $scope.weatherSpots.length * 208;
				
				if(widgetWdith > $(window).width()){
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
				}else{
					gFrame.find('ul').addClass('off');
					lBtn.hide();
					rBtn.hide();
				}
			}
			
			// | i | Aside menu...
			// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
			
			$scope.displayMenu = function(){
				$('#map-it aside').toggleClass('on');
			}
			
			// | i | Zoom continent...
			// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
			
			$scope.zoomContinent = function(_c){
				switch(_c){
					case 'northamerica':
						map.setView([43.005,-106.436],4);
					break;
					case 'southamerica':
						map.setView([-19.891,-65.479],4);
					break;
					case 'caribbean':
						map.setView([21.043,-84.683],5);
					break;
					case 'africa':
						map.setView([3.513,21.973],4);
					break;
					case 'asia':
						map.setView([53.015,73.828],3);
					break;
					case 'oceania':
						map.setView([-15.284,125.42],4);
					break;
					case 'europe':
						map.setView([50.402,5.801],4);
					break;
					default: 
						map.setView([40,0],2);
					break;
				}
			}
			
			// | i | Filter hook...
			$('ul[role="select"] li').on('click',function(){
				$scope.zoomContinent($(this).text().toLowerCase().replace(' ',''));
			});
			// | i | All destinations getter...
			$scope.retrieveDestinations();
			// | i | View all zoom...
			if($('body').hasClass('map-it')) $scope.zoomContinent();
			
		});
		
		ffAppControllers.controller('FullMapCtrl',function($scope,$element,$http){
			
			L.mapbox.accessToken = 'pk.eyJ1Ijoibm9sb2d5IiwiYSI6IkFBdm5aVEkifQ.ItKi4oQ1-kPhJhedS4QmNg';
			
			var map  = L.mapbox.map('map','nology.k0cicjhd',{
				zoomControl: true,
				attributionControl: false,
			    tileLayer: {
			        continuousWorld: false,
			        noWrap: false
			    }
			}).setView([40,0],2);
			
			map.touchZoom.disable();
			map.doubleClickZoom.disable();
			map.scrollWheelZoom.disable();
			// | i | Disable tap handler, if present.
			if(map.tap) map.tap.disable();
			
			var destLayer  = L.mapbox.featureLayer().addTo(map);
			var bookLayer  = L.mapbox.featureLayer().addTo(map);
			var hotelLayer = L.mapbox.featureLayer().addTo(map);
			var geoJson    = [];
			var bookJson   = [];
			var hotelJson  = [];
			
			$scope.theOrigin = $('#map-it').data('origin');
			$scope.displayMenu  = false;
			$scope.destinations = {};
			$scope.weatherSpots = {};
			$scope.theBook      = {};
			$scope.theHotels    = {};
			$scope.bookFilter   = undefined;
			
			$scope.selectedDestination;
			
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
		            //$scope.getWeatherData();
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
				        clickable : false,
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
					newMarker.properties.destination  = _d;
					newMarker.properties.icon.iconUrl = '/sites/all/themes/feflip/media/icons/destination-map-pin.png';
					newMarker.properties.image        = _d.image.url;
					newMarker.properties.description  = _d.description;
					newMarker.properties.url          = _d.maptourl;
					
					if(_.isUndefined($scope.theOrigin)) 
						geoJson.push(newMarker);
					else if(!_.isUndefined($scope.theOrigin) && $scope.theOrigin == _d.id) 
						$scope.displayDestination(_d);
				});
				
				destLayer.on('layeradd', function(_e){
				    
				    var marker       = _e.layer,
				        feature      = marker.feature,
						popupContent = '<a href="'+feature.properties.url+'" class="expanded-destination-pin"><figure><img src="'+feature.properties.image+'"/></figure><p>'+feature.properties.description+'</p><small>more...</small></a>';
					
				    marker.setIcon(L.icon(feature.properties.icon));
					
					marker.on('click',function(){
						$scope.displayDestination(feature.properties.destination);
					});
					
					// | i | Go to destination in case it's defined...
					
					if(!_.isUndefined($scope.theOrigin))
						$scope.displayDestination(feature.properties.destination);
					
					marker.bindPopup(popupContent,{
				        closeButton  : false,
				        minWidth     : 300,
				        zoomAnimation: true,
				        keepInView   : false,
				        autoPan      : true,
				        closeOnClick : true
				    });
				});
				
				destLayer.setGeoJSON(geoJson);
			};
			
			// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
			// | i | Address book...
            // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
			
			$scope.getAddressBookPerDestination = function(_d,_filter){
				
				// 1. Zoom the specific area...
				
				map.setView([_d.latitude,_d.longitude],13);
				bookJson = [];
				
				// 2. Set book for that destination...
				
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
				            iconSize    : [43,54], // size of the icon
				            iconAnchor  : [22,54], // point of the icon which will correspond to marker's location
				            popupAnchor : [0,-10], // point from which the popup should open relative to the iconAnchor
				            className   : "ab-Pin"
				        }
				    }
				}
				
				var setBook = function(){
					
					// | i | Attach pins to map...
	            
		            angular.forEach($scope.theBook,function(_d){
						
						var newMarker = angular.copy(markerType);
						
						newMarker.geometry.coordinates[0] = _d.longitude;
						newMarker.geometry.coordinates[1] = _d.latitude;
						newMarker.properties.title        = _d.title;
						newMarker.properties.phone        = _d.phone;
						newMarker.properties.address      = _d.address;
						newMarker.properties.icon.iconUrl = '/sites/all/themes/feflip/media/map/'+_d.association.toLowerCase()+'-pin.png';
						newMarker.properties.review  	  = _d.review;
						newMarker.properties.type  	      = _d.association.toLowerCase();
						
						if(!_.isUndefined(_filter) && _filter == _d.association.toLowerCase()) bookJson.push(newMarker);
						else bookJson.push(newMarker);
					});
					
					// | i | Bind pop-up...
					
					bookLayer.on('layeradd', function(_e){
					    
					    var marker       = _e.layer,
					        feature      = marker.feature,
							popupContent = '<div class="vertical '+feature.properties.type+'"><h1>'+feature.properties.title+'</h1>'+feature.properties.review+'</div>';
						
					    marker.setIcon(L.icon(feature.properties.icon));
					   
						if(feature.properties.type != undefined){
						    marker.bindPopup(popupContent,{
						        closeButton  : false,
						        minWidth     : 300,
						        zoomAnimation: true,
						        keepInView   : false,
						        autoPan      : true
						    });
					    }
					});
					
					bookLayer.setGeoJSON(bookJson);
				}
				
				$http({
	                method : 'POST',
	                url    : formSubmit,
	                data   : $.param({formID:'addressBook',destinationID:_d.id}),
	                headers : { 
	            		'Content-Type' : 'application/x-www-form-urlencoded'
					},
					transformRequest: angular.identity
	            }).
	            success(function(_data){
		            $scope.theBook = _data;
		            setBook();
		        }).
	            error(function(_data,_status){});
			}
			
			// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
			// | i | Hotels...
            // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
           
			$scope.getHotelsByDestination = function(_d){
				
				// 1. Set hotels for that destination...
				
				var markerType = {
				    type     : "Feature",
				    geometry : {
				        type        : "Point",
				        coordinates : [0,0]
				    },
				    properties: {
				        title     : "",
				        icon      : {
				            iconUrl     : "",
				            iconSize    : [43,54], // size of the icon
				            iconAnchor  : [22,54], // point of the icon which will correspond to marker's location
				            popupAnchor : [0,-10], // point from which the popup should open relative to the iconAnchor
				            className   : "ab-Pin"
				        }
				    }
				}
				
				var setHotels = function(){
					
					angular.forEach($scope.theHotels,function(_d){
					
						var newMarker = angular.copy(markerType);
						
						newMarker.geometry.coordinates[0] = _d.longitude;
						newMarker.geometry.coordinates[1] = _d.latitude;
						newMarker.properties.title        = _d.name;
						newMarker.properties.icon.iconUrl = '/sites/all/themes/feflip/media/icons/destination-map-pin.png';
						newMarker.properties.image        = _d.image;
						newMarker.properties.description  = _d.hotelDescription;
						newMarker.properties.url          = _d.url;
						
						hotelJson.push(newMarker);
					});
					
					hotelLayer.on('layeradd',function(_e){
				    
					    var marker       = _e.layer,
					        feature      = marker.feature,
							popupContent = '<a href="'+feature.properties.url+'" class="expanded-destination-pin"><figure><img src="'+feature.properties.image+'"/></figure><p>'+feature.properties.title+'<br>'+feature.properties.description+'</p><small>go to hotel...</small></a>';
						
					    marker.setIcon(L.icon(feature.properties.icon));
						
						marker.on('click',function(){
							//$scope.displayDestination(feature.properties.destination);
						});
						
						marker.bindPopup(popupContent,{
					        closeButton  : false,
					        minWidth     : 300,
					        zoomAnimation: true,
					        keepInView   : false,
					        autoPan      : true,
					        closeOnClick : true
					    });
					});
					
					hotelLayer.setGeoJSON(hotelJson);
				}
				
				// Get hotels per destination...
				
				$http({
	                method : 'POST',
	                url    : formSubmit,
	                data   : $.param({formID:'destinationHotels',destinationID:_d.id}),
	                headers : { 
	            		'Content-Type' : 'application/x-www-form-urlencoded'
					},
					transformRequest: angular.identity
	            }).
	            success(function(_data){
		            $scope.theHotels = _data;
		            setHotels();
		        }).
	            error(function(_data,_status){});
			};
			
			// | i | Specific functionalities...
            // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
			
			$scope.displayDestination = function(_destination){
				$scope.step = 2;
				$scope.selectedDestination = _destination;
				$scope.getAddressBookPerDestination(_destination);
				$scope.getHotelsByDestination(_destination);
			}
			
			$scope.displayAddress = function(_address){
				map.setView([_address.latitude,_address.longitude],20);
			}
			
			$scope.filterMap = function(_filter){
				$scope.step = 3;
				$scope.bookFilter = angular.lowercase(_filter);
				$scope.getAddressBookPerDestination($scope.selectedDestination,$scope.bookFilter);
			}
			
			$scope.printList = function(){
			}
			
			$scope.zoomMap = function(_a){
				map.setView([_a.latitude,_a.longitude],16);
			}
			
			$scope.filterAddress = function(_a){ 
				return angular.lowercase(_a.association) === $scope.bookFilter;
			};
			
			$scope.displayAside = function(){
				
				$scope.displayMenu = !$scope.displayMenu;
				
				if(!$scope.displayMenu){
				}
			}
			
			// | i | Zoom continent...
			// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
			
			$scope.zoomContinent = function(_c){
				switch(_c){
					case 'northamerica':
						map.setView([43.005,-106.436],4);
					break;
					case 'southamerica':
						map.setView([-19.891,-65.479],4);
					break;
					case 'caribbean':
						map.setView([21.043,-84.683],5);
					break;
					case 'africa':
						map.setView([3.513,21.973],4);
					break;
					case 'asia':
						map.setView([53.015,73.828],3);
					break;
					case 'oceania':
						map.setView([-15.284,125.42],4);
					break;
					case 'europe':
						map.setView([50.402,5.801],4);
					break;
					default: 
						map.setView([40,0],2);
					break;
				}
			}
			
			// | i | Filter hook...
			$('ul[role="select"] li').on('click',function(){
				$scope.zoomContinent($(this).text().toLowerCase().replace(' ',''));
			});
			
			// | i | All destinations getter...
			// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
			
			$scope.retrieveDestinations();
		});
		
		/* ~ Blog ~ */
		/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */
		
		ffAppControllers.controller('BlogCtrl',function($scope,$element,$timeout){
			
			var grid    = $('.feed-wrapper');
			var entries = $('a.quick-entry').toArray();
			
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
			
			$timeout(function(){
				grid.shuffle({
					itemSelector: '.quick-entry'
				});
			},0);
		});
		
		/* ~ Instagram ~ */
		/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */
		
		ffAppControllers.controller('InstagramCtrl',function($scope,$http){
			
			$scope.feed;
			$scope.lastImage = '';
			
			/*$http({
                method : 'GET',
                url    : 'https://api.instagram.com/v1/users/self/feed',
                data   : $.param({access_token:'1447456174.1d4129f.f932b30f212048a9b551672d0dcff7dd'})
            }).
            success(function(_response){
	           console.log(_response);
	           //$scope.feed      = _response.data;
	           //$scope.lastImage = $scope.feed[0].images.standard_resolution
	        }).
            error(function(_data,_status){
	            console.log(_status);
            });*/
		});
		
		/* ~ Messenger ~ */
		/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */
		
		ffAppControllers.controller('MessengerCtrl',function($scope,$element){
			
			var messageType     = ['hidden','signup','loading'];
			
			$scope.messenger      = globalPartialPath + 'messenger.tpl.html';
			$scope.overlay        = $('.call-to-action');
			$scope.isLoggedIn     = $scope.$parent.user; 
			$scope.isLoading      = $scope.$parent.loading; 
			$scope.triggerState   = messageType[0];
			$scope.display        = false;
			$scope.resetPassword  = $scope.$parent.resetPassword;
			$scope.changePassword = false;
			
			$scope.triggerOverlay = function(){
				switch($scope.triggerState){
					case 'hidden':
						$scope.display = false;
					break;
					case 'loading':
						$scope.display = true;
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
			
			$scope.$watch('resetPassword',function(_v){
				if(_v){
					$scope.triggerState = messageType[1];
					$scope.triggerOverlay();
				}
			});
			
			$scope.$watch('changePassword',function(_v){
				if(_v){
					$scope.triggerState = messageType[1];
					$scope.triggerOverlay();
				}
			});
			
			// | i | Watch loading process...
			
			$scope.$watch('isLoading',function(_v){
				if(_v){
					$scope.triggerState = messageType[3];
					$scope.triggerOverlay();
				}
			});
			
			// | i | Trigger password request...
			
			$('#change-password').on('click',function(){
				$scope.changePassword = true;
				$scope.$apply();
			});
		});
		
		/* ~ Sign-up ~ */
		/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */
		
		ffAppControllers.controller('RegistrationCtrl',function($scope,$http){
			
			$scope.response		 = ['success','error','error-in-login'];
			$scope.types   		 = ['sign-up','sign-in','response','reset-password','new-password','change-password']; 
			$scope.type    	     = $scope.types[0];
			$scope.rMessage 	 = '';
			$scope.isValid       = true;
			$scope.signInError   = '';
			$scope.signUpError   = '';
			$scope.passwordError = '';
			$scope.loading       = false;
			
			$scope.data = {
				userName       		: '',
				userLast       		: '',
				userEmail      		: '',
				userPassword   		: '',
				userRepassword 		: '',
				subscribeNewsletter : true
			}
			
			// | i | Switch bettwen forms...
			
			$scope.switcher = function(_state){
				$scope.type = _state;
				$scope.data = {
					userName            : '',
					userLast            : '',
					userEmail           : '',
					userPassword        : '',
					userRepassword      : '',
					subscribeNewsletter : true
				}
				$scope.signInError   = '';
				$scope.signUpError   = '';
				$scope.passwordError = '';
				$scope.rMessage 	 = '';
			}
			
			// | i | Close overlay...
			
			$scope.closeOverlay = function(){
				$('.call-to-action').transition({opacity:0},function(){
					$scope.$parent.$parent.display = false;
					$scope.$parent.$parent.resetPassword = false;
					$scope.$parent.$parent.triggerState = 'hidden';
					$scope.$parent.$parent.$apply();
				});
			}
			
			// | i | Input checker...
			
			$scope.checkChangedInput = function(_i){
				
				var displayWarning = function(_id,_state){
					
					var _t = $('*[name$="-'+_id.split('user')[1].toLowerCase()+'"]');
					var _c = 'warning';
					
					if(_state){
						_t.addClass(_c);
						$scope.isValid = false;
					}
					else _t.removeClass(_c);
				}
				
				angular.forEach($scope.data,function(_v,_id){
					displayWarning(_id,angular.isUndefined(_v));
				});
				
				return $scope.isValid;
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
			            $scope.loading = false;
			            $scope.signInError = 'The user or password is incorrect';
			        }
	            }).
	            error(function(){});
			}
			
			$scope.changePassword = function(){
				
				var _p = $('#password-form input[type="password"]');
				
				if($scope.data.userRepassword == $scope.data.userPassword && $scope.data.userPassword != ''){
					_p.removeClass('warning');
					$http({
		                method  : 'POST',
		                url     : formSubmit,
		                data    : $.param({formID:'updatePassw','newPassw':$scope.data.userPassword}),
		                headers : { 
		            		'Content-Type' : 'application/x-www-form-urlencoded'
						},
						transformRequest: angular.identity
		            }).
		            success(function(_data){
			            switch(_data.error){
				            case '':
				            	$scope.closeOverlay();
				            break;
				            default:
				            	$scope.passwordError = 'Something went wrong, please try again later';
				            break;
			            }
		            }).
		            error(function(_data){
		            });
				}
				else _p.addClass('warning');
			} 
			
			$scope.sendPasswordEmail = function(){
				$http({
	                method  : 'POST',
	                url     : formSubmit,
	                data    : $.param({formID:'resetPassw','userEmail':$scope.data.userEmail}),
	                headers : { 
	            		'Content-Type' : 'application/x-www-form-urlencoded'
					},
					transformRequest: angular.identity
	            }).
	            success(function(_data){
		            //console.log(_data);
		            switch(_data.error){
			            case '':
			            	$('#password-form').transition({opacity:0},function(){
				            	$scope.rMessage = 'reset-password-success'; 
				            	$scope.$apply();
			            	});
			            break;
			            default:
			            	$scope.passwordError = 'The email does not exist';
			            break;
		            }
	            }).
	            error(function(_data){
		            //console.log(_data);
	            });
			}
			
			// | i | Triggers for password recovery...
			
			if($scope.$parent.changePassword)
				$scope.switcher('change-password');
			
			if($scope.$parent.resetPassword)
				$scope.switcher('new-password');
		});
		
		/* ~ Newsletter ~ */
		/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */
		
		ffAppControllers.controller('NewsletterCtrl',function($scope,$element,$http){
			
			var mcService = '';
			var status    = ['still','success','error'];
			
			$scope.currentStatus = status[0];
			$scope.signUpData    = {
				userEmail : ''
			}
			
			// | i | Input checker...
			
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
			
			// | i | Submit form...
			
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
		
		/* ~ Hotel review ~ */
		/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */
		
		ffAppControllers.controller('HotelFilterCtrl',function($scope,$element){
			
			var _allHotels  = $('a.item').toArray();
			var _hotels     =  _allHotels;
			var selectedCat = '';
			var filtered    = new Array();
			var isInit      = true;
			
			$scope.filterHotels = function(_cat){
				// | i | F+F category exception...
				if(_cat == 'f+f favorites') _cat = _cat.split(' ')[1];
				// 1. Hide none-category hotels...
				angular.forEach(_hotels,function(_h){
					if(!$(_h).hasClass(_cat)) $(_h).remove();
				});
				// 2. Populate array with current hotels...
				_hotels = $('a.item').toArray();
			}
			
			$scope.unfilterHotels = function(_cat){
			}
			
			$scope.resetFilters = function(){
				// 1. Remove all elements...
				$('a.item').remove();
				// 2. Attach hotels...
				_.each(_allHotels,function(_m){
					$('#hotel-reviews > div.wrapper').append(_m);
				});
				// 3. Rmove on class from filter buttons...
				$($element[0]).find('li').each(function(){
					$(this).removeClass('on');
				});
			}
			
			$($element[0]).find('li').on('click',function(){
				
				var _cat = $(this).text().toLowerCase();
				
				// | i | Switch class...
				$(this).toggleClass('on');
				// | i | Filter hotels...
				switch($(this).hasClass('on')){
					case true:
						$scope.filterHotels(_cat);
					break;
					case false:
						$scope.unfilterHotels(_cat);
					break;
				}
				
				return false;
			});
			
			$('ul[role="select"] li').on('click',function(){
				$scope.resetFilters();
			});
		});
		
		/* ~ Gallery ~ */
		/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */
		
		ffAppControllers.controller('SlideshowCtrl',function($scope,$element,$http,$timeout){
			
			var gFrame = $('#'+$element[0].id);
			var lBtn   = gFrame.find('*[rel="left"]');
			var rBtn   = gFrame.find('*[rel="right"]');
			
			// | i | Hotel node exception...
			
			if($('body').hasClass('hotel')){
				lBtn = $('div.gallery-ui *[rel="left"]');
				rBtn = $('div.gallery-ui *[rel="right"]');
			}
			
			$timeout(function(){
				switch(gFrame.hasClass('one-item')){
					case false:
						/*gFrame.sly({
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
						});*/
					break;
					case true:
					
						// | i | This resizes the images within the main gallery...
						/* ------------------------------------------------------------------------------------------------- */
						if(gFrame.hasClass('main')) 
							gFrame.find('li').css({'width':$(window).width()+'px'});
						/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */
						
						if(!gFrame.hasClass('main')){
							gFrame
							.find('li')
							.delay(300)
							.transit({opacity:1},function(){
								gFrame.sly({
									horizontal     : 1,
									itemNav        : 'centered',
									activateOn     : 'click',
									smart          : 1,
									activateMiddle : 1,
									mouseDragging  : 1,
									touchDragging  : 1,
									releaseSwing   : 1,
									startAt        : 0,
									scrollBy       : 1,
									speed          : 500,
									elasticBounds  : 1,
									pagesBar       : $('div.gallery-ui ul.pages'),
									activatePageOn : 'click',
									cycleBy        : 'items',  
									cycleInterval  : 7000,
									pauseOnHover   : true,
									startPaused    : false, 
									prev           : lBtn,
									next           : rBtn
								});
							});
						}else{
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
								pagesBar       : $('div.gallery-ui ul.pages'),
								activatePageOn : 'click',
								cycleBy        : 'items',  
								cycleInterval  : 7000,
								pauseOnHover   : true,
								startPaused    : false, 
								prev           : lBtn,
								next           : rBtn
								});
							});
						}
						
						$(window).on('resize',function(){
							gFrame.sly('reload');
						});
						
					break;
				}
			},0);
			
		});
		
		/* ~ Search ~ */
		/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */
		
		ffAppControllers.controller('SearchCtrl',function($scope,$http){
			
			$scope.userSearch = '';
			$scope.destinations;
			$scope.hotels;
			$scope.showResult = false;
			$scope.noResult   = false;
			
			$scope.searchSubmit = function(_id){
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
		});
		
		/* ~ Hotel ~ */
		/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */
		
		ffAppControllers.controller('HotelCtrl',function($scope,$http){
		
			L.mapbox.accessToken = 'pk.eyJ1Ijoibm9sb2d5IiwiYSI6IkFBdm5aVEkifQ.ItKi4oQ1-kPhJhedS4QmNg';
			
			var map; 
			
			if(map != undefined) map.remove();
			
			map = L.mapbox.map('map','nology.k0cicjhd',{
				zoomControl: true,
				attributionControl: false,
			    tileLayer: {
			        continuousWorld: false,
			        noWrap: false
			    }
			});
			
			//map.dragging.disable();
			map.touchZoom.disable();
			map.doubleClickZoom.disable();
			map.scrollWheelZoom.disable();
			// | i | Disable tap handler, if present.
			if(map.tap) map.tap.disable();
			
			var destLayer  = L.mapbox.featureLayer().addTo(map);
			var bookLayer  = L.mapbox.featureLayer().addTo(map);
			var geoJson    = [];
			
			$scope.latLon;
			$scope.showMap = false;
			$scope.step = 1;
			
			// | i | Add destination markers to map...
            // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
			
			$scope.addHotel = function(){
				
				var markerType = {
				    type     : "Feature",
				    geometry : {
				        type        : "Point",
				        coordinates : [$scope.latLon[1],$scope.latLon[0]]
				    },
				    properties: {
				        title : "",
				        icon  : {
				            iconUrl     : '/sites/all/themes/feflip/media/icons/destination-map-pin.png',
				            iconSize    : [38,47], // size of the icon
				            iconAnchor  : [19,47], // point of the icon which will correspond to marker's location
				            popupAnchor : [0,-10], // point from which the popup should open relative to the iconAnchor
				            className   : "ff-Pin"
				        }
				    }
				}
				
				destLayer.on('layeradd',function(_e){
				    
				    var marker  = _e.layer,
				        feature = marker.feature;
					
				    marker.setIcon(L.icon(feature.properties.icon));
				});
				
				geoJson.push(markerType);
				destLayer.setGeoJSON(geoJson);
			};
			
			$scope.addItineraryPins = function(){
				
				var theBook    = {};
				var destParams = {
					formID 		  : 'addressBook',
					destinationID : $('#map-it').data('destination')
				}
				
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
				            iconSize    : [43,54], // size of the icon
				            iconAnchor  : [22,54], // point of the icon which will correspond to marker's location
				            popupAnchor : [0,-10], // point from which the popup should open relative to the iconAnchor
				            className   : "ab-Pin"
				        }
				    }
				}
				
				var setBook = function(){
					
					// | i | Attach pins to map...
	            
		            angular.forEach(theBook,function(_d){
						
						var newMarker = angular.copy(markerType);
						
						newMarker.geometry.coordinates[0] = _d.longitude;
						newMarker.geometry.coordinates[1] = _d.latitude;
						newMarker.properties.title        = _d.title;
						newMarker.properties.phone        = _d.phone;
						newMarker.properties.address      = _d.address;
						newMarker.properties.icon.iconUrl = '/sites/all/themes/feflip/media/map/'+_d.association.toLowerCase()+'-pin.png';
						newMarker.properties.review  	  = _d.review;
						newMarker.properties.type  	      = _d.association.toLowerCase();
						
						geoJson.push(newMarker);
					});
					
					// | i | Bind pop-up...
					
					bookLayer.on('layeradd', function(_e){
					    
					    var marker       = _e.layer,
					        feature      = marker.feature,
							popupContent = '<div class="'+feature.properties.type+'"><h1>'+feature.properties.title+'</h1>'+feature.properties.review+'</div>';
						
					    marker.setIcon(L.icon(feature.properties.icon));
					    
					    if(feature.properties.type != undefined){
						    marker.bindPopup(popupContent,{
						        closeButton  : false,
						        minWidth     : 300,
						        zoomAnimation: true,
						        keepInView   : true,
						        autoPan      : true
						    });
					    }
					});
					
					bookLayer.setGeoJSON(geoJson);
				}
				
				// | i | Retrieve all address book pins...
				
				$http({
	                method : 'POST',
	                url    : formSubmit,
	                data   : $.param(destParams),
	                headers : { 
	            		'Content-Type' : 'application/x-www-form-urlencoded'
					},
					transformRequest: angular.identity
	            }).
	            success(function(_data){
		            theBook = _data;
		            setBook();
		        }).
	            error(function(_data,_status){});
			}
			
			// | i | Loader..
            // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
			
			$scope.loadMap = function(_lat,_lon){
				$scope.latLon = [_lat,_lon];
				$scope.addHotel();
				$scope.addItineraryPins();
				map.setView($scope.latLon,19);
			}
		});
		
		/* ~ Itinerary ~ */
		/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */
		
		ffAppControllers.controller('ItineraryCtrl',function($scope){
			
			var navInc   = 60 + 40;
			
			$scope.scroll = function(_y){
				$('html,body').delay(250).animate({scrollTop:_y},500);
			}
			
			$('header button[rel]').on('click',function(){
				
				var _t     = $(this).attr('rel').toLowerCase();
				var guideY = $("#neighborhood-guide").offset().top;
				
				$("#neighborhood-guide h4").each(function(){
					if($(this).text().toLowerCase() == _t) $scope.scroll($(this).offset().top - navInc);
				});
			});
			
			$('button[rel="see-hotel-reviews"]').on('click',function(){
				$(this).fadeOut();
				$('#itinerary').css({'padding-bottom':'0px'});
				$('#hotel-reviews').removeClass('hidden');
				$scope.scroll($('#hotel-reviews').offset().top - navInc - 40);
			});
		});
		
		/* ~ Newsletter ~ */
		/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */
		
		ffAppControllers.controller('ContactCtrl',function($scope,$http){
			
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
		
		