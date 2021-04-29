<?php
  session_start();
  include("config.php");
  require 'db.php';
  $title = 'Add Daily Routine';
  $childView = 'views/_add_daily_routine.php';
  include('layout_manager.php');
  
  $json = file_get_contents('php://input');
  $data = json_decode($json);
  
  $message = '';
  if($data){
  	foreach($data[0] as $info => $x){
  		$clients_client_id = (int)$x->clients_client_id;
  		$name = $x->name;
  		$vreme = $x->vreme;

  		if(empty((int)$x->option1)){
  			$option1 = 0;
  		}
  		else{
  			$option1 = (int)$x->option1;
  		}

  		if(empty((int)$x->option2)){
  			$option2 = 0;
  		}
  		else{
  			$option2 = (int)$x->option2;
  		}

  		if(empty((int)$x->option3)){
  			$option3 = 0;
  		}
  		else{
  			$option3 = (int)$x->option3;
  		}

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
  		$vreme = $y->vreme;
  		$vezba = (int)$y->vezba;
  		$serii_povt = $y->serii_povt;
  		$tech = (int)$y->tech;
  		$date = $y->date;

      $sql = 'INSERT INTO trainings(clients_client_id, name, vreme, vezba, serii_povt, tech, date) VALUES(:clients_client_id, :name, :vreme, :vezba, :serii_povt, :tech, :date)';

  		$statement = $connection->prepare($sql);
  		
  		if ($statement->execute([':clients_client_id' => $clients_client_id, ':name' => $name, ':vreme' => $vreme, ':vezba' => $vezba, ':serii_povt' => $serii_povt, ':tech' => $tech, ':date' => $date])) {
  			 $message = 'Client Added Successfully';
  		}
  	}
  }

?>