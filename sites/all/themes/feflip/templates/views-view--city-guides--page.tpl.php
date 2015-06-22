<?php include 'slideshowandmainmenu.html.php';?>

<section id="map-it" class="full" ng-controller="FullMapCtrl" data-origin="<?php echo arg(1); ?>">
    <header class="animated fadeInUp">
        <h3 class="icon compass">MAP IT</h3>
        <nav id="zoom">
            <button rel="zoom-in"></button>
            <button rel="zoom-out"></button>
            <button rel="move"></button>
        </nav>
        <div id="address-filter" class="animated fadeIn">
	        <small>Filter by category</small>
            <button ng-repeat="type in selectedDestination.summaries" rel="{{type.name}}" ng-click="filterMap(type.name)" ng-class="{'on':bookFilter == type.name}"></button>
            <button ng-click="filterMap(undefined)" class="view-all" ng-if="bookFilter">view all</button>
        </div>
    </header>
    <section id="map" ng-click="displayMenu = false"></section>
    <aside class="destination-block" ng-class="{'on':displayMenu}">
	    <button rel="open" ng-click="displayAside()" ng-class="{'close':displayMenu}">
	    	<div class="icon-wrapper">
		    	<div class="icon">&#x24;</div>
	    	</div>
	    </button>
	    <div class="wrapper">
	    	<ul ng-class="{'step-1':step == 1,'step-2':step == 2,'step-3':step == 3}">
			    <li id="step-1">
			    	<header>
				    	<h1>Choose a destination</h1>
			    	</header>
			    	<ul>
				    	<li ng-repeat="place in destinations">
				    		<button ng-click="displayDestination(place)" class="animated fadeIn">
					    		<figure>
					    			<img ng-src="{{place.image.url}}" alt="{{place.destination}}"/>
					    		</figure>
					    		<div role="figcaption">
						    		<h2>{{place.destination}}</h2>
						    		<h3 ng-bind-html="place.description"></h3>
								</div>
								<div class="right-arrow"></div>
				    		</button>
				    	</li>
			    	</ul>
			    </li>
			    <li id="step-2">
			    	<header>
				    	<button rel="menu" ng-click="step = 1" ng-if="!theOrigin"></button>
				    	<figure>
				    		<img ng-src="{{selectedDestination.image.url}}" alt="{{selectedDestination.destination}}"/>
				    	</figure>
				    	<h1>{{selectedDestination.destination}} guide</h1>
				    	<h2>{{selectedDestination.latitude}} LAT, {{selectedDestination.longitude}} LON</h2>
				    	<h3 ng-bind-html="selectedDestination.description"></h3>
			    	</header>
			    	<ul>
				    	<li ng-repeat="type in selectedDestination.summaries">
				    		<button class="{{type.name}}" ng-click="filterMap(type.name)">
				    			<h4>{{type.name}}</h4>
				    			<p>{{type.dsc}}</p>
				    			<div class="right-arrow"></div>
				    		</button>
				    	</li>
			    	</ul>
			    </li>
			    <li id="step-3">
			    	<header>
				    	<h1 class="{{bookFilter}}">{{bookFilter != undefined ? bookFilter : "all"}}</h1>
			    	</header>
			   		<aside>
				   		<button rel="menu" ng-click="step = 2"></button>
				   		<button ng-repeat="type in selectedDestination.summaries" rel="{{type.name}}" ng-click="filterMap(type.name)" ng-class="{'on':bookFilter == type.name}"></button>
				   		<button ng-click="filterMap(undefined)" ng-class="{'on':bookFilter == undefined}" class="view-all">view all</button>
				   		<button rel="print" ng-click="printList()"></button>
				   	</aside>
			    	<ul>
				    	<li ng-repeat="address in theBook" ng-click="displayAddress(address)" ng-click="zoomMap(address)" ng-if="filterAddress(address)" ng-class="{'on':selectedAB == address.title}" data-title="{{address.title}}">
				    		<p>
					    		<span>{{address.title}}</span>
					    		<span ng-bind-html="address.review"></span>
								<span ng-if="address.phone" class="phone"><span>&#xe090;</span>{{address.phone}}</span>
				    		</p>
				    	</li>
			    	</ul>
			    </li>
	    	</ul>
	    </div>
    </aside>
</section>