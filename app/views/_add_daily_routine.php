<?php
	$current_manager = $_SESSION['manager_id'];
 	$sql = "SELECT * FROM clients WHERE managers_manager_id = '$current_manager.';";
 	$statement = $connection->prepare($sql);
  	$statement->execute();
  	$people = $statement->fetchAll(PDO::FETCH_OBJ);

  	$sql = "SELECT * FROM options";
 	$statement = $connection->prepare($sql);
  	$statement->execute();
  	$options = $statement->fetchAll(PDO::FETCH_OBJ);

  	$sql = "SELECT * FROM tehniki";
 	$statement = $connection->prepare($sql);
  	$statement->execute();
  	$tehniki = $statement->fetchAll(PDO::FETCH_OBJ);

  	$sql = "SELECT * FROM vezbi";
 	$statement = $connection->prepare($sql);
  	$statement->execute();
  	$exercises = $statement->fetchAll(PDO::FETCH_OBJ);

?>

<section>
<div class="layout-content-body">
	<div class="title-bar">
		<h1 class="title-bar-title">
			<span class="d-ib">Додади Дневна Рутина</span>
		</h1>
		<?php if(!empty($message)): ?>
      	<div class="alert alert-success">
        	<?= $message; ?>
      	</div>
    	<?php endif; ?>
	</div>
</div>

