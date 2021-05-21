CREATE TABLE user(
	id INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
	first VARCHAR(256) NOT NULL,
	last VARCHAR(256) NOT NULL,
	username VARCHAR(256) NOT NULL,
	password VARCHAR(256) NOT NULL
);

CREATE TABLE profileimg(
	id INT() NOT NULL PRIMARY KEY AUTO_INCREMENT,
	userid INT(11) NOT NULL,
	status INT(11) NOT NULL
);


<?php
	session_start();
	include_once 'dbh.php';

?>


$conn = mysqli_connect("localhost", "root", "", "imgupload");


<head>
	<title></title>
</head>

<?php
	$sql = "SELECT * FROM user";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) {
		while ($row = mysqli_fetch_assoc($result)){
			$id = $row['id'];
			$sqlImg = "SELECT * FROM profileimg WHERE userid='$id'";
			$result = mysqli_query($conn, $sqlImg);
			while($rowImg = mysqli_fetch_assoc($resultImg)){
				echo "<div class='user-container'>";
					if ($rowImg['status'] == 0) {
						echo "<img src'uploads/profile".$id.".jpg?'".mt_rand().">";
					}
					else{
						echo "<img src='uploads/profiledefaut.jpg'>";
					}
					echo "<p>".$row['username']."</p>";
				echo "</div>";
			}
		}
	}
	else{
		echo "There are no users yet!";
	}





	if (isset($_SESSION['id'])) {
		if ($_SESSION['id'] == 1) {
			echo "You are logged in as user #1";
		}
		echo "<form action="upload.php", method="POST", enctype="multipart/form-data">
						<input type="file" name="file">
						<button type="submit", name="submit">UPLOAD</button>
					</form>";
	}
	else{
		echo "You are not logged in!";
		echo "
			<form action='signup.php' method='POST'>
				<input type='text' name='first' placeholder='First Name'>
				<input type='text' name='last' placeholder='Last Name'>
				<input type='text' name='uid' placeholder=' Username'>
				<input type='password' name='pwd' placeholder='Password'>
				<button type='submit' name='submitSignup'>Signup</button>
			</form>";
	}
?>



<p>Login as user!</p>
<form action="login.php" method="POST">
	<button type="submit", name="submitLogin">Login</button>
</form>

<p>Logout as user!</p>
<form action="logout.php" method="POST">
	<button type="submit", name="submitLogout">Logout</button>
</form>

<?php
	session_start();
	if(isset($_POST['submitLogin'])){
		$_SESSION['id'] = 1;
		header("Location: index.php");
	}
?>

<?php
	session_start();

	session_unset();
	session_destroy();

	header("Location: index.php");
?>






<?php
	$first = $_POST['first'];
	$last = $_POST['last'];
	$uid = $_POST['uid'];
	$pwd = $_POST['pwd'];

	$sql = "INSERT INTO user(first, last, username, password)
					VALUES('$first', '$last', '$uid', '$pwd')";
	mysqli_query($conn, $sql);

	$sql = "SELECT * FROM user WHERE username='$uid' AND first='$first'";
	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) > 0) {
		while($row = mysqli_fetch_assoc($result)){
			$userid = $row['id'];
			$sql = "INSERT INTO profileimg(userid, status)
					VALUES('$userid', 1)";
			mysqli_query($conn, $sql);
			header("Location: index.php");
		}
	}
	else{
		echo "You have an error!";
	}
?>





<?php
	session_start();
	include_once 'dbh.php';
	$id = $_SESSION['id'];

	if (isset($_POST['submit'])) {
		$file = $_FILES['file'];

		$fileName = $file['name'];
		$fileTmpName = $file['tmp_name'];
		$fileSize = $file['size'];
		$fileError = $file['error'];
		$fileType = $file['type'];

		$fileExt = explode('.', $fileName);
		$fileActualExt = strtolower(end($fileExt));

		$allowed = array('jpg', 'jpeg', 'png', 'png');

		if(in_array($fileActualExt, $allowed)){
			if ($fileError === 0) {
				if ($fileSize < 1000000) {
					$fileNameNew = "profile".$id.".".$fileActualExt;
					$fileDestination = 'uploads/'.$fileNameNew;
					move_uploaded_file($fileTmpName, $fileDestination);
					$sql = "UPDATE profileimg SET status=0 WHERE userid='$id';";
					$result = mysqli_query($conn, $sql);
					header("Location: index.php?uploadsuccess");
				}
				else{
					echo "Your file is too big!";
				}
			}
			else{
				echo "There was an error uploading your file!";
			}
		}
		else{
			echo "You cannot upload files of this type!";
		}
	}
?>