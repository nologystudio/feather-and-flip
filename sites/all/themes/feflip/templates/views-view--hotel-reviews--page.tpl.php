<?php
    $arg = arg();
    if (isset($arg[2]) && ($arg[2] != 'itinerary')) include 'slideshowandmainmenu.html.php'; ?>
<?php
        $showPrice = false;
        $showNotAvailable = false;
        // if exists previous booking we get existing data
        $hotelRates = $inputValues = array();
        if (isset($_SESSION['hotelRates']))
        {
            $showPrice = true;
            $hotelRates = $_SESSION['hotelRates'];
            unset($_SESSION['hotelRates']);
        }
        if (isset($_SESSION['inputValues']))
        {
            $inputValues = $_SESSION['inputValues'];
            unset($_SESSION['inputValues']);
        }

        if ($showPrice)
        {
            $withRate = array();
            $withOutRate = array();

            foreach($hotels as $hotel)
            {
                $rates = Hotel::GetResponseRates($hotelRates, $hotel['sabreCode'], $hotel['expediaCode']);
                $service = '';

                if (((float)$rates['expedia']['rate'] != 0.0) && ((float)$rates['sabre']['rate'] != 0.0))
                {
                    if ((float)$rates['expedia']['rate']  < (float)$rates['sabre']['rate'])
                    {
                        $service = 'expedia';
                        $serviceCode = 'expediaCode';
                        $rate = (float)$rates['expedia']['rate'];
                        $curr = $rates['expedia']['currency'];
                    }
                    else
                    {
                        $service = 'sabre';
                        $serviceCode = 'sabreCode';
                        $rate = (float)$rates['sabre']['rate'];
                        $curr = $rates['sabre']['currency'];
                    }
                }
                elseif(((float)$rates['expedia']['rate'] == 0.0) && ((float)$rates['sabre']['rate'] != 0.0))
                {
                    $service = 'sabre';
                    $serviceCode = 'sabreCode';
                    $rate = (float)$rates['sabre']['rate'];
                    $curr = $rates['sabre']['currency'];
                }
                elseif(((float)$rates['expedia']['rate'] != 0.0) && ((float)$rates['sabre']['rate'] == 0.0))
                {
                    $service = 'expedia';
                    $serviceCode = 'expediaCode';
                    $rate = (float)$rates['expedia']['rate'];
                    $curr = $rates['expedia']['currency'];
                }

                if (!empty($service))
                {
                    $hotel['_service'] = $service;
                    $hotel['_serviceCode'] = $serviceCode;
                    $hotel['_rate'] = $rate;
                    $hotel['_curr'] = $curr;

                    if ((float)$rates['expedia']['rate'] != 0.0) {
                        $hotel['expedia_rate'] = $rates['expedia']['rate'];
                        $hotel['expedia_curr'] = $rates['expedia']['currency'];
                    }
                    
                    if ((float)$rates['sabre']['rate'] != 0.0) {
                        $hotel['sabre_rate'] = $rates['sabre']['rate'];
                        $hotel['sabre_curr'] = $rates['sabre']['currency'];
                    }

                    $withRate[] = $hotel;
                }
                else
                    $withOutRate[] = $hotel;

            }

            if (count($withRate) == 0)
                $showNotAvailable = true;

            //Se define funcion para ordenar por el rate
            function rate_sort($a,$b) {
                if (isset($a['_rate']) && isset($b['_rate'])) {
                    return $a['_rate'] > $b['_rate'];
                }

                return true;
            }

            usort($withRate, "rate_sort");

            $hotels = array_merge($withRate, $withOutRate);
        }

?>
<?php if (isset($arg[2]) && $arg[2] != 'itinerary'): ?>
    <section id="get-rates">
    	<button id="get-rates">get rates</button>
    </section>