<form data-toggle="md-validator">
	<div class="container">
		<div class="demo-md-form-wrapper">
			
			<div class="col-xs-12">
				<div class="md-form-group">
					<select class="md-form-control client" name="client" id="client" placeholder="Client">
						<option value="" disabled="disabled" selected="selected">Клиент</option>
						<?php foreach($people as $person): ?>
							<option value="<?= $person->client_id; ?>"><?= $person->name; ?> <?= $person->surname; ?> (<?= $person->client_id; ?>)</option>
						<?php endforeach; ?>
					</select>
				</div>
			</div>
			
			<div class="row" id="mealsAndTrainingContainer" style="display: none;">
				
				<div class="col-xs-12" id="mealDiv"> 								
					<div class="md-form-group">
						<div class="row">
							<div class="col-sm-3">
								<div class="md-form-group">
									<input class="md-form-control mealName" type="text" name="mealName"  placeholder="Име на Оброк">
								</div>
							</div>
							<!-- <div class="col-sm-1">
								<div class="md-form-group">
									<select class="md-form-control mealCategory" name="category" data-msg="Meal Category">
										<option value="" disabled="disabled" selected="selected">Meal Category</option>
										<option value="Obrok 1">Obrok 1</option>
										<option value="Obrok 2">Obrok 2</option>
										<option value="Obrok 3">Obrok 3</option>
										<option value="Obrok 4">Obrok 4</option>
										<option value="Obrok 5">Obrok 5</option>
										<option value="Obrok 6">Obrok 6</option>
										<option value="Dodatok">Dodatok</option>
									</select>
								</div>
							</div> -->
							<div class="col-sm-2">
								<div class="md-form-group">
									<select class="md-form-control mealOptionOne" name="mealOptionOne" placeholder="Опција 1">
										<option value="" disabled="disabled" selected="selected">Опција 1</option>
										<?php foreach($options as $option): ?>
											<option value="<?= $option->option_id; ?>"><?= $option->name; ?></option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>
							<div class="col-sm-2">
								<div class="md-form-group">
									<select class="md-form-control mealOptionTwo" name="mealOptionTwo" placeholder="Опција 2">
										<option value="" disabled="disabled" selected="selected">Опција 2</option>
										<?php foreach($options as $option): ?>
											<option value="<?= $option->option_id; ?>"><?= $option->name; ?></option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>
							<div class="col-sm-2">
								<div class="md-form-group">
									<select class="md-form-control mealOptionThree" name="mealOptionThree" placeholder="Опција 3">
										<option value="" disabled="disabled" selected="selected">Опција 3</option>
										<?php foreach($options as $option): ?>
											<option value="<?= $option->option_id; ?>"><?= $option->name; ?></option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>
							<div class="col-sm-2">
								<div class="md-form-group">
									<input class="md-form-control mealVreme" type="text" name="vreme"  placeholder="Време">
								</div>
							</div>
							<div class="col-sm-1">
								<div class="md-form-group">
									<button class="btn btn-primary" type="button" onclick="removeThis(this)">Бриши</button>
								</div>
							</div>
						</div>
					</div>
				</div>
				
				<div class="col-xs-12" id="trainingDiv"> 								
					<div class="md-form-group">
						<div class="row">
							<div class="col-sm-3">
								<div class="md-form-group">
									<input class="md-form-control trainingName" type="text" name="trainingName"  placeholder="Име На Тренинг">
								</div>
							</div>

							<div class="col-sm-2">
								<div class="md-form-group">
									<select class="md-form-control trainingVezba" name="trainingVezba" placeholder="Вежба">
										<option value="" disabled="disabled" selected="selected">Вежба</option>
										<?php foreach($exercises as $ex): ?>
											<option value="<?= $ex->vezba_id; ?>"><?= $ex->name; ?></option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>

							<div class="col-sm-2">
								<div class="md-form-group">
									<input class="md-form-control trainingSerii" type="text" name="trainingSerii"  placeholder="Серии">
								</div>
							</div>
							
							<div class="col-sm-2">
								<div class="md-form-group">
									<select class="md-form-control trainingTech" name="trainingTech" placeholder="Техника">
										<option value="" disabled="disabled" selected="selected">Техника</option>
										<?php foreach($tehniki as $t): ?>
											<option value="<?= $t->tehnika_id; ?>"><?= $t->name; ?></option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>
							<div class="col-sm-2">
								<div class="md-form-group">
									<input class="md-form-control trainingVreme" type="text" name="trainingVreme"  placeholder="Време">
								</div>
							</div>
							
							<div class="col-sm-1">
								<div class="md-form-group">
									<button class="btn btn-primary" type="button" onclick="removeThis(this)" >Бриши</button>
								</div>
							</div>
						</div>
					</div>
				</div>

			</div>

			<div class="" id="addedMealsAndTrainings"></div>
								
			<div class="col-xs-12" id="firstDate">
				<div class="md-form-group">
					<div class="md-form-group md-label-floating">
						<input class="md-form-control mealsAndTrainingsDate" style="width: 38%;" type="date" data-format="dd/MM/yyyy" data-msg-required="Please enter date" required>
						<button class="btn btn-primary m-t" type="button" onClick="removeCurrDate(this)">Бриши Дата</button>
					</div>
				</div>
			</div>

			<div id="datesWrapper"></div>

			<div class="col-xs-12">
			  <div class="md-form-group">
				<button class="btn btn-primary" type="button" onClick="addNewDate()">Додади Дата</button>
				<button class="btn btn-primary" type="button" id="addMeal">Додади Оброк</button>
				<button class="btn btn-primary" type="button" id="addTraining">Додади Тренинг</button>
				<button class="btn btn-primary" type="button" id="submitBtn">Потврди</button>
			  </div>
			</div>
		</div>
	</div>
</form>

</section>

