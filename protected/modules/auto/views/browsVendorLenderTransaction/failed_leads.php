<style>
.left-column, .right-column{
  float:left;
}
.left-column{
  width:30%; 
}
.right-column{
  width:60%; 
}
</style>
<table class="table table-striped table-hover table-bordered table-condensed">
      <thead>
        <tr>
		  <th>Date</th>
		  <th>Lender</th>
          <th width="50%">PING Data / PING Response</th>
          <th>POST Data / POST Response</th>
        </tr>
      </thead>
      <tbody>
	  <?php 
	  $connection = Yii::app()->db;
	  $command = $connection->createCommand('SELECT * FROM auto_lender_transactions WHERE response <> "accepted" ORDER BY date');
      $res = $command->queryAll(); 
	  foreach ($res as $row) {  ?>
	     <tr>
		  <td><?=$row['date']; ?></td>
		  <td><?=$row['name']; ?></td>
          <td width="50%">
		  <div class="left-column">
			  <div><b>Ping Data :-</b><br>
			  <?=htmlentities($row['ping_request']); ?>
			  </div>
			  <div><b>Ping Response :-</b><br>
			  <?=htmlentities($row['ping_response']); ?>
			  </div>
          </div>
		  </td>
		  <td width="50%">
		  <div class="right-column">
               <div><b>Post Data :-</b><br>
			  <?=htmlentities($row['request']); ?>
			  </div>
			  <div><b>Post Response :-</b><br>
			  <?=htmlentities($row['full_response']); ?>
			  </div>
          </div>
		  
		  </td>
		  </tr>
		  <?php } ?>
	  </tbody>
</table>