<?php endif; ?>
<!-- | i | Booking engine: Landing ------------------------------------------------------- -->
<?php if(count($inputValues) > 0){?>
<section id="booking-engine" ng-controller="BookingEngineCtrl" ng-include="bookingSearch" ng-init='init(<?php echo json_encode($inputValues);?>,0)'></section>
<?php } else { ?>
<section id="booking-engine" ng-controller="BookingEngineCtrl" ng-include="bookingSearch" ng-init="initRate(0,<?php if(isset($destinationId)) echo $destinationId; else echo 0;?>,<?php if(isset($internalId)) echo $internalId; else echo 0;?>)"></section>
<?php } ?>
<!-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  - - - - - - - - - -  -->
<section id="hotel-reviews"<?php echo ((isset($arg[2]) && ($arg[2] == 'itinerary')) ? ' class="hidden"' : ''); ?>>
	<?php if($showNotAvailable){?>
		<div role="header" class="not-available">
			<div>
				<h6>Don't see what you're looking for? Online availability isn't always accurate. <a href="/contact">Contact our team</a> and we'll check with the hotel directly for you.</h6>
			</div>
		</div>
    <?php }?>
    <div class="wrapper">
        <h2 class="middle-line"><?php echo $destinationDescription;?></h2>
        <div id="filter-container">
			<ul role="select" class="dark">
				<li>Reset Filters</li>
			</ul>
			<ul id="filter-list" ng-controller="HotelFilterCtrl">
				<?php
                    $name = 'hoteltags';
                    $myvoc = taxonomy_vocabulary_machine_name_load($name);
                    $tree = taxonomy_get_tree($myvoc->vid);
                    foreach ($tree as $term) {
                        echo '<li><span></span>'.$term->name.'</li>';
                    }
                ?>
			</ul>
		</div>
		<?php foreach($hotels as $hotel){ $hClasses = implode(' ', $hotel['categories']);?>
            <a class="item<?php echo (!empty($hClasses) ? ' '.$hClasses : ''); ?>" href="<?php echo $hotel['url']; ?>"<?php echo (!empty($hotel['_service']) ? ' data-service="'.$hotel['_service'].'"' : ''); ?><?php echo (!empty($hotel['_service']) ? ' data-hotelId="'.$hotel[$hotel['_serviceCode']].'"' : ''); ?> data-internalId="<?php echo $hotel['id'] ?>"
            <?php if (isset($hotel['expedia_rate'])){echo 'data-expedia = "'.$hotel['expedia_rate'] .' '. $hotel['expedia_curr'].'|' . $hotel['expediaCode'].'" ';} if (isset($hotel['sabre_rate'])){echo 'data-sabre = "'.$hotel['sabre_rate'] .' '. $hotel['sabre_curr'].'|' . $hotel['sabreCode'] .'"';}?>>
                <figure>
                    <img src="<?php echo $hotel['image'];?>" alt=""/>
                </figure>
                <div id="hotel-name">
                    <h2><?php echo $hotel['name'];?></h2>
                </div>
                <div id="hotel-destination">
                    <h3><?php echo $hotel['destination'];?></h3>
                </div>
                
                <?php if($showPrice){?>
                    <?php if (!empty($hotel['_service'])) { ?>
                        <button rel="booking" class="animated fadeInUp">
                            <span>starting from</span>
                            <h4><?php echo $hotel['_rate']; ?> <?php echo $hotel['_curr']; ?></h4>
                        </button>
                    <?php } else { ?>
                        <button rel="booking" class="warning animated fadeInUp">
                            <span>not</span>
                            <h4>available</h4>
                        </button>
                    <?php } } else {?>
                    <h4 class="description"><?php echo $hotel['hotelDescription'];?></h4>
                <?php } ?>
            </a>
        <?php } ?>
    </div>
    <div class="city-guide-block"><a href="">View our city guide for...</a></div>
</section>
<?php if (isset($travel_journal) && !empty($travel_journal)) print $travel_journal; ?>
