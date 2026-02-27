<style>
.brows-vendor-lender-transaction-page .rtime label { display: inline; }
.brows-vendor-lender-transaction-page .datehide { display: none; }
.brows-vendor-lender-transaction-page .brows-transaction-search table { width: 100%; }
.brows-vendor-lender-transaction-page .brows-transaction-search td { padding: 0.5rem 0.75rem; vertical-align: middle; }
.brows-vendor-lender-transaction-page .brows-transaction-search .inputClass { min-width: 140px; }
.brows-vendor-lender-transaction-page .morecontent span { display: none; }
.brows-vendor-lender-transaction-page .comment { max-width: 100%; word-wrap: break-word; }
</style>
<?php Yii::app()->clientScript->registerScript('search', " $('#list_leads_id').submit(function(){ $('#lender_transaction').yiiGridView('update', { data: $(this).serialize() }); return false; }); "); ?>
<section class="mortgage-dashboard-section brows-vendor-lender-transaction-page">
	<header class="lenders-page-header">
		<div class="lenders-page-header-inner">
			<h1 class="lenders-page-title">Browse Vendor / Lender Transactions</h1>
			<p class="lenders-page-subtitle">View feed lender request/response transactions by date, lender and response.</p>
		</div>
	</header>
<div class="row-fluid brows-vendor-lender-transaction">
    <div class="span12">
        <?php $this->beginWidget('zii.widgets.CPortlet', array('title' => 'Filters', 'htmlOptions' => array('class' => 'portlet portlet--filters-collapsible'))); ?>
        <?php $form = $this->beginWidget('CActiveForm', array('id' => 'list_leads_id', 'enableAjaxValidation' => false)); ?>
        <div class="brows-transaction-search">
        <table class="table table-striped table-hover table-bordered table-condensed">
            <thead>
                <tr>
                    <td style="width:140px"><b>Date range:</b>
                        <?php $this->widget('ext.EDateRangePicker.EDateRangePicker', array('id' => 'Filter_date', 'name' => 'date', 'value' => 'Today', 'options' => array('arrows' => true, 'closeOnSelect' => true), 'htmlOptions' => array('class' => 'inputClass'))); ?>
                    </td>
                    <td style="width:160px"><b>Lenders:</b><br>
                        <?php
                        $feed_lender_name = Yii::app()->getRequest()->getParam('feed_lender_name');
                        echo CHtml::listBox('feed_lender_name', $feed_lender_name, CHtml::listData(AutoFeedLenders::model()->findAll(), 'feed_lender_name', 'feed_lender_name'), array('style' => 'width:100%;min-width:120px;'));
                        ?>
                    </td>
                    <td style="width:120px"><b>Response:</b><br>
                        <?php
                        $response = isset($_REQUEST['response']) ? $_REQUEST['response'] : '';
                        echo CHtml::dropDownList('response', $response, array('1' => ACCEPTED, '0' => REJECTED, '-1' => ERROR), array('empty' => 'ANYTHING'));
                        ?>
                    </td>
                    <td><b>Action:</b><br>
                        <?php echo CHtml::submitButton('Search', array('class' => 'btn btn-primary')); ?>
                    </td>
                </tr>
            </thead>
        </table>
        </div>
        <?php $this->endWidget(); ?>
        <?php $this->endWidget(); ?>
    </div>
</div>

<div class="row-fluid brows-transaction-results">
	<div class="span12">
		<?php $this->beginWidget('zii.widgets.CPortlet', array('title' => 'Transactions')); ?>
		<div class="portlet-content dashboard-table-wrap">
<?php
$dataProvider = new CArrayDataProvider($rawData);
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'lender_transaction',
    'dataProvider' => $dataProvider,
    'htmlOptions' => array('class' => 'grid-view'),
    'itemsCssClass' => 'table table-bordered table-striped table-condensed table-hover',
    'columns' => array(
        array(
            'name' => 'date',
            'header' => 'Date Time'
        ),
        array(
            'name' => 'feed_lender_name',
            'header' => 'Lender'
        ),
        array(
            'name' => 'request',
            'header' => 'Request',
        	'value' => 'urldecode($data["request"])',
            'htmlOptions' => array(
                'style' => 'word-wrap:break-word;',
                'class' => 'comment more'
            )
        ),
		array(
    		'name' => 'full_response',
    		'header' => 'Full Response',
			'htmlOptions' => array(
				'style' => 'width:450px;',
			)
    	),
        array(
            'name' => 'response',
            'header' => 'Response',
            'value' => function($data) {
                if ((string)$data['response'] === '1') return ACCEPTED;
                if ((string)$data['response'] === '0') return REJECTED;
                if ((string)$data['response'] === '-1') return ERROR;
                return '';
            }
        )
        )
));
?>
		</div>
		<?php $this->endWidget(); ?>
	</div>
</div>
</section>



<script>
    $(document).ready(function() {

        var showChar = 120;
        var ellipsestext = "...";
        var moretext = "more";
        var lesstext = "less";
        $('.more').each(function() {
            var content = $(this).html();

            if (content.length > showChar) {

                var c = content.substr(0, showChar);
                var h = content.substr(showChar - 1, content.length - showChar);

                var html = c + '<span class="moreellipses">' + ellipsestext + '&nbsp;</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink">' + moretext + '</a></span>';

                $(this).html(html);
            }

        });

        $(".morelink").click(function() {
            if ($(this).hasClass("less")) {
                $(this).removeClass("less");
                $(this).html(moretext);
            } else {
                $(this).addClass("less");
                $(this).html(lesstext);
            }
            $(this).parent().prev().toggle();
            $(this).prev().toggle();
            return false;
        });


    });
</script>
