<?php
	$clients_client_id = $_SESSION["client_id"];
 	$sql = "SELECT * FROM measurements WHERE clients_client_id = $clients_client_id ";
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
	<div class="layout-content-body">
	  <div class="title-bar">
			<h1 class="title-bar-title">
			  <span class="d-ib">Листа На Мерења</span>
			</h1>
	  </div>
	  <div class="row gutter-xs">
			<div class="col-xs-12">
		 		<div class="card">
					<div class="card-header">
		  			<div class="card-actions">
							<button type="button" class="card-action card-toggler" title="Collapse"></button>
							<button type="button" class="card-action card-reload" title="Reload"></button>
							<button type="button" class="card-action card-remove" title="Remove"></button>
		  			</div>
		  			<strong>Листа На Мерења</strong>
					</div>
					<div class="card-body">
			  		<table id="demo-datatables-buttons-1" class="table table-bordered table-striped table-wrap dataTable" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th>Р.б.</th>
									<th>Тежина</th>
									<th>Врат</th>
									<th>Гради</th>
									<th>Под Гради</th>
									<th>Папок</th>
									<th>Колк</th>
									<th>Рака</th>
									<th>Бут</th>
									<th>Дата</th>
									<th>Бриши</th>
									<th>Уреди</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($measurements as $m): ?>
								<tr>
									<td><?= $m->measurement_id; ?></td>
									<td><?= $m->tezina; ?></td>
									<td><?= $m->vrat; ?></td>
									<td><?= $m->gradi; ?></td>
									<td><?= $m->pod_gradi; ?></td>
									<td><?= $m->papok; ?></td>
									<td><?= $m->kolk; ?></td>
									<td><?= $m->raka; ?></td>
									<td><?= $m->but; ?></td>
									<td><?= $m->cur_date; ?></td>
									<td>
					  				<a onclick="return confirm('Are you sure you want to delete this entry?')" href="delete_measurement.php?measurement_id=<?= $m->measurement_id ?>" class='btn btn-danger'>Бриши</a>
									</td>
									<td>
					  				<a href="edit_measurement.php?measurement_id=<?= $m->measurement_id ?>" class='btn btn-default'>Уреди</a>
									</td>
				  			</tr>
				  			<?php endforeach; ?>
							</tbody>
			 	 		</table>
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
            <strong>Графикон за Тежина</strong>
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
              label: "Графикон за Тежина",
              borderColor: "#000000",
              backgroundColor: '#98721a55',
              fill: true,
              borderWidth: 0,
            }]
          },
          options: {
            animations: {
            y: {
            duration: 3000,
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
            duration: 3000
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
            <strong>Графикон за Гради</strong>
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
              label: "Графикон за Гради",
              borderColor: "#000000",
              backgroundColor: '#00B0ED55',
              fill: true,
              borderWidth: 0,
            }]
          },
          options: {
            animations: {
            y: {
            duration: 3000,
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
            duration: 3000
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
            <strong>Графикон за Папок</strong>
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
              label: "Графикон за Папок",
              borderColor: "#000000",
              backgroundColor: '#00FF7955',
              fill: true,
              borderWidth: 0,
            }]
          },
          options: {
            animations: {
            y: {
            duration: 3000,
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
            duration: 3000
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
            <strong>Графикон за Колк</strong>
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
              label: "Графикон за Колк",
              borderColor: "#000000",
              backgroundColor: '#f0ff0055',
              fill: true,
              borderWidth: 0,
            }]
          },
          options: {
            animations: {
            y: {
            duration: 3000,
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
            duration: 3000
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
            <strong>Графикон за Рака</strong>
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
              label: "Графикон за Рака",
              borderColor: "#000000",
              backgroundColor: '#D3000055',
              fill: true,
              borderWidth: 0,
            }]
          },
          options: {
            animations: {
            y: {
            duration: 3000,
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
            duration: 3000
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
            <strong>Графикон за Бут</strong>
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
              label: "Графикон за Бут",
              borderColor: "#000000",
              backgroundColor: '#B400D355',
              fill: true,
              borderWidth: 0,
            }]
          },
          options: {
            animations: {
            y: {
            duration: 3000,
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
            duration: 3000
          },
          },
          }
        });
      </script>

	  </div>
	</div>
</section>