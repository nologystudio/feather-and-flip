<?php include 'slideshowandmainmenu.html.php';?>

<section id="booking-engine">
    <div id="step-5">
        <header>
            <div class="wrapper">
                <div class="feather"></div>
                <h1>Thank you!</h1>
                <h2>Booking ID <?php echo $booking['id'];?></h2>
                <h3>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text.</h3>
            </div>
        </header>
        <div class="wrapper">
            <div id="booking-info">
                <ul id="selection-detail">
                    <li>
                        <span>Name</span>
                        <span><?php echo $booking['firstName'];?></span>
                    </li>
                    <li>
                        <span>Last</span>
                        <span><?php echo $booking['lastName'];?></span>
                    </li>
                    <li>
                        <span>Email</span>
                        <span><?php echo $booking['mail'];?></span>
                    </li>
                    <li>
                        <span>Phone</span>
                        <span>...</span>
                    </li>
                    <li>
                        <span>Credit card number</span>
                        <span>...</span>
                    </li>
                    <li>
                        <span>Room Type</span>
                        <span>...</span>
                    </li>
                    <li>
                        <span>Check-in</span>
                        <span><?php echo $booking['checkIn'];?></span>
                    </li>
                    <li>
                        <span>Check-out</span>
                        <span><?php echo $booking['checkOut'];?></span>
                    </li>
                    <li>
                        <span>Nights</span>
                        <span>...</span>
                    </li>
                    <li>
                        <span>Rooms</span>
                        <span>...</span>
                    </li>
                    <li>
                        <span>Adults</span>
                        <span>...</span>
                    </li>
                    <li class="clear-border">
                        <span>Children</span>
                        <span>...</span>
                    </li>
                    <li>
                        <span>Total</span>
                        <span><?php echo $booking['rate'];?></span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>