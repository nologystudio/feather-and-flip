    <form action="/user" method="post" id="user-login" accept-charset="UTF-8" style="float:left;"><div><div class="form-item form-type-textfield form-item-name">
  <label for="edit-name">Username <span class="form-required" title="This field is required.">*</span></label>
 <input type="text" id="edit-name" name="name" value="" size="60" maxlength="60" class="form-text required" />
<div class="description">Enter your Feather &amp; Flip username.</div>
</div>
<div class="form-item form-type-password form-item-pass">
  <label for="edit-pass">Password <span class="form-required" title="This field is required.">*</span></label>
 <input type="password" id="edit-pass" name="pass" size="60" maxlength="128" class="form-text required" />
<div class="description">Enter the password that accompanies your username.</div>
</div>
<input type="hidden" name="form_build_id" value="form-7r78qocQk_QyocGvrlZMPgk4hTsFz0LdnSduLJlhHy8" />
<input type="hidden" name="form_id" value="user_login" />
<div class="form-actions form-wrapper" id="edit-actions"><input type="submit" id="edit-submit" name="op" value="Log in" class="form-submit" /></div></div></form>  
<section id="start-your-journey">
        <header><h3 class="simple">start your journey</h3></header>
        <div class="gallery-wrapper">
                <?php for($i=0;$i<5;$i++): ?>
                <a href="" rel="destination" class="gallery-item">
                        <figure class="circle-mask">
                                <img src="http://placehold.it/300x300" alt=""/>
                                <div class="border"></div>
                        </figure>
                        <h2>destination</h2>
                </a>
                <?php endfor; ?>
        </div>
</section>  
<section id="map-it">
        <header>
                <h3 class="icon compass">MAP IT<span> where to go now </span></h3>
        </header>
        <aside class="on">
                <nav>
                        <ul>
                                <li data-image=""><span>hotels</span>destination</li>
                                <li data-image=""><span>0</span>destination</li>
                                <li data-image=""><span>1</span>destination</li>
                                <li data-image=""><span>2</span>destination</li>
                                <li data-image=""><span>3</span>destination</li>
                        </ul>
                        <figure>
                                <img src="" alt=""/>
                        </figure>
                </nav>
        </aside>
        <div id="map" ng-controller="MapCtrl">
                <div class="pin" data-lat="" data-lon="">
                        <a href="" class="info">
                                <div class="wrapper">
                                        <figure>
                                                <img src="" alt=""/>
                                        </figure>
                                        <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English</p>
                                </div>
                        </a>
                        <small>destination</small>
                </div>
        </div>
</section>
<section id="travel-journal">
        <header>
                <h3 class="icon feather">TRAVEL<span> journal </span></h3>
                <button class="rounded-btn icon arrow-down">Filter by category</button>
                <ul>
                        <li>category</li>
                        <li>category</li>
                        <li>category</li>
                </ul>
        </header>
        <div id="newsletter-signup" class="quick-entry">
                <h3>Join the adventure</h3>
                <h4>Sign up for our newsletter</h4>
                <form>
                        <input type="email" placeholder="Your email address" value=""/>
                        <input type="submit" value="submit"/>
                </form>
        </div>
        <?php for($i=0;$i<5;$i++): ?>
        <article class="quick-entry">
                <figure>
                        <img src="" alt=""/>
                </figure>
                <footer>
                        <h4>Block title</h4>
                        <time datetime="2008-02-14 20:00">Date</time>
                </footer>
        </article>
        <?php endfor; ?>
        <article class="quick-entry review">
                <h3>hotel le panam</h3>
                <h4>Sign up for our newsletter</h4>
                <time datetime="2008-02-14 20:00">Date</time>
        </article>
</section>  