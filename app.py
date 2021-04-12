from flask import Flask, render_template, request, redirect, json, jsonify, url_for, flash, session, send_file, send_from_directory
from flaskext.mysql import MySQL
import MySQLdb
import yaml
import pymysql
from datetime import datetime, date, timedelta
import hashlib
import random
import string
from flask_mail import Mail, Message
from werkzeug.utils import secure_filename
import os
import imghdr

ALLOWED_EXTENSIONS = set(['jpg', 'png', 'jpeg'])
UPLOAD_PATH = './uploaded_images'

app = Flask(__name__)
app.secret_key = 'many random bytes'

db = yaml.load(open('db.yaml'))

app.config['MYSQL_DATABASE_USER'] = db['mysql_user']
app.config['MYSQL_DATABASE_PASSWORD'] = db['mysql_password']
app.config['MYSQL_DATABASE_DB'] = db['mysql_db']
app.config['MYSQL_DATABASE_HOST'] = db['mysql_host']

app.config['MAIL_SERVER'] = 'smtp.gmail.com'
app.config['MAIL_PORT'] = 465
app.config['MAIL_USERNAME'] = 'beyourowncode@gmail.com'
app.config['MAIL_PASSWORD'] = 'Coding@1000'
app.config['MAIL_USE_TLS'] = False
app.config['MAIL_USE_SSL'] = True

app.config['UPLOAD_PATH'] = UPLOAD_PATH

mysql = MySQL(app)
mysql.init_app(app)

mail = Mail(app)


def allowed_file(_file):
	image_type = imghdr.what(None, _file.read())
	return image_type in ALLOWED_EXTENSIONS




@app.route('/')
def home():
	return render_template('index.html')




# Registering Page
@app.route('/signup', methods=['GET', 'POST'])
def signup():
	conn = mysql.connect()
	cursor = conn.cursor(pymysql.cursors.DictCursor)

	if request.method == 'POST' and 'email' in request.form and 'password' in request.form:
		managers_manager_id = request.form['managers_manager_id']
		name = request.form['name']
		surname = request.form['surname']
		email = request.form['email']
		password = request.form['password']

		encPassword = hashlib.md5(password.encode()).hexdigest()
   
		cursor.execute('SELECT * FROM clients WHERE email = %s', (email))
		account = cursor.fetchone()
		if account:
			flash(u'Acount already exist!', 'error')
		else:
			cursor.execute('INSERT INTO clients VALUES (NULL, %s, %s, %s, %s, %s)', (managers_manager_id, name, surname, email, encPassword)) 
			conn.commit()

			flash("You have registered successfully!")
   
	elif request.method == 'POST':
		flash("Fill in the form")

	cursor.execute("SELECT * FROM managers")
	data = cursor.fetchall()
	cursor.close()

	return render_template('signup.html', data=data)




# Login Page
@app.route('/login/', methods=['GET', 'POST'])
def login():
	conn = mysql.connect()
	cursor = conn.cursor(pymysql.cursors.DictCursor)
  
	if request.method == 'POST' and 'email' in request.form and 'password' in request.form:
		email = request.form['email']
		password = request.form['password']

		encPassword = hashlib.md5(password.encode()).hexdigest()

		cursor.execute('SELECT * FROM clients WHERE email = %s AND password = %s', (email, encPassword))
		account = cursor.fetchone()
   
		if account:
			session['loggedin'] = True
			session['client_id'] = account['client_id']
			session['email'] = account['email']
			return redirect(url_for('client_profile'))
		else:
			flash("Incorrect username or password")

	if request.method == 'POST' and 'email' in request.form and 'password' in request.form:
		email = request.form['email']
		password = request.form['password']

		encPassword = hashlib.md5(password.encode()).hexdigest()

		cursor.execute('SELECT * FROM managers WHERE email = %s AND password = %s', (email, encPassword))
		account = cursor.fetchone()

		if account:
			session['loggedin'] = True
			session['manager_id'] = account['manager_id']
			session['email'] = account['email']
			return redirect(url_for('manager_profile'))
		else:
			flash("Incorrect username or password")
	
	return render_template('login.html')




# Logout Page
@app.route('/logout')
def logout():
   session.pop('loggedin', None)
   session.pop('id', None)
   session.pop('email', None)
   return redirect(url_for('login'))




@app.route('/forgot_password', methods=['GET', 'POST'])
def forgot_password():
	conn = mysql.connect()
	cursor = conn.cursor(pymysql.cursors.DictCursor)

	if request.method == 'POST':
		user_email = request.form['email']
		
		cursor.execute('SELECT * FROM clients WHERE email = %s', (user_email))
		account = cursor.fetchone()

		if account:
			letters = string.ascii_letters
			new_password = ""

			for i in range (10):
				new_password += str(random.choice(letters))

			msg = Message('Reset Password', sender = 'beyourowncode@gmail.com', recipients = [user_email])
			msg.body = "New password is: {}".format(new_password)
			mail.send(msg)

			encPassword = hashlib.md5(new_password.encode()).hexdigest()

			cursor.execute('UPDATE clients SET password = %s WHERE email = %s', (encPassword, user_email))
			conn.commit()

		else:
			print("Account not in database")
	
	return render_template('forgot_password.html')




