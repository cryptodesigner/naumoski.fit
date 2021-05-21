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
?>

<section>
<div class="profile">
  <div class="profile-header">
    <div class="profile-cover">
      <div class="profile-container">
        <div class="profile-card">
          <div class="profile-avetar">
            <img class="profile-avetar-img" width="128" height="128" src="../static/img/user.jpg" alt="Teddy Wilson">
          </div>
          <div class="profile-overview">
            <?php foreach($clients as $c): ?>
              <h1 class="profile-name"><?= $c->name; ?> <?= $c->surname; ?></h1>
            <?php endforeach; ?>
            <a class="profile-follow-btn" href ="edit_profile.php">Уреди Профил</a>
            <p>Клиент<a class="link-inverted"></a></p>
          </div>
        </div>
        <div class="profile-tabs">
          <ul class="profile-nav">
            <li><a onclick="openTab('Profile')">Профил</a></li>
            <li><a onclick="openTab('Trainings')">Тренинзи</a></li>
            <li><a onclick="openTab('Diets')">Диети</a></li>
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
          <h1><?= $c->name; ?> Профил</h1>
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
            <strong>Клиент</strong>
          </div>
          <div class="card-body" data-toggle="match-height">
            <div class="table-responsive">
              <table class="table table-hover">
                <tr>
                  <?php foreach($clients as $c): ?>
                  <th colspan="6">Р.б: </th>
                  <td colspan="6"><?= $c->client_id; ?></td>
                  <?php endforeach; ?>
                </tr>
                <tr>
                  <?php foreach($assigned_manager as $am): ?>
                  <th colspan="6">Менаџер: </th>
                  <td colspan="6"><?= $am->name; ?></td>
                  <?php endforeach; ?>
                </tr>
                <tr>
                  <?php foreach($clients as $c): ?>
                  <th colspan="6">Име: </th>
                  <td colspan="6"><?= $c->name; ?></td>
                  <?php endforeach; ?>
                </tr>
                <tr>
                  <?php foreach($clients as $c): ?>
                  <th colspan="6">Презиме: </th>
                  <td colspan="6"><?= $c->surname; ?></td>
                  <?php endforeach; ?>
                </tr>
                <tr>
                  <?php foreach($clients as $c): ?>
                  <th colspan="6">Емаил: </th>
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
            <strong>Основни Инфо</strong>
          </div>
          <div class="card-body" data-toggle="match-height">
            <div class="table-responsive">
              <table class="table table-hover">
                <tr>
                  <?php foreach($basics as $b): ?>
                  <th colspan="6">Пол: </th>
                  <td colspan="6"><?= $b->pol; ?></td>
                  <?php endforeach; ?>
                </tr>
                <tr>
                  <?php foreach($basics as $b): ?>
                  <th colspan="6">Роденден: </th>
                  <td colspan="6"><?= $b->godini; ?></td>
                  <?php endforeach; ?>
                </tr>
                <tr>
                  <?php foreach($basics as $b): ?>
                  <th colspan="6">Висина: </th>
                  <td colspan="6"><?= $b->visina; ?></td>
                  <?php endforeach; ?>
                </tr>
                <tr>
                  <?php foreach($basics as $b): ?>
                  <th colspan="6">Тежина: </th>
                  <td colspan="6"><?= $b->tezina; ?></td>
                  <?php endforeach; ?>
                </tr>
                <tr>
                  <?php foreach($basics as $b): ?>
                  <th colspan="6">Искуство: </th>
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
            <strong>Карактеристики</strong>
          </div>
          <div class="card-body" data-toggle="match-height">
            <div class="table-responsive">
              <table class="table table-hover">
                <tr>
                  <?php foreach($basics as $b): ?>
                  <th colspan="6">Алергии: </th>
                  <td colspan="6"><?= $b->alergija; ?></td>
                  <?php endforeach; ?>
                </tr>
                <tr>
                  <?php foreach($basics as $b): ?>
                  <th colspan="6">Нетолерантност: </th>
                  <td colspan="6"><?= $b->netolerantnost; ?></td>
                  <?php endforeach; ?>
                </tr>
                <tr>
                  <?php foreach($basics as $b): ?>
                  <th colspan="6">Одбивност: </th>
                  <td colspan="6"><?= $b->odbivnost; ?></td>
                  <?php endforeach; ?>
                </tr>
                <tr>
                  <?php foreach($basics as $b): ?>
                  <th colspan="6">Заболувања: </th>
                  <td colspan="6"><?= $b->zaboluvanja; ?></td>
                  <?php endforeach; ?>
                </tr>
                <tr>
                  <?php foreach($basics as $b): ?>
                  <th colspan="6">Суплементи?: </th>
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
            <strong>Дневна Рутина</strong>
          </div>
          <div class="card-body" data-toggle="match-height">
            <div class="table-responsive">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>Име</th>
                    <th>Време</th>
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
        foreach ($measurements as $m) {
          array_push($datapoints, array("x"=> $m->cur_date, "y"=> $m->tezina));
        }
        // echo '<pre>'; print_r($datapoints); echo '</pre>';
      ?>

      <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <div class="card-actions">
              <button type="button" class="card-action card-toggler" title="Collapse"></button>
              <button type="button" class="card-action card-reload" title="Reload"></button>
              <button type="button" class="card-action card-remove" title="Remove"></button>
            </div>
            <strong>Графикон за Тежина</strong>
          </div>
          <div class="card-body">
            <canvas id="myChart" style="width:100%;max-width:1200px;height:200px"></canvas>
          </div>
        </div>
      </div>
      
      <script>
        var myArray = <?php echo json_encode($datapoints); ?>;
        // console.log(myArray)
        var xresults = [];
        var yresults = [];
        for(var i=myArray.length-1; i>=0; i--) {
          xresults.push(myArray[i].x)
          yresults.push(parseInt(myArray[i].y))
        }
        // console.log(xresults)
        // console.log(yresults)
        new Chart("myChart", {
          type: "line",
          data: {
            labels: xresults,
            datasets: [{ 
              data: yresults,
              borderColor: "red",
              fill: false
            }]
          },
          options: {
            legend: {display: false}
          }
        });
      </script>
    </div>
     
    <div id="Trainings" class="tab" style="display: none">
      <div class="card-body">
        <?php foreach($clients as $c): ?>
          <h1><?= $c->name; ?> Листа На Тренинзи</h1>
        <?php endforeach; ?>
      </div>
      <div class="panel m-b-lg">
        <ul class="nav nav-tabs nav-justified">
          <li class="active"><a href="#trainingtoday" data-toggle="tab">Денес</a></li>
          <li><a href="#trainingtomorrow" data-toggle="tab">Утре</a></li>
          <li><a href="#trainingweek" data-toggle="tab">Сите</a></li>
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
                <strong>Денес</strong>
              </div>
              <div class="card-body">
                <table id="demo-datatables-buttons-3" class="table table-bordered table-striped table-wrap dataTable"cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th>Р.б.</th>
                      <th>Име</th>
                      <th>Вежба</th>
                      <th>Серии / Повт</th>
                      <th>Техника</th>
                      <th>Време</th>
                      <th>Дата</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($today_trainings as $tt): ?>
                    <tr>
                      <td><?= $tt->training_id; ?></td>
                      <td><?= $tt->name; ?></td>
                      <td><button data-toggle="modal" data-target="#exampleVezbaModal" onClick="seeVezba(<?= $tt->vezba; ?>)">Преглед</button></td>
                      <td><?= $tt->serii_povt; ?></td>
                      <td><button data-toggle="modal" data-target="#exampleTrainingModal" onClick="seeOptionTraining(<?= $tt->tech; ?>)">Преглед</button></td>
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
                <strong>Утре</strong>
              </div>
              <div class="card-body">
                <table id="demo-datatables-buttons-4" class="table table-bordered table-striped table-wrap dataTable"cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th>Р.б.</th>
                      <th>Име</th>
                      <th>Вежба</th>
                      <th>Серии / Повт</th>
                      <th>Техника</th>
                      <th>Време</th>
                      <th>Дата</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($tomorrow_trainings as $tts): ?>
                    <tr>
                      <td><?= $tts->training_id; ?></td>
                      <td><?= $tts->name; ?></td>
                      <td><button data-toggle="modal" data-target="#exampleVezbaModal" onClick="seeVezba(<?= $tts->vezba; ?>)">Преглед</button></td>
                      <td><?= $tts->serii_povt; ?></td>
                      <td><button data-toggle="modal" data-target="#exampleTrainingModal" onClick="seeOptionTraining(<?= $tts->tech; ?>)">Преглед</button></td>
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
                <strong>Сите</strong>
              </div>
              <div class="card-body">
                <table id="demo-datatables-buttons-5" class="table table-bordered table-striped table-wrap dataTable"cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th>Р.б.</th>
                      <th>Име</th>
                      <th>Вежба</th>
                      <th>Серии / Повт</th>
                      <th>Техника</th>
                      <th>Дата</th>
                      <th>Време</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($all_trainings as $at): ?>
                    <tr>
                      <td><?= $at->training_id; ?></td>
                      <td><?= $at->name; ?></td>
                      <td><button data-toggle="modal" data-target="#exampleVezbaModal" onClick="seeVezba(<?= $at->vezba; ?>)">Преглед</button></td>
                      <td><?= $at->serii_povt; ?></td>
                      <td><button data-toggle="modal" data-target="#exampleTrainingModal" onClick="seeOptionTraining(<?= $at->tech; ?>)">Преглед</button></td>
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
          <h1><?= $c->name; ?> Листа На Диети</h1>
        <?php endforeach; ?>
      </div>
      <div class="panel m-b-lg">
        <ul class="nav nav-tabs nav-justified">
          <li class="active"><a href="#dietToday" data-toggle="tab">Денес</a></li>
          <li><a href="#dietTomorrow" data-toggle="tab">Утре</a></li>
          <li><a href="#dietWeek" data-toggle="tab">Сите</a></li>
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
                <strong>Денес</strong>
              </div>
              <div class="card-body">
                <table id="demo-datatables-buttons-6" class="table table-bordered table-striped table-wrap dataTable"cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th>Р.б.</th>
                      <th>Име</th>
                      <th>Време</th>
                      <th>Опција 1</th>
                      <th>Опција 2</th>
                      <th>Опција 3</th>
                      <th>Дата</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($today_meals as $tm): ?>
                    <tr>
                      <td><?= $tm->meal_id; ?></td>
                      <td><?= $tm->name; ?></td>
                      <td><?= $tm->vreme; ?></td>
                      <td><?php if($tm->option1 != 0): ?> 
                        <button data-toggle="modal" data-target="#exampleModal" onClick="seeOption(<?= $tm->option1; ?>)">Преглед</button>  
                      <?php else: ?>
                        <p>Нема Опција</p>
                      <?php endif; ?>    
                      </td>
                      <td><?php if($tm->option2 != 0): ?> 
                        <button data-toggle="modal" data-target="#exampleModal" onClick="seeOption(<?= $tm->option2; ?>)">Преглед</button>  
                      <?php else: ?>
                        <p>Нема Опција</p>
                      <?php endif; ?>    
                      </td>
                      <td><?php if($tm->option3 != 0): ?> 
                          <button data-toggle="modal" data-target="#exampleModal" onClick="seeOption(<?= $tm->option3; ?>)">Преглед</button>  
                      <?php else: ?>
                        <p>Нема Опција</p>
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
                <strong>Утре</strong>
              </div>
              <div class="card-body">
                <table id="demo-datatables-buttons-7" class="table table-bordered table-striped table-wrap dataTable"cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th>Р.б.</th>
                      <th>Име</th>
                      <th>Време</th>
                      <th>Опција 1</th>
                      <th>Опција 2</th>
                      <th>Опција 3</th>
                      <th>Дата</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($tomorrow_meals as $tms): ?>
                    <tr>
                      <td><?= $tms->meal_id; ?></td>
                      <td><?= $tms->name; ?></td>
                      <td><?= $tms->vreme; ?></td>
                      <td><?php if($tms->option1 != 0): ?> 
                          <button data-toggle="modal" data-target="#exampleModal" onClick="seeOption(<?= $tms->option1; ?>)">Преглед</button>  
                      <?php else: ?>
                        <p>Нема Опција</p>
                      <?php endif; ?>    
                      </td>
                      <td><?php if($tms->option2 != 0): ?> 
                          <button data-toggle="modal" data-target="#exampleModal" onClick="seeOption(<?= $tms->option2; ?>)">Преглед</button>  
                      <?php else: ?>
                        <p>Нема Опција</p>
                      <?php endif; ?>    
                      </td>
                      <td><?php if($tms->option3 != 0): ?> 
                          <button data-toggle="modal" data-target="#exampleModal" onClick="seeOption(<?= $tms->option3; ?>)">Преглед</button>  
                      <?php else: ?>
                        <p>Нема Опција</p>
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
                <strong>Сите</strong>
              </div>
              <div class="card-body">
               <table id="demo-datatables-buttons-2" class="table table-bordered table-striped table-wrap dataTable"cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th>Р.б.</th>
                      <th>Име</th>
                      <th>Време</th>
                      <th>Опција 1</th>
                      <th>Опција 2</th>
                      <th>Опција 3</th>
                      <th>Дата</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($all_meals as $ams): ?>
                    <tr>
                      <td><?= $ams->meal_id; ?></td>
                      <td><?= $ams->name; ?></td>
                      <td><?= $ams->vreme; ?></td>
                      <td><?php if($ams->option1 != 0): ?> 
                          <button data-toggle="modal" data-target="#exampleModal" onClick="seeOption(<?= $ams->option1; ?>)">Преглед</button>  
                      <?php else: ?>
                        <p>Нема Опција</p>
                      <?php endif; ?>    
                      </td>
                      <td><?php if($ams->option2 != 0): ?> 
                          <button data-toggle="modal" data-target="#exampleModal" onClick="seeOption(<?= $ams->option2; ?>)">Преглед</button>  
                      <?php else: ?>
                        <p>Нема Опција</p>
                      <?php endif; ?>    
                      </td>
                      <td><?php if($ams->option3 != 0): ?> 
                          <button data-toggle="modal" data-target="#exampleModal" onClick="seeOption(<?= $ams->option3; ?>)">Преглед</button>  
                      <?php else: ?>
                        <p>Нема Опција</p>
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
        <h4 class="text-primary text-center">Состојки</h4>
        <div id="modalSostojki" style="text-align: center;">Sostojki:</div>
        <hr>
        <h4 class="text-primary text-center">Макронутриенти</h4>
        <div class="row">
          <div class="col-md-4">
            <div id="modalProteins" class="text-center">Proteini:</div>
          </div>
          <div class="col-md-4">
            <div id="modalCarbohydrates" class="text-center">Jaglenohidrati:</div>
          </div>
          <div class="col-md-4">
            <div id="modalFats" class="text-center">Masti:</div>
          </div>
        </div>
        <br>
        <div class="text-center mark bg-primary" id="modalCalories">Kalorii:</div>
        <hr>
        <h4 class="text-primary text-center dt">Начин на Подготовка</h4>
        <div id="modalDescription" style="text-align: center;">Description:</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Затвори</button>
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
        <h4 class="text-primary text-center">Име на Техника</h4>
        <div id="modalName" style="text-align: center;">Name:</div>
        <hr>
        <h4 class="text-primary text-center">Линк за Техника</h4>
        <div class="text-center">
          <a id="modalLink" target="blank">Link:</a>
        </div>
        <hr>
        <h4 class="text-primary text-center">Објаснување</h4>
        <div id="modalTrainingDescription" style="text-align: center;">Description:</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Затвори</button>
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
          <h4 class="text-primary text-center">Име на Вежба</h4>
          <div id="modalVezbaName" style="text-align: center;">Name:</div>
          <hr>
          <h4 class="text-primary text-center">Линк за Вежба</h4>
          <div class="text-center">
            <a id="modalVezbaLink" target="blank">Link:</a>
          </div>
          <hr>
          <h4 class="text-primary text-center">Мускулна Група</h4>
          <div id="modalVezbaMuscle" style="text-align: center;">Muskulna Grupa:</div>
          <hr>
          <h4 class="text-primary text-center">Објаснување</h4>
          <div id="modalVezbaDescription" style="text-align: center;">Description:</div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal">Затвори</button>
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
            modalProteins.innerHTML = "Протеини<br>" + theItem.proteins + "гр"
            modalCarbohydrates.innerHTML = "Јаглехидрати<br>" + theItem.carbohydrates + "гр"
            modalFats.innerHTML = "Масти<br>" + theItem.fats + "гр"
            modalCalories.innerHTML = "Вкупно Калории : " + ((parseInt(theItem.proteins) * 4) + (parseInt(theItem.carbohydrates) * 4) + (parseInt(theItem.fats) * 9)) + " kCal"
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