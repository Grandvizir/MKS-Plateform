<?php
if(!empty($_GET['id']) && $_GET['id'] != NULL)
{
	include('dao/factory/IDaoFactory.php');
	include('model/User.php');
	include('model/Model.php');
	include('model/Product.php');
	$daoFactory = IDaoFactory::getInstance();
	$ProductDAO = $daoFactory->getProductDAO();

	$id = $_GET['id'];
	$data = $ProductDAO->getProductByID($id);
}
else
{
	header('location:index.php');
}


?>
	<ul class="breadcrumb">
	  <li><a href="index.php">Home</a> <span class="divider">/</span></li>
	  <li class="active">Product edition</li>
	</ul>
	<tr>
						<td><label>Product</label></td>
						<td><select name="product">
						<?php 	foreach ($ProductDAO->getAllProduct()  as $model) {
							echo '<option ';
							if($id == $model->Product->ProductID){
								echo 'selected="selected"';
							}
							echo ' value="'.$model->Product->ProductID.'">'.$model->Product->Item.'</option>';
						} ?>
						</select></td>
	</tr>
	<form method="post" action="controller/controller.php">
				<table>
					<tr>
						<td><label>Nom item</label></td>
						<td><input name="item" value="<?php echo $data->Product->Item; ?>" type="text" /></td>
					</tr>
					<tr>
						<td><label>D&eacute;tails</label></td>
						<td><textarea name="detail"><?php echo $data->Product->Detail; ?></textarea></td>
					</tr>

					<tr>
						<td><label>Prioryty</label></td>
						<td><input value="<?php echo $data->Product->Priority; ?>" name="priority" type="text" /></td>
					</tr>
					<tr>
						<td><label>Estimate Value</label></td>
						<td><input value="<?php echo $data->Product->EstimateValue; ?>" name="EstimateValue" type="text" /></td>
					</tr>
					<tr>
						<td><label>Effort</label></td>
						<td><input value="<?php echo $data->Product->Effor; ?>" name="effort" type="text" /></td>
					</tr>
					<tr>
						<td><label>Remaining</label></td>
						<td><input name="remaining" value="<?php echo $data->Product->Remaining; ?>" type="text" /></td>
					</tr>
					<tr>
						<input type="hidden"  name="actionPostEditProduct" value="1"/>
						<input type="hidden"  name="ProductID" value="<?php echo $id; ?>"/>
						<br/>
						<td><button type="submit" class="btn btn-primary">Valider mes infos</button></td>
					</tr>
				</table>
			</form>