# --------------------MANAGER--------------------
# Add Manager Page
@app.route('/add_manager', methods=['GET', 'POST'])
def add_manager():
	conn = mysql.connect()
	cursor = conn.cursor(pymysql.cursors.DictCursor)

	if request.method == 'POST':
		name = request.form['name']
		surname = request.form['surname']
		email = request.form['email']
		password = request.form['password']

		encPassword = hashlib.md5(password.encode()).hexdigest()

		cursor.execute('INSERT INTO managers VALUES (NULL, %s, %s, %s, %s)', (name, surname, email, encPassword)) 
		conn.commit()
   
	elif request.method == 'POST':
		flash("Please fill out the form!")

	return render_template('add_manager.html')




# Manager Profile Page
@app.route('/manager_profile')
def manager_profile():
	conn = mysql.connect()
	cursor = conn.cursor(pymysql.cursors.DictCursor)

	cursor.execute("SELECT * FROM managers WHERE manager_id = '{}'".format(session['manager_id']))
	data = cursor.fetchall()

	cursor.execute("SELECT * FROM clients WHERE managers_manager_id = '{}'".format(session['manager_id']))
	data2 = cursor.fetchall()

	cursor.close()

	return render_template('manager_profile.html', email=session['email'], data=data, data2=data2)




# --------------------CLIENT--------------------
# Add Client Page
@app.route('/add_client', methods=['GET', 'POST'])
def add_client():
	conn = mysql.connect()
	cursor = conn.cursor(pymysql.cursors.DictCursor)

	if request.method == 'POST':
		managers_manager_id = session['manager_id']
		name = request.form['name']
		surname = request.form['surname']
		email = request.form['email']
		password = request.form['password']

		encPassword = hashlib.md5(password.encode()).hexdigest()
   
		cursor.execute('SELECT * FROM clients')
		account = cursor.fetchone()
	   
		cursor.execute('INSERT INTO clients VALUES (NULL, %s, %s, %s, %s, %s)', (managers_manager_id, name, surname, email, encPassword)) 
		conn.commit()
   
		flash("You have added client successfully")
		#return redirect(url_for('clients'))
	elif request.method == 'POST':
		flash("Please fill out the form!")

	return render_template('add_client.html', email=session['email'])




# Client Profile Page
@app.route('/client_profile')
def client_profile():
	conn = mysql.connect()
	cursor = conn.cursor(pymysql.cursors.DictCursor)
	
	cursor.execute("SELECT * FROM clients WHERE client_id = '{}'".format(session['client_id']))
	data = cursor.fetchall()

	cursor.execute("SELECT * FROM measurements WHERE clients_client_id = '{}'".format(session['client_id']))
	data2 = cursor.fetchall()

	cursor.execute("SELECT * FROM basics WHERE clients_client_id = '{}'".format(session['client_id']))
	data3 = cursor.fetchall()

	cursor.execute("SELECT * FROM schedules WHERE clients_client_id = '{}'".format(session['client_id']))
	data4 = cursor.fetchall()

	sql = "SELECT m.name FROM managers m \
		INNER JOIN clients c ON m.manager_id = c.managers_manager_id \
		WHERE client_id = {}".format(session['client_id'])

	cursor.execute(sql)
	assigned_manager = cursor.fetchall()

	sql = "SELECT * FROM trainings WHERE clients_client_id = '{}' \
		AND date = CURDATE() \
		ORDER BY vreme ASC".format(session['client_id'])

	cursor.execute(sql)
	today_trainings = cursor.fetchall()

	sql = "SELECT * FROM trainings WHERE clients_client_id = '{}' \
		AND date = DATE_ADD(CURDATE(), INTERVAL 1 DAY) \
		ORDER BY vreme ASC".format(session['client_id'])

	cursor.execute(sql)
	tomorrow_trainings = cursor.fetchall()

	sql = "SELECT * FROM trainings WHERE clients_client_id = '{}' \
		AND date >= CURDATE() \
		ORDER BY vreme ASC".format(session['client_id'])

	cursor.execute(sql)
	all_trainings = cursor.fetchall()

	sql = "SELECT * FROM meals WHERE clients_client_id = '{}' \
		AND date = CURDATE() \
		ORDER BY vreme ASC".format(session['client_id'])

	cursor.execute(sql)
	today_meals = cursor.fetchall()

	sql = "SELECT * FROM meals WHERE clients_client_id = '{}' \
		AND date = DATE_ADD(CURDATE(), INTERVAL 1 DAY) \
		ORDER BY vreme ASC".format(session['client_id'])

	cursor.execute(sql)
	tomorrow_meals = cursor.fetchall()

	sql = "SELECT * FROM meals WHERE clients_client_id = '{}' \
		AND date >= CURDATE() \
		ORDER BY vreme ASC".format(session['client_id'])

	cursor.execute(sql)
	all_meals = cursor.fetchall()

	cursor.close()
	return render_template('client_profile.html', 
		email=session['email'], data=data, data2=data2, data3=data3, data4=data4, assigned_manager=assigned_manager, today_trainings=today_trainings, tomorrow_trainings=tomorrow_trainings, all_trainings=all_trainings, today_meals=today_meals, tomorrow_meals=tomorrow_meals, all_meals=all_meals)




# Show All Clients Page
@app.route('/clients')
def clients():
	conn = mysql.connect()
	cursor = conn.cursor(pymysql.cursors.DictCursor)

	cursor.execute("SELECT * FROM clients WHERE managers_manager_id = '{}'".format(session['manager_id']))
	data = cursor.fetchall()
	cursor.close()

	return render_template('clients.html', email=session['email'], data=data)




