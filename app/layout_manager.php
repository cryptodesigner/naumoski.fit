<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $title; ?></title>
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
    <meta name="description" content="Online coaching">
    <meta property="og:url" content="https://app.naumoski.fit/">
    <meta property="og:type" content="website">
    <meta property="og:title" content="The fastest way to build your body.">
    <meta property="og:description" content="Online coaching. The fastest way to build your body.">
    <meta property="og:image" content="https://app.naumoski.fit/static/img/avatar-logo.png">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@">
    <meta name="twitter:creator" content="@">
    <meta name="twitter:title" content="Online coaching. The fastest way to build your body.">
    <meta name="twitter:description" content="Online coaching. The fastest way to build your body.">
    <meta name="twitter:image" content="https://app.naumoski.fit/static/img/avatar-logo.png">
    <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png">
    <!-- <link rel="icon" type="image/png" href="../static/img/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="../static/img/favicon-16x16.png" sizes="16x16"> -->
    <!-- <link rel="manifest" href="../manifest.json"> -->
    <link rel="mask-icon" href="safari-pinned-tab.svg" color="#0288d1">
    <meta name="theme-color" content="#ffffff">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,400italic,500,700">
    <link rel="stylesheet" href="../static/css/vendor.min.css">
    <link rel="stylesheet" href="../static/css/elephant.min.css">
    <link rel="stylesheet" href="../static/css/application.min.css">
    <link rel="stylesheet" href="../static/css/profile.min.css">
    <link rel="stylesheet" href="../static/css/demo.min.css">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
  </head>
  <body class="layout layout-header-fixed">
    <div class="layout-header">
      <div class="navbar navbar-default">
        <div class="navbar-header">
          <a class="navbar-brand navbar-brand-center" href="manager_profile.php">
            <img class="navbar-brand-logo" src="../static/img/logo-inverse.svg" alt="Elephant">
          </a>
          <button class="navbar-toggler visible-xs-block collapsed" type="button" data-toggle="collapse" data-target="#sidenav">
            <span class="sr-only">Toggle navigation</span>
            <span class="bars">
              <span class="bar-line bar-line-1 out"></span>
              <span class="bar-line bar-line-2 out"></span>
              <span class="bar-line bar-line-3 out"></span>
            </span>
            <span class="bars bars-x">
              <span class="bar-line bar-line-4"></span>
              <span class="bar-line bar-line-5"></span>
            </span>
          </button>
          <button class="navbar-toggler visible-xs-block collapsed" type="button" data-toggle="collapse" data-target="#navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="arrow-up"></span>
            <span class="ellipsis ellipsis-vertical">
              <img class="ellipsis-object" width="32" height="32" src="../static/img/avatar-logo-small.jpg" alt="">
            </span>
          </button>
        </div>
        <div class="navbar-toggleable">
          <nav id="navbar" class="navbar-collapse collapse">
            <button class="sidenav-toggler hidden-xs" title="Collapse sidenav ( [ )" aria-expanded="true" type="button">
              <span class="sr-only">Toggle navigation</span>
              <span class="bars">
                <span class="bar-line bar-line-1 out"></span>
                <span class="bar-line bar-line-2 out"></span>
                <span class="bar-line bar-line-3 out"></span>
                <span class="bar-line bar-line-4 in"></span>
                <span class="bar-line bar-line-5 in"></span>
                <span class="bar-line bar-line-6 in"></span>
              </span>
            </button>
            <ul class="nav navbar-nav navbar-right">
              <li class="visible-xs-block">
                <h4 class="navbar-text text-center"><?php echo $_SESSION['email']; ?></h4>
              </li>
              <li class="dropdown hidden-xs">
                <button class="navbar-account-btn" data-toggle="dropdown" aria-haspopup="true">
                  <img class="rounded" width="36" height="36" src="../static/img/avatar-logo-small.jpg" alt=""> 
                  <?php echo $_SESSION['email']; ?>
                  <span class="caret"></span>
                </button>
                <ul class="dropdown-menu dropdown-menu-right">
                  <li>
                    <a href="#">
                      <h5 class="navbar-upgrade-heading">?????????????????? ??????????</h5>
                    </a>
                  </li>
                  <li class="divider"></li>
                  <!-- <li><a href="contacts.html">Contacts</a></li>
                  <li><a href="profile.html">Profile</a></li> -->
                  <li><a href="logout.php">???????????? ????</a></li>
                </ul>
              </li>
              <li class="visible-xs-block">
                <a href="logout.php">
                  <span class="icon icon-power-off icon-lg icon-fw"></span>
                  ???????????? ????
                </a>
              </li>
            </ul>
          </nav>
        </div>
      </div>
    </div>
    <div class="layout-main">
      <div class="layout-sidebar">
        <div class="layout-sidebar-backdrop"></div>
        <div class="layout-sidebar-body">
          <div class="custom-scrollbar">
            <nav id="sidenav" class="sidenav-collapse collapse">
              <ul class="sidenav">
                <li class="sidenav-search hidden-md hidden-lg">
                  <form class="sidenav-form" action="/">
                    <div class="form-group form-group-sm">
                      <div class="input-with-icon">
                        <input class="form-control" type="text" placeholder="Search???">
                        <span class="icon icon-search input-icon"></span>
                      </div>
                    </div>
                  </form>
                </li>

                <li class="sidenav-item">
                  <a href="manager_profile.php">
                    <span class="sidenav-icon icon icon-home"></span>
                    <span class="sidenav-label">????????</span>
                  </a>
                </li>

                <li class="sidenav-item has-subnav">
                  <a href="#" aria-haspopup="true">
                    <span class="sidenav-icon icon icon-user"></span>
                    <span class="sidenav-label">??????????????</span>
                  </a>
                  <ul class="sidenav-subnav collapse">
                    <li class="sidenav-subheading">??????????????</li>
                    <li><a href="clients.php">?????????????? ??????????????</a></li>
                    <li><a href="add_client.php">???????????? ????????????</a></li>
                  </ul>
                </li>

                <!-- <li class="sidenav-item has-subnav">
                  <a href="#" aria-haspopup="true">
                    <span class="sidenav-icon icon icon-cutlery"></span>
                    <span class="sidenav-label">Food</span>
                  </a>
                  <ul class="sidenav-subnav collapse">
                    <li class="sidenav-subheading">Food</li>
                    <li><a href="{{'food'}}">Show All Food</a></li>
                    <li><a href="{{'add_food'}}">Add Food</a></li>
                  </ul>
                </li> -->

                <li class="sidenav-item has-subnav">
                  <a href="#" aria-haspopup="true">
                    <span class="sidenav-icon icon icon-heartbeat"></span>
                    <span class="sidenav-label">??????????????</span>
                  </a>
                  <ul class="sidenav-subnav collapse">
                    <li class="sidenav-subheading">??????????????</li>
                    <li><a href="techniques.php">?????????????? ??????????????</a></li>
                    <li><a href="add_tech.php">???????????? ??????????????</a></li>
                  </ul>
                </li>

                <li class="sidenav-item has-subnav">
                  <a href="#" aria-haspopup="true">
                    <span class="sidenav-icon icon icon-universal-access"></span>
                    <span class="sidenav-label">??????????</span>
                  </a>
                  <ul class="sidenav-subnav collapse">
                    <li class="sidenav-subheading">??????????</li>
                    <li><a href="exercises.php">?????????????? ??????????</a></li>
                    <li><a href="add_exercise.php">???????????? ??????????</a></li>
                  </ul>
                </li>

                <li class="sidenav-item has-subnav">
                  <a href="#" aria-haspopup="true">
                    <span class="sidenav-icon icon icon-cutlery"></span>
                    <span class="sidenav-label">????????????</span>
                  </a>
                  <ul class="sidenav-subnav collapse">
                    <li class="sidenav-subheading">????????????</li>
                    <li><a href="meals.php">?????????????? ????????????</a></li>
                    <li><a href="add_meal.php">???????????? ??????????</a></li>
                  </ul>
                </li>

                <!-- <li class="sidenav-item has-subnav">
                  <a href="#" aria-haspopup="true">
                    <span class="sidenav-icon icon icon-certificate"></span>
                    <span class="sidenav-label">Daily Meal</span>
                  </a>
                  <ul class="sidenav-subnav collapse">
                    <li class="sidenav-subheading">Meals</li>
                    <li><a href="{{'daily_meals'}}">Show All Daily Meals</a></li>
                    <li><a href="{{'add_daily_meal'}}">Add Daily Meal</a></li>
                  </ul>
                </li> -->

                <!-- <li class="sidenav-item has-subnav">
                  <a href="#" aria-haspopup="true">
                    <span class="sidenav-icon icon icon-heart"></span>
                    <span class="sidenav-label">Trainings</span>
                  </a>
                  <ul class="sidenav-subnav collapse">
                    <li class="sidenav-subheading">Trainings</li>
                    <li><a href="{{'trainings'}}">Show All Trainings</a></li>
                    <li><a href="{{'add_training'}}">Add Training</a></li>
                  </ul>
                </li> -->

                <li class="sidenav-item">
                  <a href="trainings.php">
                    <span class="sidenav-icon icon icon-gear"></span>
                    <span class="sidenav-label">????????????????</span>
                  </a>
                </li>

                <!-- <li class="sidenav-item has-subnav">
                  <a href="#" aria-haspopup="true">
                    <span class="sidenav-icon icon icon-heart"></span>
                    <span class="sidenav-label">Daily Meals</span>
                  </a>
                  <ul class="sidenav-subnav collapse">
                    <li class="sidenav-subheading">Daily Meals</li>
                    <li><a href="{{'daily_meals'}}">Show All Daily Meals</a></li>
                    <li><a href="{{'add_training'}}">Add Training</a></li>
                  </ul>
                </li> -->

                <li class="sidenav-item">
                  <a href="daily_meals.php">
                    <span class="sidenav-icon icon icon-apple"></span>
                    <span class="sidenav-label">???????????? ????????????</span>
                  </a>
                </li>
                
                <!-- <li class="sidenav-item has-subnav">
                  <a href="#" aria-haspopup="true">
                    <span class="sidenav-icon icon icon-certificate"></span>
                    <span class="sidenav-label">Daily Routines</span>
                  </a>
                  <ul class="sidenav-subnav collapse">
                    <li class="sidenav-subheading">Meals</li>
                    <li><a href="{{'daily_routines'}}">Show All Daily Routines</a></li>
                    <li><a href="{{'add_daily_routine'}}">Add Daily Routine</a></li>
                  </ul>
                </li> -->

                <li class="sidenav-item">
                  <a href="add_daily_routine.php">
                    <span class="sidenav-icon icon icon-sun-o"></span>
                    <span class="sidenav-label">???????????? ???????????? ????????????</span>
                  </a>
                </li>

                <li class="sidenav-item has-subnav">
                  <a href="#" aria-haspopup="true">
                    <span class="sidenav-icon icon icon-heart"></span>
                    <span class="sidenav-label">??????????????</span>
                  </a>
                  <ul class="sidenav-subnav collapse">
                    <li class="sidenav-subheading">??????????????</li>
                    <li><a href="recepts.php">?????????????????? ??????????????</a></li>
                    <li><a href="add_recept.php">???????????? ????????????</a></li>
                  </ul>
                </li>

              </ul>
            </nav>
          </div>
        </div>
      </div>

      <div class="layout-content">
        <?php include($childView); ?>
      </div>


    </div>
    <script src="../static/js/vendor.min.js"></script>
    <script src="../static/js/elephant.min.js"></script>
    <script src="../static/js/application.min.js"></script>
    <script src="../static/js/profile.min.js"></script>
    <script src="../static/js/demo.min.js"></script>
    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
      ga('create', 'UA-83990101-1', 'auto');
      ga('send', 'pageview');
    </script>
    <script>
      function openTab(tabName) {
        var i;
        var x = document.getElementsByClassName("tab");
        for (i = 0; i < x.length; i++) {
          x[i].style.display = "none";
        }
        document.getElementById(tabName).style.display = "block";
      }
    </script>

    
    <!-- <script>
      $('ul li').click(function() {
        $('.active').removeClass('active');
        $(this).addClass('active');
      });
    </script> -->
  </body>
</html>