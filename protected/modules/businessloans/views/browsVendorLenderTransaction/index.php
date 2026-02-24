<style>
.left-column,.right-column {float: left;}
.left-column {width: 30%;}
.right-column {width: 100%;}
.rtime label {display: inline;}
.datehide {display: none;}
</style>
<?php Yii::app()->clientScript->registerScript('search', " $('#list_leads_id').submit(function(){ $('#lender_transaction').yiiGridView('update', { data: $(this).serialize() }); return false; }); "); ?>
<div class="row-fluid">
    <div class="span12">
        <?php $this->beginWidget('zii.widgets.CPortlet', array('title'=>"Search",)); ?>
        <?php $form=$this->beginWidget('CActiveForm', array( 'id'=>'list_leads_id', 'enableAjaxValidation'=>false, )); ?>
        <table class="table table-striped table-hover table-bordered table-condensed">
            <thead>
                <tr>
                    <td style="width:100px"><b>Date range : </b>
                        <?php $this->widget('ext.EDateRangePicker.EDateRangePicker', array('id' => 'Filter_date', 'name' => 'date', 'value' => 'Today', 'options' => array('arrows' => true,'closeOnSelect'=>true ), 'htmlOptions' => array('class' => 'inputClass' ) )); ?>
                    </td>
                    <td style="width:100px"><b>Lenders :</b>
                        <br>
                        <?php
                        $feed_lender_name = Yii::app()->getRequest()->getParam('feed_lender_name');
                        echo Chtml::listBox( 'feed_lender_name', ''.$feed_lender_name. '',
                        		CHtml::listData(AutoFeedLenders::model()->findAll(),'feed_lender_name','feed_lender_name'),array('style' => 'width:auto;'));
                        ?>
                    </td>
                    <td style="width:100px"><b>Response :</b>
                        <br>
                        <?php 
                        $response=!empty($_REQUEST['response']) ? $_REQUEST['response'] : ''; 
                        echo CHtml::dropDownList('response', ''.$response. '', array( '1' => ACCEPTED,'0' => REJECTED,'-1' => ERROR), array('empty' => 'ANYTHING')); 
                        ?>
                    </td>
                    <td><b>Action :</b>
                        <br>
                        <?php echo CHtml::submitButton( 'search',array( 'class'=>'btn btn btn-primary')); ?>
                    </td>
                </tr>
        </table>
        <?php $this->endWidget();?>
        <?php $this->endWidget(); ?>
    </div>
</div>

<?php
$dataProvider = new CArrayDataProvider($rawData);
// echo '<pre>';print_r($dataProvider);echo '</pre>';
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'lender_transaction',
    'dataProvider' => $dataProvider,
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
            'value' => function($res) {
                if($res['response'] == '1') {
                    echo ACCEPTED;
                } else if($res['response'] == '0') {
                    echo REJECTED;
                } else if($res['response'] == '-1') {
                    echo ERROR;
                }
            }
        )
    )
));
?>



<style>
    .morecontent span {
        display: none;
    }
    .comment {
        width: 400px;
    }
</style>
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