# Delete Client
@app.route('/delete_client/<string:id_data>', methods=['GET'])
def delete_client(id_data):
	conn = mysql.connect()
	cursor = conn.cursor(pymysql.cursors.DictCursor)
	cursor.execute("DELETE FROM clients WHERE client_id=%s", (id_data))
	conn.commit()
	return redirect(url_for('clients'))




@app.route('/edit_profile')
def edit_profile():
	return render_template('edit_profile.html', email=session['email'])




@app.route('/change_password', methods=['GET', 'POST'])
def change_password():
	conn = mysql.connect()
	cursor = conn.cursor(pymysql.cursors.DictCursor)

	if request.method == 'POST':
		client_id = session['client_id']
		newpass = request.form['newpass']

		encPassword = hashlib.md5(newpass.encode()).hexdigest()

		cursor.execute('UPDATE clients SET password = %s WHERE client_id = %s', (encPassword, client_id))
		conn.commit()
		return redirect(url_for('client_profile'))

	return render_template('change_password.html', email=session['email'])



# --------------------MEASUREMENT--------------------
# Add Measurements Page
@app.route('/add_measurement', methods=['GET', 'POST'])
def add_measurement():
	conn = mysql.connect()
	cursor = conn.cursor(pymysql.cursors.DictCursor)

	if request.method == 'POST':
		clients_client_id = session['client_id']
		tezina = request.form['tezina']
		vrat = request.form['vrat']
		gradi = request.form['gradi']
		pod_gradi = request.form['pod_gradi']
		papok = request.form['papok']
		kolk = request.form['kolk']
		raka = request.form['raka']
		but = request.form['but']
		cur_date = date.today()
   
		cursor.execute('INSERT INTO measurements VALUES (NULL, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)', (clients_client_id, tezina, vrat, gradi, pod_gradi, papok, kolk, raka, but, cur_date)) 
		conn.commit()
   
		flash("You have added client successfully")
		#return redirect(url_for('clients'))
	elif request.method == 'POST':
		flash("Please fill out the form!")

	return render_template('add_measurement.html', email=session['email'])




# Show All Measurements Page
@app.route('/measurements')
def measurements():
	conn = mysql.connect()
	cursor = conn.cursor(pymysql.cursors.DictCursor)

	cursor.execute("SELECT * FROM measurements WHERE clients_client_id = '{}'".format(session['client_id']))
	data = cursor.fetchall()
	cursor.close()

	return render_template('measurements.html', email=session['email'], data=data)




# Show Clients Measurements Page
@app.route('/client_measurements')
def client_measurements():
	conn = mysql.connect()
	cursor = conn.cursor(pymysql.cursors.DictCursor)

	cursor.execute("SELECT * FROM measurements WHERE clients_client_id = '{}'".format(session['client_id']))
	data = cursor.fetchall()
	cursor.close()

	return render_template('client_measurements.html', email=session['email'], data=data)




# Delete Client
@app.route('/delete_measurement/<string:id_data>', methods=['GET'])
def delete_measurement(id_data):
	conn = mysql.connect()
	cursor = conn.cursor(pymysql.cursors.DictCursor)
	cursor.execute("DELETE FROM measurements WHERE measurement_id=%s", (id_data))
	conn.commit()
	return redirect(url_for('clients_measurements'))




# --------------------BASICS--------------------
# Add Basics Page
@app.route('/add_basics', methods=['GET', 'POST'])
def add_basics():
	conn = mysql.connect()
	cursor = conn.cursor(pymysql.cursors.DictCursor)

	if request.method == 'POST':
		clients_client_id = session['client_id']
		pol = request.form['pol']
		godini = request.form['godini']
		visina = request.form['visina']
		tezina = request.form['tezina']
		alergija = request.form['alergija']
		netolerantnost = request.form['netolerantnost']
		odbivnost = request.form['odbivnost']
		zaboluvanja = request.form['zaboluvanja']
		iskustvo = request.form['iskustvo']
   
		cursor.execute('INSERT INTO basics VALUES (NULL, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)', (clients_client_id, pol, godini, visina, tezina, alergija, netolerantnost, odbivnost, zaboluvanja, iskustvo)) 
		conn.commit()
   
		flash("You have added client successfully")
		#return redirect(url_for('clients'))
	elif request.method == 'POST':
		flash("Please fill out the form!")

	return render_template('add_basics.html', email=session['email'])




# Show All Basics Page
# @app.route('/basics')
# def basics():
# 	conn = mysql.connect()
# 	cursor = conn.cursor(pymysql.cursors.DictCursor)

# 	cursor.execute("SELECT * FROM basics WHERE clients_client_id = '{}'".format(session['client_id']))
# 	data = cursor.fetchall()
# 	cursor.close()

# 	return render_template('basics.html', email=session['email'], data=data)




# Show Clients Basics Page
# @app.route('/client_basics')
# def client_basics():
# 	conn = mysql.connect()
# 	cursor = conn.cursor(pymysql.cursors.DictCursor)

# 	cursor.execute("SELECT * FROM basics WHERE clients_client_id = '{}'".format(session['client_id']))
# 	data = cursor.fetchall()
# 	cursor.close()

# 	return render_template('client_basics.html', email=session['email'], data=data)




