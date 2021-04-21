<section>
	<div class="layout-content-body">
  <div class="title-bar">
		<h1 class="title-bar-title">
		  <span class="d-ib">Add Schedule</span>
		</h1>
  </div>
  <form data-toggle="md-validator" action="" method="POST">
		<div class="row">
		  <div class="col-sm-6 col-sm-offset-3">
				<div class="md-form-group">
				  <select class="md-form-control" name="stanuvanje" id="stanuvanje" data-msg-required="Vreme na budenje" required>
						<option value="" disabled="disabled" selected="selected">Vreme na Budenje</option>
						<option value="05:00">05:00</option>
						<option value="05:30">05:30</option>
						<option value="06:00">06:00</option>
						<option value="06:30">06:30</option>
						<option value="07:00">07:00</option>
						<option value="07:30">07:30</option>
						<option value="08:00">08:00</option>
						<option value="08:30">08:30</option>
						<option value="09:00">09:00</option>
						<option value="09:30">09:30</option>
						<option value="10:00">10:00</option>
						<option value="10:30">10:30</option>
						<option value="11:00">11:00</option>
						<option value="11:30">11:30</option>
						<option value="12:00">12:00</option>
				  </select>
				  <label class="md-control-label"></label>
				</div>
				<div class="md-form-group">
		  		<select class="md-form-control" name="legnuvanje" id="legnuvanje" data-msg-required="Vreme na legnuvanje" required>
						<option value="" disabled="disabled" selected="selected">Vreme na Zaspivanje</option>
						<option value="21:00">21:00</option>
						<option value="21:30">21:30</option>
						<option value="22:00">22:00</option>
						<option value="22:30">22:30</option>
						<option value="23:00">23:00</option>
						<option value="23:30">23:30</option>
						<option value="00:00">00:00</option>
						<option value="00:30">00:30</option>
						<option value="01:00">01:00</option>
						<option value="01:30">01:30</option>
						<option value="02:00">02:00</option>
						<option value="02:30">02:30</option>
						<option value="03:00">03:00</option>
						<option value="03:30">03:30</option>
						<option value="04:00">04:00</option>
		  		</select>
		  		<label class="md-control-label"></label>
				</div>
				<div class="md-form-group">
				  <input class="md-form-control" type="text" name="rabota" id="rabota" placeholder="Rabota / Shkolo (od - do) ako ima smeni (od - do)">
				</div>
				<div class="md-form-group">
				  <input class="md-form-control" type="text" name="pauzi" id="pauzi" placeholder="Pauza (od - do)">
				</div>
				<div class="md-form-group">
				  <input class="md-form-control" type="text" name="trening" id="trening" placeholder="Trening (preferirano vreme)">
				</div>
				<div class="md-form-group">
				  <input class="md-form-control" type="text" name="cardio" id="cardio" placeholder="Cardio (preferirano vreme)">
				</div>
				<div class="md-form-group">
				  <input class="md-form-control" type="text" name="description" id="description" placeholder="Drugi Zanimanja">
				</div>
				<button class="btn btn-default btn-block" type="submit">Add Schedule</button>
	  	</div>
		</div>
  </form>
</div>
</section>