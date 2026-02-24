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
			<th>PING Data / PING Response</th>
			<th>POST Data / POST Response</th>
		</tr>
	</thead>
	<tbody>
	<?php
		$where = 'post_status <> "1"';
		$order = 'date';
		$rawData = Yii::app()->dbBusinessLoans->createCommand()
		->select('*')
		->from('businessloans_lender_transactions')
		->where($where)
		->order($order)
		->queryAll();
		foreach($rawData as $row){?>
			<tr>
				<td><?php echo $row['date']; ?></td>
				<td><?php echo $row['lender_name']; ?></td>
				<td>
					<div class="left-column">
						<div>
							<b>Ping Data :-</b><br>
				  			<?php echo htmlentities($row['ping_request']); ?>
						</div>
						<div>
						<b>Ping Response :-</b><br>
				  			<?php echo htmlentities($row['ping_response']); ?>
						</div>
					</div>
				</td>
				<td>
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
<?php } ?>
</tbody>
</table>
