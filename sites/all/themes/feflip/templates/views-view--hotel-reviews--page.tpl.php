<?php include 'slideshowandmainmenu.html.php';?>
<?php
        // if exists previous booking we get existing data
        $hotelRates = $inputValues = array();
        if (isset($_SESSION['hotelRates']))
                $hotelRates = $_SESSION['hotelRates'];
        if (isset($_SESSION['inputValues']))
                $inputValues = $_SESSION['inputValues'];

?>
<section id="hotel-reviews">
<header id="booking-header-engine">
				<form id="booking-search" ng-controller="BookingEngineCtrl" ng-include="searchTpl" ng-init="bookingInfo.destination = 0"></form>
			</header>
        <div class="wrapper">
                <h1 class="middle-line">Hotel Reviews</h1>
<ul role="select" class="dark">
					<li>filter by category</li>
					<li>Boutique</li>
					<li>Hip</li>
					<li>Modern</li>
					<li>Classic</li>
					<li>Waterfront</li>
					<li>Kids Club</li>
					<li>Pool</li>
					<li>Gym</li>
					<li>Teens Only</li>
					<li>F+F Favorite</li>
				</ul>
                <?php foreach($hotels as $hotel): ?>
                <?php
                        $rates = Hotel::GetResponseRates($hotelRates, $hotel['sabreCode'], $hotel['expediaCode']);
                        $service = '';
                        if (((float)$rates['expedia']['rate'] < (float)$rates['sabre']['rate']) && ((float)$rates['expedia']['rate'] != 0.0)){
                                $service = 'expedia';
                                $serviceCode = 'expediaCode';
                                $rate = (float)$rates['expedia']['rate'];
                                $curr = $rates['expedia']['currency'];
                        }
                        elseif (((float)$rates['sabre']['rate'] < (float)$rates['expedia']['rate']) && ((float)$rates['sabre']['rate'] != 0.0)) {
                                $service = 'sabre';
                                $serviceCode = 'sabreCode';
                                $rate = (float)$rates['sabre']['rate'];
                                $curr = $rates['sabre']['currency'];
                        }
                ?>
                        <a class="item" href="<?php echo $hotel['url']; ?>"<?php echo (!empty($service) ? ' data-service="'.$service.'"' : ''); ?><?php echo (!empty($service) ? ' data-hotelId="'.$hotel[$serviceCode].'"' : ''); ?>>
                                <figure>
                                        <img src="<?php echo $hotel['image'];?>" alt=""/>
                                </figure>
                                <div>
                                        <h2><?php echo $hotel['name'];?></h2>
                                        <h3><?php echo $hotel['destination'];?></h3>
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
                                        <?php } ?>
                                </div>
                        </a>
                <?php endforeach; ?>
        </div>
        <footer>
                <button rel="load-more">load more</button>
        </footer>
</section>