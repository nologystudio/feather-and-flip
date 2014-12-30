<?php
    $arg = arg();
    if (isset($arg[2]) && ($arg[2] != 'itinerary')) include 'slideshowandmainmenu.html.php'; ?>
<?php
        $showPrice = false;
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

?>
<section id="hotel-reviews"<?php echo ((isset($arg[2]) && ($arg[2] == 'itinerary')) ? ' class="hidden"' : ''); ?>>
<header id="booking-header-engine">
            <?php if(count($inputValues) > 0){?>
                <form id="booking-search" ng-controller="BookingEngineCtrl" ng-include="searchTpl" ng-init='init(<?php echo json_encode($inputValues);?>)'></form>
            <?php } else { ?>
                <form id="booking-search" ng-controller="BookingEngineCtrl" ng-include="searchTpl" ng-init="bookingInfo.destination = <?php if(isset($destinationId)) echo $destinationId; else echo 0;?>"></form>
            <?php } ?>
			</header>
        <div class="wrapper">
                <h1 class="middle-line">Hotel Reviews</h1>
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
				</ul>
            <?php
            if ($showPrice)
            {
                $newHotels = array();

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

                    if (!empty($service)) {
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

                        array_unshift($newHotels, $hotel);
                    }
                    else
                        array_push($newHotels, $hotel);

                }

                $hotels = $newHotels;
            }
            ?>
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
                        <?php } }?>
                </a>
            <?php } ?>
        </div>
    <footer>
        <button rel="load-more">load more</button>
    </footer>
</section>

<div class="service-overlay">
			<div class="content">
				<button rel="close"></button>
				<header>BOOK NOW!</header>
				<div id="expedia-service">
					<button>
						<span>starting from</span>
						<h4>1000$</h4>
					</button>
					<small>book with expedia</small>
				</div>
				<div id="sabre-service">
					<button>
						<span>starting from</span>
						<h4>1000$</h4>
					</button>
					<small>*book with feather+flip</small>
				</div>
				<footer>
					<sup>*</sup>
					Feather+Flip perks may include free breakfasts, room upgrades and spa credits at partner hotels.
				</footer>
			</div>
		</div>