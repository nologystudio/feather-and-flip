<?php include 'slideshowandmainmenu.html.php';?>

<section id="hotel-reviews">
        <div class="wrapper">
                <h1 class="middle-line">Hotel Reviews</h1>
                <?php foreach($hotels as $hotel): ?>
                <a class="item" href="<?php echo $hotel['url']; ?>">
                        <figure>
                                <img src="<?php echo $hotel['image'];?>" alt=""/>
                        </figure>
                        <div>
                                <h2><?php echo $hotel['name'];?></h2>
                                <h3><?php echo $hotel['destination'];?></h3>
                        </div>
                </a>
                <?php endforeach; ?>
        </div>
        <footer>
                <button rel="load-more">load more</button>
        </footer>
</section>