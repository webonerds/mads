<?php
class SiteController extends Controller
{
	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
			
			
			$postmodel = new UserPosts();
			$post_total = Yii::app()->db->createCommand("select count(*) as total_post, (select count(*) from user_posts where post_type='picture') as picture_post,(select count(*) from user_posts where post_type='story') as story_post from user_posts")->queryAll();
			$post_per_day = Yii::app()->db->createCommand("select count(*) as total_post, (select count(*) from user_posts where post_type='picture' and created_on between curdate()-1 and curdate()) as picture_post,(select count(*) from user_posts where post_type='story' and created_on between curdate()-1 and curdate()) as story_post from user_posts  where created_on between curdate()-1 and curdate()")->queryAll();
			$post_per_week = Yii::app()->db->createCommand("select count(*) as total_post, (select count(*) from user_posts where post_type='picture' and created_on between curdate()-7 and curdate()) as picture_post,(select count(*) from user_posts where post_type='story' and created_on between curdate()-7 and curdate()) as story_post from user_posts  where created_on between curdate()-7 and curdate()")->queryAll();
			$post_per_month= Yii::app()->db->createCommand("select count(*) as total_post, (select count(*) from user_posts where post_type='picture' and created_on between curdate()-30 and curdate()) as picture_post,(select count(*) from user_posts where post_type='story' and created_on between curdate()-30 and curdate()) as story_post from user_posts  where created_on between curdate()-30 and curdate()")->queryAll();
			$post_graphdata=  Reports::getGraphData('user_posts','day');
			$order_graphdata=  Reports::getGraphData('orders','day');
			
		$this->render('index',array('postmodel'=>$postmodel,'post_per_day'=>$post_per_day[0],'post_per_week'=>$post_per_week[0],'post_per_month'=>$post_per_month[0],'post_total'=>$post_total[0],'postgraphdata'=>$post_graphdata,'ordergraphdata'=>$order_graphdata));
	}
		
		
			
}
