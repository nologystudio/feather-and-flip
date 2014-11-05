<section id="hotel-reviews">
        <div class="wrapper">
                <h1 class="middle-line">Hotel Reviews</h1>
                <?php for($i=0;$i<20;$i++): ?>
                <a class="item" href="">
                        <figure>
                                <img src="http://placehold.it/347x300" alt=""/>
                        </figure>
                        <div>
                                <h2>Hotel Name</h2>
                                <h3>City, Country</h3>
                        </div>
                </a>
                <?php endfor; ?>
        </div>
        <footer>
                <button rel="load-more">load more</button>
        </footer>
</section>