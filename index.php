<?php
$the_title = "DBC | Home";
$pathcor = "";
session_start();
require_once './view/header.php';
?>

</div>
  <header class="masthead" id="home_masthead">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="site-heading">
            <h1>Dream Bean Club!</h1>
            <span class="subheading">Great Vibes. Great Coffee.</span>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- Main Content -->
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
      <div class="post-preview">
            <h2 class="post-title">
             Our Business
            </h2>
            <h3 class="post-subtitle">
            <p>Address: 330 S 21st St, Lincoln, NE 68510</p>
            <p>Business Hours: 6AM–9PM Daily.</p>
            </h3>
        </div>
        <hr>
        <div class="post-preview">
            <h2 class="post-title">
              Chess Leagues
            </h2>
            <h3 class="post-subtitle">
              Come join our friendly community as we host our weekly chess leagues on the weekends. Seasonal knock out touraments are held for the top players!
            </h3>
        </div>
        <hr>
        <div class="post-preview">
            <h2 class="post-title">
              Gallery
            </h2>
            <h3 class="post-subtitle">
              See some photos of the coffee shop and learn more about the stories behind our gallery.
            </h3>
          <img src="img/sample_post.jpg" alt="An example of gallery">
        </div>
        <hr>
        <div class="post-preview">
            <h2 class="post-title">
              Newsletter
            </h2>
            <h3 class="post-subtitle">
              Sign up for our monthly newsletter about chess, coffee, local news, and other topics. We also include articles contributed by readers like you!
            </h3>
        </div>
        <hr>
        <form>
        <h3 class="post-subtitle">
         Sign Up!
        </h3>
        <input type="text">
        <div class="clearfix">
          <a class="btn btn-primary float-right" href="#">Sign Up!</a>
        </div>
        </form>
      </div>
    </div>
  </div>

  <hr>
<?php require_once './view/footer.php'; ?>  
</body>
</html>

