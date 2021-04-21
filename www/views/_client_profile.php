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
            <h1 class="profile-name"><?php echo $_SESSION['email']; ?></h1>
            <a class="profile-follow-btn" href ="edit_profile.php">Edit Profile</a>
            <p>Genesis Fitness Client<a class="link-inverted"></a></p>
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
      <div class="profile-container">
        <?php echo $_SESSION['email']; ?>
      </div>

      <div class="col-md-4">
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
            <table class="table table-striped">
              <tr>
                {% for row in data %}
                <th colspan="6">Serial: </th>
                <td colspan="6">{{row['client_id']}}</td>
                {% endfor %}
              </tr>
              <tr>
                {% for row in assigned_manager %}
                <th colspan="6">Manager: </th>
                <td colspan="6">{{row['name']}}</td>
                {% endfor %}
              </tr>
              <tr>
                {% for row in data %}
                <th colspan="6">Ime: </th>
                <td colspan="6">{{row['name']}}</td>
                {% endfor %}
              </tr>
              <tr>
                {% for row in data %}
                <th colspan="6">Prezime: </th>
                <td colspan="6">{{row['surname']}}</td>
                {% endfor %}
              </tr>
              <tr>
                {% for row in data %}
                <th colspan="6">Email: </th>
                <td colspan="6">{{row['email']}}</td>
                {% endfor %}
              </tr>
            </table>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card">
          <div class="card-header">
            <div class="card-actions">
              <button type="button" class="card-action card-toggler" title="Collapse"></button>
              <button type="button" class="card-action card-reload" title="Reload"></button>
              <button type="button" class="card-action card-remove" title="Remove"></button>
            </div>
            <strong>Basics</strong>
          </div>
          <div class="card-body" data-toggle="match-height">
            <table class="table table-striped">
              <tr>
                {% for row in data %}
                <th colspan="6">Ime: </th>
                <td colspan="6">{{row['name']}}</td>
                {% endfor %}
              </tr>
              <tr>
                {% for basic in data3 %}
                <th colspan="6">Pol: </th>
                <td colspan="6">{{basic['pol']}}</td>
                {% endfor %}
              </tr>
              <tr>
                {% for basic in data3 %}
                <th colspan="6">Rodenden: </th>
                <td colspan="6">{{basic['godini']}}</td>
                {% endfor %}
              </tr>
              <tr>
                {% for basic in data3 %}
                <th colspan="6">Visina: </th>
                <td colspan="6">{{basic['visina']}}</td>
                {% endfor %}
              </tr>
              <tr>
                {% for basic in data3 %}
                <th colspan="6">Tezina: </th>
                <td colspan="6">{{basic['tezina']}}</td>
                {% endfor %}
              </tr>
            </table>
          </div>
        </div>
      </div>

      <div class="col-md-4">
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
            <table class="table table-striped">
              <tr>
                {% for row in data3 %}
                <th colspan="6">Alergii: </th>
                <td colspan="6">{{row['alergija']}}</td>
                {% endfor %}
              </tr>
              <tr>
                {% for basic in data3 %}
                <th colspan="6">Netolerantnost: </th>
                <td colspan="6">{{basic['netolerantnost']}}</td>
                {% endfor %}
              </tr>
              <tr>
                {% for basic in data3 %}
                <th colspan="6">Odbivnost: </th>
                <td colspan="6">{{basic['odbivnost']}}</td>
                {% endfor %}
              </tr>
              <tr>
                {% for basic in data3 %}
                <th colspan="6">Zaboluvanja: </th>
                <td colspan="6">{{basic['zaboluvanja']}}</td>
                {% endfor %}
              </tr>
              <tr>
                {% for basic in data3 %}
                <th colspan="6">Iskustvo: </th>
                <td colspan="6">{{basic['iskustvo']}}</td>
                {% endfor %}
              </tr>
            </table>
          </div>
        </div>
      </div>

      <div class="col-md-4">
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
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Name.</th>
                  <th>Vreme</th>
                </tr>
              </thead>
              <tbody>
                {% for row in daily_routines %}
                <tr>
                  <td>{{row['name']}}</td>
                  <td>{{row['vreme']}}</td>
                </tr>
                {% endfor %}
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <!-- <div class="col-md-12">
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
            

            <table id="demo-datatables-buttons-2" class="table table-bordered table-striped table-nowrap dataTable" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>Routine Name</th>
                </tr>
              </thead>
              <tbody>
                {% for row in data5 %}
                <tr>
                  <td>{{row['dailyRoutineName']}}</td>
                </tr>
                {% endfor %}
              </tbody>
            </table>
          </div>
        </div>
      </div> -->
    </div>
     
    <div id="Trainings" class="tab" style="display: none">
      <div class="profile-container">
        {% for row in data %}<h1>{{row['name']}}'s Training List</h1>{% endfor %}
      </div>
      <div class="panel m-b-lg">
        <ul class="nav nav-tabs nav-justified">
          <li class="active"><a href="#trainingtoday" data-toggle="tab">Today</a></li>
          <li><a href="#trainingtomorrow" data-toggle="tab">Tomorrow</a></li>
          <li><a href="#trainingweek" data-toggle="tab">All</a></li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane fade active in" id="trainingtoday">
            <strong>Today</strong>

            <div class="card-body">
              <table id="demo-datatables-buttons-2" class="table table-bordered table-striped table-nowrap dataTable"cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <!-- <th>Seq.</th> -->
                    <th>Name</th>
                    <th>Muscle Group</th>
                    <th>Serii/Povtoruvanja</th>
                    <th>Link Vezba</th>
                    <th>Tehnika</th>
                    <th>Vreme</th>
                    <th>Description</th>
                  </tr>
                </thead>
                <tbody>
                  {% for row in today_trainings %}
                  <tr>
                    <!-- <td>{{row['training_id']}}</td> -->
                    <td>{{row['name']}}</td>
                    <td>{{row['muskulna_grupa']}}</td>
                    <td>{{row['serii_povt']}}</td>
                    <td>{{row['link_vezba']}}</td>
                    <td><button data-toggle="modal" data-target="#exampleTrainingModal" onClick="seeOptionTraining({{row['tech']}})">See Option</button></td>
                    <td>{{row['vreme']}}</td>
                    <td>{{row['description']}}</td>
                  </tr>
                  {% endfor %}
                </tbody>
              </table>
            </div>

          </div>
          
          <div class="tab-pane fade" id="trainingtomorrow">
            <strong>Tomorrow</strong>

            <div class="card-body">
              <table id="demo-datatables-buttons-2" class="table table-bordered table-striped table-nowrap dataTable"cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <!-- <th>Seq.</th> -->
                    <th>Name</th>
                    <th>Muscle Group</th>
                    <th>Serii/Povtoruvanja</th>
                    <th>Link Vezba</th>
                    <th>Tehnika</th>
                    <th>Vreme</th>
                    <th>Description</th>
                  </tr>
                </thead>
                <tbody>
                  {% for row in tomorrow_trainings %}
                  <tr>
                    <!-- <td>{{row['training_id']}}</td> -->
                    <td>{{row['name']}}</td>
                    <td>{{row['muskulna_grupa']}}</td>
                    <td>{{row['serii_povt']}}</td>
                    <td>{{row['link_vezba']}}</td>
                    <td><button data-toggle="modal" data-target="#exampleTrainingModal" onClick="seeOptionTraining({{row['tech']}})">See Option</button></td>
                    <td>{{row['vreme']}}</td>
                    <td>{{row['description']}}</td>
                  </tr>
                  {% endfor %}
                </tbody>
              </table>
            </div>

          </div>
          
          <div class="tab-pane fade" id="trainingweek">
            <strong>All</strong>

            <div class="card-body">
              <table id="demo-datatables-buttons-2" class="table table-bordered table-striped table-nowrap dataTable"cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <!-- <th>Seq.</th> -->
                    <th>Name</th>
                    <th>Muscle Group</th>
                    <th>Serii/Povtoruvanja</th>
                    <th>Link Vezba</th>
                    <th>Tehnika</th>
                    <th>Vreme</th>
                    <th>Description</th>
                  </tr>
                </thead>
                <tbody>
                  {% for row in all_trainings %}
                  <tr>
                    <!-- <td>{{row['training_id']}}</td> -->
                    <td>{{row['name']}}</td>
                    <td>{{row['muskulna_grupa']}}</td>
                    <td>{{row['serii_povt']}}</td>
                    <td>{{row['link_vezba']}}</td>
                    <td><button data-toggle="modal" data-target="#exampleTrainingModal" onClick="seeOptionTraining({{row['tech']}})">See Option</button></td>
                    <td>{{row['vreme']}}</td>
                    <td>{{row['description']}}</td>
                  </tr>
                  {% endfor %}
                </tbody>
              </table>
            </div>

          </div>
        </div>
      </div>
    </div>

      
    <div id="Diets" class="tab" style="display: none">
      <div class="profile-container">
        {% for row in data %}<h1>{{row['name']}}'s Diet List</h1>{% endfor %}
      </div>
      <div class="panel m-b-lg">
        <ul class="nav nav-tabs nav-justified">
          <li class="active"><a href="#dietToday" data-toggle="tab">Today</a></li>
          <li><a href="#dietTomorrow" data-toggle="tab">Tomorrow</a></li>
          <li><a href="#dietWeek" data-toggle="tab">All</a></li>
        </ul>

        <div class="tab-content">
          <div class="tab-pane fade active in" id="dietToday">
            <strong>Today</strong>

            <div class="card-body">
              <table id="demo-datatables-buttons-2" class="table table-bordered table-striped table-nowrap dataTable"cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <!-- <th>Seq.</th> -->
                    <th>Name</th>
                    <th>Vreme</th>
                    <th>Opcija 1</th>
                    <th>Opcija 2</th>
                    <th>Opcija 3</th>
                  </tr>
                </thead>
                <tbody>
                  {% for row in today_meals %}
                  <tr>
                    <!-- <td>{{row['meal_id']}}</td> -->
                    <td>{{row['name']}}</td>
                    <td>{{row['vreme']}}</td>
                    <td>{% if row['option1'] != 0 %}<button data-toggle="modal" data-target="#exampleModal" onClick="seeOption({{row['option1']}})">See Option</button>{% else %}No option{% endif %}</td>
                    <td>{% if row['option2'] != 0 %}<button data-toggle="modal" data-target="#exampleModal" onClick="seeOption({{row['option2']}})">See Option</button>{% else %}No option{% endif %}</td>
                    <td>{% if row['option3'] != 0 %}<button data-toggle="modal" data-target="#exampleModal" onClick="seeOption({{row['option3']}})">See Option</button>{% else %}No option{% endif %}</td>
                  </tr>
                  {% endfor %}
                </tbody>
              </table>
            </div>

          </div>
          <div class="tab-pane fade" id="dietTomorrow">
            <strong>Tomorrow</strong>

            <div class="card-body">
              <table id="demo-datatables-buttons-2" class="table table-bordered table-striped table-nowrap dataTable"cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <!-- <th>Seq.</th> -->
                    <th>Name</th>
                    <th>Vreme</th>
                    <th>Opcija 1</th>
                    <th>Opcija 2</th>
                    <th>Opcija 3</th>
                  </tr>
                </thead>
                <tbody>
                  {% for row in tomorrow_meals %}
                  <tr>
                    <!-- <td>{{row['meal_id']}}</td> -->
                    <td>{{row['name']}}</td>
                    <td>{{row['vreme']}}</td>
                    <td>{% if row['option1'] != 0 %}<button data-toggle="modal" data-target="#exampleModal" onClick="seeOption({{row['option1']}})">See Option</button>{% else %}No option{% endif %}</td>
                    <td>{% if row['option2'] != 0 %}<button data-toggle="modal" data-target="#exampleModal" onClick="seeOption({{row['option2']}})">See Option</button>{% else %}No option{% endif %}</td>
                    <td>{% if row['option3'] != 0 %}<button data-toggle="modal" data-target="#exampleModal" onClick="seeOption({{row['option3']}})">See Option</button>{% else %}No option{% endif %}</td>
                  </tr>
                  {% endfor %}
                </tbody>
              </table>
            </div>

          </div>
          <div class="tab-pane fade" id="dietWeek">
            <strong>All</strong>

            <div class="card-body">
              <table id="demo-datatables-buttons-2" class="table table-bordered table-striped table-nowrap dataTable"cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <!-- <th>Seq.</th> -->
                    <th>Name</th>
                    <th>Vreme</th>
                    <th>Opcija 1</th>
                    <th>Opcija 2</th>
                    <th>Opcija 3</th>
                    <th>Date</th>
                  </tr>
                </thead>
                <tbody>
                  {% for row in all_meals %}
                  <tr>
                    <!-- <td>{{row['meal_id']}}</td> -->
                    <td>{{row['name']}}</td>
                    <td>{{row['vreme']}}</td>
                    <td>{% if row['option1'] != 0 %}<button data-toggle="modal" data-target="#exampleModal" onClick="seeOption({{row['option1']}})">See Option</button>{% else %}No option{% endif %}</td>
                    <td>{% if row['option2'] != 0 %}<button data-toggle="modal" data-target="#exampleModal" onClick="seeOption({{row['option2']}})">See Option</button>{% else %}No option{% endif %}</td>
                    <td>{% if row['option3'] != 0 %}<button data-toggle="modal" data-target="#exampleModal" onClick="seeOption({{row['option3']}})">See Option</button>{% else %}No option{% endif %}</td>
                    <td>{{row['date']}}</td>
                  </tr>
                  {% endfor %}
                </tbody>
              </table>
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
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Current Option Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="modalSostojki">Sostojki:</div>
        <div id="modalProteins">Proteini:</div>
        <div id="modalCarbohydrates">Jaglenohidrati:</div>
        <div id="modalFats">Masti:</div>
        <div id="modalDescription">Description:</div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Training -->
