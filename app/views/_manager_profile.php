<?php
  $current_manager = $_SESSION['manager_id'];
  $sql = "SELECT * FROM clients WHERE managers_manager_id = '$current_manager.';";
  $statement = $connection->prepare($sql);
  $statement->execute();
  $clients = $statement->fetchAll(PDO::FETCH_OBJ);

  $cur_manager = $_SESSION['manager_id'];
  $sql = "SELECT * FROM managers WHERE manager_id = '$cur_manager.';";
  $statement = $connection->prepare($sql);
  $statement->execute();
  $managers = $statement->fetchAll(PDO::FETCH_OBJ);
?>

<section>
<div class="profile">
  <div class="profile-header">
    <div class="profile-cover">
      <div class="profile-container">
        <div class="profile-card">
          <div class="profile-avetar">
            <img class="profile-avetar-img" width="128" height="128" src="../static/img/user.jpg" alt="Wilson">
          </div>
          <div class="profile-overview">
            <?php foreach($managers as $m): ?>
              <h1 class="profile-name"><?= $m->name; ?> <?= $m->surname; ?>'s Profile</h1>
            <?php endforeach; ?>
            <a class="profile-follow-btn" href ="edit_m_profile.php">Edit Profile</a>
            <p>Manager<a class="link-inverted"></a></p>
          </div>
        </div>
        <div class="profile-tabs">
          <ul class="profile-nav">
            <li><a onclick="openTab('Profile')">Profile</a></li>
            <li><a onclick="openTab('Clients')">Clients</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>


<div class="profile-body">
  <div class="card-body">

    <div id="Profile" class="tab">

      <div class="col-xs-6 col-md-3">
        <div class="card no-background no-border">
          <div class="card-values">
            <div class="p-x">
              <small>Clents</small>
              <h3 class="card-title fw-l">185,118</h3>
            </div>
          </div>
          <div class="card-chart">
            <canvas data-chart="line" data-animation="false" data-labels='["Jun 21", "Jun 20", "Jun 19", "Jun 18", "Jun 17", "Jun 16", "Jun 15"]' data-values='[{"backgroundColor": "rgba(2, 136, 209,                    0.03)", "borderColor": "#0288d1", "data": [25250, 23370, 25568, 28961, 26762, 30072, 25135]}]' data-scales='{"yAxes": [{ "ticks": {"max": 32327}}]}' data-hide='["legend", "points",                    "scalesX", "scalesY", "tooltips"]' height="35"></canvas>
          </div>
        </div>
      </div>
      <div class="col-xs-6 col-md-3">
        <div class="card bg-primary no-border">
          <div class="card-values">
            <div class="p-x">
              <small>Groceries</small>
              <h3 class="card-title fw-l">68,394</h3>
            </div>
          </div>
          <div class="card-chart">
            <canvas data-chart="line" data-animation="false" data-labels='["Jun 21", "Jun 20", "Jun 19", "Jun 18", "Jun 17", "Jun 16", "Jun 15"]' data-values='[{"backgroundColor": "rgba(255, 255,                     255, 0.5)", "borderColor": "#ffffff", "data": [8796, 11317, 8678, 9452, 8453, 11853, 9945]}]' data-scales='{"yAxes": [{ "ticks": {"max": 12742}}]}' data-hide='["legend", "points",                     "scalesX", "scalesY", "tooltips"]' height="35"></canvas>
          </div>
        </div>
      </div>
      <div class="col-xs-6 col-md-3">
        <div class="card bg-info no-border">
          <div class="card-values">
            <div class="p-x">
              <small>Meals</small>
              <h3 class="card-title fw-l">95,590</h3>
            </div>
          </div>
          <div class="card-chart">
            <canvas data-chart="line" data-animation="false" data-labels='["Jun 21", "Jun 20", "Jun 19", "Jun 18", "Jun 17", "Jun 16", "Jun 15"]' data-values='[{"backgroundColor": "rgba(255, 255,                     255, 0.5)", "borderColor": "#ffffff", "data": [116196, 145160, 124419, 147004, 134740, 120846, 137225]}]' data-scales='{"yAxes": [{ "ticks": {"max": 158029}}]}' data-hide='["legend",                    "points", "scalesX", "scalesY", "tooltips"]' height="35"></canvas>
          </div>
        </div>
      </div>
      <div class="col-xs-6 col-md-3">
        <div class="card bg-primary no-border">
          <div class="card-values">
            <div class="p-x">
              <small>Trainings</small>
              <h3 class="card-title fw-l">600,44</h3>
            </div>
          </div>
          <div class="card-chart">
            <canvas data-chart="line" data-animation="false" data-labels='["Jun 21", "Jun 20", "Jun 19", "Jun 18", "Jun 17", "Jun 16", "Jun 15"]' data-values='[{"backgroundColor": "rgba(255, 255,                     255, 0.5)", "borderColor": "#ffffff", "data": [8796, 11317, 8678, 9452, 8453, 11853, 9945]}]' data-scales='{"yAxes": [{ "ticks": {"max": 12742}}]}' data-hide='["legend", "points",                     "scalesX", "scalesY", "tooltips"]' height="35"></canvas>
          </div>
        </div>
      </div>
    </div>

    <div id="Clients" class="tab" style="display: none">
      <div class="profile-container">
        <?php foreach($managers as $m): ?>
          <h1><?= $m->name; ?>'s Client List</h1>
        <?php endforeach; ?>
      </div>
      <div class="tab-content">
        <div class="card">
          <div class="card-header">
            <div class="card-actions">
              <button type="button" class="card-action card-toggler" title="Collapse"></button>
              <button type="button" class="card-action card-reload" title="Reload"></button>
              <button type="button" class="card-action card-remove" title="Remove"></button>
            </div>
            <strong>Clients List</strong>
          </div>
          <div class="card-body">
            <table id="demo-datatables-buttons-2" class="table table-bordered table-striped table-wrap dataTable" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>Seq.</th>
                  <th>Name</th>
                  <th>Surname</th>
                  <th>Email</th>
                  <!--<th>Password</th>-->
                  <th>Profile</th>
                  <th>Photos</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($clients as $c): ?>
                <tr>
                  <td><?= $c->client_id; ?></td>
                  <td><?= $c->name; ?></td>
                  <td><?= $c->surname; ?></td>
                  <td><?= $c->email; ?></td>
                  <!--<td><?= $c->password; ?></td>-->
                  <td>
                    <a href="profile_of_client.php?client_id=<?= $c->client_id ?>" class='btn btn-default'>Profile</a>
                  </td>
                  <td>
                    <a href="photos_of_client.php?client_id=<?= $c->client_id ?>" class='btn btn-primary'>Photos</a>
                  </td>
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
</section>

