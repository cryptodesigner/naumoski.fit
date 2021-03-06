<?php
  $current_client = $_SESSION['client_id'];
  $sql = "SELECT * FROM clients WHERE client_id = '$current_client.';";
  $statement = $connection->prepare($sql);
  $statement->execute();
  $clients = $statement->fetchAll(PDO::FETCH_OBJ);
  $current_client = $_SESSION['client_id'];
  $sql = "SELECT m.name FROM managers m 
    INNER JOIN clients c ON m.manager_id = c.managers_manager_id
    WHERE client_id = '$current_client.';";
  $statement = $connection->prepare($sql);
  $statement->execute();
  $assigned_manager = $statement->fetchAll(PDO::FETCH_OBJ);
  $current_client = $_SESSION['client_id'];
  $sql = "SELECT * FROM basics WHERE clients_client_id = '$current_client.';";
  $statement = $connection->prepare($sql);
  $statement->execute();
  $basics = $statement->fetchAll(PDO::FETCH_OBJ);
  $current_client = $_SESSION['client_id'];
  $sql = "SELECT name, vreme FROM meals WHERE clients_client_id = '$current_client.'
    AND date = CURDATE()
    UNION
    SELECT name, vreme FROM trainings WHERE clients_client_id = '$current_client.'
    AND date = CURDATE()
    ORDER BY vreme ASC";
  $statement = $connection->prepare($sql);
  $statement->execute();
  $daily_routine = $statement->fetchAll(PDO::FETCH_OBJ);
  $current_client = $_SESSION['client_id'];
  $sql = "SELECT * FROM trainings WHERE clients_client_id = '$current_client.'
    AND date = CURDATE()
    ORDER BY vreme ASC";
  $statement = $connection->prepare($sql);
  $statement->execute();
  $today_trainings = $statement->fetchAll(PDO::FETCH_OBJ);
  $current_client = $_SESSION['client_id'];
  $sql = "SELECT * FROM trainings WHERE clients_client_id = '$current_client.'
    AND date = DATE_ADD(CURDATE(), INTERVAL 1 DAY)
    ORDER BY vreme ASC";
  $statement = $connection->prepare($sql);
  $statement->execute();
  $tomorrow_trainings = $statement->fetchAll(PDO::FETCH_OBJ);
  $current_client = $_SESSION['client_id'];
  $sql = "SELECT * FROM trainings WHERE clients_client_id = '$current_client.'
    AND date >= CURDATE() AND date <= DATE_ADD(CURDATE(), INTERVAL 7 DAY)
    ORDER BY vreme ASC";
  $statement = $connection->prepare($sql);
  $statement->execute();
  $all_trainings = $statement->fetchAll(PDO::FETCH_OBJ);
  $current_client = $_SESSION['client_id'];
  $sql = "SELECT * FROM meals WHERE clients_client_id = '$current_client.'
    AND date = CURDATE()
    ORDER BY vreme ASC";
  $statement = $connection->prepare($sql);
  $statement->execute();
  $today_meals = $statement->fetchAll(PDO::FETCH_OBJ);
  $current_client = $_SESSION['client_id'];
  $sql = "SELECT * FROM meals WHERE clients_client_id = '$current_client.'
    AND date = DATE_ADD(CURDATE(), INTERVAL 1 DAY)
    ORDER BY vreme ASC";
  $statement = $connection->prepare($sql);
  $statement->execute();
  $tomorrow_meals = $statement->fetchAll(PDO::FETCH_OBJ);
  $current_client = $_SESSION['client_id'];
  $sql = "SELECT * FROM meals WHERE clients_client_id = '$current_client.'
    AND date >= CURDATE() AND date <= DATE_ADD(CURDATE(), INTERVAL 7 DAY)
    ORDER BY vreme ASC";
  $statement = $connection->prepare($sql);
  $statement->execute();
  $all_meals = $statement->fetchAll(PDO::FETCH_OBJ);
  $current_client = $_SESSION['client_id'];
  $sql = "SELECT * FROM measurements WHERE clients_client_id = '$current_client.' ORDER BY cur_date DESC;";
  $statement = $connection->prepare($sql);
  $statement->execute();
  $measurements = $statement->fetchAll(PDO::FETCH_OBJ);
  $current_client = $_SESSION['client_id'];
  $sql = "SELECT tezina, cur_date FROM measurements WHERE clients_client_id = '$current_client.' ORDER BY cur_date DESC;";
  $statement = $connection->prepare($sql);
  $statement->execute();
  $tezina = $statement->fetchAll(PDO::FETCH_OBJ);
  $current_client = $_SESSION['client_id'];
  $sql = "SELECT gradi, cur_date FROM measurements WHERE clients_client_id = '$current_client.' ORDER BY cur_date DESC;";
  $statement = $connection->prepare($sql);
  $statement->execute();
  $gradi = $statement->fetchAll(PDO::FETCH_OBJ);
  $current_client = $_SESSION['client_id'];
  $sql = "SELECT papok, cur_date FROM measurements WHERE clients_client_id = '$current_client.' ORDER BY cur_date DESC;";
  $statement = $connection->prepare($sql);
  $statement->execute();
  $papok = $statement->fetchAll(PDO::FETCH_OBJ);
  $current_client = $_SESSION['client_id'];
  $sql = "SELECT kolk, cur_date FROM measurements WHERE clients_client_id = '$current_client.' ORDER BY cur_date DESC;";
  $statement = $connection->prepare($sql);
  $statement->execute();
  $kolk = $statement->fetchAll(PDO::FETCH_OBJ);
  $current_client = $_SESSION['client_id'];
  $sql = "SELECT raka, cur_date FROM measurements WHERE clients_client_id = '$current_client.' ORDER BY cur_date DESC;";
  $statement = $connection->prepare($sql);
  $statement->execute();
  $raka = $statement->fetchAll(PDO::FETCH_OBJ);
  $current_client = $_SESSION['client_id'];
  $sql = "SELECT but, cur_date FROM measurements WHERE clients_client_id = '$current_client.' ORDER BY cur_date DESC;";
  $statement = $connection->prepare($sql);
  $statement->execute();
  $but = $statement->fetchAll(PDO::FETCH_OBJ);