# Delete Basics
# @app.route('/delete_basics/<string:id_data>', methods=['GET'])
# def delete_basics(id_data):
# 	conn = mysql.connect()
# 	cursor = conn.cursor(pymysql.cursors.DictCursor)
# 	cursor.execute("DELETE FROM basics WHERE basic_id=%s", (id_data))
# 	conn.commit()
# 	return redirect(url_for('client_basics'))




# --------------------SCHEDULES--------------------
# Add Schedule Page
@app.route('/add_schedule', methods=['GET', 'POST'])
def add_schedule():
	conn = mysql.connect()
	cursor = conn.cursor(pymysql.cursors.DictCursor)

	if request.method == 'POST':
		clients_client_id = session['client_id']
		stanuvanje = request.form['stanuvanje']
		legnuvanje = request.form['legnuvanje']
		rabota = request.form['rabota']
		trening = request.form['trening']
		description = request.form['description']
	   
		cursor.execute('INSERT INTO schedules VALUES (NULL, %s, %s, %s, %s, %s, %s)', (clients_client_id, stanuvanje, legnuvanje, rabota, trening, description)) 
		conn.commit()
   
		flash("You have added client successfully")
		#return redirect(url_for('clients'))
	elif request.method == 'POST':
		flash("Please fill out the form!")

	return render_template('add_schedule.html', email=session['email'])




# Show All Schedule Page
# @app.route('/schedules')
# def schedules():
# 	conn = mysql.connect()
# 	cursor = conn.cursor(pymysql.cursors.DictCursor)

# 	cursor.execute("SELECT * FROM schedules WHERE clients_client_id = '{}'".format(session['client_id']))
# 	data = cursor.fetchall()
# 	cursor.close()

# 	return render_template('schedules.html', email=session['email'], data=data)




# Show Clients Schedule Page
# @app.route('/client_schedule')
# def client_schedule():
# 	conn = mysql.connect()
# 	cursor = conn.cursor(pymysql.cursors.DictCursor)

# 	cursor.execute("SELECT * FROM schedules WHERE clients_client_id = '{}'".format(session['client_id']))
# 	data = cursor.fetchall()
# 	cursor.close()

# 	return render_template('client_schedule.html', email=session['email'], data=data)




# Delete Schedule
# @app.route('/delete_schedule/<string:id_data>', methods=['GET'])
# def delete_schedule(id_data):
# 	conn = mysql.connect()
# 	cursor = conn.cursor(pymysql.cursors.DictCursor)
# 	cursor.execute("DELETE FROM schedules WHERE schedule_id=%s", (id_data))
# 	conn.commit()
# 	return redirect(url_for('client_schedule'))




# --------------------UPLOAD IMAGE--------------------
@app.route('/upload_photo', methods=['GET', 'POST'])
def upload_photo():
	if request.method == 'POST':
		_file = request.files['file']
		if _file and allowed_file(_file):
			filename = secure_filename(_file.filename)
			_file.seek(0)
			try:
				_file.save(os.path.join(app.config['UPLOAD_PATH'], filename))
			except IOError:
				os.mkdir(app.config['UPLOAD_PATH'])
				_file.save(os.path.join(app.config['UPLOAD_PATH'], filename))
			return redirect(url_for('upload_photo'))
		else:
			return "Upload failed"
	else:
		return render_template('upload_photo.html', email=session['email'])




@app.route('/photos', methods=['GET', 'POST'])
def photos():
	files = os.listdir(app.config['UPLOAD_PATH'])
	return render_template('photos.html', files=files, email=session['email'])




@app.route('/uploads/<filename>')
def upload(filename):
	return send_from_directory(app.config['UPLOAD_PATH'], filename)




# # --------------------GROCERIES-SUPLEMENTS--------------------
# # Add Food Page
# @app.route('/add_food', methods=['GET', 'POST'])
# def add_food():
# 	conn = mysql.connect()
# 	cursor = conn.cursor(pymysql.cursors.DictCursor)

# 	if request.method == 'POST':
# 		name = request.form['name']
# 		category = request.form['category']
# 		proteins = request.form['proteins']
# 		carbohydrates = request.form['carbohydrates']
# 		fats = request.form['fats']
   
# 		cursor.execute('INSERT INTO gros_sups VALUES (NULL, %s, %s, %s, %s, %s)', (name, category, proteins, carbohydrates, fats)) 
# 		conn.commit()
   
# 	elif request.method == 'POST':
# 		flash("Please fill out the form!")

# 	return render_template('add_food.html', email=session['email'])




# # Show All Food Page
# @app.route('/food')
# def food():
# 	conn = mysql.connect()
# 	cursor = conn.cursor(pymysql.cursors.DictCursor)

# 	cursor.execute("SELECT * FROM gros_sups")
# 	data = cursor.fetchall()
# 	cursor.close()

# 	return render_template('food.html', email=session['email'], data=data)




# # Delete Food
# @app.route('/delete_food/<string:id_data>', methods=['GET'])
# def delete_food(id_data):
# 	conn = mysql.connect()
# 	cursor = conn.cursor(pymysql.cursors.DictCursor)
# 	cursor.execute("DELETE FROM gros_sups WHERE gros_sups_id=%s", (id_data))
# 	conn.commit()
# 	return redirect(url_for('food'))




