<?php
class GraphController extends Controller{
	public $layout = 'column1';
	/**
	 * All graph view page
	 */
	public function actionIndex(){
		$this->render('index');
	}
	/**
	 * Accepted Leads at Hour of the Day (For Admin, Displayed on Graph Module)
	 */
	public function actionHourlyacceptancerate(){
		$model = new LenderTransactions();
		$xml_cat = $model->hourlyAcceptedLeads();
		echo $xml_cat;
	}
	/**
	 * Accepted State wise in Last 15 Days (For Admin, Displayed on Graph Module)
	 */
	public function actionStatewiseacceptance(){
		$model = new AffiliateTransactions();
		$xml_cat = $model->acceptLaststate15days();
		echo $xml_cat;
	}
	/**
	 * Total Looks to Lenders Today (For Admin, Displayed on Graph Module)
	 */
	public function actionLendersdailycountaccept(){
		$model = new LenderAffiliateTransaction();
		$xml_cat = $model->dailyCount();
		echo $xml_cat;
	}
	/**
	 * Valid Pings of Last 15 Days (For Admin, Displayed on Graph Module)
	 */
	public function actionSubmissionlast15days(){
		$model = new Submissions();
		$xml_cat = $model->submission15days();
		echo $xml_cat;
	}
	/**
	 * Specific Affiliate Ping Report for Last 15 Days
	 */
	public function actionAffiliatepingreportlast15days(){
		$model = new AffiliateDailyCounts();
		$xml_cat = $model->specific_affiliate_pingreport_last_15days();
		echo $xml_cat;
	}
	/**
	 * Specific Affiliate Post Report for Last 15 Days
	 */
	public function actionAffiliatepostreportlast15days(){
		$model = new AffiliateDailyCounts();
		$xml_cat = $model->specific_affiliate_postreport_last_15days();
		echo $xml_cat;
	}
	/**
	 * Todays ping report (ping sent vs ping duplicate vs ping rejected). Displyed on admin dashboard. 
	 */
	public function actionTodayspingreport(){
		$model = new AffiliateDailyCounts();
		echo $xml = $model->todayspingreport();
	}
	/**
	 * Todays post report (post sent vs post rejected). Displyed on admin dashboard. 
	 */
	public function actionTodayspostreport(){
		$model = new AffiliateDailyCounts();
		echo $xml = $model->todayspostreport();
	}
	/**
	 * Pings of last 15 days. Displayed on admin dashboard.
	 */
	public function actionPingsoflast15days(){
		$model = new AffiliateDailyCounts();
		echo $xml = $model->pingsoflast15days(); 
	}
	/**
	 * Conversions of last 15 days. Displayed on admin dashboard.
	 */
	public function actionConversionsoflast15days(){
		$model = new AffiliateDailyCounts();
		echo $xml = $model->conversionsoflast15days();
	}
	/**
	 * Specific lender ping report when they logged in. Displayed on Lender dashboard.
	 */
	public function actionLenderpingreportlast15days(){
		$model = new LenderAffiliateTransaction();
		echo $xml = $model->specific_lender_ping_report_last_15days();
	}
	/**
	 * Specific lender post report when they logged in. Displayed on Lender dashboard.
	 */
	public function actionLenderpostreportlast15days(){
		$model = new LenderAffiliateTransaction();
		echo $xml = $model->specific_lender_post_report_last_15days();	
	}
	/**
	 * Specific feed lender post report when they logged in. Displayed on Lender dashboard.
	 */
	public function actionFeedLenderpostreportlast15days(){
		$model = new FeedLenderVendorTransaction();
		echo $xml = $model->specific_feed_lender_post_report_last_15days();	
	}
	
}
?>