?>
<section>
<div class="profile">
  <div class="profile-header">
    <div class="profile-cover">
      <div class="profile-container">
        <div class="profile-card">
          <div class="profile-avetar">
            <img class="profile-avetar-img" width="128" height="128" src="../static/img/avatar-logo.png" alt="user">
          </div>
          <div class="profile-overview">
            <?php foreach($clients as $c): ?>
              <h1 class="profile-name"><?= $c->name; ?> <?= $c->surname; ?></h1>
            <?php endforeach; ?>
            <a class="profile-follow-btn" href ="edit_profile.php">Edit Profile</a>

            <span><a style="color: white;" href="client_profile.php">MK</a> <span style="color: white;">|</span> <a style="color: white;" href="client_profile_en.php">EN</a></span>

            <p>Client<a class="link-inverted"></a></p>
          </div>
        </div>
        <div class="profile-tabs">
          <ul class="profile-nav">
            <li><a onclick="openTab('Profile')">Profile</a></li>
            <li><a onclick="openTab('Trainings')">Trainings</a></li>
            <li><a onclick="openTab('Diets')">Diets</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
          
<div class="profile-body">
  <div class="card-body">
    <div id="Profile" class="tab">
      <div class="card-body">
        <?php foreach($clients as $c): ?>
          <h3><?= $c->name; ?> Profile</h3>
        <?php endforeach; ?>
      </div>
      <div class="col-md-3">
        <div class="card">
          <div class="card-header">
            <div class="card-actions">
              <button type="button" class="card-action card-toggler" title="Collapse"></button>
              <button type="button" class="card-action card-reload" title="Reload"></button>
              <button type="button" class="card-action card-remove" title="Remove"></button>
            </div>
            <strong>Client</strong>
          </div>
          <div class="card-body" data-toggle="match-height">
            <div class="table-responsive">
              <table class="table table-hover">
                <tr>
                  <?php foreach($clients as $c): ?>
                  <th colspan="6">Seq: </th>
                  <td colspan="6"><?= $c->client_id; ?></td>
                  <?php endforeach; ?>
                </tr>
                <tr>
                  <?php foreach($assigned_manager as $am): ?>
                  <th colspan="6">Manager: </th>
                  <td colspan="6"><?= $am->name; ?></td>
                  <?php endforeach; ?>
                </tr>
                <tr>
                  <?php foreach($clients as $c): ?>
                  <th colspan="6">Name: </th>
                  <td colspan="6"><?= $c->name; ?></td>
                  <?php endforeach; ?>
                </tr>
                <tr>
                  <?php foreach($clients as $c): ?>
                  <th colspan="6">Surname: </th>
                  <td colspan="6"><?= $c->surname; ?></td>
                  <?php endforeach; ?>
                </tr>
                <tr>
                  <?php foreach($clients as $c): ?>
                  <th colspan="6">Email: </th>
                  <td colspan="6"><?= $c->email; ?></td>
                  <?php endforeach; ?>
                </tr>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card">
          <div class="card-header">
            <div class="card-actions">
              <button type="button" class="card-action card-toggler" title="Collapse"></button>
              <button type="button" class="card-action card-reload" title="Reload"></button>
              <button type="button" class="card-action card-remove" title="Remove"></button>
            </div>
            <strong>Basic info</strong>
          </div>
          <div class="card-body" data-toggle="match-height">
            <div class="table-responsive">
              <table class="table table-hover">
                <tr>
                  <?php foreach($basics as $b): ?>
                  <th colspan="6">Gender: </th>
                  <td colspan="6"><?= $b->pol; ?></td>
                  <?php endforeach; ?>
                </tr>
                <tr>
                  <?php foreach($basics as $b): ?>
                  <th colspan="6">Birthday: </th>
                  <td colspan="6"><?= $b->godini; ?></td>
                  <?php endforeach; ?>
                </tr>
                <tr>
                  <?php foreach($basics as $b): ?>
                  <th colspan="6">Height: </th>
                  <td colspan="6"><?= $b->visina; ?></td>
                  <?php endforeach; ?>
                </tr>
                <tr>
                  <?php foreach($basics as $b): ?>
                  <th colspan="6">Weight: </th>
                  <td colspan="6"><?= $b->tezina; ?></td>
                  <?php endforeach; ?>
                </tr>
                <tr>
                  <?php foreach($basics as $b): ?>
                  <th colspan="6">Experience: </th>
                  <td colspan="6"><?= $b->iskustvo; ?></td>
                  <?php endforeach; ?>
                </tr>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card">
          <div class="card-header">
            <div class="card-actions">
              <button type="button" class="card-action card-toggler" title="Collapse"></button>
              <button type="button" class="card-action card-reload" title="Reload"></button>
              <button type="button" class="card-action card-remove" title="Remove"></button>
            </div>
            <strong>Characteristics</strong>
          </div>
          <div class="card-body" data-toggle="match-height">
            <div class="table-responsive">
              <table class="table table-hover">
                <tr>
                  <?php foreach($basics as $b): ?>
                  <th colspan="6">Alergies: </th>
                  <td colspan="6"><?= $b->alergija; ?></td>
                  <?php endforeach; ?>
                </tr>
                <tr>
                  <?php foreach($basics as $b): ?>
                  <th colspan="6">Intolerances: </th>
                  <td colspan="6"><?= $b->netolerantnost; ?></td>
                  <?php endforeach; ?>
                </tr>
                <tr>
                  <?php foreach($basics as $b): ?>
                  <th colspan="6">Rejection: </th>
                  <td colspan="6"><?= $b->odbivnost; ?></td>
                  <?php endforeach; ?>
                </tr>
                <tr>
                  <?php foreach($basics as $b): ?>
                  <th colspan="6">Diseases: </th>
                  <td colspan="6"><?= $b->zaboluvanja; ?></td>
                  <?php endforeach; ?>
                </tr>
                <tr>
                  <?php foreach($basics as $b): ?>
                  <th colspan="6">Suplements?: </th>
                  <td colspan="6"><?= $b->suplement; ?></td>
                  <?php endforeach; ?>
                </tr>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card">
          <div class="card-header">
            <div class="card-actions">
              <button type="button" class="card-action card-toggler" title="Collapse"></button>
              <button type="button" class="card-action card-reload" title="Reload"></button>
              <button type="button" class="card-action card-remove" title="Remove"></button>
            </div>
            <strong>Daily Routine</strong>
          </div>
          <div class="card-body" data-toggle="match-height">
            <div class="table-responsive">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Time</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($daily_routine as $dr): ?>
                  <tr>
                    <td><?= $dr->name; ?></td>
                    <td><?= $dr->vreme; ?></td>
                  </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <?php
        $datapoints = array();
        foreach ($tezina as $t) {
          array_push($datapoints, array("x"=> $t->cur_date, "y"=> $t->tezina));
        }
        // echo '<pre>'; print_r($datapoints); echo '</pre>';
        $datapoints2 = array();
        foreach ($gradi as $g) {
          array_push($datapoints2, array("x"=> $g->cur_date, "y"=> $g->gradi));
        }
        $datapoints3 = array();
        foreach ($papok as $p) {
          array_push($datapoints3, array("x"=> $p->cur_date, "y"=> $p->papok));
        }
        $datapoints4 = array();
        foreach ($kolk as $k) {
          array_push($datapoints4, array("x"=> $k->cur_date, "y"=> $k->kolk));
        }
        $datapoints5 = array();
        foreach ($raka as $r) {
          array_push($datapoints5, array("x"=> $r->cur_date, "y"=> $r->raka));
        }
        $datapoints6 = array();
        foreach ($but as $b) {
          array_push($datapoints6, array("x"=> $b->cur_date, "y"=> $b->but));
        }
      ?>
    <!-- Grafikon za Tezina -->
      <script src="static/js/chart.js"></script>
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <div class="card-actions">
              <button type="button" class="card-action card-toggler" title="Collapse"></button>
              <button type="button" class="card-action card-reload" title="Reload"></button>
              <button type="button" class="card-action card-remove" title="Remove"></button>
            </div>
            <strong>Weight Graphique</strong>
          </div>
          <div class="card-body">
            <div class="chart-container">
              <canvas id="myChart" style="width:100%; height:200px"></canvas>
            </div>
          </div>
        </div>
      </div>
      
      <script>
        var myArray = <?php echo json_encode($datapoints); ?>;
        // console.log(myArray)
        var xresults = [];
        var yresults = [];
        for(var i=myArray.length-1; i>=0; i--) {
          if(!(myArray[i].y)){
            // console.log("do nothing",i)
          }
          else{
            xresults.push(myArray[i].x)
            yresults.push(parseInt(myArray[i].y))
          }
        }
        // console.log(xresults)
        // console.log(yresults)
        new Chart("myChart", {
          type: "line",
          data: {
            labels: xresults,
            datasets: [{ 
              data: yresults,
              label: "Weight Graphique",
              borderColor: "#000000",
              backgroundColor: '#98721a55',
              fill: true,
              borderWidth: 0,
            }]
          },
          options: {
            animations: {
            y: {
            duration: 2000,
            lazy: false,
            easing: 'easeOutBounce',
            loop: false,
            from: (ctx) => {
            if (ctx.type === 'data') {
            if (ctx.mode === 'default' && !ctx.dropped) {
              ctx.dropped = true;
              return 0;
                        }
                      }
                    }
                  }
                },
            responsive: true,
            plugins: {
              legend: {
                labels: {
                  usePointStyle: true,
                },
              },
              title: {
              display: false,
              text: 'TEXT'
              }
              },
            maintainAspectRatio: true,
            legend: {display: false},
            layout: {
            padding: 2,
            animation: {
            easing: 'easeInOutQuad',
          },
          },
          }
        });
      </script>
    <!-- Grafikon za Gradi -->
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <div class="card-actions">
              <button type="button" class="card-action card-toggler" title="Collapse"></button>
              <button type="button" class="card-action card-reload" title="Reload"></button>
              <button type="button" class="card-action card-remove" title="Remove"></button>
            </div>
            <strong>Chest Graphique</strong>
          </div>
          <div class="card-body">
            <canvas id="myChart2" style="width:100%;max-width:1200px;height:200px"></canvas>
          </div>
        </div>
      </div>
      
      <script>
        var myArray2 = <?php echo json_encode($datapoints2); ?>;
        // console.log(myArray)
        var xresults2 = [];
        var yresults2 = [];
        for(var i=myArray2.length-1; i>=0; i--) {
          if(!(myArray2[i].y)){
            // console.log("do nothing",i)
          }
          else{
            xresults2.push(myArray2[i].x)
            yresults2.push(parseInt(myArray2[i].y))
          }
        }
        // console.log(xresults)
        // console.log(yresults)
        new Chart("myChart2", {
          type: "line",
          data: {
            labels: xresults2,
            datasets: [{ 
              data: yresults2,
              label: "Chest Graphique",
              borderColor: "#000000",
              backgroundColor: '#00B0ED55',
              fill: true,
              borderWidth: 0,
            }]
          },
          options: {
            animations: {
            y: {
            duration: 2000,
            lazy: false,
            easing: 'easeInOutSine',
            loop: false,
            from: (ctx) => {
            if (ctx.type === 'data') {
            if (ctx.mode === 'default' && !ctx.dropped) {
              ctx.dropped = true;
              return 0;
                        }
                      }
                    }
                  }
                },
            responsive: true,
            plugins: {
              legend: {
                labels: {
                  usePointStyle: true,
                },
              },
              title: {
              display: false,
              text: 'TEXT'
              }
              },
            maintainAspectRatio: true,
            legend: {display: false},
            layout: {
            padding: 2,
            animation: {
            easing: 'easeInOutQuad',
          },
          },
          }
        });
      </script>
    <!-- Grafikon za Papok -->
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <div class="card-actions">
              <button type="button" class="card-action card-toggler" title="Collapse"></button>
              <button type="button" class="card-action card-reload" title="Reload"></button>
              <button type="button" class="card-action card-remove" title="Remove"></button>
            </div>
            <strong>Navel Graphique</strong>
          </div>
          <div class="card-body">
            <canvas id="myChart3" style="width:100%;max-width:1200px;height:200px"></canvas>
          </div>
        </div>
      </div>
      
      <script>
        var myArray3 = <?php echo json_encode($datapoints3); ?>;
        // console.log(myArray)
        var xresults3 = [];
        var yresults3 = [];
        for(var i=myArray3.length-1; i>=0; i--) {
          if(!(myArray3[i].y)){
            // console.log("do nothing",i)
          }
          else{
            xresults3.push(myArray3[i].x)
            yresults3.push(parseInt(myArray3[i].y))
          }
        }
        // console.log(xresults)
        // console.log(yresults)
        new Chart("myChart3", {
          type: "line",
          data: {
            labels: xresults3,
            datasets: [{ 
              data: yresults3,
              label: "Navel Graphique",
              borderColor: "#000000",
              backgroundColor: '#00FF7955',
              fill: true,
              borderWidth: 0,
            }]
          },
          options: {
            animations: {
            y: {
            duration: 2000,
            lazy: false,
            easing: 'easeInOutQuint',
            loop: false,
            from: (ctx) => {
            if (ctx.type === 'data') {
            if (ctx.mode === 'default' && !ctx.dropped) {
              ctx.dropped = true;
              return 0;
                        }
                      }
                    }
                  }
                },
            responsive: true,
            plugins: {
              legend: {
                labels: {
                  usePointStyle: true,
                },
              },
              title: {
              display: false,
              text: 'TEXT'
              }
              },
            maintainAspectRatio: true,
            legend: {display: false},
            layout: {
            padding: 2,
            animation: {
            easing: 'easeInOutQuad',
          },
          },
          }
        });
      </script>
    <!-- Grafikon za Kolk -->
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <div class="card-actions">
              <button type="button" class="card-action card-toggler" title="Collapse"></button>
              <button type="button" class="card-action card-reload" title="Reload"></button>
              <button type="button" class="card-action card-remove" title="Remove"></button>
            </div>
            <strong>Hip Graphique</strong>
          </div>
          <div class="card-body">
            <canvas id="myChart4" style="width:100%;max-width:1200px;height:200px"></canvas>
          </div>
        </div>
      </div>
      
      <script>
        var myArray4 = <?php echo json_encode($datapoints4); ?>;
        // console.log(myArray)
        var xresults4 = [];
        var yresults4 = [];
        for(var i=myArray4.length-1; i>=0; i--) {
          if(!(myArray4[i].y)){
            // console.log("do nothing",i)
          }
          else{
            xresults4.push(myArray4[i].x)
            yresults4.push(parseInt(myArray4[i].y))
          }
        }
        // console.log(xresults)
        // console.log(yresults)
        new Chart("myChart4", {
          type: "line",
          data: {
            labels: xresults4,
            datasets: [{ 
              data: yresults4,
              label: "Hip Graphique",
              borderColor: "#000000",
              backgroundColor: '#f0ff0055',
              fill: true,
              borderWidth: 0,
            }]
          },
          options: {
            animations: {
            y: {
            duration: 2000,
            lazy: false,
            easing: 'easeInOutExpo',
            loop: false,
            from: (ctx) => {
            if (ctx.type === 'data') {
            if (ctx.mode === 'default' && !ctx.dropped) {
              ctx.dropped = true;
              return 0;
                        }
                      }
                    }
                  }
                },
            responsive: true,
            plugins: {
              legend: {
                labels: {
                  usePointStyle: true,
                },
              },
              title: {
              display: false,
              text: 'TEXT'
              }
              },
            maintainAspectRatio: true,
            legend: {display: false},
            layout: {
            padding: 2,
            animation: {
            easing: 'easeInOutQuad',
          },
          },
          }
        });
      </script>
    <!-- Grafikon za Raka -->
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <div class="card-actions">
              <button type="button" class="card-action card-toggler" title="Collapse"></button>
              <button type="button" class="card-action card-reload" title="Reload"></button>
              <button type="button" class="card-action card-remove" title="Remove"></button>
            </div>
            <strong>Arm Graphique</strong>
          </div>
          <div class="card-body">
            <canvas id="myChart5" style="width:100%;max-width:1200px;height:200px"></canvas>
          </div>
        </div>
      </div>
      
      <script>
        var myArray5 = <?php echo json_encode($datapoints5); ?>;
        // console.log(myArray)
        var xresults5 = [];
        var yresults5 = [];
        for(var i=myArray5.length-1; i>=0; i--) {
          if(!(myArray5[i].y)){
            // console.log("do nothing",i)
          }
          else{
            xresults5.push(myArray5[i].x)
            yresults5.push(parseInt(myArray5[i].y))
          }
        }
        // console.log(xresults)
        // console.log(yresults)
        new Chart("myChart5", {
          type: "line",
          data: {
            labels: xresults5,
            datasets: [{ 
              data: yresults5,
              label: "Arm Graphique",
              borderColor: "#000000",
              backgroundColor: '#D3000055',
              fill: true,
              borderWidth: 0,
            }]
          },
          options: {
            animations: {
            y: {
            duration: 2000,
            lazy: false,
            easing: 'easeInOutElastic',
            loop: false,
            from: (ctx) => {
            if (ctx.type === 'data') {
            if (ctx.mode === 'default' && !ctx.dropped) {
              ctx.dropped = true;
              return 0;
                        }
                      }
                    }
                  }
                },
            responsive: true,
            plugins: {
              legend: {
                labels: {
                  usePointStyle: true,
                },
              },
              title: {
              display: false,
              text: 'TEXT'
              }
              },
            maintainAspectRatio: true,
            legend: {display: false},
            layout: {
            padding: 2,
            animation: {
            easing: 'easeInOutQuad',
          },
          },
          }
        });
      </script>
    <!-- Grafikon za But -->
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <div class="card-actions">
              <button type="button" class="card-action card-toggler" title="Collapse"></button>
              <button type="button" class="card-action card-reload" title="Reload"></button>
              <button type="button" class="card-action card-remove" title="Remove"></button>
            </div>
            <strong>But Graphique</strong>
          </div>
          <div class="card-body">
            <canvas id="myChart6" style="width:100%;max-width:1200px;height:200px"></canvas>
          </div>
        </div>
      </div>
      
      <script>
        var myArray6 = <?php echo json_encode($datapoints6); ?>;
        // console.log(myArray)
        var xresults6 = [];
        var yresults6 = [];
        for(var i=myArray6.length-1; i>=0; i--) {
          if(!(myArray6[i].y)){
            // console.log("do nothing",i)
          }
          else{
            xresults6.push(myArray6[i].x)
            yresults6.push(parseInt(myArray6[i].y))
          }
        }
        // console.log(xresults)
        // console.log(yresults)
        new Chart("myChart6", {
          type: "line",
          data: {
            labels: xresults6,
            datasets: [{ 
              data: yresults6,
              label: "But Graphique",
              borderColor: "#000000",
              backgroundColor: '#B400D355',
              fill: true,
              borderWidth: 0,
            }]
          },
          options: {
            animations: {
            y: {
            duration: 2000,
            lazy: false,
            easing: 'easeInOutBack',
            loop: false,
            from: (ctx) => {
            if (ctx.type === 'data') {
            if (ctx.mode === 'default' && !ctx.dropped) {
              ctx.dropped = true;
              return 0;
                        }
                      }
                    }
                  }
                },
            responsive: true,
            plugins: {
              legend: {
                labels: {
                  usePointStyle: true,
                },
              },
              title: {
              display: false,
              text: 'TEXT'
              }
              },
            maintainAspectRatio: true,
            legend: {display: false},
            layout: {
            padding: 2,
            animation: {
            easing: 'easeInOutQuad',
          },
          },
          }
        });
      </script>
    </div>
     
    <div id="Trainings" class="tab" style="display: none">
      <div class="card-body">
        <?php foreach($clients as $c): ?>
          <h3><?= $c->name; ?> List of Trainings</h3>
        <?php endforeach; ?>
      </div>
      <div class="profile-body">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#trainingtoday" data-toggle="tab">Today</a></li>
          <li><a href="#trainingtomorrow" data-toggle="tab">Tomorrow</a></li>
          <li><a href="#trainingweek" data-toggle="tab">All</a></li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane fade active in" id="trainingtoday">
            <div class="card">
              <div class="card-header">
                <div class="card-actions">
                  <button type="button" class="card-action card-toggler" title="Collapse"></button>
                  <button type="button" class="card-action card-reload" title="Reload"></button>
                  <button type="button" class="card-action card-remove" title="Remove"></button>
                </div>
                <strong>Today</strong>
              </div>
              <div class="card-body">
                <table id="demo-datatables-buttons-3" class="table table-bordered table-striped table-wrap dataTable" width="100%">
                  <thead>
                    <tr>
                      <th>Seq.</th>
                      <th>Name</th>
                      <th>Exercise</th>
                      <th>Ser/Rep</th>
                      <th>Technique</th>
                      <th>Time</th>
                      <th>Date</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($today_trainings as $tt): ?>
                    <tr>
                      <td><?= $tt->training_id; ?></td>
                      <td><?= $tt->name; ?></td>
                      <td><button data-toggle="modal" data-target="#exampleVezbaModal" onClick="seeVezba(<?= $tt->vezba; ?>)">Show</button></td>
                      <td><?= $tt->serii_povt; ?></td>
                      <td><button data-toggle="modal" data-target="#exampleTrainingModal" onClick="seeOptionTraining(<?= $tt->tech; ?>)">Show</button></td>
                      <td><?= $tt->vreme; ?></td>
                      <td><?= $tt->date; ?></td>
                    </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          
          <div class="tab-pane fade" id="trainingtomorrow">
            <div class="card">
              <div class="card-header">
                <div class="card-actions">
                  <button type="button" class="card-action card-toggler" title="Collapse"></button>
                  <button type="button" class="card-action card-reload" title="Reload"></button>
                  <button type="button" class="card-action card-remove" title="Remove"></button>
                </div>
                <strong>Tomorrow</strong>
              </div>
              <div class="card-body">
                <table id="demo-datatables-buttons-4" class="table table-bordered table-striped table-wrap dataTable" width="100%">
                  <thead>
                    <tr>
                      <th>Seq.</th>
                      <th>Name</th>
                      <th>Exercise</th>
                      <th>Ser/Rep</th>
                      <th>Technique</th>
                      <th>Time</th>
                      <th>Date</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($tomorrow_trainings as $tts): ?>
                    <tr>
                      <td><?= $tts->training_id; ?></td>
                      <td><?= $tts->name; ?></td>
                      <td><button data-toggle="modal" data-target="#exampleVezbaModal" onClick="seeVezba(<?= $tts->vezba; ?>)">Show</button></td>
                      <td><?= $tts->serii_povt; ?></td>
                      <td><button data-toggle="modal" data-target="#exampleTrainingModal" onClick="seeOptionTraining(<?= $tts->tech; ?>)">Show</button></td>
                      <td><?= $tts->vreme; ?></td>
                      <td><?= $tts->date; ?></td>
                    </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          
          <div class="tab-pane fade" id="trainingweek">
            <div class="card">
              <div class="card-header">
                <div class="card-actions">
                  <button type="button" class="card-action card-toggler" title="Collapse"></button>
                  <button type="button" class="card-action card-reload" title="Reload"></button>
                  <button type="button" class="card-action card-remove" title="Remove"></button>
                </div>
                <strong>All</strong>
              </div>
              <div class="card-body">
                <table id="demo-datatables-buttons-5" class="table table-bordered table-striped table-wrap dataTable" width="100%">
                  <thead>
                    <tr>
                      <th>Seq.</th>
                      <th>Name</th>
                      <th>Exercise</th>
                      <th>Ser/Rep</th>
                      <th>Technique</th>
                      <th>Date</th>
                      <th>Time</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($all_trainings as $at): ?>
                    <tr>
                      <td><?= $at->training_id; ?></td>
                      <td><?= $at->name; ?></td>
                      <td><button data-toggle="modal" data-target="#exampleVezbaModal" onClick="seeVezba(<?= $at->vezba; ?>)">Show</button></td>
                      <td><?= $at->serii_povt; ?></td>
                      <td><button data-toggle="modal" data-target="#exampleTrainingModal" onClick="seeOptionTraining(<?= $at->tech; ?>)">Show</button></td>
                      <td><?= $at->date; ?></td>
                      <td><?= $at->vreme; ?></td>
                    </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
      
    <div id="Diets" class="tab" style="display: none">
      <div class="card-body">
        <?php foreach($clients as $c): ?>
          <h3><?= $c->name; ?> List of Diets</h3>
        <?php endforeach; ?>
      </div>
      <div class="profile-body">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#dietToday" data-toggle="tab">Today</a></li>
          <li><a href="#dietTomorrow" data-toggle="tab">Tomorrow</a></li>
          <li><a href="#dietWeek" data-toggle="tab">All</a></li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane fade active in" id="dietToday">
            <div class="card">
              <div class="card-header">
                <div class="card-actions">
                  <button type="button" class="card-action card-toggler" title="Collapse"></button>
                  <button type="button" class="card-action card-reload" title="Reload"></button>
                  <button type="button" class="card-action card-remove" title="Remove"></button>
                </div>
                <strong>Today</strong>
              </div>
              <div class="card-body">
                <table id="demo-datatables-buttons-6" class="table table-bordered table-striped table-wrap dataTable" width="100%">
                  <thead>
                    <tr>
                      <th>Seq.</th>
                      <th>Name</th>
                      <th>Time</th>
                      <th>Option 1</th>
                      <th>Option 2</th>
                      <th>Option 3</th>
                      <th>Date</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($today_meals as $tm): ?>
                    <tr>
                      <td><?= $tm->meal_id; ?></td>
                      <td><?= $tm->name; ?></td>
                      <td><?= $tm->vreme; ?></td>
                      <td><?php if($tm->option1 != 0): ?> 
                        <button data-toggle="modal" data-target="#exampleModal" onClick="seeOption(<?= $tm->option1; ?>)">Show</button>  
                      <?php else: ?>
                        <p>No Option</p>
                      <?php endif; ?>    
                      </td>
                      <td><?php if($tm->option2 != 0): ?> 
                        <button data-toggle="modal" data-target="#exampleModal" onClick="seeOption(<?= $tm->option2; ?>)">Show</button>  
                      <?php else: ?>
                        <p>No Option</p>
                      <?php endif; ?>    
                      </td>
                      <td><?php if($tm->option3 != 0): ?> 
                          <button data-toggle="modal" data-target="#exampleModal" onClick="seeOption(<?= $tm->option3; ?>)">Show</button>  
                      <?php else: ?>
                        <p>No Option</p>
                      <?php endif; ?>    
                      </td>
                      <td><?= $tm->date; ?></td>
                    </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="dietTomorrow">
            <div class="card">
              <div class="card-header">
                <div class="card-actions">
                  <button type="button" class="card-action card-toggler" title="Collapse"></button>
                  <button type="button" class="card-action card-reload" title="Reload"></button>
                  <button type="button" class="card-action card-remove" title="Remove"></button>
                </div>
                <strong>Tomorrow</strong>
              </div>
              <div class="card-body">
                <table id="demo-datatables-buttons-7" class="table table-bordered table-striped table-wrap dataTable" width="100%">
                  <thead>
                    <tr>
                      <th>Seq.</th>
                      <th>Name</th>
                      <th>Time</th>
                      <th>Option 1</th>
                      <th>Option 2</th>
                      <th>Option 3</th>
                      <th>Date</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($tomorrow_meals as $tms): ?>
                    <tr>
                      <td><?= $tms->meal_id; ?></td>
                      <td><?= $tms->name; ?></td>
                      <td><?= $tms->vreme; ?></td>
                      <td><?php if($tms->option1 != 0): ?> 
                          <button data-toggle="modal" data-target="#exampleModal" onClick="seeOption(<?= $tms->option1; ?>)">Show</button>  
                      <?php else: ?>
                        <p>No Option</p>
                      <?php endif; ?>    
                      </td>
                      <td><?php if($tms->option2 != 0): ?> 
                          <button data-toggle="modal" data-target="#exampleModal" onClick="seeOption(<?= $tms->option2; ?>)">Show</button>  
                      <?php else: ?>
                        <p>No Option</p>
                      <?php endif; ?>    
                      </td>
                      <td><?php if($tms->option3 != 0): ?> 
                          <button data-toggle="modal" data-target="#exampleModal" onClick="seeOption(<?= $tms->option3; ?>)">Show</button>  
                      <?php else: ?>
                        <p>No Option</p>
                      <?php endif; ?>    
                      </td>
                      <td><?= $tms->date; ?></td>
                    </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="dietWeek">
            <div class="card">
              <div class="card-header">
                <div class="card-actions">
                  <button type="button" class="card-action card-toggler" title="Collapse"></button>
                  <button type="button" class="card-action card-reload" title="Reload"></button>
                  <button type="button" class="card-action card-remove" title="Remove"></button>
                </div>
                <strong>All</strong>
              </div>
              <div class="card-body">
               <table id="demo-datatables-buttons-2" class="table table-bordered table-striped table-wrap dataTable" width="100%">
                  <thead>
                    <tr>
                      <th>Seq.</th>
                      <th>Name</th>
                      <th>Time</th>
                      <th>Option 1</th>
                      <th>Option 2</th>
                      <th>Option 3</th>
                      <th>Date</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($all_meals as $ams): ?>
                    <tr>
                      <td><?= $ams->meal_id; ?></td>
                      <td><?= $ams->name; ?></td>
                      <td><?= $ams->vreme; ?></td>
                      <td><?php if($ams->option1 != 0): ?> 
                          <button data-toggle="modal" data-target="#exampleModal" onClick="seeOption(<?= $ams->option1; ?>)">??????????????</button>  
                      <?php else: ?>
                        <p>No Option</p>
                      <?php endif; ?>    
                      </td>
                      <td><?php if($ams->option2 != 0): ?> 
                          <button data-toggle="modal" data-target="#exampleModal" onClick="seeOption(<?= $ams->option2; ?>)">??????????????</button>  
                      <?php else: ?>
                        <p>No Option</p>
                      <?php endif; ?>    
                      </td>
                      <td><?php if($ams->option3 != 0): ?> 
                          <button data-toggle="modal" data-target="#exampleModal" onClick="seeOption(<?= $ams->option3; ?>)">??????????????</button>  
                      <?php else: ?>
                        <p>No Option</p>
                      <?php endif; ?>    
                      </td>
                      <td><?= $ams->date; ?></td>
                    </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content animated flipInY">
      <div class="modal-header">
        <h3 class="modal-title text-primary text-center" id="modalOpName"></h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h4 class="text-primary text-center">Ingredients</h4>
        <div id="modalSostojki" style="text-align: center;">Ingredients:</div>
        <hr>
        <h4 class="text-primary text-center">Macronutritions</h4>
        <div class="row">
          <div class="col-md-4">
            <div id="modalProteins" class="text-center">Proteins:</div>
          </div>
          <div class="col-md-4">
            <div id="modalCarbohydrates" class="text-center">Carbohydrates:</div>
          </div>
          <div class="col-md-4">
            <div id="modalFats" class="text-center">Fats:</div>
          </div>
        </div>
        <br>
        <div class="text-center mark bg-primary" id="modalCalories">Calories:</div>
        <hr>
        <h4 class="text-primary text-center dt">Method of Preparation</h4>
        <div id="modalDescription" style="text-align: center;">Description:</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal Training -->