# Add Food Page
@app.route('/add_meal', methods=['GET', 'POST'])
def add_meal():
	conn = mysql.connect()
	cursor = conn.cursor(pymysql.cursors.DictCursor)

	if request.method == 'POST':
		name = request.form['name']
		sostojki = request.form['sostojki']
		proteins = request.form['proteins']
		carbohydrates = request.form['carbohydrates']
		fats = request.form['fats']
		description = request.form['description']

		cursor.execute('INSERT INTO options VALUES (NULL, %s, %s, %s, %s, %s, %s)', (name, sostojki, proteins, carbohydrates, fats, description)) 
		conn.commit()
   
	elif request.method == 'POST':
		flash("Please fill out the form!")

	return render_template('add_meal.html', email=session['email'])




# --------------------RECEPTS--------------------
# Add Recept Page
@app.route('/add_recept', methods=['GET', 'POST'])
def add_recept():
	conn = mysql.connect()
	cursor = conn.cursor(pymysql.cursors.DictCursor)

	if request.method == 'POST':
		managers_manager_id = session['manager_id']
		name = request.form['name']
		description = request.form['description']
		link = request.form['link']
   
		cursor.execute('INSERT INTO recepts VALUES (NULL, %s, %s, %s, %s)', (managers_manager_id, name, description, link)) 
		conn.commit()
   
	elif request.method == 'POST':
		flash("Please fill out the form!")

	return render_template('add_recept.html', email=session['email'])




# Show All Recepts Page
@app.route('/recepts')
def recepts():
	conn = mysql.connect()
	cursor = conn.cursor(pymysql.cursors.DictCursor)

	cursor.execute("SELECT * FROM recepts")
	data = cursor.fetchall()
	cursor.close()

	return render_template('recepts.html', email=session['email'], data=data)




# Show All Clients Recepts Page
@app.route('/client_recepts')
def client_recepts():
	conn = mysql.connect()
	cursor = conn.cursor(pymysql.cursors.DictCursor)

	cursor.execute("SELECT * FROM recepts")
	data = cursor.fetchall()
	cursor.close()

	return render_template('client_recepts.html', email=session['email'], data=data)




# Delete Recept
@app.route('/delete_recept/<string:id_data>', methods=['GET'])
def delete_recept(id_data):
	conn = mysql.connect()
	cursor = conn.cursor(pymysql.cursors.DictCursor)
	cursor.execute("DELETE FROM recepts WHERE recept_id=%s", (id_data))
	conn.commit()
	return redirect(url_for('recepts'))




# # -------- MEAL-OPTIONS ------------
# @app.route('/add_meal', methods=['GET', 'POST'])
# def add_meal():
# 	conn = mysql.connect()
# 	cursor = conn.cursor(pymysql.cursors.DictCursor)

# 	if request.method == 'POST':
# 		name = request.form['name']
# 		groceerie = request.form["groceerie"]
# 		description = request.form['description']

# 		cursor.execute('INSERT INTO meal_options VALUES (NULL, %s, %s)', (name, description))
# 		conn.commit()

		
# 		grocerieList = groceerie.split(',')
# 		cursor.execute("SELECT * FROM meal_options WHERE option_id = (SELECT MAX(option_id) FROM meal_options)")
# 		result = cursor.fetchone()
# 		print(result)

# 		id_meal = result["option_id"]
		
# 		for x in grocerieList:
# 			cursor.execute('INSERT INTO meal_options_has_gros_sups VALUES (%s, %s)', (id_meal, int(x))) 
# 			conn.commit()

# 	elif request.method == 'POST':
# 		flash("Fill the form")

# 	#tuka dodaj za selectiranje tabeli drugi
# 	cursor.execute("SELECT * FROM gros_sups")
# 	data = cursor.fetchall()

# 	return render_template('add_meal.html', email=session['email'], data=data)




# # ------- DAILY-MEALS -------
# @app.route('/add_daily_meal', methods=['GET', 'POST'])
# def add_daily_meal():
# 	conn = mysql.connect()
# 	cursor = conn.cursor(pymysql.cursors.DictCursor)

# 	if request.method == 'POST':
# 		name = request.form['name']
# 		category = request.form['category']
# 		description = request.form['description']
# 		meals = request.form['meals']

# 		cursor.execute('INSERT INTO daily_meals VALUES (NULL, %s, %s, %s)', (name, category, description))
# 		conn.commit()

# 		mealsList = meals.split(',')
# 		cursor.execute("SELECT * FROM daily_meals WHERE meal_id = (SELECT MAX(meal_id) FROM daily_meals)")
# 		result = cursor.fetchone()
# 		print(result)
# 		meal_id = result['meal_id']

# 		for x in mealsList:
# 			cursor.execute('INSERT INTO daily_meals_has_meal_options VALUES (%s, %s)', (meal_id, int(x))) 
# 			conn.commit()




# 	elif request.method == 'POST':
# 		flash("Fill the form")

# 	#tuka dodaj za selectiranje tabeli drugi
# 	cursor.execute("SELECT * FROM meal_options")
# 	data = cursor.fetchall()

# 	return render_template('add_daily_meal.html', email=session['email'], data=data)




