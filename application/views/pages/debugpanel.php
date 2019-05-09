<!DOCTYPE html>
<html>
<head>
	<title>DEBUG PANEL</title>
	<?php 
		echo $js;
		echo $css;
	?>
</head>
<body>
	<?php echo $header;?>

   <div class="container" style="margin-top: 35px;">
		<?php echo form_open("Home/set_user_id"); ?>
			<div class="form-group">
				<label class="control-label col-sm-2">Set ID:</label>
				<div class="col-sm-10">
					<input required type="text" class="form-control" name="userid" id="userid" placeholder="Enter userid">
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
				<button type="submit" name="submit" class="btn btn-info">Submit</button><br><br>
				<!-- <button type="cancel" name="cancel" onclick="location.href='<?php echo base_url();?>';return false;" class="btn btn-default" onClick=re>Cancel</button> -->
				</div>
			</div>
      <?php echo form_close(); ?>
		<?php echo form_open("Home/set_account_type"); ?>
			<div class="form-group">
				<label class="control-label col-sm-2">Account Type</label>
				<div class="col-sm-10">
					<select class="form-control" name="account_type">
						<option value="admin">(Pick an option...)</option>
						<option value="admin">Admin</option>
						<option value="user">User</option>
					</select>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
				<button type="submit" name="submit" class="btn btn-info">Submit</button><br>
				<!-- <button type="cancel" name="cancel" onclick="location.href='<?php echo base_url();?>';return false;" class="btn btn-default" onClick=re>Cancel</button> -->
				</div>
			</div>
      <?php echo form_close(); ?>
	</div>
	<br>
	<div class="container">         
		<table class="table table-stripped table-bordered" id="produk">
			<thead>
				<tr>
				<th>Order ID</th>
				<th>Tracking Number</th>
				<th>Status</th>
				<th>Date Ordered</th>
				<th>Action</th>
				</tr>
			</thead>
			<tbody>
			<?php 
				foreach ($orders as $row) {
					$order_id = $row['order_id'];
					$tracking_number = $row['tracking_number'];
					$status = $row['description'];
					$order_date = $row['order_date'];
					echo "<tr>";
						echo "<td>" . $order_id. "</td>";
						echo "<td>" . $tracking_number . "</td>";
						echo "<td>" . $status . "</td>";
						echo "<td>" . $order_date . "</td>";
						echo "<td>";
							echo "<a href='OrderDetails/$order_id'
									style='margin-right:10px;color:rgb(0,200,255);'>";
								echo "<button class='btn'>";
									echo "<span class='glyphicon glyphicon-search'></span>";
								echo "</button>";
							echo "</a>";
							if($accountType=="admin") {
								echo "<a href='EditOrder/$order_id'
										style='margin-right:10px;color:rgb(255,215,0);'>";
									echo "<button class='btn'>";
									echo "<span class='glyphicon glyphicon-edit'></span>";
									echo "</button>";
								echo "</a>";
							}

						echo "</td>";
					echo "</tr>";
				}
			?>
			</tbody>
		</table>
		<script type="text/javascript">
			$('#produk').DataTable();
		</script>  
	</div>
	
	<?php echo $footer; ?>
</body>
</html>