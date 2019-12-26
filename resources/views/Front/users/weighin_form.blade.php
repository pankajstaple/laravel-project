<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Invite</title>
    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Fontawesome CSS -->
    <link href="vendor/font-awesome/css/font-awesome.css" rel="stylesheet">
    <!-- Theme CSS -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="css/custom.css" rel="stylesheet">
    <link href="css/aos.css" rel="stylesheet">
    <link href="cover.css" rel="stylesheet">
    
  </head>
  <body>
    <div class="blog_header">
      <div class="container">
        <div class="admin_section">
          <!--Navbar-->
          <nav class="custom_menu">
            <div class="toggle-wrap">
              <span class="toggle-bar"></span>
            </div>
          </nav>
          <div class="ani_menu">
            <aside class="custom_side_bar">
              <ul class="side-bar-menu">
                <li class="dropdown game">
                  <a class="dropdown-toggle" data-toggle="dropdown" href="#">GAME
                  <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li><a href="#">Page 1-1</a></li>
                    <li><a href="#">Page 1-2</a></li>
                    <li><a href="#">Page 1-3</a></li>
                  </ul>
                </li>
                <li> <a href="#">MEMBERSHIP</a></li>
                <li><a href="#">GROUPS</a></li>
                <li><a href="#">BLOG</a></li>
                <li> <a href="#">POINT</a></li>
                <li><a href="#">INVITE</a></li>
                <li><a href="#">SETTINGS</a></li>
                <li><a href="#">FAQ</a></li>
              </ul>
            </aside>
          </div>
          <!--  <a class="navbar-brand" href="#">Navbar</a> -->
          <div class="logo_">
            <a class="navbar-brand" href="#"><img src="images/logo-new1.png"></a>
          </div>
          <div class="dropdown john">
            <a href="#">
              <div class="dropbtn">Dropdown <i class="fa fa-caret-down" aria-hidden="true"></i></div>
            </a>
            <div class="dropdown-content">
              <a class="dropdown-item" href="#"><i class="fa fa-cog" aria-hidden="true"></i>Setting</a>
              <a class="dropdown-item" href="#"><i class="fa fa-user" aria-hidden="true"></i>Profile</a>
              <a class="dropdown-item" href="#"><i class="fa fa-bell-o" aria-hidden="true"></i>Notification</a>
              <a class="dropdown-item" href="#"><i class="fa fa-question-circle" aria-hidden="true"></i>Need Help?</a>
              <a class="dropdown-item" href="#"><i class="fa fa-sign-out" aria-hidden="true"></i>Logout</a>
            </div>
            <img class="rounded-circle user" src="images/user.png">
          </div>
        </div>
      </div>
    </div>

    <div class="container">
      
      <nav aria-label="breadcrumb" class="p-0 mt-4">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Weigh-In</li>
        </ol>
      </nav>




      <div class="card my-4" style="">
        <div class="card-body">
          <h5 class="card-title">Weigh-In Form</h5>
          <div class="invite-form">
            <div class="form-group">
              <label>Image</label>
              <div class="custom-file">
                <input type="file" class="custom-file-input" id="customFileLangHTML">
                <label class="custom-file-label" for="customFileLangHTML" data-browse="">Choose file...</label>
              </div>
            </div>
            <div class="form-group">
              <label>Message</label>
              <textarea class="form-control" rows="3"></textarea>
            </div>
            <input type="submit" class="btn btn-yellow" value="Send">
          </div>
                  
         
        </div>
      </div>


      




    </div>




    <footer>
      <div class="footer_section">
        <div class="social-icons">
          <ul>
            <li> <a href="#"><img src="images/facebook.png"></a></li>
            <li> <a href="#"><img src="images/twitter-f.png"></a></li>
            <li> <a href="#"><img src="images/insta.png"></a></li>
          </ul>
        </div>
        <div class="footer_menus my-3">
          <ul>
            <li> <a href="#">CONTACT</a></li>
            <li> <a href="#">FAQS</a></li>
            <li> <a href="#">PRIVACY</a></li>
            <li> <a href="#">TERMS</a></li>
          </ul>
        </div>
        <p class="mt-3 text-center">copyright 2018 Dad Strong LLC.Disclaimer</p>
      </div>
    </footer>






    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/owlcarousel/js/owl.carousel.js"></script>
    <script src="assets/js/index.js"></script>
    <script type="text/javascript">
      $(function() {
      var selectedClass = "";
      $(".filter").click(function(){
      selectedClass = $(this).attr("data-rel");
      $("#gallery").fadeTo(100, 0.1);
      $("#gallery div").not("."+selectedClass).fadeOut().removeClass('animation');
      setTimeout(function() {
      $("."+selectedClass).fadeIn().addClass('animation');
      $("#gallery").fadeTo(300, 1);
      }, 300);
      });
      });
    </script>
    <script type="text/javascript">
      (function() {
      $('.toggle-wrap').on('click', function() {
        $(this).toggleClass('active');
        $('aside').animate({width: 'toggle'}, 200);
      });
      })();
    </script>
  </body>
</html>