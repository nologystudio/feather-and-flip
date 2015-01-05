        <!-- Header gallery -->
        <div id="main-header-gallery" class="one-item main" ng-controller="SlideshowCtrl">
               <ul>
                    <?php foreach($slideImages as $image){ ?>
                     <li>
                        <article>
                                <figure>
                                        <img src="<?php echo $image['url'];?>" alt="" data-size="<?php echo $image['size'][0].'x'.$image['size'][1];?>"/>
                                </figure>
                                <div class="info-wrapper animated fadeInUp<?php echo (!isset($image['btntext']) ? ' static' : ''); ?>">
                                    <?php if (isset($image['linkto'])) { ?>
                                        <a href="<?php if(isset($image['linkto'])) echo $image['linkto']; else echo ''; ?>" <?php if(isset($blank) && $blank){ echo 'target="_blank"'; } ?> rel="">
                                            <h1><?php if(isset($image['text'])) echo $image['text']; else echo 'city, country'; ?></h1>
                                            <?php if(isset($image['subtitle'])){ ?>
                                            <span class="cursive"><?php echo $image['subtitle']; ?></span>
                                            <?php } ?>
                                            <?php if(isset($image['btntext'])){?>
                                            <span class="rounded-btn"><?php echo $image['btntext'];?></span>
                                            <?php } ?>
                                        </a>
                                    <?php } else { ?>
                                        <div>
                                            <h1><?php if(isset($image['text'])) echo $image['text']; else echo 'city, country'; ?></h1>
                                            <?php if(isset($image['subtitle'])){ ?>
                                            <span class="cursive"><?php echo $image['subtitle']; ?></span>
                                            <?php } ?>
                                            <?php if(isset($image['btntext'])){?>
                                            <span class="rounded-btn"><?php echo $image['btntext'];?></span>
                                            <?php } ?>
                                        </div>
                                    <?php } ?>
                                </div>
                        </article>
                     </li>
                    <?php } ?>
               </ul>
            <?php if (count($slideImages) > 1) { ?>
                <button rel="left"></button>
                <button rel="right"></button>
            <?php } ?>
        </div>
                
        <?php 
        
        /* ------------------------------------------------------------------------------------------------------------- */
        /* | i | Nav starts here... */ 
        /* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */ ?>
        
        <nav role="main-navigation" ng-controller="NavCtrl"<?php echo (Helpers::IsStickySection() ? ' class="sticky"' : ''); ?>>
                <div class="wrapper">
						<a id="brand" href="/"></a>
                        <?php $form = drupal_get_form('feflip_features_search_form'); ?>
                        <?php //echo drupal_render($form); ?>
                        <form id="search" ng-controller="SearchCtrl">
							<input type="text" placeholder="Enter destination or hotel" ng-keyup="searchSubmit()" value="{{userSearch}}" ng-model="userSearch"/>
							<input type="submit" ng-click="searchSubmit()" value=""/>
							<ul ng-if="showResult" ng-class="{'show':showResult}">
								<li class="no-result" ng-if="noResult">
									<a href="/contact">Don't see what you're looking for? Contact our team for help</a>
								</li>
								<li class="title" ng-if="hotels.length > 0">Hotels</li>
								<li class="hotel" ng-repeat="hotel in hotels">
									<a href="{{hotel.url}}">{{hotel.title}}</a>
								</li>
								<li class="title" ng-if="destinations.length > 0">Destinations</li>
								<li class="destination" ng-repeat="destination in destinations">
									<a href="{{destination.url}}">{{destination.title}}</a>
								</li>
							</ul>
						</form>
                        <?php print_r($main_navigation); ?>
                </div>
        </nav>