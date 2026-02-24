<?php
$this->breadcrumbs=array('Affiliate Registration Page Validations');
$this->menu=array(array('label'=>'Validations','url'=>array('index')));
?>
<h4>Affiliate Registration Page Validations</h4>
<?php if(Yii::app()->user->hasFlash('success')): ?>
<div class="alert alert-success" role="alert">
	<?php echo Yii::app()->user->getFlash('success'); ?>
</div>
<?php elseif(Yii::app()->user->hasFlash('error')): ?>
<div class="alert alert-danger" role="alert">
	<?php echo Yii::app()->user->getFlash('error'); ?>
</div>
<?php endif; ?>
<div class="row-fluid">
	<div class="span12">
		<?php
		$this->beginWidget('zii.widgets.CPortlet', array('title'=>"Validation",));
		?>
        <div class="table-responsive">
		<table id="myTable" class="tablesorter table table-striped table-hover table-bordered table-condensed affiliate_report" style="text-align:center;">
			<thead>
				<tr>
					<th style="text-align:center;">Verify Phone</th>
					<th style="text-align:center;">Verify Email</th>
					<th style="text-align:center;">Verify Address</th>
					<th style="text-align:center;">Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
					/*print_r($allowed_verifications);
					if(isset($allowed_verifications) && !empty($allowed_verifications)) {
						
					} else {
						echo '<tr><td colspan="3">No Validations Found</td></tr>';
					}*/
					$btn_val = 'Submit';
					$verify_phone=$verify_email=$verify_address='0';
					if(isset($allowed_verifications) && !empty($allowed_verifications)) {
						$btn_val = 'Update';
						$verify_phone=$allowed_verifications[0]['verify_phone'];
						$verify_email=$allowed_verifications[0]['verify_email'];
						$verify_address=$allowed_verifications[0]['verify_address'];
					}
					?>
					<tr>
					<form name="affiliate_verify" method="post" action="">
						<td><input type="checkbox" name="verify_phone" value="" <?php echo ($verify_phone == '1') ? 'checked' : '';?>></td>
						<td><input type="checkbox" name="verify_email" value="" <?php echo ($verify_email == '1') ? 'checked' : '';?>></td>
						<td><input type="checkbox" name="verify_address" value="" <?php echo ($verify_address == '1') ? 'checked' : '';?>></td>
						<td><input type="submit" name="save_validations" value="<?php echo $btn_val; ?>" class="btn btn-primary"></td>
					</form>
					</tr>
					<?php
				?>
			</tbody>
		</table>
        </div>
	</div>
	<?php $this->endWidget(); ?>
</div>
<style>
.table.table-striped.table-hover.table-bordered.table-condensed a.Block{color: red;}
.table.table-striped.table-hover.table-bordered.table-condensed a.Allow{color: green;}
</style>
<script type="text/javascript">
$(document).ready(function(){
	$(".alert").animate({opacity: 1.0}, 3000).fadeOut("slow");
});
</script>