# ------- TRAININGS ------
@app.route('/add_training', methods=['GET', 'POST'])
def add_training():
	conn = mysql.connect()
	cursor = conn.cursor(pymysql.cursors.DictCursor)

	if request.method == 'POST':
		clients_client_id = request.form['clients_client_id']
		name = request.form['name']
		serii_povt = request.form['serii_povt']
		link_vezba = request.form['link_vezba']
		tech = request.form['tech']
		link_tech = request.form['link_tech']
		vreme = request.form['vreme']
		date = request.form['date']
		description = request.form['description']

		cursor.execute('INSERT INTO trainings VALUES (NULL, %s, %s, %s, %s, %s, %s, %s, %s, %s)', (clients_client_id, name, serii_povt, link_vezba, tech, link_tech, vreme, date, description))
		conn.commit()

		#tuka lista od js za pomosna tabela

	elif request.method == 'POST':
		flash("Fill the form")

	

	return render_template('add_training.html', email=session['email'])





# --------- DAILY ROUTINES ----------
@app.route('/add_daily_routine', methods=['GET', 'POST'])
def add_daily_routine():
	conn = mysql.connect()
	cursor = conn.cursor(pymysql.cursors.DictCursor)

	if request.method == 'POST':
		# allSelectedMeals = request.form['allSelectedMeals']
		# allSelectedTrainings = request.form['allSelectedTrainings']
		req = request.get_json()
		
		for i in req[0]:
			cursor.execute('INSERT INTO meals VALUES (NULL, %s, %s, %s, %s, %s, %s, %s, %s)', (i["clients_client_id"], i["name"], i["category"], i["vreme"], i["option1"], i["option2"], i["option3"], i["date"]))
			conn.commit()

		for i in req[1]:
			cursor.execute('INSERT INTO trainings VALUES (NULL, %s, %s, %s, %s, %s, %s, %s, %s, %s)', (i["clients_client_id"], i["name"], i["serii_povt"], i["link_vezba"], i["tech"], i["link_tech"], i["vreme"], i["date"], i["description"]))
			conn.commit()


		
		# print(allSelectedTrainings[0])

		

		
		#tuka lista od js za pomosna tabela

	elif request.method == 'POST':
		flash("Fill the form")

	cursor.execute("SELECT * FROM clients WHERE managers_manager_id = '{}'".format(session['manager_id']))
	data = cursor.fetchall()

	cursor.execute("SELECT * FROM options")
	data2 = cursor.fetchall()

	cursor.close()

	return render_template('add_daily_routine.html', email=session['email'], data=data, data2=data2)




# # ------- DAILY-ROUTINES ------
# @app.route('/add_daily_routine', methods=['GET', 'POST'])
# def add_daily_routine():
# 	conn = mysql.connect()
# 	cursor = conn.cursor(pymysql.cursors.DictCursor)

# 	if request.method == 'POST':
# 		name = request.form['name']
# 		meal = request.form['meal']
# 		training = request.form['training']
# 		dates = request.form['dates']
# 		vreme = request.form['vreme']
		
# 		print(meal)
# 		print(training)
# 		print(dates)
# 		print(vreme)
# 		print(name)



# 		if training:
# 			dates = dates.split(',')
# 			date_count = len(dates)
# 			print(date_count)

# 			for x in dates:
# 				cursor.execute('INSERT INTO daily_routines VALUES (NULL, %s, %s, %s)', (name, x, vreme))
# 				conn.commit()

# 			cursor.execute("SELECT daily_id FROM daily_routines ORDER BY daily_id DESC LIMIT %s", (date_count))
# 			daily_ids = cursor.fetchall()
# 			print(daily_ids)

# 			last_daily_ids = []
# 			for i in daily_ids:
# 				last_daily_ids.append(i.get("daily_id"))

# 			print(last_daily_ids)


# 			for x in last_daily_ids:
# 				cursor.execute('INSERT INTO daily_routines_has_trainings VALUES (%s, %s)', (int(x), training))
# 				conn.commit()

# 		elif meal:
# 			dates = dates.split(',')
# 			date_count = len(dates)
# 			print(date_count)

# 			for x in dates:
# 				cursor.execute('INSERT INTO daily_routines VALUES (NULL, %s, %s, %s)', (name, x, vreme))
# 				conn.commit()

# 			cursor.execute("SELECT daily_id FROM daily_routines ORDER BY daily_id DESC LIMIT %s", (date_count))
# 			daily_ids = cursor.fetchall()
# 			print(daily_ids)

# 			last_daily_ids = []
# 			for i in daily_ids:
# 				last_daily_ids.append(i.get("daily_id"))

# 			print(last_daily_ids)


# 			for x in last_daily_ids:
# 				cursor.execute('INSERT INTO daily_routines_has_daily_meals VALUES (%s, %s)', (int(x), meal))
# 				conn.commit()

# 		else:
# 			print('error')


# 	elif request.method == 'POST':
# 		flash("Fill the form")

# 	#tuka dodaj za selectiranje tabeli drugi
# 	cursor.execute("SELECT * FROM daily_meals")
# 	data = cursor.fetchall()

# 	cursor.execute("SELECT * FROM trainings")
# 	data2 = cursor.fetchall()

# 	return render_template('add_daily_routine.html', email=session['email'], data=data, data2=data2)




# @app.route('/set_daily_routine', methods=['GET', 'POST'])
# def set_daily_routine():
# 	conn = mysql.connect()
# 	cursor = conn.cursor(pymysql.cursors.DictCursor)



# 	if request.method == 'POST':
# 		client_id = request.form['client_id']
# 		routine_id = request.form['routine_id']

# 		cursor.execute('INSERT INTO clients_has_daily_routines VALUES (%s, %s)', (client_id, routine_id))
# 		conn.commit()

