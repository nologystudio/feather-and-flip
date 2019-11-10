
	<!-- Press -->

	<section id="press">
		<?php if(isset($press)){ ?>
        <ul class="logo-gallery">
	        <?php $counter = 1; ?>
            <?php foreach ($press as $nid => $press_node){
                $press_wrapper = entity_metadata_wrapper('node', $press_node);
                $press_id = str_replace(' ', '-', strtolower($press_wrapper->title->value()));
                $press_src = file_create_url($press_wrapper->field_image->file->value()->uri);
                $press_alt = $press_wrapper->title->value(); ?>
                <li>
                    <figure id="<?php echo $press_id; ?>" data-animate="<?php echo $counter++; ?>">
                        <img src="<?php echo $press_src; ?>" alt="<?php echo $press_alt; ?>"/>
                    </figure>
                </li>
            <?php } ?>
        </ul>
		<?php } ?>
    </section>

	<!-- Footer -->

	<footer>
		<nav>
			<ul>
				<li><span class="icon destinations"></span>destinations</li>
				<?php foreach ($footer_destinations_menu as $destination){ ?>
				<li><a href="<?php echo $destination['url'].'/city-guide'; ?>"><?php echo $destination['withcountry']?></a></li>
				<?php } ?>
			</ul>
			<ul>
				<li><span class="icon popular"></span>popular hotels</li>
				<?php foreach ($footer_hotels_menu as $hotel){ ?>
				<li><a href="<?php echo $hotel['url']; ?>"><?php echo $hotel['name'].', '. $hotel['country'];?></a></li>
				<?php } ?>
			</ul>
			<?php echo $footer_fixed_menu; ?>
		</nav>
		<div class="partners">
			<div class="wrapper">
				<a target="_blank">
					<img src="<?php echo variable_get('relativePath'); ?>media/brand/logo-virtuoso.png" alt="Virtuoso Member"/>
				</a>
				<a target="_blank">
					<img src="<?php echo variable_get('relativePath'); ?>media/brand/logo-four-seasons.png" alt="Four Seasons"/>
					
				</a>
				<a target="_blank">
					<img src="<?php echo variable_get('relativePath'); ?>media/brand/logo-rosewood.png" alt="Rosewood Elite"/>
				</a>
				<a target="_blank">
					<img src="<?php echo variable_get('relativePath'); ?>media/brand/logo-belmond.png" alt="Belmond"/>
				</a>
			</div>
		</div>
		<div class="fixed-bar">
			<a id="brand" href="/">
				<img src="<?php echo variable_get('relativePath'); ?>media/brand/passported-white-logo.svg" type="image/svg+xml" alt="Passported, kid friendly travel for grown-ups"/>
			</a>
			<nav id="social-media" class="black">
				<a href="https://twitter.com/passported" class="icon-twitter" target="_blank" rel="twitter"></a>
				<a href="https://www.facebook.com/getpassported" class="icon-facebook" target="_blank" rel="facebook"></a>
				<a href="http://instagram.com/getpassported" class="icon-instagram" target="_blank" rel="instagram"></a>
				<a href="http://www.pinterest.com/passported" class="icon-pinterest-2" target="_blank" rel="pinterest"></a>
			</nav>
			<small><?php echo date("Y"); ?> PASSPORTED ALL RIGHTS RESERVED</small>
		</div>
	</footer>

	<!-- Call To Action -->
	<div class="call-to-action" ng-controller="CallToActionController" ng-include="overlayTpl" ng-show="display"></div>
	<!-- Overlay -->
	<pp-newsletter></pp-newsletter>