<script type="text/javascript">
		var addMeal = document.getElementById("addMeal")
		var addTraining = document.getElementById("addTraining")
		var client =  document.getElementById("client")
		
		var mealDiv = document.getElementById("mealDiv")
		var mealsAndTrainingContainer = document.getElementById("mealsAndTrainingContainer")
		var addedMealsAndTrainings = document.getElementById("addedMealsAndTrainings")
		var submitBtn = document.getElementById("submitBtn")

		var firstDate = document.getElementById("firstDate")
		var datesWrapper = document.getElementById("datesWrapper")

		// console.log(firstDate)

		var allSelectedMeals = []


		function addNewDate(){
			var clnfirstDate = firstDate.cloneNode(true);
			datesWrapper.appendChild(clnfirstDate)
		}

		function removeCurrDate(t){
			t.parentNode.parentNode.parentNode.remove()
		}

		submitBtn.addEventListener("click", function(){
			// console.log("rabotit")
			var allSelectedMeals = createArrayOfAllMeals();
			var allSelectedTrainings = createArrayOfAllTrainings();
			var allMealsAndTrainings = [allSelectedMeals, allSelectedTrainings]
			// console.log(allSelectedMeals)
			// console.log(allSelectedTrainings)
			// console.log(allMealsAndTrainings)
			// console.log(JSON.stringify(allMealsAndTrainings))
			// json_array = JSON.stringify(allMealsAndTrainings)

			fetch("/add_daily_routine.php", {
        		method: "POST",
        		headers: {
            	"Content-Type": "application/json"
        		},
        			body: JSON.stringify(allMealsAndTrainings)
      			}).then(res => {
  			        // console.log(res);
                location.reload();
                $('html,body').scrollTop(0);
  			    });
  		});

		function createArrayOfAllMeals(){
			var mealName = document.querySelectorAll(".mealName");
			// var mealCategory = document.querySelectorAll(".mealCategory");
			var mealOptionOne = document.querySelectorAll(".mealOptionOne");
			var mealOptionTwo = document.querySelectorAll(".mealOptionTwo");
			var mealOptionThree = document.querySelectorAll(".mealOptionThree");
			var mealVreme = document.querySelectorAll(".mealVreme");
			var mealsAndTrainingsDate = document.querySelectorAll(".mealsAndTrainingsDate");

			var allDates=[]
			var allSelectedMeals = []
			
			for (var j = 0; j < mealsAndTrainingsDate.length; j++) {
				allDates.push(mealsAndTrainingsDate[j].value)
				
			}

			for (var i = 1; i < mealName.length; i++) {
				for (var x = 0; x < allDates.length; x++) {
					var newMeal = {
						clients_client_id  : client.value,
						name : mealName[i].value,
						// category  : mealCategory[i].value,
						vreme : mealVreme[i].value,
						option1 : mealOptionOne[i].value,
						option2 : mealOptionTwo[i].value,
						option3 : mealOptionThree[i].value,
						date : allDates[x]
					}
					allSelectedMeals.push(newMeal)
				}
			}
			return allSelectedMeals;
		}

		function createArrayOfAllTrainings(){
			var trainingName = document.querySelectorAll(".trainingName");
			var trainingVezba = document.querySelectorAll(".trainingVezba");
			// var trainingMuscle = document.querySelectorAll(".trainingMuscle");
			var trainingSerii = document.querySelectorAll(".trainingSerii");
			// var trainingVezbaLink = document.querySelectorAll(".trainingVezbaLink");
			var trainingTech = document.querySelectorAll(".trainingTech");
			var trainingVreme = document.querySelectorAll(".trainingVreme");
			// var trainingDescription = document.querySelectorAll(".trainingDescription");
			var mealsAndTrainingsDate = document.querySelectorAll(".mealsAndTrainingsDate");

			var allDates=[]
			var allSelectedTrainings = []
			
			for (var j = 0; j < mealsAndTrainingsDate.length; j++) {
				allDates.push(mealsAndTrainingsDate[j].value)
				
			}

			for (var i = 1; i < trainingName.length; i++) {
				for (var x = 0; x < allDates.length; x++) {
					var newTraining = {
						clients_client_id  : client.value,
						name : trainingName[i].value,
						vezba : trainingVezba[i].value,
						// muskulna_grupa : trainingMuscle[i].value,
						serii_povt : trainingSerii[i].value,
						// link_vezba : trainingVezbaLink[i].value,
						tech : trainingTech[i].value,
						vreme : trainingVreme[i].value,
						date : allDates[x]
						// description : trainingDescription[i].value
					}
					allSelectedTrainings.push(newTraining)
				}
			}
			return allSelectedTrainings;
		}

		function removeThis(t){
			t.parentNode.parentNode.parentNode.parentNode.parentNode.remove()
		}

		addMeal.addEventListener("click", function(){
			
			var newMealDiv = mealsAndTrainingContainer.childNodes;
			var clnMealDiv = newMealDiv[1].cloneNode(true);
			addedMealsAndTrainings.appendChild(clnMealDiv)
			// console.log(clnMealDiv)
		})

		addTraining.addEventListener("click", function(){
			// console.log(addTraining)
			var newTrainingDiv = mealsAndTrainingContainer.childNodes;
			// console.log(newTrainingDiv)
			var clnTrainingDiv = newTrainingDiv[3].cloneNode(true);
			addedMealsAndTrainings.appendChild(clnTrainingDiv)

		})
		
</script>
