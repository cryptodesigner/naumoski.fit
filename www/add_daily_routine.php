<?php
  session_start();
  include("config.php");
  require 'db.php';
  $title = 'Add Daily Routine';
  $childView = 'views/_add_daily_routine.php';
  include('layout_manager.php');


	// $string = file_get_contents("/test.json");
	// if ($string === false) {
	//     // deal with error...
	// }
	
	// $json_a = json_decode($string, true);
	// if ($json_a === null) {
	//     // deal with error...
	// }
	
	// foreach ($json_a as $person_name => $person_a) {
	//     echo $person_a['status'];
	// }	


  // {"meals":[{"name":"meal1","vreme":10:00, "option1":1, "option2":2, "option3":3, "date":04-22-2021},{"name":"meal2","vreme":12:00, "option1":4, "option2":5, "option3":6, "date":04-22-2021},{"name":"meal3","vreme":14:00, "option1":7, "option2":8, "option3":9, "date":04-22-2021}],"trainings":[{"name":"trening1", "muskulna_grupa":"Gradi", "serii_povt":4/10, "link_vezba":"youtube.com", "tech":1, "vreme":11:00, "date":04-22-2021, "description":"umri"},{"name":"trening2", "muskulna_grupa":"Noze", "serii_povt":5/8, "link_vezba":"youtube.com", "tech":1, "vreme":13:00, "date":04-22-2021, "description":"umri pak"}]}

  