<div class="modal fade" id="exampleTrainingModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content animated flipInY">
      <div class="modal-header">
        <!--<h5 class="modal-title" id="modalTechName"></h5>-->
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h4 class="text-primary text-center">Tech Name</h4>
        <div id="modalName" style="text-align: center;">Name:</div>
        <hr>
        <h4 class="text-primary text-center">Tech Link</h4>
        <div class="text-center">
          <a id="modalLink" target="blank">Link:</a>
        </div>
        <hr>
        <h4 class="text-primary text-center">Description</h4>
        <div id="modalTrainingDescription" style="text-align: center;">Description:</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal Vezba-->
  <div class="modal fade" id="exampleVezbaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content animated flipInY">
        <div class="modal-header">
          <!--<h5 class="modal-title" id="modalVezbaName1"></h5>-->
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <h4 class="text-primary text-center">Exercise Name</h4>
          <div id="modalVezbaName" style="text-align: center;">Name:</div>
          <hr>
          <h4 class="text-primary text-center">Exercise Link</h4>
          <div class="text-center">
            <a id="modalVezbaLink" target="blank">Link:</a>
          </div>
          <hr>
          <h4 class="text-primary text-center">Muscule Group</h4>
          <div id="modalVezbaMuscle" style="text-align: center;">Muscule Group:</div>
          <hr>
          <h4 class="text-primary text-center">Description</h4>
          <div id="modalVezbaDescription" style="text-align: center;">Description:</div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</section>
