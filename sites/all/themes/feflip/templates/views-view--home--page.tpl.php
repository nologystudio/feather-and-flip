<?php include 'slideshowandmainmenu.html.php';?>

<?php

/***************************** Pruebas de rate codes *******************************************/
/*
$rates = Hotel::GetHotelRateCodesBydestination(142);
dpm($rates);
$codes = Hotel::GetHotelCodesByDestination(142);
$sabreService = new Sabre;
$result = $sabreService->ListHotelAvail($codes['sabre'],$rates,2,'2015-01-11','2015-01-19');
dpm($result);
*/
/*********************************** Fin de prueba *********************************************/

/************************************* Prueba funcional de booking ***************************************/

/*
$sabreService = new Sabre;
$star = '2015-01-11';
$end = '2015-01-19';
$hotelCode = '0054271';//'0050313' con este hotel funciona la reserva;
$expediaHC = '113127';
$numPersonas = 1;
$mail = 'mail@testing.com';

$sessionInfo = $sabreService->CreateSession();
$_SESSION['sabreSession'] = $sessionInfo;

try {

    $values = array(
        'service'=>'sabre',
        'roomCode'=>'2',
        'numUnit'=>'1',
        'firstName'=>'TEST',
        'lastName'=>'TEST',
        'email'=>'mail@testing.com',
        'phone'=>'123456',
        'guaranteeType'=>'GDPST',
        'creditCardCode'=>'VI',
        'creditCardNumber'=>'4111111111111111',
        'creditCardExpireDate'=>'2015-12',
        'checkIn' => $star,
        'checkOut' => $end
    );

    $result = $sabreService->HotelDescription($sessionInfo,$hotelCode, $numPersonas, $star, $end);
    dpm($result);
    $result = AdminForms::hotelBookingReservation($values);
    dpm($result);
}
catch(Exception $e){dpm($e->getMessage());}
finally
{
    $sabreService->CloseSession($sessionInfo);
    unset($_SESSION['sabreSession']);
}
*/

/************************************* Fin prueba  **********************************************************/
?>

<section id="start-your-journey">
        <header>
            <h3 class="simple">Collections</h3>
        </header>
        <div id="miss-slideshow" ng-controller="SlideshowCtrl">
            <ul>
            <?php foreach($collections as $key => $collection){ ?>
                <li>
                    <a href="<?php echo $collection['url']?>">
                            <figure class="circle-mask">
                                    <img src="<?php echo $collection['image'];?>" alt=""/>
                                    <div class="border"></div>
                            </figure>
                            <h2><?php echo $collection['title']?></h2>
                    </a>
                 </li>
                <?php } ?>
            </ul>
            <button rel="left"></button>
            <button rel="right"></button>
        </div>
        <footer>
                <a href="" class="section-button"></a>
        </footer>
</section>
<!-- | i | Booking engine: Landing ------------------------------------------------------- -->
<section id="booking-engine" ng-controller="BookingEngineCtrl" ng-include="bookingSearch"></section>
<!-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  - - - - - - - - - -  -->
<?php
// Print Travel journal section
echo $travel_journal; ?>

<section id="press">
    <?php if (isset($press)) { ?>
        <ul class="logo-gallery">
            <?php foreach ($press as $nid => $press_node) { 
                $press_wrapper = entity_metadata_wrapper('node', $press_node);
                $press_id = str_replace(' ', '-', strtolower($press_wrapper->title->value()));
                $press_src = file_create_url($press_wrapper->field_image->file->value()->uri);
                $press_alt = $press_wrapper->title->value(); ?>
                <li>
                    <figure id="<?php echo $press_id; ?>">
                        <img src="<?php echo $press_src; ?>" alt="<?php echo $press_alt; ?>"/>
                    </figure>
                </li>
            <?php } ?>
        </ul>
    <?php } ?>
</section>

<section id="map-it" ng-controller="MapCtrl">
        <header>
                <h3 class="icon compass">MAP IT<span> where to go now </span></h3>
        </header>
        <aside>
                <nav>
                        <div class="tab" ng-click="displayMenu()"></div>
                        <ul>
                                <li data-image=""><span>hotels</span>destination</li>
                                <?php foreach($destinations as $destination){ ?>
                                    <li data-image=""><span><?php echo $destination['numhotels']; ?></span><a href="<?php echo $destination['url']. '/hotel-reviews';?>"><?php echo $destination['destination']; ?></a></li>
                                <?php } ?>
                        </ul>
                        <figure>
                                <img src="" alt=""/>
                        </figure>
                </nav>
        </aside>
        <div id="map">
        </div>
        <footer>
                <a href="/map-it" class="section-button">view all</a>
        </footer>
</section>