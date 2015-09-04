<?php include 'slideshowandmainmenu.html.php';?>

<section id="booking-engine" class="expanded" ng-controller="BookingEngineCtrl">
    <div id="booking-reference">
        <header>
            <div class="feather-logo"></div>
            <?php if($booking['service'] == 'expedia') {?>
            <h3>Thank you for booking with Passported and the Expedia Affiliate Network. We only recommend hotels we know and love, and we hope you feel the same way. Read on for your confirmation number, hotel cancellation policy and contact details.</h3>
		    <?php } else { ?>
                <h3>Thank you for booking with Passported and Tzell Travel Group. We only recommend hotels we know and love, and we hope you feel the same way. Read on for your confirmation number, hotel cancellation policy and contact details.</h3>
            <?php } ?>
        </header>
		<?php if (!empty($booking['cancellationNumber'])) { ?>
	        <div id="booking-id" class="module">
		        <header>
			        <?php if($booking['service'] == 'expedia'): ?>
			        <figure><img src="/sites/all/themes/feflip_mobile/media/services/expedia-service-email.png"/></figure>
			        <?php else: ?>
			        <figure><img src="/sites/all/themes/feflip_mobile/media/services/f+f-service-email.png"/></figure>
			        <?php endif; ?>
			        <h4>Your reservation cancellation is pending. 
	Your cancellation request has been received and forwarded to the hotel, it is currently pending their response. For further actions the Call Center.</h4>
				</header>
		        <ul class="content">
		        	<li><span>Cancellation Number:</span><?php echo $booking['cancellationNumber'];?></li>
			        <li><span>Customer Name:</span><?php echo $booking['firstName'];?> <?php echo $booking['lastName'];?></li>
			        <li><span>Customer Email:</span><?php echo $booking['mail'];?></li>
			        <li><span>Itinerary Number:</span><?php echo $booking['id'];?></li>
		        </ul>
		        <small>Please refer to your Itinerary Number if you contact customer service for any reason.</small>
	        </div>
		<?php } else { ?>
	        <div id="booking-id" class="module">
		        <header>
			        <?php if($booking['service'] == 'expedia'): ?>
			        <figure><img src="/sites/all/themes/feflip_mobile/media/services/expedia-service-email.png"/></figure>
			        <?php else: ?>
			        <figure><img src="/sites/all/themes/feflip_mobile/media/services/f+f-service-email.png"/></figure>
			        <?php endif; ?>
			        <h4>The booking you recently made on the featherandflip.com website is confirmed. 
	Your reservation details are below.</h4>
				</header>
		        <ul class="content">
			        <li><span>Customer Name:</span><?php echo $booking['firstName'];?> <?php echo $booking['lastName'];?></li>
			        <li><span>Customer Email:</span><?php echo $booking['mail'];?></li>
			        <li><span>Itinerary Number:</span><?php echo $booking['id'];?></li>
		        </ul>
		        <small>Please refer to your Itinerary Number if you contact customer service for any reason.</small>
	        </div>
		<?php } ?>
        <div id="hotel" class="module">
	        <header>Hotel <?php echo $booking['hotelName'];?></header>
	        <ul class="content">
		        <li><span>Address:</span><?php echo $booking['hotelAddress'];?></li>
		        <li><span>Phone:</span><?php echo $booking['hotelPhone'];?></li>
		        <li><span>Check-in:</span><?php echo $booking['checkIn'];?></li>
		        <li><span>Check-out:</span><?php echo $booking['checkOut'];?></li>
		        <li><span>Number of nights:</span><?php echo $booking['nights'];?></li>
		        <li><span>Number of guests:</span><?php echo ($booking['adults'] + $booking['children']); ?></li>
	        </ul>
        </div>
        <div id="room-detail" class="module">
	        <header>Room Details</header>
	        <ul id="" class="content col-5 smaller">
		        <li class="black">#</li>
		        <li>1</li>
	        </ul>
	        <ul id="" class="content col-5">
		        <li class="black">Room Type</li>
		        <li><?php echo $booking['roomType'];?></li>
	        </ul>
	        <ul id="" class="content col-5">
		        <li class="black">Reserved for</li>
		        <li><?php echo $booking['firstName']. ', ' .($booking['adults'] + $booking['children']);?></li>
	        </ul>
	        <ul id="" class="content col-5">
		        <li class="black">Confirmation number</li>
                <?php if($booking['service'] == 'expedia'): ?>
                    <li><?php echo $booking['confirmationNumber'];?></li>
                <?php else:?>
		        <li><?php echo $booking['id'];?></li>
                <?php endif;?>
	        </ul>
	        <ul id="" class="content col-5">
		        <li class="black">Refundable</li>
		        <li>No</li>
	        </ul>
	        <small>*Please note: Preferences and special requests cannot be guaranteed. Special requests are subject to availability upon check-in and may incur additional charges.</small>
        </div>
        <div id="charges" class="module">
	        <header>Charges</header>
	        <small><span>Cost per night and per room in USD$</span>(Excluding tax recovery charges and service fees)</small>
	        <ul id="dates" class="content col-3">
		        <li class="black">Dates</li>
                <?php $i=0; foreach($booking['nightlyRates'] as $nightlyRate){?>
		        <li><?php /*echo $booking['checkIn'];?> to <?php echo $booking['checkOut'];*/?><?php echo date('m/d/Y', strtotime($booking['checkIn'].' + '.($i++).' day'));?></li>
                <?php } ?>
	        </ul>
	        <ul id="rooms" class="content col-3 right">
		        <li class="black">Room 1</li>
                <?php foreach($booking['nightlyRates'] as $nightlyRate){?>
		        <li><?php echo $nightlyRate;?></li>
                <?php } ?>
		    </ul>
	        <ul id="total" class="content col-3 right">
		        <li class="black">Total per night</li>
                <?php foreach($booking['nightlyRates'] as $nightlyRate){?>
		        <li class="black"><?php echo $nightlyRate;?></li>
                <?php } ?>
	        </ul>
	        <small id="other-charges-title">Other Charges, fees and savings in USD$</small>
	        <ul id="fees" class="content col-2">
		        <li class="black">Item</li>
		        <li>Tax Recovery Charges and Service Fees</li>
	        </ul>
	        <ul id="total" class="content col-2">
		        <li class="black">Total</li>
		        <li class="black"><?php echo $booking['taxRate'];?></li>
	        </ul>
        </div>
        <div id="total" class="module grey">
	        <small><span>Total cost for entire stay in USD$</span>(Including tax recovery charges and service fees)</small>
	        <ul id="payment" class="content col-2">
		        <li class="black">Payment status</li>
		        <li>PAID</li>
	        </ul>
	        <ul id="cost" class="content col-2">
		        <li class="black">Total cost of stay</li>
		        <li><?php echo $booking['rate'];?></li>
	        </ul>
        </div>
        <div id="payment-info" class="module">
	        <header>
		        Payment Info
		        <h4>We have charged your credit card for the full payment of this reservation.</h4>
			</header>
	        <ul class="content">
		        <li><span>Payment card name:</span><?php echo $booking['firstName'];?> <?php echo $booking['lastName'];?></li>
		        <li><span>Billing Address:</span><?php echo $booking['address'] .', ' . $booking['cityCode']. ', ' . $booking['postalCode']?></li>
		        <li><span>Itinerary Number:</span><?php echo $booking['id'];?></li>
	        </ul>
	        <?php if($booking['service'] == 'expedia') {?>
	        	<small>The above charges to your credit card were made by Travelscape, LLC. View our full <a href="http://travel.ian.com/index.jsp?pageName=userAgreement&locale=en_US&cid=456134" target="_blank">EAN Terms and Conditions.</a></small>
	        <?php } ?>
        </div>
        <div id="cancellation" class="module">
	        <header>Cancellation Policy</header>
	        <ul class="content">
		        <li><span>Room 1</span></li>
		        <li><?php echo $booking['cancellationPolicy'];?></li>
	        </ul>
        </div>
        <div id="support" class="module">
	        <header>Customer Support Contact Info</header>
	        <ul class="content">
		        <li><?php if($booking['service'] == 'expedia'): ?>
		        	<figure>
		        		<img src="/sites/all/themes/feflip_mobile/media/services/expedia-service-email.png"/>
		        	</figure>
		        	<?php if (empty($booking['cancellationNumber'])) { ?>
		        		<a ng-click="cancel('confirm')" target="_blank">Change or cancel your reservation with Expedia/TravelNow</a>
		        	<?php } ?>
		        	<?php else: ?>
		        	<a href="/contact">Contact us</a> or call our Customer Support (646) 854-3386
		        	<?php endif; ?>
		        </li>
	        </ul>
        </div>
    </div>
</section>

<div class="cancel-confirmation-overlay" data-cancellation="<?php echo $booking['mail'];?>|<?php echo $booking['id'];?>|<?php echo $booking['confirmationNumber'];?>|<?php echo $booking['service'];?>">
	<div class="content">
		<small>
			Are you sure you want to cancel this reservation?
			<div>
				<button id="confirm-cancellation">Yes</button>
				<button id="not-confirm-cancellation">No,thanks</button>
			</div>
		</small>
	</div>
</div>