# 		#tuka lista od js za pomosna tabela

# 	elif request.method == 'POST':
# 		flash("Fill the form")

# 	#tuka dodaj za selectiranje tabeli drugi
# 	cursor.execute("SELECT * FROM clients")
# 	data = cursor.fetchall()

# 	cursor.execute("SELECT * FROM daily_routines")
# 	data2 = cursor.fetchall()

# 	return render_template('set_daily_routine.html', email=session['email'], data=data, data2=data2)




# --------------------MEAL--------------------
# Add Meal Page
# @app.route('/add_meal', methods=['GET', 'POST'])
# def add_meal():
# 	conn = mysql.connect()
# 	cursor = conn.cursor(pymysql.cursors.DictCursor)

# 	if request.method == 'POST':
# 		managers_manager_id = session['manager_id']
# 		clients_client_id = request.form['clients_client_id']
# 		name = request.form['name']
# 		category = request.form['category']
# 		option = request.form['option']
# 		grocerie = request.form['grocerie']
# 		vreme = request.form['vreme']
# 		start_date = request.form['start_date']
# 		end_date = request.form['end_date']
# 		description = request.form['description']
		
# 		cursor.execute('INSERT INTO meals VALUES (NULL, %s, %s, %s, %s, %s, %s, %s, %s, %s)', (managers_manager_id, clients_client_id, name, category, option, vreme, start_date, end_date, description)) 
# 		conn.commit()
	   
# 		grocerieList = grocerie.split(',')
# 		cursor.execute("SELECT * FROM meals WHERE meal_id = (SELECT MAX(meal_id) FROM meals)")
# 		result = cursor.fetchone()
# 		id_meal = result["meal_id"]
		
# 		for x in grocerieList:
# 			cursor.execute('INSERT INTO meals_has_gros_sups VALUES (%s, %s)', (id_meal, int(x))) 
# 			conn.commit()

# 		# sodrzina = " "
# 		# a_date = start_date
# 		# cursor.execute('INSERT INTO daily VALUES (NULL, %s, %s, %s, %s, %s)', (clients_client_id, name, vreme, sodrzina, a_date))
		
# 	elif request.method == 'POST':
# 		flash("Please fill out the form!")

# 	cursor.execute("SELECT * FROM gros_sups")
# 	data = cursor.fetchall()
	
# 	cursor.execute("SELECT * FROM clients WHERE managers_manager_id = '{}'".format(session['manager_id']))
# 	data2 = cursor.fetchall()

# 	cursor.close()

# 	return render_template('add_meal.html', email=session['email'], data=data, data2=data2)




# # Show All Meals Page
@app.route('/meals')
def meals():
	conn = mysql.connect()
	cursor = conn.cursor(pymysql.cursors.DictCursor)

	cursor.execute("SELECT * FROM options")
	data = cursor.fetchall()

	cursor.close()

	return render_template('meals.html', email=session['email'], data=data)




# # Show All Daily Meals Page
@app.route('/daily_meals', methods=['GET', 'POST'])
def daily_meals():
	conn = mysql.connect()
	cursor = conn.cursor(pymysql.cursors.DictCursor)

	cursor.execute("SELECT * FROM meals")
	data = cursor.fetchall()

	

	if request.method == 'POST':
		req = request.get_json()
		cursor.execute("SELECT * FROM options WHERE option_id = %s",(req))
		data2 = cursor.fetchall()
		cursor.close()
		print(jsonify(data2))
		print(type(data2))
		cursor.close()
		return jsonify(data2)




	cursor.close()
		
			

	

	return render_template('daily_meals.html', email=session['email'], data=data)


@app.route('/chose_option', methods=['POST'])
def chose_option():
	
	conn = mysql.connect()
	cursor = conn.cursor(pymysql.cursors.DictCursor)

	req = request.get_json()
	cursor.execute("SELECT * FROM options WHERE option_id = %s",(req))
	data2 = cursor.fetchall()
	cursor.close()
	print(data2)	

	return jsonify(data2)




# # Show All Daily Routines Page
@app.route('/daily_routines')
def daily_routines():
	conn = mysql.connect()
	cursor = conn.cursor(pymysql.cursors.DictCursor)

	cursor.execute("SELECT * FROM daily_routines")
	data = cursor.fetchall()

	cursor.close()

	return render_template('daily_routines.html', email=session['email'], data=data)




# Show Clients Meals Page
@app.route('/client_meals')
def client_meals():
	conn = mysql.connect()
	cursor = conn.cursor(pymysql.cursors.DictCursor)

	cursor.execute("SELECT * FROM meals WHERE clients_client_id = '{}'".format(session['client_id']))
	data = cursor.fetchall()

	cursor.close()



	return render_template('client_meals.html', email=session['email'], data=data)




# Delete Meal Option
@app.route('/delete_meal/<string:id_data>', methods=['GET'])
def delete_meal(id_data):
	conn = mysql.connect()
	cursor = conn.cursor(pymysql.cursors.DictCursor)
	cursor.execute("DELETE FROM options WHERE option_id=%s", (id_data))
	conn.commit()
	return redirect(url_for('meals'))



# Delete Daily Meal
@app.route('/delete_daily_meal/<string:id_data>', methods=['GET'])
def delete_daily_meal(id_data):
	conn = mysql.connect()
	cursor = conn.cursor(pymysql.cursors.DictCursor)
	cursor.execute("DELETE FROM meals WHERE meal_id=%s", (id_data))
	conn.commit()
	return redirect(url_for('daily_meals'))