$message = '';
  // if (isset ($_POST['allMealsAndTrainings'])) {
  	// print_r($_POST['allMealsAndTrainings']);


				

  	$json = file_get_contents('php://input');

  	

  	
  		$data = json_decode($json);
  		// if($data){

  		//  $name = "name";
  		//   $sostojki = "sostojki";
    // $proteins = "pro";
    // $carbohydrates = "car";
    // $fats = "fat";
    // $description = $data[0][1]->name;

    // $sql = 'INSERT INTO options(name, sostojki, proteins, carbohydrates, fats, description) VALUES(:name, :sostojki, :proteins, :carbohydrates, :fats, :description)';
    // $statement = $connection->prepare($sql);
    // if ($statement->execute([':name' => $name, ':sostojki' => $sostojki, ':proteins' => $proteins, ':carbohydrates' => $carbohydrates, ':fats' => $fats, ':description' => $description])) {
    //   $message = 'Meal Added Successfully';
    // }  
  		// }


  		// if($data){
  		// 	foreach($data[0] as $info => $x){
  				
  		// 			 $name = "novi";
  		//   $sostojki = "sostojki";
    // $proteins = "pro";
    // $carbohydrates = "car";
    // $fats = "fat";
    // $description = $x->name;

    // $sql = 'INSERT INTO options(name, sostojki, proteins, carbohydrates, fats, description) VALUES(:name, :sostojki, :proteins, :carbohydrates, :fats, :description)';
    // $statement = $connection->prepare($sql);
    // if ($statement->execute([':name' => $name, ':sostojki' => $sostojki, ':proteins' => $proteins, ':carbohydrates' => $carbohydrates, ':fats' => $fats, ':description' => $description])) {
    //   $message = 'Meal Added Successfully';
    // }  
  		
  		
  		// 		}
  		// 	}
  		
   

  		if($data){
  			foreach($data[0] as $info => $x){
  				$clients_client_id = (int)$x->clients_client_id;
  				$name = $x->name;
  				$vreme = $x->vreme;
  				$option1 = (int)$x->option1;
  				$option2 = (int)$x->option2;
  				$option3 = (int)$x->option3;
  				$date = $x->date;

  				$sql = 'INSERT INTO meals(clients_client_id, name, vreme, option1, option2, option3, date) VALUES(:clients_client_id, :name, :vreme, :option1, :option2, :option3, :date)';
  				$statement = $connection->prepare($sql);
  				if ($statement->execute([':clients_client_id' => $clients_client_id, ':name' => $name, ':vreme' => $vreme, ':option1' => $option1, ':option2' => $option2, ':option3' => $option3, ':date' => $date])) {
  			  	$message = 'Client Added Successfully';
  				}
  			}
  			foreach($data[1] as $info => $y){
  				$clients_client_id = (int)$y->clients_client_id;
  				$name = $y->name;
  				$muskulna_grupa = $y->muskulna_grupa;
  				$serii_povt = $y->serii_povt;
  				$link_vezba = $y->link_vezba;
  				$tech = (int)$y->tech;
  				$vreme = $y->vreme;
  				$date = $y->date;
  				$description = $y->description;

  				$sql = 'INSERT INTO trainings(clients_client_id, name, muskulna_grupa, serii_povt, link_vezba, tech, vreme, date, description) VALUES(:clients_client_id, :name, :muskulna_grupa, :serii_povt, :link_vezba, :tech, :vreme, :date, :description)';
  				$statement = $connection->prepare($sql);
  				if ($statement->execute([':clients_client_id' => $clients_client_id, ':name' => $name, ':muskulna_grupa' => $muskulna_grupa, ':serii_povt' => $serii_povt, ':link_vezba' => $link_vezba, ':tech' => $tech, ':vreme' => $vreme, ':date' => $date, ':description' => $description])) {
  			  	$message = 'Client Added Successfully';
  				}
  			}
  		}
  		
  	

  		// $clients_client_id = $data[0][i]['clients_client_id']
  		// $name = $_POST[$data[0][2]];
  		// $vreme = $_POST[$data[0][3]];
  		// //OVDEKA SO IF ELSE GI PROVERVIS OPCIITE DA NE SE prazni
  		// $option1 = $_POST[$data[0][4]];
  		// $option2 = $_POST[$data[0][5]];
  		// $option3 = $_POST[$data[0][6]];
  		// $date = $_POST[$data[0][7]];
  		// for($i = 0; $i < 5; $i++){
  		// 	$sql = 'INSERT INTO meals(clients_client_id, name, vreme, option1, option2, option3, date) VALUES(:clients_client_id, :name, :vreme, :option1, :option2, :option3, :date)';
  		// 	$statement = $connection->prepare($sql);
  		// 	if ($statement->execute([':clients_client_id' => $clients_client_id, ':name' => $name, ':vreme' => $vreme, ':option1' => $option1, ':option2' => $option2, ':option3' => $option3, ':date' => $date])) {
  		// 	  $message = 'Client Added Successfully';
  		// 	}
  		// }
  	// }

  	// else if($data[0]){
  	// 	$clients_client_id = $_POST[$data[0]->clients_client_id];
  	// 	$name = $_POST[$data[0]->name];
  	// 	$vreme = $_POST[$data[0]->vreme];
  	// 	$option1 = $_POST[$data[0]->option1];
  	// 	$option2 = $_POST[$data[0]->option2];
  	// 	$option3 = $_POST[$data[0]->option3];
  	// 	$date = $_POST[$data[0]->date];
  	// 	for($i = 0; $i < 5; $i++){
  	// 		$sql = 'INSERT INTO meals(clients_client_id, name, vreme, option1, option2, option3, date) VALUES(:clients_client_id, :name, :vreme, :option1, :option2, :option3, :date)';
  	// 		$statement = $connection->prepare($sql);
  	// 		if ($statement->execute([':clients_client_id' => $clients_client_id, ':name' => $name, ':vreme' => $vreme, ':option1' => $option1, ':option2' => $option2, ':option3' => $option3, ':date' => $date])) {
  	// 		  $message = 'Client Added Successfully';
  	// 		}
  	// 	}
  	// }
  	
  	// $managers_manager_id = $_SESSION["manager_id"];
  	
  	// $sql = 'INSERT INTO clients(managers_manager_id, name, surname, email, password) VALUES(:managers_manager_id, :name, :surname, :email, :password)';
  	// $statement = $connection->prepare($sql);
  	// if ($statement->execute([':managers_manager_id' => $managers_manager_id, ':name' => $name, ':surname' => $surname, ':email' => $email, ':password' => $password])) {
  	//   $message = 'Client Added Successfully';
  // 	}
  // }

?>