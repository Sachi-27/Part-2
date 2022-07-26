<?php 
	//connect to database
	include('config/db_connect.php');

	// write query for all pizzas
	$sql = "SELECT Name, Roll_Number, Department, Hostel, ID FROM students ORDER BY ID";

	//make query and get results
	$result = mysqli_query($conn, $sql);

	//fetch resulting rows as an array
	$students = mysqli_fetch_all($result, MYSQLI_ASSOC);

	//Free result from memory.
	mysqli_free_result($result);

	//closing connection
	mysqli_close($conn);

 
?>

<!DOCTYPE html>
<html>
	<?php include('templates/header.php'); ?>

	<h4 class = "center blue-text">List of Registered Students</h4>

	<div class = "container">
		<table bgcolor = "lightgrey" class="bordered responsive-table highlight">
			<thead>
				<tr bgcolor="lightgreen">
					<td style="font-weight:bold">S.No.</td>
					<td style="font-weight:bold">Name</td>
					<td style="font-weight:bold">Roll Number</td>
					<td style="font-weight:bold">Department</td>
					<td style="font-weight:bold">Hostel No.</td>
					<td style="font-weight:bold"></td>
				</tr>
			</thead>
			
			<?php $i=1; ?>
			<?php foreach($students as $student): ?>
				<tr>
					<td><?php echo($i) ?></td>
					<td><?php echo htmlspecialchars($student['Name']); ?></td>
					<td><?php echo htmlspecialchars($student['Roll_Number']); ?></td>
					<td><?php echo htmlspecialchars($student['Department']); ?></td>
					<td>H<?php echo htmlspecialchars($student['Hostel']); ?></td>	
					<td><a href="updatedelete.php?id=<?php echo $student['ID']; ?>" class="btn background:blue">Update</a></td>
					<td><a id="<?php echo $student['ID']; ?>" class="btn-floating btn-small waves-effect waves-light red" href="delete.php?id=<?php echo $student['ID']; ?>"><i class="material-icons">delete</i></a></td>

						
				</tr>
				<?php $i++; ?>
			<?php endforeach; ?>
		</table>
		<ul><li><a href="add.php" class="btn btn-primary">Add a new student</a></li></ul>	

	<?php include('templates/footer.php'); ?>

</html>