# --------------------TRAINING--------------------
# Add Trainig Page
# @app.route('/add_training', methods=['GET', 'POST'])
# def add_training():
# 	conn = mysql.connect()
# 	cursor = conn.cursor(pymysql.cursors.DictCursor)

# 	if request.method == 'POST':
# 		managers_manager_id = session['manager_id']
# 		clients_client_id = request.form['clients_client_id']
# 		name = request.form['name']
# 		serii_povt = request.form['serii_povt']
# 		link_vezba = request.form['link_vezba']
# 		tech = request.form['tech']
# 		link_tech = request.form['link_tech']
# 		description = request.form['description']
# 		date = request.form['date']
# 		vreme = request.form['vreme']
		  
# 		cursor.execute('INSERT INTO trainings VALUES (NULL, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)', (managers_manager_id, clients_client_id, name, serii_povt, link_vezba, tech, link_tech, description, date, vreme)) 
# 		conn.commit()
   
# 	elif request.method == 'POST':
# 		flash("Please fill out the form!")

# 	cursor.execute("SELECT * FROM clients WHERE managers_manager_id = '{}'".format(session['manager_id']))
# 	data = cursor.fetchall()

# 	return render_template('add_training.html', email=session['email'], data=data)




# Show All Trainings Page
@app.route('/trainings')
def trainings():
	conn = mysql.connect()
	cursor = conn.cursor(pymysql.cursors.DictCursor)

	cursor.execute("SELECT * FROM trainings")
	data = cursor.fetchall()
	cursor.close()

	return render_template('trainings.html', email=session['email'], data=data)




# Show Clients Trainings Page
@app.route('/client_trainings')
def clients_trainings():
	conn = mysql.connect()
	cursor = conn.cursor(pymysql.cursors.DictCursor)

	cursor.execute("SELECT * FROM trainings WHERE clients_client_id = '{}'".format(session['client_id']))
	data = cursor.fetchall()
	cursor.close()

	return render_template('client_trainings.html', email=session['email'], data=data)




# Delete Training
# @app.route('/delete_training/<string:id_data>', methods=['GET'])
# def delete_training(id_data):
# 	conn = mysql.connect()
# 	cursor = conn.cursor(pymysql.cursors.DictCursor)
# 	cursor.execute("DELETE FROM trainings WHERE training_id=%s", (id_data))
# 	conn.commit()
# 	return redirect(url_for('trainings'))




# Client Profile
# @app.route('/clients_profile/<string:id_data>', methods=['GET', 'POST'])
# def clients_profile(id_data):
# 	conn = mysql.connect()
# 	cursor = conn.cursor(pymysql.cursors.DictCursor)
	
# 	cursor.execute("SELECT * FROM clients WHERE client_id=%s", (id_data))
# 	data = cursor.fetchall()

# 	cursor.execute("SELECT * FROM measurements WHERE clients_client_id=%s", (id_data))
# 	data2 = cursor.fetchall()

# 	cursor.execute("SELECT * FROM basics WHERE clients_client_id=%s", (id_data))
# 	data3 = cursor.fetchall()

# 	cursor.execute("SELECT * FROM schedules WHERE clients_client_id=%s", (id_data))
# 	data4 = cursor.fetchall()

# 	cursor.execute("SELECT * FROM trainings WHERE clients_client_id=%s AND date >= CURDATE() AND date <= DATE_ADD(CURDATE(),INTERVAL 7 DAY)", (id_data))
# 	t_week = cursor.fetchall()

# 	cursor.execute("SELECT * FROM trainings WHERE clients_client_id=%s AND date = DATE_ADD(CURDATE(),INTERVAL 1 DAY)", (id_data))
# 	t_tomorrow = cursor.fetchall()

# 	cursor.execute("SELECT * FROM trainings WHERE clients_client_id=%s AND date = CURDATE()", (id_data))
# 	t_today = cursor.fetchall()

# 	cursor.execute("SELECT * FROM meals WHERE clients_client_id=%s AND start_date >= CURDATE() AND start_date <= DATE_ADD(CURDATE(),INTERVAL 7 DAY)", (id_data))
# 	m_week = cursor.fetchall()

# 	cursor.execute("SELECT * FROM meals WHERE clients_client_id=%s AND start_date = DATE_ADD(CURDATE(),INTERVAL 1 DAY)", (id_data))
# 	m_tomorrow = cursor.fetchall()

# 	cursor.execute("SELECT * FROM meals WHERE clients_client_id=%s AND start_date = CURDATE()", (id_data))
# 	m_today = cursor.fetchall()

# 	sql = "SELECT m.name FROM managers m \
# 		INNER JOIN clients c ON m.manager_id = c.managers_manager_id \
# 		WHERE manager_id = {}".format(session['manager_id'])

# 	cursor.execute(sql)
# 	assigned_manager = cursor.fetchall()

# 	cursor.close()

# 	return render_template('profile_of_client.html', assigned_manager=assigned_manager, data=data, data2=data2, data3=data3, data4=data4, t_today=t_today, t_tomorrow=t_tomorrow, t_week=t_week, m_today=m_today, m_tomorrow=m_tomorrow, m_week=m_week, email=session['email'])




if __name__ == "__main__":
	app.run(debug=True)