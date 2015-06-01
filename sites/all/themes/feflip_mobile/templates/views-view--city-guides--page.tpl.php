<?php include 'slideshowandmainmenu.html.php';?>

<section id="map-it" class="full" ng-controller="FullMapCtrl" data-origin="<?php echo arg(1); ?>">
    <header class="animated fadeInUp">
        <h3 class="icon compass">MAP IT</h3>
        <nav id="zoom">
            <button rel="zoom-in"></button>
            <button rel="zoom-out"></button>
            <button rel="move"></button>
        </nav>
    </header>
    <section id="map"></section>
 </section>