<script type="text/javascript">
var modalOpName = document.getElementById("modalOpName")
var modalSostojki = document.getElementById("modalSostojki")
var modalProteins = document.getElementById("modalProteins")
var modalCarbohydrates = document.getElementById("modalCarbohydrates")
var modalFats = document.getElementById("modalFats")
var modalCalories = document.getElementById("modalCalories")
var modalDescription = document.getElementById("modalDescription")
modalSostojki.innerHTML = "proba"
// console.log(modalSostojki)
  function seeOption(t){
    console.log(t)
    fetch("/chose_option.php", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
            Accept: 'application/json'
          },
            body: JSON.stringify(t)
          }).then((response) => {
            return response.text()
          })
          .then((data) => {
            // Work with JSON data here  
            var theItem = JSON.parse(data.slice(57,-1))
            modalOpName.innerHTML = "" + theItem.name
            modalSostojki.innerHTML = "" + theItem.sostojki
            modalProteins.innerHTML = "????????????????<br>" + theItem.proteins + "????"
            modalCarbohydrates.innerHTML = "????????????????????????<br>" + theItem.carbohydrates + "????"
            modalFats.innerHTML = "??????????<br>" + theItem.fats + "????"
            modalCalories.innerHTML = "???????????? ?????????????? : " + ((parseInt(theItem.proteins) * 4) + (parseInt(theItem.carbohydrates) * 4) + (parseInt(theItem.fats) * 9)) + " kCal"
            modalDescription.innerHTML = "" + theItem.description
          })
          .catch((err) => {
            console.log(err)
          })
  }
