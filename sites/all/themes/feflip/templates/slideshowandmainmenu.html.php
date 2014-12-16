        <!-- Header gallery -->
        <div id="main-header-gallery" ng-controller="SlideshowCtrl">
               <ul>
                    <?php foreach($slideImages as $image){ ?>
                     <li>
                        <article>
                                <figure>
                                        <img src="<?php echo $image['url'];?>" alt="" data-size="<?php echo $image['size'][0].'x'.$image['size'][1];?>"/>
                                </figure>
                                <div class="info-wrapper animated fadeInUp">
                                        <a href="<?php if(isset($image['linkto'])) echo $image['linkto']; else echo ''; ?>" <?php if(isset($blank) && $blank){ echo 'target="_blank"'; } ?> rel="">
                                                <h1><?php if(isset($image['text'])) echo $image['text']; else echo 'city, country'; ?></h1>
                                                <?php if(isset($image['subtitle'])){ ?>
                                                <span class="cursive"><?php echo $image['subtitle']; ?></span>
                                                <?php } ?>
                                                <?php if(isset($image['btntext'])){?>
                                                <span class="rounded-btn"><?php echo $image['btntext'];?></span>
                                                <?php } ?>
                                        </a>
                                </div>
                        </article>
                     </li>
                    <?php } ?>
               </ul>
            <button rel="left"></button>
            <button rel="right"></button>
            <!--<div id="slideshow-state-bar">
                <button class="on"></button>
                <button></button>
            </div>-->
        </div>        
                
        <?php 
        
        /* ------------------------------------------------------------------------------------------------------------- */
        /* | i | Nav starts here... */ 
        /* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */ ?>
        
        <nav role="main-navigation" ng-controller="NavCtrl">
                <div class="wrapper">
                        <?php $form = drupal_get_form('feflip_features_search_form'); ?>
                        <?php //echo drupal_render($form); ?>
                        <form id="search">
                                <input type="text" placeholder="Enter destination or hotel" value=""/>
                                <input type="submit" value=""/>
                        </form>
                        <?php print_r($main_navigation); ?>
                </div>
        </nav>