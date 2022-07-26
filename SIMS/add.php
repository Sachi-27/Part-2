<?php 

	//connect to database
	include('config/db_connect.php');

	$name = "";
	$dept = "";
	$roll = "";
	$hostel = "";

	$errors = array('name'=>'', 'roll'=>'', 'dept'=>'', 'hostel'=>'');

	//Processing the submit click.
	if(isset($_POST["submit"])){

		//check name
		if(empty($_POST["name"])){
			$errors['name'] = "Name is required<br/ >";
		} 
		else{
			$name = $_POST["name"];
			//REGEX
			if (!preg_match('/^[a-zA-Z\s]+$/',$name)) {
				$errors['name'] = "Name must contain letters and spaces only";
			}
		}

		//check roll number
		if(empty($_POST["roll"])){
			$errors['roll'] = "Roll No. is required<br/ >";
		} 
		else{
			$roll = $_POST["roll"];
			if (!filter_var($roll,FILTER_VALIDATE_INT)) {
				$errors['roll'] = "Invalid Roll Number";
			}
			//Assumption -> Roll no. contains only numbers, eg:21do70054 is not allowed.
		}

		//check dept
		if(empty($_POST["dept"])){
			$errors['dept'] = "Department is required<br/ >";
		} 
		else{
			$dept = $_POST["dept"];
			if (!preg_match('/^[a-zA-Z\s]+$/',$dept)) {
				$errors['dept'] = "Department Not Available";
			}
		}

		//check Hostel No.
		if(empty($_POST["hostel"])){
			$errors['hostel'] = "Hostel Number is required<br/ >";
		} 
		else{
			$hostel = $_POST["hostel"];
			if (!filter_var($hostel,FILTER_VALIDATE_INT) || $hostel<=0 || $hostel>=20) {
				$errors['hostel'] = "Invalid Hostel Number";
			} //Assuming Hostel Number lies between 0 and 20 
		}

		if(!array_filter($errors)){

			//escape any malicious SQL Injections.
			$name = mysqli_real_escape_string($conn,$_POST['name']);
			$dept = mysqli_real_escape_string($conn,$_POST['dept']);
			$roll = mysqli_real_escape_string($conn,$_POST['roll']);
			$hostel = mysqli_real_escape_string($conn,$_POST['hostel']);

			//create sql
			$sql = "INSERT INTO students(Name, Roll_Number, Department, Hostel) VALUES('$name','$roll','$dept' ,'$hostel')";

			//save to db and check
			if(mysqli_query($conn, $sql)){
				//success
				// echo 'form is valid'; //redirection
				header('Location: index.php');	
			}
			else{
				//error
				echo "Query Error".mysqli_error($conn);
			}

		}

		//end of POST check
	}
?>

<!DOCTYPE html>
<html>
	<?php include('templates/header.php'); ?>

	<section class="container gray-text">
		<h4 class = "center">Enter details</h4>
		<form class="white" action="add.php" method="POST">
			<label>Name:</label>
			<input type="text" name=name value = "<?php echo htmlspecialchars($name) ?>">
			<div class = "red-text"><?php echo $errors['name']; ?></div>
			<label>Roll Number:</label>
			<input type="text" name="roll" value = "<?php echo htmlspecialchars($roll) ?>">
			<div class = "red-text"><?php echo $errors['roll']; ?></div>
			<label>Hostel No:</label>
			<input type="text" name="hostel" value = "<?php echo htmlspecialchars($hostel) ?>">
			<div class = "red-text"><?php echo $errors['hostel']; ?></div>
			<label>Department (Full Form):</label>
			<input type="text" name="dept" value = "<?php echo htmlspecialchars($dept) ?>">
			<div class = "red-text"><?php echo $errors['dept']; ?></div>
			<div class = "center">
			
				<input type="submit" name="submit" value="submit" class="btn brand btn-green">
			</div>
		</form>
	</section>

	<?php include('templates/footer.php'); ?>

</html>