</script>
<script type="text/javascript">
// var modalTechName = document.getElementById("modalTechName")
var modalName = document.getElementById("modalName")
var modalLink = document.getElementById("modalLink")
var modalTrainingDescription = document.getElementById("modalTrainingDescription")
  function seeOptionTraining(t){
    console.log(t)
    fetch("/chose_tech.php", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
            Accept: 'application/json'
          },
            body: JSON.stringify(t)
          }).then((response) => {
              // console.log(response)
            return response.text()
          })
          .then((data) => {
            // Work with JSON data here
            // console.log(data[0])
            var theItem = JSON.parse(data.slice(57, -1))
            // modalTechName.innerHTML = "" + theItem.name
            modalName.innerHTML = "" + theItem.name
            modalLink.innerHTML = "" + theItem.link
            modalLink.href = theItem.link
            modalTrainingDescription.innerHTML = "" + theItem.description
          })
          .catch((err) => {
            // Do something for an error here
          })
  }
</script>
<script type="text/javascript">
// var modalVezbaName1 = document.getElementById("modalVezbaName1")
var modalVezbaName = document.getElementById("modalVezbaName")
var modalVezbaLink = document.getElementById("modalVezbaLink")
var modalVezbaMuscle = document.getElementById("modalVezbaMuscle")
var modalVezbaDescription = document.getElementById("modalVezbaDescription")
  function seeVezba(t){
    console.log(t)
    fetch("/chose_vezba.php", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
            Accept: 'application/json'
          },
            body: JSON.stringify(t)
          }).then((response) => {
              // console.log(response)
            return response.text()
          })
          .then((data) => {
            // Work with JSON data here
            // console.log(data[0])
            var theItem = JSON.parse(data.slice(57, -1))
            // modalVezbaName1.innerHTML = "" + theItem.name
            modalVezbaName.innerHTML = "" + theItem.name
            modalVezbaLink.innerHTML = "" + theItem.link_vezba
            modalVezbaLink.href = theItem.link_vezba
            modalVezbaMuscle.innerHTML = "" + theItem.muskulna_grupa
            modalVezbaDescription.innerHTML = "" + theItem.description
          })
          .catch((err) => {
            // Do something for an error here
          })
  }
</script>