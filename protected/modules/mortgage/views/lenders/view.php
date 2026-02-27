<?php
/* @var $this LendersController */
/* @var $model LenderUser */

$this->breadcrumbs = array(
	'Lender Details' => array('index'),
	$model->name,
);

$this->menu = array(
	array('label' => 'Create New Lender', 'url' => array('create')),
	array('label' => 'Update Lender', 'url' => array('update', 'id' => $model->id)),
	array('label' => 'Delete Lender', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
	array('label' => 'Lender Details', 'url' => array('index')),
);

$statusLabel = $model->getStatus($model->status);
$statusClass = in_array((string)$model->status, array('1', '2'), true) ? 'lender-status-badge--active' : 'lender-status-badge--inactive';
?>
<section class="lenders-page mortgage-dashboard-section lenders-view-page">
	<header class="lenders-page-header lenders-view-header">
		<div class="lenders-page-header-inner">
			<h1 class="lenders-page-title"><?php echo CHtml::encode($model->name); ?></h1>
			<p class="lenders-page-subtitle">Lender details and configuration.</p>
			<?php if ($statusLabel !== ''): ?>
				<span class="lender-status-badge <?php echo CHtml::encode($statusClass); ?>"><?php echo CHtml::encode($statusLabel); ?></span>
			<?php endif; ?>
		</div>
		<div class="lenders-page-actions">
			<?php echo CHtml::link('Edit', array('update', 'id' => $model->id), array('class' => 'btn btn-primary')); ?>
			<?php echo CHtml::link('Back to list', array('index'), array('class' => 'btn btn-default')); ?>
		</div>
	</header>

	<div class="lenders-view-grid">
		<div class="lenders-view-card portlet">
			<div class="portlet-decoration">
				<span class="portlet-title">Overview</span>
			</div>
			<div class="portlet-content">
				<?php
				$this->widget('zii.widgets.CDetailView', array(
					'data' => $model,
					'attributes' => array(
						'id',
						'name',
						array(
							'name' => 'status',
							'value' => $model->getStatus($model->status) ?: '—',
						),
						'company_name',
						array(
							'name' => 'lender_pingpost_type',
							'value' => ($model->lender_pingpost_type == 1) ? 'Direct Buyer' : 'Ping Post Buyer',
						),
						array(
							'name' => 'createdAt',
							'value' => $model->createdAt ? $model->createdAt : '—',
						),
					),
					'htmlOptions' => array('class' => 'lenders-detail-view'),
				));
				?>
			</div>
		</div>

		<div class="lenders-view-card portlet">
			<div class="portlet-decoration">
				<span class="portlet-title">Credentials & contact</span>
			</div>
			<div class="portlet-content">
				<?php
				$this->widget('zii.widgets.CDetailView', array(
					'data' => $model,
					'attributes' => array(
						'user_name',
						'first_name',
						'last_name',
						array('name' => 'email', 'value' => $model->email ?: '—'),
						array('name' => 'phone', 'value' => $model->phone ?: '—'),
					),
					'htmlOptions' => array('class' => 'lenders-detail-view'),
				));
				?>
			</div>
		</div>

		<div class="lenders-view-card portlet lenders-view-card--full">
			<div class="portlet-decoration">
				<span class="portlet-title">URLs</span>
			</div>
			<div class="portlet-content">
				<?php
				$this->widget('zii.widgets.CDetailView', array(
					'data' => $model,
					'attributes' => array(
						array('name' => 'ping_url_test', 'value' => $model->ping_url_test ? CHtml::encode($model->ping_url_test) : '—', 'type' => 'raw'),
						array('name' => 'ping_url_live', 'value' => $model->ping_url_live ? CHtml::encode($model->ping_url_live) : '—', 'type' => 'raw'),
						array('name' => 'post_url_test', 'value' => $model->post_url_test ? CHtml::encode($model->post_url_test) : '—', 'type' => 'raw'),
						array('name' => 'post_url_live', 'value' => $model->post_url_live ? CHtml::encode($model->post_url_live) : '—', 'type' => 'raw'),
					),
					'htmlOptions' => array('class' => 'lenders-detail-view lenders-detail-view--urls'),
				));
				?>
			</div>
		</div>

		<div class="lenders-view-card portlet">
			<div class="portlet-decoration">
				<span class="portlet-title">Caps & limits</span>
			</div>
			<div class="portlet-content">
				<?php
				$this->widget('zii.widgets.CDetailView', array(
					'data' => $model,
					'attributes' => array(
						array('name' => 'static_lead_price', 'value' => $model->static_lead_price !== null && $model->static_lead_price !== '' ? $model->static_lead_price : '—'),
						array('name' => 'submission_cap', 'value' => $model->submission_cap !== null && $model->submission_cap !== '' ? $model->submission_cap : '—'),
						array('name' => 'accepted_cap', 'value' => $model->accepted_cap !== null && $model->accepted_cap !== '' ? $model->accepted_cap : '—'),
						array('name' => 'paused_vendor', 'value' => $model->paused_vendor !== null && $model->paused_vendor !== '' ? $model->paused_vendor : '—'),
						array('name' => 'posting_timelimit', 'value' => $model->posting_timelimit !== null && $model->posting_timelimit !== '' ? $model->posting_timelimit : '—'),
						array('name' => 'margin', 'value' => $model->margin !== null && $model->margin !== '' ? $model->margin : '—'),
					),
					'htmlOptions' => array('class' => 'lenders-detail-view'),
				));
				?>
			</div>
		</div>

		<div class="lenders-view-card portlet">
			<div class="portlet-decoration">
				<span class="portlet-title">Parameters & notes</span>
			</div>
			<div class="portlet-content">
				<?php
				$this->widget('zii.widgets.CDetailView', array(
					'data' => $model,
					'attributes' => array(
						array('name' => 'parameter1', 'value' => $model->parameter1 ?: '—'),
						array('name' => 'parameter2', 'value' => $model->parameter2 ?: '—'),
						array('name' => 'parameter3', 'value' => $model->parameter3 ?: '—'),
						array('name' => 'note', 'value' => $model->note ? nl2br(CHtml::encode($model->note)) : '—', 'type' => 'raw'),
					),
					'htmlOptions' => array('class' => 'lenders-detail-view'),
				));
				?>
			</div>
		</div>
	</div>
</section>
