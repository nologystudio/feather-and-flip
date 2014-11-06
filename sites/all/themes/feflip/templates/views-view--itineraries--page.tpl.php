<section id="itinerary">
        <header>
                <ul>
                        <li>
                                <button rel="sleep">sleep</button>
                        </li>
                        <li>
                                <button rel="eat">eat</button>
                        </li>
                        <li id="destination">
                                <figure>
                                        <div class="mask">
                                                <img src="" alt=""/>
                                        </div>
                                        <figcaption></figcaption>
                                </figure>
                                <small>
                                        <div id="current-time"></div>
                                        <div id="weather"></div>
                                </small>
                        </li>
                        <li>
                                <button rel="play">play</button>
                        </li>
                        <li>
                                <button rel="play">noteworthy</button>
                        </li>
                </ul>
        </header>
        <div class="wrapper">
                <article id="itinerary-guide">
                        <h2 class="middle-line">Itinerary Guide</h2>
                        <h3>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</h3>
                        <!-- Gallery starts here -->
                        <div class="slideshow-gallery" ng-controller="SlideshowCtrl">
                                <button rel="left"></button>
                                <button rel="right"></button>
                                <div id="slideshow-state-bar">
                                        <button class="on"></button>
                                        <button></button>
                                </div>
                                <div class="slideshow-wrapper">
                                        <?php for($i=0;$i<1;$i++): ?>
                                        <article class="slideshow-item">
                                                <figure>
                                                        <img src="http://placehold.it/1280x800" alt="City, Country" data-size="1280x800"/>
                                                </figure>
                                        </article>
                                        <?php endfor; ?>
                                </div>
                        </div>
                </article>
                <article id="neighborhood-guide">
                        <h2 class="middle-line">Neighborhood Guide</h2>
                        <ul>
                                <?php for($i=0;$i<4;$i++): ?>
                                <li>
                                        <figure>
                                                <img src="http://placehold.it/200x200" alt=""/>
                                        </figure>
                                        <div>
                                                <h4>Neighborhood</h4>
                                                <h5>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</h5>
                                        </div>
                                </li>
                                <?php endfor; ?>
                        </ul>
                </article>
        </div>
        <footer></footer>
</section>  