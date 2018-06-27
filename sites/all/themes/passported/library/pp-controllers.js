


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

        var formSubmit = window.location.protocol + '//' + window.location.host + '/api/forms'; //"https://www.passported.com/api/forms"; //
        var ppControllers = angular.module('ppControllers',[]);
        var drupalTemplatePath = '/sites/all/themes/passported/';

        /* Global APP Controller
        ---------------------------------------------------------------------------------------------------------------- */

        ppControllers.controller('AppController',function($scope,$log,$timeout,$location){

			$scope.user;
			$scope.view;
			$scope.loading = false;
			$scope.error = false;
			$scope.resetPassword = false;

	    	/* Layout & Tools
	        - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */

			$scope.isMobile = (Modernizr.touch && $(window).width() < 800) ? true : false;

	        var triggerGoogleEvent = function(_s){
				// ga('send','event','ux','scroll',_s);
	        }

	        var scrolling = function(){

		        $('#newsletter-block').waypoint(function(){

			        var _t = $(this);

			        $timeout(function(){_t.find('*[data-animate="1"]').addClass('animated fadeInDown')},200);

		        },{ offset: '0%' });

		        $('body > header').waypoint(function(){

			        var _t = $(this);

			        $timeout(function(){_t.find('*[data-animate="1"]').addClass('animated fadeInDown')},200);
					$timeout(function(){_t.find('*[data-animate="2"]').addClass('animated fadeInDown')},400);
					$timeout(function(){_t.find('*[data-animate="3"]').addClass('animated fadeInDown')},600);
					$timeout(function(){_t.find('*[data-animate="4"]').addClass('animated fadeInDown')},800);
					$timeout(function(){_t.find('*[data-animate="5"]').addClass('animated fadeInDown')},1000);
					$timeout(function(){_t.find('*[data-animate="6"]').addClass('animated fadeInDown')},1200);
					$timeout(function(){_t.find('*[data-animate="7"]').addClass('animated fadeInDown')},1400);
					$timeout(function(){_t.find('*[data-animate="8"]').addClass('animated fadeIn')},1600);
					$timeout(function(){_t.find('*[data-animate="9"]').addClass('animated fadeIn')},1800);

		        },{ offset: '10%' });


		        $('#passported-intro').waypoint(function(){

			        var _t = $(this);

			        $timeout(function(){_t.find('*[data-animate="1"]').addClass('animated fadeInUp')},200);
					$timeout(function(){_t.find('*[data-animate="2"]').addClass('animated fadeInUp')},400);
					$timeout(function(){_t.find('*[data-animate="3"]').addClass('animated fadeInUp')},600);
					$timeout(function(){_t.find('*[data-animate="4"]').addClass('animated fadeInUp')},800);
					$timeout(function(){_t.find('*[data-animate="5"]').addClass('animated fadeInUp')},1000);
					$timeout(function(){_t.find('*[data-animate="6"]').addClass('animated fadeInUp')},1200);
					$timeout(function(){_t.find('*[data-animate="7"]').addClass('animated fadeInUp')},1400);

		        },{ offset: '10%' });

		        $('#inspiration').waypoint(function(){

			        var _t = $(this);

			        $timeout(function(){_t.find('*[data-animate="1"]').addClass('animated fadeIn')},200);
					$timeout(function(){_t.find('*[data-animate="2"]').addClass('animated fadeIn')},600);

		        },{ offset: '100%' });

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

					triggerGoogleEvent('map');

			        $timeout(function(){_t.find('*[data-animate="1"]').addClass('animated fadeIn')},200);
			        $timeout(function(){_t.find('*[data-animate="2"]').addClass('animated fadeInLeft')},400);
			        $timeout(function(){_t.find('*[data-animate="3"]').addClass('animated fadeInRight')},600);

		        },{ offset: '30%' });

		        $('#travel-journal').waypoint(function(){

			        var _t = $(this);

			        triggerGoogleEvent('travel-journal');
			        $timeout(function(){_t.find('*[data-animate="1"]').addClass('animated fadeInUp')},200);

			        if(!_t.hasClass('related'))
			        	$timeout(function(){_t.find('*[data-animate="2"]').addClass('animated fadeIn')},400);

			    },{ offset: '75%' });

		        $('#press').waypoint(function(){

			        var _t = $(this);

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

			    if(!$scope.isMobile){
				    $('div.dropdown-wrapper').on({
				    	mouseover: function(){
					    	userControl = true;
					    }
					});

			        $('header > nav a.subnav').on({
				    	mouseover: function(){

					    	var middlePoint = $(this).offset().left + 10 + $(this).width()/2;
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
								    	_t.show().transition({height:wHeight + 'px'},function(){
									    	$(this).css({'overflow':'visible'});
								    	});
							    		_n.show().transition({opacity:1});
							    		_s.hide();
							    	}
							    	// 2. Search
							    	if(_element == 'search'){
								    	_t.show().transition({height:220 + 'px'},function(){
									    	$(this).css({'overflow':'visible'});
								    	});
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
							    	_t.css({'overflow':'hidden'});
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
				}else{
					$('button.mobile-nav-trigger').on('click',function(){
						$('header > nav').toggleClass('mobile');
					});
				}
	        }

	        var waitForImages = function(){
		        $('body').transit({opacity:1},function(){
			    	if(!$scope.isMobile) scrolling();
			    	navManager();
		        });
		        $('body').imagesLoaded().always(function(_e){
				});
	        }

	        /* Scope
	        - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */

	        $scope.state = $location.path().replace('/','');

	        $scope.goToURL = function(_l){
		        window.location = _l;
	        }

	        $timeout(function(){
				waitForImages();
			},200);
	    });

	    /* City Guide Controller
        ---------------------------------------------------------------------------------------------------------------- */

	    ppControllers.controller('MapController',function($scope,$rootScope,$log,$timeout){

		    $scope.map;
		    $scope.lat = 30;
		    $scope.lon = -30;
		    $scope.inspirationSearch;

		    var bounds = new google.maps.LatLngBounds();
		    var markers = [];
		    var destinationMarkers = [];

			var mapID = 'passported';
		    var setMapHeight = function(){
			    $('#map').css({
				    height: ($(window).height() - 90) + 'px'
				});
		    }

		    var initialize = function(){

			    var mapOptions = {
					zoom: 3,
					center: new google.maps.LatLng($scope.lat,$scope.lon),
					zoomControl: true,
					mapTypeControl: false,
					draggable: true,
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
								$rootScope.$emit('display-destination',[_d]);
							});

							destinationMarkers.push(destination);
							bounds.extend(destination.position);
						});

						$scope.map.fitBounds(bounds);

				    break;
				    case 'guide':

				    	var zoom   = (_data.zoom_level.length == 0) ? 12 : Number(_data.zoom_level);
						var latLng = (_data.addressbook_reference.length == 0) ? [_data.lat,_data.lon] : [_data.addressbook_reference.lat,_data.addressbook_reference.lon];
						var detail = [_data.guide,_data.hotels];

						_.map(destinationMarkers,function(_d){
							_d.setMap(null);
							_d = null;
						});

				    	_.map(detail,function(_d){
					    	_.map(_d,function(_p){
						    	if(_p.isLoaded || _p.isLoaded === undefined){

							    	var _interest = (!_.isUndefined(_p.assoc_interests)) ? _p.assoc_interests.toLowerCase() : 'stay';
							    	var _title    = (!_.isUndefined(_p.title)) ? _p.title : _p.name;
							    	var _body     = (!_.isUndefined(_p.short_description)) ? _p.short_description : _p.short_review;

							    	var pin = new google.maps.Marker({
										position: {
											lat: Number(_p.lat),
											lng: Number(_p.lon)
										},
										type: _interest,
										id: _p.id,
										map: $scope.map,
										title: _title,
										icon: _path + _interest + '-pin-icon.svg'
									});

									var infowindow = new google.maps.InfoWindow({
										content: '<div class="in-map '+_interest+'"><h1>'+_title+'</h1><h2>'+_body+'</h2></div>',
										maxWidth: 200
									});

									pin.addListener('click',function(){
										$scope.map.setZoom(16);
										$scope.map.setCenter(pin.getPosition());
										infowindow.open($scope.map,pin);
									});

									bounds.extend(pin.position);
									markers.push(pin);
								}
							});
					    });

						$scope.map.fitBounds(bounds);
					    $scope.map.setCenter(new google.maps.LatLng(Number(latLng[0]),Number(latLng[1])));
					    $scope.map.setZoom(zoom);

				    break;
				    case 'pick':

				    	var _p        = _data;
				    	var _interest = (!_.isUndefined(_p.assoc_interests)) ? _p.assoc_interests.toLowerCase() : 'stay';
				    	var _title    = (!_.isUndefined(_p.title)) ? _p.title : _p.name;
				    	var _body     = (!_.isUndefined(_p.short_description)) ? _p.short_description : _p.short_review;

				    	var pin = new google.maps.Marker({
							position: {
								lat: Number(_p.lat),
								lng: Number(_p.lon)
							},
							type: _interest,
							id: _p.id,
							map: $scope.map,
							title: _title,
							icon: _path + _interest + '-pin-icon.svg'
						});

						var infowindow = new google.maps.InfoWindow({
							content: '<div class="in-map '+_interest+'"><h1>'+_title+'</h1><h2>'+_body+'</h2></div>',
							maxWidth: 200
						});

						pin.addListener('click',function(){
							$scope.map.setZoom(16);
							$scope.map.setCenter(pin.getPosition());
							infowindow.open($scope.map,pin);
						});

						bounds.extend(pin.position);
						markers.push(pin);

				    break;
			    }
		    }

		    var refiltering = function(_filter){
			    _.map(markers,function(_m){
				    if(_m.type != _filter && !_.isUndefined(_filter)) _m.setMap(null);
				    else _m.setMap($scope.map);
				});
		    }

		    $timeout(function(){
				setMapHeight();
				initialize();
			},0);

			$(window).on('resize',function(){
				setMapHeight();
			});

			$rootScope.$on('filter-map',function(_e,_data){
				refiltering(_data[0]);
			});

			$rootScope.$on('display-pick',function(_e,_data){
				_.map(markers,function(_m){
				    if(_m.id == _data[0]) google.maps.event.trigger(_m,'click');
				});
			});
		});

		ppControllers.controller('ItineraryController',function($scope,$log,$timeout,$resource,$location,$routeParams,$rootScope){

			var api      = window.location.protocol + '//' + window.location.host + '/api/content/';
			var destSrc  = $resource(api+'destinations.json');
			var abookSrc = $resource(api+'address-books.json');
			var hotelSrc = $resource(api+'hotels.json');
			var itSrc    = $resource('https://go.passported.com/api/v2/location');

			//'https://www.passported.com/api/content/';

			//GET https://gostage.passported.com/api/v2/location?name=Paris
			//This will return a list of itineraries for New York:
			//GET https://gostage.passported.com/api/v2/location?name=New+York+City
			//This will return a single itinerary based on id:
			//GET https://gostage.passported.com/api/v2/itinerary?id=64

			$scope.itineraryIsReady;
			$scope.cityGuideID;
			$scope.step = (_.isUndefined($scope.cityGuideID)) ? 1 : 2;
			$scope.pick;
			$scope.showAside = true;
			$scope.filter = undefined;
			$scope.dayOfWeek = moment().day() - 1;
			$scope.hotelFilters = [];
			$scope.addressFilters = {
				eat: [],
				do: [],
				noteworthy: [],
				shop: []
			}

			// Tools

			$scope.check = {
				phone: function(_p){
					return _.isArray(_p);
				},
				features: function(_d){
					return _.isArray(_d);
				}
			}

			$scope.setClass = function(_tags){

				var tags = '';

				_.map(_tags,function(_t){
					_.each(_t,function(_f,_index){

						var gap = (_index == (_t.length - 1)) ? '' : ' ';

						tags += _f.toLowerCase() + gap;
					});
				});

				return tags;
			}

			/* Open/Close panel
	        - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */

			$scope.openLeftAside = function(){
				$scope.showAside = !$scope.showAside;
				$('#map').toggleClass('full');
				google.maps.event.trigger($scope.map,'resize');
			}

			$scope.openHours = function(_id){

				var _t = $('#a-'+_id);
				var _state = Boolean(_t.data('state'));
				var _options = _t.find('li').toArray();

				_t.data('state',!_state);
				_.map(_options,function(_o){
					if(!$(_o).hasClass('selected')){
						if(_state) $(_o).show();
						else $(_o).hide();
					}
				});
			}

			$scope.goTo = function(_state){
				$scope.step = _state;
			}

			/* Destinations
	        - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */

			$scope.displayDestination = function(_d){

				$scope.pick = _d;

				// 1. Address Books

				abookSrc.query({'destination':_d.id},function(_data){

					$scope.pick.guide = _data;

					// Wrap categories...

					_.extend($scope.pick,{
						guide_by_category : angular.copy($scope.addressFilters)
					});

					// Google Place replacement...

					_.map(_data,function(_a){

						if(!_.isUndefined($scope.pick.guide_by_category[_a.assoc_interests.toLowerCase()]))
							$scope.pick.guide_by_category[_a.assoc_interests.toLowerCase()].push(_a);

						if(!_.isArray(_a.google_place_id) && _a.google_place_id){

							var place = new google.maps.places.PlacesService($scope.map);

							var puller = function(){
								place.getDetails({placeId:_a.google_place_id},function(_place,_status){
									if(_status == google.maps.places.PlacesServiceStatus.OK){

										//console.log('success:' + _a.title + '|' + _place.name);

										_a.title 		= _place.name;
										_a.lat 			= _place.geometry.location.lat();
										_a.lon 			= _place.geometry.location.lng();
										_a.phone_number = _place.international_phone_number;
										_a.address 		= _place.formatted_address;
										_a.website 		= _place.website;
										_a.hours        = (_.isUndefined(_place.opening_hours)) ? undefined : _place.opening_hours.weekday_text;
										_a.open         = (_.isUndefined(_place.opening_hours)) ? undefined : _place.opening_hours.open_now;

										if(_a.isLoaded === false){
											$scope.$parent.addMarkers('pick',_a);
											_a.isLoaded  = true;
										}
									};

									if(_status == google.maps.places.PlacesServiceStatus.OVER_QUERY_LIMIT){

										//console.log('fail:' + _a.title);

										_a.isLoaded = false;

										setTimeout(function(){
											puller();
										},3000);
									}
								});
							}

							puller();
						}

						// Get hotel filters...

						_.map(_a.guide_categories,function(_tags,_key){

							var category = _key.toLowerCase();

							_.map(_tags,function(_tag){
								if(_.indexOf($scope.addressFilters[category],_tag.toLowerCase()) == -1)
									$scope.addressFilters[category].push(_tag.toLowerCase());
							});
						});
					});

					// 3. Hotels

					hotelSrc.query({'destination':_d.id},function(_data){

						$scope.pick.hotels = _data;
						$scope.$parent.addMarkers('guide',_d);

						// Get hotel filters...

						_.map($scope.pick.hotels,function(_h){
							_.map(_h.guide_categories,function(_tags){
								_.map(_tags,function(_tag){
									if(_.indexOf($scope.hotelFilters,_tag.toLowerCase()) == -1)
										$scope.hotelFilters.push(_tag.toLowerCase());
								});
							});
						});

						// Rearrange hotels: 1. Identify featured - 2. Remove featured - 3. Reorder the object

                        var featuredHotels = _.filter($scope.pick.hotels,function(_v){
							return _v.featured == "1";
						});

						$scope.pick.hotels = _.filter($scope.pick.hotels,function(_v){
							return (_v.featured == "0" || _.isUndefined(_v.featured));
						});

						_.extend($scope.pick.hotels,featuredHotels);

					});
				});

				$scope.step = 2;

				$('#step-2').delay(500).transition({opacity:1},'fast',function(){
					$scope.itineraryIsReady = true;
					$scope.$apply();
				});
			}

			if(_.isUndefined($scope.cityGuideID) && _.isUndefined($scope.inspirationSearch)){
				$scope.destinations = destSrc.query({},function(_data){
					$scope.$parent.addMarkers('destinations',_data);
				});
			}
			else if(!_.isUndefined($scope.cityGuideID)){
				$scope.pick = destSrc.query({id:$scope.cityGuideID},function(_data){
					$scope.displayDestination(_data[0]);
				});
			}
			else if(!_.isUndefined($scope.inspirationSearch)){

				var _s = $location.search();

				$scope.destinations = destSrc.query({place_type:_s.place,season:_s.season},function(_data){
					$scope.$parent.addMarkers('destinations',_data);
				});
			}

			/* Filter
	        - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */

			$scope.filterMap = function(_filter){

				$scope.filter = _filter;

				if(!_.isUndefined($('#guide-wrapper.'+_filter))){
					$('#step-2 div.wrapper').animate({
						scrollTop: 780
					},1000);
				}

				$rootScope.$emit('filter-map',[_filter]);
			}

			$rootScope.$on('display-destination',function(_e,_data){
				$scope.displayDestination(_data[0]);
			});

			$scope.highlightMarker = function(_id){
				$rootScope.$emit('display-pick',[_id]);
			}

			/* Books
			- - - - - - - - - - - - - - - - - - - - - - - - - - - - - */

			$scope.book = function(_hotel){
				$rootScope.$emit('open-booking',[_hotel]);
			}
		});

		/* Booking Controller
        ---------------------------------------------------------------------------------------------------------------- */

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

		    $scope.error;
		    $scope.showRightAside = false;
		    $scope.showCalendar = false;
		    $scope.booking = angular.copy(bookingData);

			$scope.openAside = function(){

				$scope.showRightAside = !$scope.showRightAside;
				$('#map').toggleClass('full');
				google.maps.event.trigger($scope.map,'resize');

				// Reset object...

				if(!$scope.showRightAside)
					$scope.booking = angular.copy(bookingData);
			}

			$scope.setter = {
				checkButtons: function(){
					$('*.budget-check').on('click',function(){
						$('*.budget-check span').removeClass('on');
						$(this).find('span').toggleClass('on');
						return false;
					});
				},
				calendarButtons: function(){
					$('*.icon-calendar').on('click',function(){
						$scope.showCalendar = true;
						$scope.$apply();
						return false;
					});
				},
				date: function(){
				},
				budget: function(_price){
					$scope.booking.budget = _price;
				}
			}

			$scope.submit = function(){

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
		            $('#booking-message').show().transition({opacity:1});
	            }).
	            error(function(){});
			}

			$rootScope.$on('open-booking',function(_e,_data){
				$scope.showRightAside = true;
				$scope.booking.destination = _data[0].destination;
				$scope.booking.hotel = _data[0].name;
			});

			$scope.$watch('booking',function(_n,_o){
				if(!_.isEqual(_n,_o)){
					_.map(_n,function(_value,_key){
						if(_n[_key] != _o[_key]){
							switch(_key){
								case 'start_date': case 'end_date':
									if(!_.isUndefined($scope.booking.start_date) && !_.isUndefined($scope.booking.end_date)){
										if(moment($scope.booking.end_date).isBefore($scope.booking.start_date))
											$scope.error = "Please make sure you have selected correct dates";
										else
											$scope.error = false;
									}
								break;
								case 'adults':
									if(_.isUndefined($scope.booking.adults) || $scope.booking.adults == 0)
										$scope.error = "Please make sure you have selected correct adults";
									else
										$scope.error = false;
								break;
							}
						}
					})
				}
			},true);

			$timeout(function(){
				$scope.setter.checkButtons();
				$scope.setter.calendarButtons();
			},0);
		});

	    ppControllers.controller('CalendarController',function($scope,$log,$timeout){

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
					month.days[moment(_m._d).format('D')] = moment(_m._d).format('MM/DD/YYYY');
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

			$timeout(function(){

				var setGallery = function(_calendar){
					_calendar.sly({
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
						prev           : _calendar.find('*[rel="prev"]'),
						next           : _calendar.find('*[rel="next"]')
					});

					_calendar.find('button').on('click',function(){
						switch($(this).hasClass('arrival')){
							case true:
								$scope.booking.start_date = $(this).data('date');
								$('#arrival button[data-date]').removeClass('on');
							break;
							case false:
								$scope.booking.end_date = $(this).data('date');
								$('#departure button[data-date]').removeClass('on');
							break;
						}

						$(this).addClass('on');
						$scope.$apply();

						return false;
					})
				}

				setGallery(aFrame);
				setGallery(dFrame);
			},0);

			$scope.buildYear();
		});

		/* Post Controller
        ---------------------------------------------------------------------------------------------------------------- */

	    ppControllers.controller('BlogController',function($scope,$log,$timeout){

		    var grid    = $('.grid-wrapper');
			var entries = $('.grid-wrapper *.quick-entry').toArray();
			var hiddenEntries = $('.grid-wrapper *.hidden').toArray();
			var _height = $('#travel-journal').height();

			$scope.expand = 'view all';

			$scope.viewAll = function(){

				var config = ($scope.expand == 'view all') ? ['view less','auto'] : ['view all',_height+'px'];

				$scope.expand = config[0];
				$('#travel-journal').css({height:config[1]});

				switch(config[0]){
					case 'view all':
						// This case is when the user expands the block
						$('#travel-journal .hidden').transition({opacity:0},function(){
							$(this).hide();
						});
					break;
					case 'view less':
						// This case is when the user collapses the block
						$('#travel-journal .hidden').show().transition({opacity:1});
					break;
				}
			}

			$timeout(function(){
				$('#travel-journal').imagesLoaded().always(function(_e){
			        grid.shuffle({
						itemSelector: '.quick-entry'
					});
					$('.grid-wrapper *.hidden').css({opacity:0});
				});
			},0);
		});

	    ppControllers.controller('PromotedController',function($scope,$log,$timeout,$resource){
		});

		/* Newsletter Controller
        ---------------------------------------------------------------------------------------------------------------- */

	    ppControllers.controller('NewsletterController',function($scope,$log,$http,$timeout){

		    var mcService = '';
			var status    = ['still','success','error'];

			$scope.currentStatus = status[0];
			$scope.signUpData    = {
				userEmail : undefined
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
		});

        ppControllers.controller('NewsletterOverlayController',function($scope,$log,$http,$element,$timeout){
        });

	    /* Search Controller
        ---------------------------------------------------------------------------------------------------------------- */

	    ppControllers.controller('SearchController',function($scope,$log,$http,$timeout){

		    var timer;

		    $scope.userSearch = '';
			$scope.destinations;
			$scope.hotels;
			$scope.showResult = false;
			$scope.noResult   = false;

			$scope.reset = function(){
				$scope.userSearch = '';
				$scope.$apply();
			};

			$scope.searchSubmit = function(){

				var searchAction = function(){
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

		ppControllers.controller('InspirationController',function($scope,$log,$http,$cookies,$timeout){

			$scope.search = {
				place: undefined,
				season: undefined
			};

			$scope.submitInspiration = function(){
				if($scope.search.place && $scope.search.season)
					window.location = window.location.origin + '/inspiration/#/?place=' + $scope.search.place + '&season=' + $scope.search.season;
			};

			$scope.$watch(function(){
				$scope.submitInspiration();
			});
		});

		/* Sign Up/In Controller
        ---------------------------------------------------------------------------------------------------------------- */

        ppControllers.controller('CallToActionController',function($scope,$rootScope,$element,$timeout,$cookies){

			var messageType = ['hidden','signup','loading'];
			var overlay     = $('.call-to-action');

			$scope.overlayTpl     = drupalTemplatePath + 'library/templates/sign.tpl.html';
			$scope.isLoggedIn     = $scope.user;
			$scope.isLoading      = $scope.loading;
			$scope.triggerState   = messageType[0];
			$scope.isSignPage     = $scope.view;
			$scope.types   		  = ['sign-up','sign-in','response','reset-password','new-password','change-password','newsletter'];
			$scope.type    	      = $scope.types[0];
			$scope.newsStatus     = 'still';
			$scope.display        = false;
			$scope.resetPassword  = $scope.resetPassword;
			$scope.changePassword = false;

			$scope.triggerOverlay = function(){
                switch($scope.triggerState){
					case 'hidden':
						$scope.display = false;
					break;
					default:
						$scope.display = true;
						$scope.$digest();
					break;
				}
			}

			// Watch user state: This event is linked to $scope.user

			$scope.$watch('isLoggedIn',function(_v){
			});

			$scope.$watch('isSignPage',function(_v){
				if(_v == 'sign-in' || _v == 'sign-up'){
					$timeout(function(){
						$scope.type = _v;
						$scope.triggerState = messageType[1];
						$scope.triggerOverlay();
						$('.call-to-action').show().transition({opacity:1});
					},200);
				}
			});

			$scope.$watch('resetPassword',function(_v){
				if(_v){
					$timeout(function(){
						$scope.triggerState = messageType[1];
						$scope.triggerOverlay();
						$('.call-to-action').show().transition({opacity:1});
					},200);
				}
			});

			$scope.$watch('changePassword',function(_v){
				if(_v){
					$scope.triggerState = messageType[1];
					$scope.triggerOverlay();
				}
			});

			// Watch loading process...

			$scope.$watch('isLoading',function(_v){
				if(_v){
					$scope.triggerState = messageType[3];
					$scope.triggerOverlay();
				}
			});

			// Bind cookie event...

			$rootScope.$on('display-overlay',function(_e,_data){
				if(!$scope.user){
					$scope.triggerState = messageType[1];
					$scope.triggerOverlay();
					$('.call-to-action').show().transition({opacity:1});
				}
			});

			// Trigger password request...

			$('#change-password').on('click',function(_e){
				$scope.changePassword = true;
				$scope.$apply();
				_e.preventDefault();
			});

			// Trigger password request...

			$('#sign-in').on('click',function(_e){
				$rootScope.$emit('display-overlay','');
				$scope.type = $scope.types[1];
				$scope.$apply();
				_e.preventDefault();
			});

			$('#sign-up').on('click',function(_e){
				$rootScope.$emit('display-overlay','');
				$scope.type = $scope.types[0];
				$scope.$apply();
				_e.preventDefault();
			});

			$('#newsletter-trigger').on('click',function(_e){
				$rootScope.$emit('display-overlay','');
				$scope.type = $scope.types[6];
				$scope.$apply();
				_e.preventDefault();
			});

			$('#newsletter-block button.icon-close').on('click',function(_e){
				$(this).parent().transition({top:'-100px'},function(){
					$(this).remove();
				});
				$('body > header').transition({top:'0px'},function(){});
				$('body > main[id="passported-intro"]').transition({top:'0px'},function(){});
				$cookies.put('nUser',true);
				_e.preventDefault();
			});
		});

		ppControllers.controller('SignController',function($scope,$http,$timeout,$cookies){

			$scope.response		 = ['success','error','error-in-login'];
			$scope.rMessage 	 = '';
			$scope.isValid       = true;
			$scope.signInError   = '';
			$scope.signUpError   = '';
			$scope.passwordError = '';
			$scope.newsStatus    = '';
			$scope.loading       = false;

			$scope.data = {
				userName       		: '',
				userLast       		: '',
				userEmail      		: '',
				userPassword   		: '',
				userRepassword 		: '',
				subscribeNewsletter : true
			}

			// Switch bettwen forms...

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
				$scope.newsStatus    = '';
			}

			// Close overlay...

			$scope.closeOverlay = function(){
				$('.call-to-action').transition({opacity:0},function(){
					$(this).hide();
				});
			}

			// Input checker...

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

			// Submit form...

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
		            if(_data.result){

			            var _rf = $(document)[0].referrer.split('.passported.com');

			            if(_rf.length > 1) window.location = $(document)[0].referrer;
			            else window.location.reload();
		            }
			        else{
			            $scope.loading = false;
			            if(_id == 'up') $scope.signUpError = 'Your user already exists';
			            if(_id == 'in') $scope.signInError = 'The user or password is incorrect';
			        }
	            }).
	            error(function(_data){
	            });
			}

			$scope.regNewsletter= function(){
				$http({
	                method : 'POST',
	                url    : formSubmit,
	                data   : $.param({formID:'newsletterForm','userEmail':$scope.data.userEmail}),
	                headers : {
	            		'Content-Type' : 'application/x-www-form-urlencoded'
					},
					transformRequest: angular.identity
	            }).
	            success(function(_data){
		            $scope.newsStatus = 'success';
		            $timeout(function(){
			            $scope.closeOverlay();
			            $('#newsletter-block button.icon-close').trigger('click');
			        },1000);
		        }).
	            error(function(){
		            $scope.newsStatus = 'error';
	            });
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
		            error(function(_data){ });
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
		        });
			}

			// Triggers for password recovery...

			if($scope.$parent.changePassword)
				$scope.switcher('change-password');

			if($scope.$parent.resetPassword)
				$scope.switcher('new-password');
		});

		/* Contact Controller
        ---------------------------------------------------------------------------------------------------------------- */

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

		/* Instagram
        ---------------------------------------------------------------------------------------------------------------- */

		ppControllers.controller('SocialFeedController',function($scope,$rootScope,$location,$timeout,$http){

		    $scope.instagram;

		    $scope.loadInstagram = function(){

				// https://www.instagram.com/oauth/authorize?client_id=&redirect_uri=https://www.passported.com&response_type=code&scope=basic+public_content+follower_list+comments+relationships+likes
                // https://www.instagram.com/oauth/authorize?client_id=&redirect_uri=https://www.passported.com&response_type=token

                var theID = "1058347608";
				var token = "1058347608.e7fe43b.2cb6e683df8245a7af6a50538ecee938"; // 95513defb5a24f8d8d638c1e650e5920
				var endPoint = "https://api.instagram.com/v1/users/self/media/recent/?access_token="+token+"&callback=JSON_CALLBACK";

                $http.jsonp(endPoint).success(function(_data){
					$scope.instagram = _data.data;
				});
            };

            $scope.loadInstagram();

		});
