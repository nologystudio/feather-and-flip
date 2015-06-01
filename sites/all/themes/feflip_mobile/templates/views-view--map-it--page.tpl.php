<?php include 'slideshowandmainmenu.html.php';?>

<section id="map-it" class="full" ng-controller="FullMapCtrl">
    <header class="animated fadeInUp">
        <h3 class="icon compass">MAP IT</h3>
        <nav id="zoom">
            <button rel="zoom-in"></button>
            <button rel="zoom-out"></button>
            <button rel="move"></button>
        </nav>
        <ul role="select" ng-if="!theOrigin">
            <li>filter by continent</li>
            <li>North America</li>
            <li>South America</li>
            <li>Caribbean</li>
            <li>Africa</li>
            <li>Europe</li>
            <li>Asia</li>
            <li>Oceania</li>
        </ul>
        <button rel="full-screen"></button>
    </header>
    <section id="map" ng-click="displayMenu = false"></section>
</section>