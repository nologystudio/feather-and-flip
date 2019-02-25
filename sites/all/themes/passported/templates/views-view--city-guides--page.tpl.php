

	<!-- Map -->

	<script>
        window.location.href = 'https://www.passported.com/';
    </script>
	
	<section id="map" class="single-destination" ng-controller="MapController" ng-init="cityGuideID = <?php echo arg(1); ?>;lat = <?php echo (isset($lat) ? $lat : ''); ?>;lon = <?php echo (isset($lon) ? $lon : ''); ?>">
		<?php include 'map_content.php'; ?>
	</section>
    <?php if (isset($travel_journal) && !empty($travel_journal)) print $travel_journal; ?>