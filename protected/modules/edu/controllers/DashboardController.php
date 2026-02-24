<?php
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
class DashboardController extends Controller{
	public $layout='/layouts/column1';
    /**
	 * @return array action filters
	 */
	public function filters(){
		// perform access control for CRUD operations
		return array(
			'accessControl',
		);
	}
	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules(){
		return array(
			// allow all users to perform 'index' and 'view' actions
			array('allow',
				'actions'=>array('index','view'),
				'users'=>array('@'),
			),
			// deny all users
			array('deny',
				'users'=>array('*'),
			),
		);
	}
	public function actionIndex(){
		$submission_model = new Submissions();
		$aff_trans_model = new AffiliateTransactions();
		$lender_affiliate_transaction = new LenderAffiliateTransaction();
		$affiliate_daily_counts = new AffiliateDailyCounts();
		$lender_transaction = new LenderTransactions();
		$t_affiliate_stat_logs = '';
		$lender_details = new LenderDetails();
		$Buyers = $lender_details->GetAllLenders();
		// ONLY FOR ADMIN USER
		if(Yii::app()->user->getState('roles')=='1'){
			/*$getDurationSubmissions = $submission_model->getDurationSubmissions();
			$week_submissions = $getDurationSubmissions['week_submission'];
			$week_accepted = $getDurationSubmissions['month_submission'];*/
			$graph1 = $affiliate_daily_counts->conversionsoflast15days();
			$affiliatetransaction_model = new AffiliateTransactions();
			$getDurationAff = $affiliatetransaction_model->getDurationAffiliateTransactions();
			$week_affs = $getDurationAff['week_submission'];
			$month_affs = $getDurationAff['month_submission'];
			$campain_performance_reports = $submission_model->campain_performance();
			//echo '<pre>';print_r($campain_performance_reports);exit;
			$lender_pingpost_statistics = $lender_affiliate_transaction->lender_pingpost_statistics();
			$lenders_pingpost_dates = [];
			$lenders = [];
			foreach($lender_pingpost_statistics as $row){
				$lenders_pingpost_dates[] = $row['date'];
				$lenders[] = $row['lender_id'];
				$lenders_statistics[$row['lender_id']][$row['date']]['ping_sent'] = $row['ping_sent'];
				$lenders_statistics[$row['lender_id']][$row['date']]['ping_accepted'] = $row['ping_accepted'];
				$lenders_statistics[$row['lender_id']][$row['date']]['post_sent'] = $row['post_sent'];
				$lenders_statistics[$row['lender_id']][$row['date']]['post_accepted'] = $row['post_accepted'];
			}
			$lenders_pingpost_dates = array_unique($lenders_pingpost_dates);
			$lenders_pingpost_dates = array_values($lenders_pingpost_dates);
			$lenders = array_unique($lenders);
			$lenders = array_values($lenders);
			$affiliate_pingpost_statistics = $affiliate_daily_counts->affiliate_pingpost_statistics();
			$affiliates_pingpost_dates = [];
			$affiliates =[];
			foreach($affiliate_pingpost_statistics as $row){
				$affiliates_pingpost_dates[] = $row['date'];
				$affiliates[$row['promo_code']] = $row['user_name'];
				$affiliates_statistics[$row['promo_code']][$row['date']]['ping_sent'] = $row['ping_sent'];
				$affiliates_statistics[$row['promo_code']][$row['date']]['ping_accepted'] = $row['ping_accepted'];
				$affiliates_statistics[$row['promo_code']][$row['date']]['post_sent'] = $row['post_sent'];
				$affiliates_statistics[$row['promo_code']][$row['date']]['post_accepted'] = $row['post_accepted'];
			}
			$affiliates_pingpost_dates = array_unique($affiliates_pingpost_dates);
			$affiliates_pingpost_dates = array_values($affiliates_pingpost_dates);
			$affiliates = array_unique($affiliates);
		}
		// AFFILIATE
		if(Yii::app()->user->getState('usertype')=='affiliate'){
			$affiliate_reports = $aff_trans_model->specific_affiliate_report();
			$o_affiliate_stat_logs = new AffiliateStatLogs();
			$t_affiliate_stat_logs = $o_affiliate_stat_logs->affiliate_stat_logs();
		}
		// LENDER
		if(Yii::app()->user->getState('usertype')=='lender'){
			$lender_reports = $lender_transaction->specific_lender_report();
		}
		// FEED LENDER
		if(Yii::app()->user->getState('usertype')=='edulender'){
			$feed_lender_transaction = new FeedLenderTransactions();
			$feed_lender_reports = $feed_lender_transaction->specific_feed_lender_report();
		}
		$dashboard = [
			'week_affs'=>$week_affs,
			'month_affs'=>$month_affs,
			'profit' => $campain_performance_reports['profit'],
			'revenue_buyer' => $campain_performance_reports['revenue_buyer'],
			'revenue_seller' => $campain_performance_reports['revenue_seller'],
			'leads' => $campain_performance_reports['leads'],
			'affiliates_pingpost_dates' => $affiliates_pingpost_dates,
			'affiliates' => $affiliates,
			'affiliates_statistics' => $affiliates_statistics,
			'lenders_pingpost_dates' => $lenders_pingpost_dates,
			'lenders' => $lenders,
			'lenders_statistics' => $lenders_statistics,
			'affiliate_reports' => $affiliate_reports,
			'lender_reports' => $lender_reports,
			'feed_lender_reports' => $feed_lender_reports,
			't_affiliate_stat_logs' => $t_affiliate_stat_logs,
			'graph1'=>$graph1,
			'Buyers'=>$Buyers
		];
		//echo '<pre>';print_r($dashboard);exit;
		$this->render('index',$dashboard);
	}
}
?>
