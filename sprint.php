<?php
include('dao/factory/IDaoFactory.php');
include('model/User.php');
include('model/Model.php');
include('model/Product.php');
include('model/Sprint.php');
include('model/Task.php');
include('model/UserTask.php');

$daoFactory = IDaoFactory::getInstance();
$ModelDAO = $daoFactory->getModelDAO();
$UserDAO = $daoFactory->getUserDAO();
$ProductDAO = $daoFactory->getProductDAO();

if(!empty($_GET['id']) && $_GET['id'] != NULL)
{
	$id = $_GET['id'];
	$data = $ModelDAO->getAllDependencyByProductID($id);
	$i = true;
	if(empty($data)){
		header("location:index.php?page=sprint");
	}
}
else
{
	$data = $ModelDAO->getAllWithDependency();
	$i = false;
}
?>
<div class="row">
     <div class="span5"><ul class="breadcrumb"  style="margin-top:20px;">
		 <li><a href="index.php">Home</a> <span class="divider">/</span></li>
		  <li><a href="index.php?page=sprint">Sprint view</a> <span class="divider">/</span></li>
		  <li class="active"><?php if($i){ echo $data[0]->Product->Item;} ?></li>
		</ul>
	</div>
 	<div class="span7" style="margin-left:20px;">
     	 	<div class="legend" id = "form-task">
     	 	 <a class="close" onclick="close();"  href="#">&times;</a>
			<form method="post" action="controller/controller.php">
				<table class="inscription">
						<tr>
						<td><label>Product Item</label></td>
						<td><select name="product">
						<?php 	foreach ($ProductDAO->getAllProduct() as $model) {
							echo '<option value="'.$model->Product->ProductID.'">'.$model->Product->Item.'</option>';
						} ?>
						</select></td>
					</tr>
					<tr>
						<td><label>Description</label></td>
						<td><textarea name="description" type="text"></textarea></td>
					</tr>

					<tr>
						<td><label>Effort</label></td>
						<td><input name="Effort" type="text" /></td>
					</tr>
					<tr>
						<td><label>User</label></td>
						<td><select name="user[]" multiple id="multiselect-demo">
						<?php 	foreach ($UserDAO->getAllUser() as $model) {
							echo '<option value="'.$model->User->getUserID().'">'.$model->User->getUserName().'</option>';
						} ?>
						</select></td>
					</tr>
					<tr>
						<input type="hidden"  name="actionPostAddTask" value="1"/>
						<input type="hidden"  name="SprintID" value="<?php echo $data[0]->Sprint->SprintID; ?>"/>
						<!--input type="hidden"  name="product" value="<?php echo $data[0]->Product->ProductID; ?>"/ -->

						<br/>
						<td><button type="submit" class="btn btn-primary">Valider mes infos</button></td>
					</tr>
				</table>
			</form>
		</div>
	</div>
	</div>
	<div class="row">
		<p><u>Sprint Backlog <?php if($i){echo 'de "<strong>'.$data[0]->Product->Item.'</strong>"';}else echo '<strong>all</strong>'; ?></u></p>
		<p>	<a href = "#" id = "add-task"><button class="alert alert-info">Ajout d'une tache</button></a></p>
		<table class="table table-bordered">
			<tr>
				<?php if($i){echo '	<th>BackLog product item</th>';}?>

				<th>Sprint task</th>
				<th>Volunteer</th>
				<?php if(!$i){echo '<th>Product Item</th>';}?>
				<th>Initial estimate of effort</th>
				<th>Task actions</th>
			</tr>

			<tr>
				<?php if($i){ $var = count($data) + 1; echo '<td rowspan="'.$var.'">'.$data[0]->Product->Item.'</td>';} ?></td>
			</tr>
			<?php //'.$obj->User->getUserName().'
				foreach($data as $obj){ ?>
				<tr>
				<td><?php echo $obj->Task->Description ?></td>
				<td ><?php 	foreach ($UserDAO->getAllUserByTaskID($obj->Task->TaskID) as $model) {
					echo '<a href="#"  id="tooltip" title="'.$model->User->getUserMail().'">'.$model->User->getUserName().'</a> ';
				} ?></td>
				<?php if(!$i){ echo '<td><a href="index.php?page=sprint&id='.$obj->Product->ProductID.'">'.$obj->Product->Item.'</a></td>';} ?>
				<td><?php echo $obj->Task->TaskEffor; ?></td>
				<td><a href = "index.php?page=edit-task&id=<?php echo $obj->Task->TaskID; ?>"> Edit </a> <a href = "#"> Delete </a></td>
				</tr>
			<?php }	?>
		</table>
</div>
<script type="text/javascript" src="lib/js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="lib/js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="lib/js/agile.js"></script>
<script src="lib/select/jquery-ui-1.9.0.custom.js"></script>
<script src="lib/select/script.js"></script>
<script type="text/javascript" src="lib/bootstrap/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="lib/select/style.css" />
<script type="text/javascript">
$('#tooltip').tooltip('hide');
$("#multiselect-demo").multiselect({
	selectedText: "# User(s)"
});
$(".alert").alert();
$(".close").click(function (){
	$("#form-task").hide();
});
</script>