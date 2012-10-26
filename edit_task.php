<?php
if(!empty($_GET['id']) && $_GET['id'] != NULL)
{
	include('dao/factory/IDaoFactory.php');
	include('model/User.php');
	include('model/Model.php');
	include('model/Product.php');
	include('model/Task.php');
	include('model/Sprint.php');

	$daoFactory = IDaoFactory::getInstance();
	$TaskDAO = $daoFactory->getTaskDAO();
	$UserDAO = $daoFactory->getUserDAO();
	$id = $_GET['id'];
	$data = $TaskDAO->getTaskByID($id);
}
else
{
	header('location:index.php');
}

?>
<ul class="breadcrumb">
	  <li><a href="index.php">Home</a> <span class="divider">/</span></li>
	  <li><a href="index.php?page=sprint">Sprint view</a> <span class="divider">/</span></li>
	  <li class="active">Sprint edition</li>
	</ul>
<p>Edition d'un sprint :</p>
<table>
			<form action= "controller/controller.php" method="POST">
				<tr>
					<td>Sprint task : </td><td><textarea name="description"><?php echo $data->Task->Description; ?></textarea></td>
				</tr>
				<tr>
					<td>Initial estimate of effort :</td>
					<td><input type = "text" name="effort" value = "<?php echo $data->Task->TaskEffor; ?>" /></td>
				</tr>
					<tr>
							<td><label>User : 	<?php 	foreach ($UserDAO->getAllUserByTaskID($id) as $model) {
								echo '<strong>'.$model->User->getUserName().'</strong> ';
							} ?> </label></td>
							<td>
								<select name="user[]" multiple id="multiselect-demo">
								<?php 	foreach ($UserDAO->getAllUser() as $model) {
									echo '<option value="'.$model->User->getUserID().'">'.$model->User->getUserName().'</option>';
								} ?>
								</select>
							</td>
							<input type="hidden"  name="TaskID" value="<?php echo $id; ?>"/>
							<input type="hidden"  name="SprintID" value="<?php echo $data->Sprint->SprintID; ?>"/>
							<input type="hidden"  name="actionPostEditTask" value="1"/>
							<input type="hidden"  name="currentUser[]" value="<?php echo $UserDAO->getAllUserByTaskID($id); ?>"/>
				</tr>
				<tr>	<td><button type="submit" class="btn btn-primary">Valider mes infos</button></td></tr>
			</form>
</table>
<script src="lib/js/jquery-1.7.1.min.js"></script>
<script src="lib/select/jquery-ui-1.9.0.custom.js"></script>
<script src="lib/select/script.js"></script>
<link rel="stylesheet" type="text/css" href="lib/select/style.css" />
<script type="text/javascript">
$('#tooltip').tooltip('hide');
$("#multiselect-demo").multiselect({
	selectedText: "# User(s)"
});
</script>