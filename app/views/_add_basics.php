<section>
	<div class="layout-content-body">
		<div class="title-bar">
		  <h1 class="title-bar-title">
			<span class="d-ib">Додавање Основни Информација</span>
		  </h1>
		</div>
		<form data-toggle="md-validator" action="" method="POST">
		  <div class="row">
			<div class="col-sm-6 col-sm-offset-3">
			  <div class="md-form-group">
				<select class="md-form-control" name="pol" id="pol" data-msg-required="Please indicate your gender." required>
					<option value="" disabled="disabled" selected="selected">Пол</option>
					<option value="Машко">Машко</option>
					<option value="Женско">Женско</option>
					<option value="Неопределено">Неопределено</option>
				</select>
				<label class="md-control-label"></label>
				</div>
					<div class="row">
						<div class="col-sm-12">
						  <div class="md-form-group md-label-floating">
								<input class="md-form-control" type="date" name="godini" id="godini" data-format="dd/MM/yyyy" data-msg-required="Please enter your birth date">
								<label class="md-control-label"></label>
						  </div>
						</div>
					</div>
					<div class="md-form-group">
					  <input class="md-form-control" type="text" name="visina" id="visina" placeholder="Висина (цм)">
					  <label class="md-control-label"></label>
					</div>
					<div class="md-form-group">
					  <input class="md-form-control" type="text" name="tezina" id="tezina" placeholder="Тежина (кг)">
					  <label class="md-control-label"></label>
					</div>
					<div class="md-form-group">
					  <input class="md-form-control" type="text" name="alergija" id="alergija" placeholder="Алергија на Храна (ако има)">
					  <label class="md-control-label"></label>
					</div>
					<div class="md-form-group">
					  <input class="md-form-control" type="text" name="netolerantnost" id="netolerantnost" placeholder="Нетолерантност на Храна (ако има)">
					  <label class="md-control-label"></label>
					</div>
					<div class="md-form-group">
					  <input class="md-form-control" type="text" name="odbivnost" id="odbivnost" placeholder="Одбивност на Храна (ако има)">
					  <label class="md-control-label"></label>
					</div>
					<div class="md-form-group">
					  <input class="md-form-control" type="text" name="zaboluvanja" id="zaboluvanja" placeholder="Заболуванја (ако има)">
					  <label class="md-control-label"></label>
					</div>
					<div class="md-form-group">
					  	<select class="md-form-control" name="iskustvo" id="iskustvo" data-msg-required="Please indicate your gender.">
							<option value="" disabled="disabled" selected="selected">Искуство во Теретана</option>
							<option value="Почетник">Почетник</option>
							<option value="Напреден">Напреден</option>
							<option value="Професионалец">Професионалец</option>
						</select>
					</div>
					<button class="btn btn-default btn-block" type="submit">Додади</button>
				 </div>
			</div>
		</form>
	</div>
</section>