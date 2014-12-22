<?php include 'slideshowandmainmenu.html.php';?>
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
<section id="hotel-reviews">
<header id="booking-header-engine">
            <?php if(count($inputValues) > 0){?>
                <form id="booking-search" ng-controller="BookingEngineCtrl" ng-include="searchTpl" ng-init='init(<?php echo json_encode($inputValues);?>)'></form>
            <?php } else { ?>
                <form id="booking-search" ng-controller="BookingEngineCtrl" ng-include="searchTpl" ng-init="bookingInfo.destination = 0"></form>
            <?php } ?>
			</header>
        <div class="wrapper">
                <h1 class="middle-line">Hotel Reviews</h1>
                <div id="filter-container">
					<ul role="select" class="dark">
						<li>filter by category</li>
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
                <?php foreach($hotels as $hotel): ?>
                <?php
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

                        // hotel categories classes
                        $hClasses = implode(' ', $hotel['categories']);
                ?>

                         <a class="item<?php echo (!empty($hClasses) ? ' '.$hClasses : ''); ?>" href="<?php echo $hotel['url']; ?>"<?php echo (!empty($service) ? ' data-service="'.$service.'"' : ''); ?><?php echo (!empty($service) ? ' data-hotelId="'.$hotel[$serviceCode].'"' : ''); ?> data-internalId="<?php echo $hotel['id'] ?>">
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
                            <?php if (!empty($service)) { ?>
                                    <button rel="booking" class="animated fadeInUp">
                                            <span>starting from</span>
                                            <h4><?php echo $rate; ?> <?php echo $curr; ?></h4>
                                    </button>
                            <?php } else { ?>
                                    <button rel="booking" class="warning animated fadeInUp">
                                            <span>not</span>
                                            <h4>available</h4>
                                    </button>
                            <?php } }?>
                        </a>
                <?php endforeach; ?>
        </div>
        <footer>
                <button rel="load-more">load more</button>
        </footer>
</section>