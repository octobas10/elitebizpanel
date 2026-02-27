<?php
class BrowsVendorLenderTransactionController extends Controller
{
	public $layout = 'column2';

	public function filters()
	{
		return array(
			'accessControl',
		);
	}

	public function accessRules()
	{
		return array(
			array('allow',
				'actions' => array('index', 'list_leads', 'failed_leads'),
				'users' => array('@'),
			),
			array('deny',
				'users' => array('*'),
			),
		);
	}

	/**
	 * Browse feed vendor/lender transactions.
	 */
	public function actionIndex()
	{
		$model = new FeedLenderTransactions();
		$rawData = $model->browsefeedlendertransction();
		$this->render('index', array('rawData' => $rawData ?: array()));
	}
}
