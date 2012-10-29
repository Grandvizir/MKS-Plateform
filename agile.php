<?php
include('dao/factory/IDaoFactory.php');
include('model/User.php');
include('model/Model.php');
include('model/Product.php');
include('model/Sprint.php');
include('model/Task.php');


$daoFactory = IDaoFactory::getInstance();
$productDAO = $daoFactory->getProductDAO();
$data = $productDAO->getAllProduct();
?>
<div class="row">
     <div class="span5"><ul class="breadcrumb" style="margin-top:20px;">
	  <li class="active"><a href="index.php">Home</a> <span class="divider">/</span></li>
	</ul></div>
     <div class="span7">
	    	<div class="legend" id = "form-item">
	    	 <a class="close" onclick="close();"  href="#">&times;</a>
			<form method="post" action="controller/controller.php">
				<table>
					<tr>
						<td><label>Nom item</label></td>
						<td><input name="item" type="text" /></td>
					</tr>
					<tr>
						<td><label>D&eacute;tails</label></td>
						<td><textarea name="detail" type="text"></textarea></td>
					</tr>

					<tr>
						<td><label>Prioryty</label></td>
						<td><input name="priority" type="text" /></td>
					</tr>
					<tr>
						<td><label>Estimate Value</label></td>
						<td><input name="EstimateValue" type="text" /></td>
					</tr>
					<tr>
						<td><label>Effort</label></td>
						<td><input name="effort" type="text" /></td>
					</tr>
					<tr>
						<td><label>Remaining</label></td>
						<td><input name="remaining" type="text" /></td>
					</tr>
					<tr>
						<input type="hidden"  name="actionPostAddProduct" value="1"/>
						<br/>
						<td><button type="submit" class="btn btn-primary">Valider mes infos</button></td>
					</tr>
				</table>
			</form>
		</div>
	 </div>
   </div>

		<h3>Front office</h3>
		<p><u>Product Backlog</u></p>
		<p><a href = "#" id = "add-item"><button class="alert alert-info">Ajout d'un item</button></a></p>
		<table class="table table-bordered">
			<tr>
				<th>Item</th>
				<th>Detail</th>
				<th>Priority</th>
				<th>Estimate of Value</th>
				<th>Initial estimate of effort</th>
				<th>Remaining</th>
				<th>Product actions</th>
			</tr>
			<?php foreach($data as $obj)
			{
				echo '
				<tr>
					<td><a href = "?page=sprint&id='.$obj->Product->ProductID.'">'.$obj->Product->Item.'</a></td>
					<td>'.$obj->Product->Detail.'</td>
					<td>'.$obj->Product->Priority.'</td>
					<td>'.$obj->Product->EstimateValue.'</td>
					<td>'.$obj->Product->Effor.'</td>
					<td>'.$obj->Product->Remaining.'</td>
					<td><a href="?page=edit-item&id='.$obj->Product->ProductID.'"> Edit </a> <a href="#">Delete</a></td>
				</tr>';
			}
			?>
		</table>

		<script type="text/javascript" src="lib/js/jquery-1.7.1.min.js"></script>
		<script type="text/javascript" src="lib/js/jquery.easing.1.3.js"></script>
		<script type="text/javascript" src="lib/js/agile.js"></script>
<script type="text/javascript" src="lib/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript">
$(".close").click(function (){
	$("#form-item").hide();
});

</script>