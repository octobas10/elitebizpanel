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
		// ONLY FOR ADMIN USER
		$campain_performance_reports=[];$lenders_pingpost_dates=[];$lenders_statistics=[];$affiliates_pingpost_dates=[];
		$affiliates_statistics = [];$affiliate_reports=[];$lender_reports=[];
		$lender_details = new LenderDetails();
		$Buyers = $lender_details->GetAllLenders();
		if(Yii::app()->user->getState('roles')=='1'){
			$submission_model = new Submissions();
			$campain_performance_reports = $submission_model->campain_performance();
			//echo '<pre>';print_r($campain_performance_reports);
			$lender_revenue_statistics = $submission_model->lender_revenue_statistics();
			$affiliate_revenue_statistics = $submission_model->affiliate_revenue_statistics();
			$lender_affiliate_transaction = new LenderAffiliateTransaction();
			$lender_pingpost_statistics = $lender_affiliate_transaction->lender_pingpost_statistics();
			$lenders = [];
			foreach($lender_pingpost_statistics as $row){
				$lenders_pingpost_dates[] = $row['date'];
				$lenders[] = $row['lender_id'];
				$lenders_statistics[$row['lender_id']][$row['date']]['ping_sent'] = $row['ping_sent'];
				$lenders_statistics[$row['lender_id']][$row['date']]['ping_accepted'] = $row['ping_accepted'];
				$lenders_statistics[$row['lender_id']][$row['date']]['post_sent'] = $row['post_sent'];
				$lenders_statistics[$row['lender_id']][$row['date']]['post_accepted'] = $row['post_accepted'];
			}
			foreach($lender_revenue_statistics as $row){
				$lenders_statistics[$row['lender_id']][$row['date']]['returned'] = $row['returned'];
				$lenders_statistics[$row['lender_id']][$row['date']]['buyer_price'] = $row['total_buyer_price']?$row['total_buyer_price']:0;
			}
			$lenders_pingpost_dates = array_unique($lenders_pingpost_dates);
			$lenders_pingpost_dates = array_values($lenders_pingpost_dates);
			$lenders = array_unique($lenders);
			$lenders = array_values($lenders);
			$affiliate_daily_counts = new AffiliateDailyCounts();
			// AFFILIATE PING POST STATISTICS
			$affiliate_pingpost_statistics = $affiliate_daily_counts->affiliate_pingpost_statistics();
			$affiliates = [];
			foreach($affiliate_pingpost_statistics as $row){
				$affiliates_pingpost_dates[] = $row['date'];
				$affiliates[$row['promo_code']] = $row['user_name'];
				$affiliates_statistics[$row['promo_code']][$row['date']]['ping_sent'] = $row['ping_sent'];
				$affiliates_statistics[$row['promo_code']][$row['date']]['ping_accepted'] = $row['ping_accepted'];
				$affiliates_statistics[$row['promo_code']][$row['date']]['post_sent'] = $row['post_sent'];
				$affiliates_statistics[$row['promo_code']][$row['date']]['post_accepted'] = $row['post_accepted'];
			}
			foreach($affiliate_revenue_statistics as $row){
				$affiliates_statistics[$row['promo_code']][$row['date']]['returned'] = $row['returned'];
				$affiliates_statistics[$row['promo_code']][$row['date']]['vendor_price'] = $row['total_vendor_price']?$row['total_vendor_price']:0;
			}
			$affiliates_pingpost_dates = array_unique($affiliates_pingpost_dates);
			$affiliates_pingpost_dates = array_values($affiliates_pingpost_dates);
			$affiliates = array_unique($affiliates); 
		}
		/*==================================================================================*/
		// FOR AFFILIATE LOGIN
		$affiliate_reports = [];
		if(Yii::app()->user->getState('usertype')=='affiliate'){
			$aff_trans_model = new AffiliateTransactions();
			$affiliate_reports = $aff_trans_model->specific_affiliate_report();
		}
		// FOR LENDER LOGIN
		$lender_reports = [];
		if(Yii::app()->user->getState('usertype')=='lender'){
			$lender_transaction = new LenderTransactions();
			$lender_reports = $lender_transaction->specific_lender_report();
		}
		/*==================================================================================*/
		
		$dashboard = [
			//'week_submissions'=>$week_submissions,
			//'week_accepted'=>$week_accepted,
			'profit' => $campain_performance_reports['profit'],
			'revenue_buyer' => $campain_performance_reports['revenue_buyer'],
			'revenue_seller' => $campain_performance_reports['revenue_seller'],
			'leads' => $campain_performance_reports['leads'],
			// LENDER STATS
			'lenders_pingpost_dates' => $lenders_pingpost_dates,
			'lenders' => $lenders,
			'lenders_statistics' => $lenders_statistics,
			// AFFILIATE STATS
			'affiliates_pingpost_dates' => $affiliates_pingpost_dates,
			'affiliates' => $affiliates,
			'affiliates_statistics' => $affiliates_statistics,
			'affiliate_reports' => $affiliate_reports,
			'lender_reports' => $lender_reports,
			'Buyers'=>$Buyers
		];
		//echo '<pre>';print_r($dashboard);exit;
		$this->render('index',$dashboard);
	}
}