<div class="modal fade" id="exampleTrainingModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Current Technique Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="modalName">Name:</div>
        <div id="modalLink">Link:</div>
        <div id="modalTrainingDescription">Description:</div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
</section>

<script type="text/javascript">
var modalSostojki = document.getElementById("modalSostojki")
var modalProteins = document.getElementById("modalProteins")
var modalCarbohydrates = document.getElementById("modalCarbohydrates")
var modalFats = document.getElementById("modalFats")
var modalDescription = document.getElementById("modalDescription")

modalSostojki.innerHTML = "proba"
console.log(modalSostojki)


  function seeOption(t){

    console.log(t)

    fetch("/chose_option", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
            Accept: 'application/json'
          },
            body: JSON.stringify(t)
          }).then((response) => {
              console.log(response)
            return response.json()
          })
          .then((data) => {
            // Work with JSON data here
            console.log(data[0])
            modalSostojki.innerHTML = "Sostoji: " + data[0].sostojki
            modalProteins.innerHTML = "Proteini : " + data[0].proteins
            modalCarbohydrates.innerHTML = "Jaglenohidrati : " + data[0].carbohydrates
            modalFats.innerHTML = "Masti : " + data[0].fats
            modalDescription.innerHTML = "Description : " + data[0].description

          })
          .catch((err) => {
            // Do something for an error here
          })

  }
</script>

<script type="text/javascript">
var modalName = document.getElementById("modalName")
var modalLink = document.getElementById("modalLink")
var modalTrainingDescription = document.getElementById("modalTrainingDescription")

  function seeOptionTraining(t){

    console.log(t)

    fetch("/chose_tech", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
            Accept: 'application/json'
          },
            body: JSON.stringify(t)
          }).then((response) => {
              console.log(response)
            return response.json()
          })
          .then((data) => {
            // Work with JSON data here
            // console.log(data[0])
            modalName.innerHTML = "Name: " + data[0].name
            modalLink.innerHTML = "Link : " + data[0].link
            modalTrainingDescription.innerHTML = "Description : " + data[0].description

          })
          .catch((err) => {
            // Do something for an error here
          })

  }
</script>

{% endblock %}