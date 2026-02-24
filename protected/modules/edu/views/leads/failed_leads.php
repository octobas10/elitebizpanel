<style>
.left-column, .right-column {
	float: left;
}
.left-column {
	width: 30%;
}
.right-column {
	width: 60%;
}
</style>
<h4>Failed Leads</h4>
<table class="table table-striped table-hover table-bordered table-condensed">
	<thead>
		<tr>
			<th>Date</th>
			<th>Lender</th>
			<!--<th>PING Data / PING Response</th>-->
			<th>POST Data / POST Response</th>
		</tr>
	</thead>
	<tbody>
	<?php
		/**
		 ** Author : Vatsal Gadhia
		 ** Description : 1) query removed from view and placed in model
		 **               2) ping fields commented
		 ** Date : 02-08-2016
		**/			
	if(isset($rawData) && !empty($rawData)) { 
		foreach($rawData as $row) { ?>
			<tr>
				<td><?php echo $row['date']; ?></td>
				<td><?php echo $row['lender_name']; ?></td>
				<!--<td>
					<div class="left-column">
						<div>
							<b>Ping Data :-</b><br>
				  			<?php //echo htmlentities($row['ping_request']); ?>
						</div>
						<div>
						<b>Ping Response :-</b><br>
				  			<?php //echo htmlentities($row['ping_response']); ?>
						</div>
					</div>
				</td>-->
				<td class="comment more" style="word-wrap:break-word;max-width:400px">
					<div class="right-column">
						<div>
							<b>Post Data :-</b><br>
			  				<?php echo htmlentities($row['post_request']); ?>
						</div>
						<div>
							<b>Post Response :-</b><br>
							<?php echo htmlentities($row['post_response']); ?>
						</div>
					</div>
				</td>
			</tr>
<?php } } else { ?>
			<tr>
				<td colspan="3"><div class="alert alert-danger" align="center"><h4>No data found for this criteria.</h4></div></td>
			</tr>
<?php } ?>
</tbody>
</table>
