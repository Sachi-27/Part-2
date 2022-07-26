<?php 
 	
 	include('config/db_connect.php');

 	if(isset($_POST['Delete'])){

 		$id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);

 		$sql = "DELETE FROM students WHERE id = $id_to_delete";

 		if(mysqli_query($conn,$sql)){
 			//success
 			header('Location: index.php');
 		}
 		else{
 			echo 'Query error:'.mysqli_error($conn);
 		}
 	}

	//check get request id parameter
	if(isset($_GET['id'])){
		$id = mysqli_real_escape_string($conn,$_GET['id']);

		//make sql
		$sql = "SELECT * FROM students WHERE ID = $id";

		//get the query results
		$result = mysqli_query($conn, $sql);

		//fetch result in array form
		$student = mysqli_fetch_assoc($result);

		//free result from memory
		mysqli_free_result($result);
		mysqli_close($conn);
	}

?>


<!DOCTYPE html>
<html>
	<?php include('templates/header.php'); ?>

	<h1 class = "center red-text">Are you sure you want to delete?</h1>
	<div class="container">
		<table bgcolor = "lightgrey" class="bordered highlight">
		<thead>
			<tr>
				<td style="font-weight:bold"><?php echo $student['Name'] ?></td>
				<td style="font-weight:bold"><?php echo $student["Roll_Number"] ?></td>
				<td style="font-weight:bold"><?php echo $student["Department"] ?></td>
				<td style="font-weight:bold">Hostel<?php echo $student["Hostel"] ?></td>
				<td>
					<form action="delete.php" method="POST">
						<input type="hidden" name="id_to_delete" value="<?php echo $student['ID']?>">
						<input type="submit" name="Delete" value="Yes" class="btn brand">

						<a href="index.php" class="btn" >No</a>
					</form>

				</td>
			</tr>
		</thead>
	</table>
	</div>
	
	<?php include('templates/footer.php'); ?>
</html>