<?php

include 'slideshowandmainmenu.html.php';

// if exists previous booking we get existing data

$hotelDescription = $inputValues = array();
$datas = '';

if (isset($_SESSION['hotelDescription'])){
    $hotelDescription = $_SESSION['hotelDescription'];
    unset($_SESSION['hotelDescription']);
}

if (isset($_SESSION['inputValues'])){
    $inputValues = $_SESSION['inputValues'];
    unset($_SESSION['inputValues']);
}

if (isset($hotelDescription) && !empty($hotelDescription))
    $datas .= 'data-Result=\''. str_replace("'", "&#39;", json_encode($hotelDescription)) . '\'';

if(isset($inputValues['service']) && !empty($inputValues['service']))
    $datas .= 'data-service="'.$inputValues['service'] . '"';

?>

<section id="get-rates">
	<button id="get-rates">get rates</button>
</section>

<!-- | i | Booking engine: Landing --------------------------------------------------------------------------------------------------------------- -->

<?php if(count($inputValues) > 0){?>
	<section id="booking-engine" ng-controller="BookingEngineCtrl" ng-include="bookingSearch" ng-init='init(<?php echo json_encode($inputValues);?>,0)'></section>
<?php } else { ?>
	<section id="booking-engine" ng-controller="BookingEngineCtrl" ng-include="bookingSearch" ng-init="initRate(0,<?php if(isset($destination)) echo $destination; else echo 0;?>,<?php if(isset($internalId)) echo $internalId; else echo 0;?>)"></section>
<?php } ?>

<!-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -->

<article id="hotel" <?php echo $datas ?> ng-controller="HotelCtrl" ng-init="loadMap(<?php echo isset($node->field_latitude['und'][0]['value']) ? $node->field_latitude['und'][0]['value'] : '0'; ?>,<?php echo isset($node->field_longitude['und'][0]['value']) ? $node->field_longitude['und'][0]['value'] : '0'; ?>)">
	
    <!-- | i | Booking engine: Room detail ------------------------------------------------------------------------------------------------------ -->
    
    <?php if(count($inputValues) > 0){?>
    <section id="booking-engine" ng-controller="BookingEngineCtrl" ng-include="booking" ng-init='init(<?php echo json_encode($inputValues);?>, 3)'></section>
    <?php } else {?>
    <section id="booking-engine" ng-controller="BookingEngineCtrl" ng-include="booking" ng-init="init({},3)"></section>
    <?php } ?>
    
    <!-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  -->

    <section id="detail">
        <header>
            <a href="<?php echo $hotelreviews;?>" rel="all">
	            <figure>
					<img src="<?php echo $image['url'];?>" alt="destination"/>
				</figure>
				<?php echo $destinationText;?>
            </a>
            <h1 class="middle-line"><?php echo $node->title;?></h1>
            <a href="<?php echo $previous;?>" rel="prev">previous hotel</a>
            <a href="<?php echo $next;?>" rel="next">next hotel</a>
        </header>
        <div class="gallery-wrapper">
            <div id="hotel-gallery" class="one-item" ng-controller="SlideshowCtrl">
                <ul>
                    <?php foreach($images as $image){ ?>
                        <li>
                            <article>
                                <figure>
                                    <img src="<?php echo $image['url'];?>" alt="<?php echo $image['alt']?>"/>
                                </figure>
                            </article>
                        </li>
                    <?php } ?>
                </ul>
            </div>
            <div class="gallery-ui">
				<div id="gallery-state-bar">
					<ul class="pages"></ul>
				</div>
                <button rel="left"></button>
                <button rel="right"></button>
            </div>
        </div>
    </section>

    <section id="features">
        <?php foreach($features as $obj){?>
            <ul class="row">
                <?php foreach($obj as $contentblock) {?>
                    <li>
                        <ul>
                            <li id="<?php echo strtolower($contentblock['title']) ?>"><span></span><?php echo $contentblock['title'] ?></li>
                            <?php foreach($contentblock['features'] as $feature) {?>
							<li><span>&bull;</span><?php echo $feature; ?></li>
                            <?php } ?>
                        </ul>
                    </li>
                <?php } ?>    
            </ul>
        <?php } ?>
    </section>
    
    <section id="map-it" class="short" <?php if (isset($destination) && !empty($destination)) echo 'data-destination = "'.$destination.'"';?>>
		<header class="animated fadeInUp">
	        <h3></h3>
	        <a href="https://www.google.com/maps?q=<?php echo isset($node->field_latitude['und'][0]['value']) ? $node->field_latitude['und'][0]['value'] : '0'; ?>,<?php echo isset($node->field_longitude['und'][0]['value']) ? $node->field_longitude['und'][0]['value'] : '0'; ?>" target="_blank" rel="google-maps">View on Google Maps</a>
	    </header>
		<section id="map" class="single"></section>
	</section>
	
	<section id="hotel-info">
		<ul>
			<li id="address">
				<?php if(count($node->field_adress_1) == 1) echo $node->field_adress_1['und'][0]['value']; ?>
			</li>
			<li id="phone">
				<?php if(count($node->field_phone_number) == 1) echo $node->field_phone_number['und'][0]['value']; ?>
			</li>
			<li id="sharing">
				<nav id="social-media">
					<a target="_blank" href="<?php echo getSocialLink('twitter', url('node/'.$node->nid, array('absolute' => TRUE))); ?>" rel="twitter"></a>
					<a target="_blank" href="<?php echo getSocialLink('facebook', url('node/'.$node->nid, array('absolute' => TRUE))); ?>" rel="facebook"></a>
					<a target="_blank" href="<?php echo getSocialLink('pinterest', url('node/'.$node->nid, array('absolute' => TRUE)), $images[0]['url'], $features[0][0]['features'][0]); ?>" rel="pinterest"></a>
					<a target="_blank" href="<?php echo getSocialLink('google+', url('node/'.$node->nid, array('absolute' => TRUE))); ?>" rel="google-plus"></a>
				</nav>
				<span>share hotel</span>
			</li>
		</ul>
	</section>

    <?php if (count($testimonials) > 0){?>
	<section id="hotel-testimonials">
		<header>
			<h5>Recent Review<span></span></h5>
			<div class="divider"></div>
		</header>
        <?php foreach($testimonials as $testimonial){?>
		<blockquote>
			<?php echo $testimonial['testimonial'];?>
			<footer>- <?php echo $testimonial['person'];?></footer>
		</blockquote>
        <?php }?>
		<footer>
			<button rel="load-more">load more</button>
		</footer>
	</section>
    <?php } ?>
</article>
