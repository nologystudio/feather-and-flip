<?php include 'slideshowandmainmenu.html.php';?>

<?php
// if exists previous booking we get existing data
$hotelDescription = $inputValues = array();
if (isset($_SESSION['hotelDescription']))
{
    $hotelDescription = $_SESSION['hotelDescription'];
    unset($_SESSION['hotelDescription']);
}

$dataInputValues = '';
if (isset($_SESSION['inputValues']))
{
    $inputValues = $_SESSION['inputValues'];
    $dataInputValues = 'data-inputvalues=\''. json_encode($inputValues) . '\'';
    unset($_SESSION['inputValues']);
}

$datas = '';

if (isset($hotelDescription) && !empty($hotelDescription))
    $datas .= 'data-Result=\''. str_replace("'", "&#39;", json_encode($hotelDescription)) . '\'';

if(isset($inputValues['service']) && !empty($inputValues['service']))
    $datas .= 'data-service="'.$inputValues['service'] . '"';

?>

<section id="hotel" <?php echo $datas . ' ' . $dataInputValues; ?>>
        <header id="booking-header-engine">
            <form id="booking-search" ng-controller="BookingEngineCtrl" ng-include="searchTpl"></form>
        </header>

    <!-- | i | Booking engine: Room detail --------------------------------------------------- -->
    <?php if(count($inputValues) > 0){?>
    <section id="booking-engine" ng-controller="BookingEngineCtrl" ng-include="booking" ng-init='init(<?php echo json_encode($inputValues);?>);state=3'></section>
    <?php } else {?>
    <section id="booking-engine" ng-controller="BookingEngineCtrl" ng-include="booking" ng-init="state=3"></section>
    <?php } ?>
    <!-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  - - - -  - - - -  -  -->

    <article id="detail">
                <header>
                        <a href="<?php echo $hotelreviews;?>" rel="all">view all hotels in destination</a>
                        <h1 class="middle-line"><?php echo $node->title;?></h1>
                        <a href="<?php echo $previous;?>" rel="prev">previous hotel</a>
                        <a href="<?php echo $next;?>" rel="next">next hotel</a>
                        <div id="category">
                                <div class="star"></div>
                                <div class="star"></div>
                                <div class="star"></div>
                                <div class="star"></div>
                                <div class="star"></div>
                        </div>
                </header>
                <!-- Gallery starts here -->
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
                    <button rel="left"></button>
                    <button rel="right"></button>
                </div>
        </article>

        <article id="features">
                <!-- Features -->
                <?php foreach($features as $obj){?>
                <ul class="row">
                    <?php foreach($obj as $contentblock) {?>
                        <li>
                                <ul>
                                        <li id="<?php echo strtolower($contentblock['title']) ?>"><?php echo $contentblock['title'] ?></li>
                                         <?php $i=1; foreach($contentblock['features'] as $feature) {?>
                                            <li><span>&bull;</span><?php echo $feature; ?></li>
                                         <?php } ?>
                                </ul>
                        </li>
                    <?php } ?>    
                </ul>
                <?php } ?>
                
                <footer>
					<h3 class="middle-line">Share this</h3>
					<nav id="social-media">
						<a target="_blank" href="<?php echo getSocialLink('twitter', url('node/'.$node->nid, array('absolute' => TRUE))); ?>" rel="twitter"></a>
						<a target="_blank" href="<?php echo getSocialLink('facebook', url('node/'.$node->nid, array('absolute' => TRUE))); ?>" rel="facebook"></a>
						<a target="_blank" href="<?php echo getSocialLink('pinterest', url('node/'.$node->nid, array('absolute' => TRUE)), $images[0]['url'], $features[0][0]['features'][0]); ?>" rel="pinterest"></a>
						<a target="_blank" href="<?php echo getSocialLink('google+', url('node/'.$node->nid, array('absolute' => TRUE))); ?>" rel="google-plus"></a>
					</nav>
                        <h3 class="middle-line">Info</h3>
                        <h4>
                                <ul>
                                        <?php if(count($node->field_adress_1) == 1){ ?>
                                        <li><?php echo $node->field_adress_1['und'][0]['value'];?></li>
                                        
                                        <?php } if(count($node->field_adress_2) == 1){ ?>
                                        <li><?php echo $node->field_adress_2['und'][0]['value'];?></li>
                                        
                                        <?php } if(count($node->field_phone_number) == 1){ ?>
                                        <li><?php echo $node->field_phone_number['und'][0]['value'];?></li>
                                        
                                        <?php } if(count($node->field_hotel_url) == 1){
                                            $url_text = (isset($node->field_hotel_url_text['und']) ? $node->field_hotel_url_text['und'][0]['value'] : $node->field_hotel_url['und'][0]['value']); ?>
                                        <!--<li><a href="<?php echo 'http://'.$node->field_hotel_url['und'][0]['value'];?>" target="_blank"><?php echo $url_text;?></a></li>-->
                                        <?php } ?>
                                </ul>
                        </h4>
                </footer>
        </article>
        <footer>
                <a href="#" rel="terms-and-conditions"></a>
                <a href="#" rel="map"></a>
                <a href="#" rel="tripadvisor"></a>
        </footer>
</section>