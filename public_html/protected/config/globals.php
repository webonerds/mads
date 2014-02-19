<?php
/**
 * @file       globals.php$
 * @created    11/10/2013 1:52:50 PM
 * @package    Thankful
 * @copyright  Copyright (C) 2014
 * @license    Proprietary
 * @author     Rohit Gupta
 */

/**
 * Description of globals
 *
 * @author Rohit Gupta
 */
class AppConstants
{
	//Post Entity Specifics	
	public static $USERPOST_STORY_BACKGROUND_COLOUR = array('red' => 'red', 'yellow' => 'Yellow', 'green' => 'Green');
	public static $USERPOST_STORY_FONT_STYLE = array('arial' => 'arial','arial rounded mt'=>'Arial Rounded MT', 'haettenschweiler' => 'Haettenschweiler', 'harrington' => 'Harrington');
	public static $USERPOST_MEDIA_CONFIGURATION = array('XS' => array('prefix' => 'img_132_72_', 'width' => 132, 'height' => 72));

	//Product Entity Specifics
	public static $PRODUCTS_MEDIA_CONFIGURATION = array('XS' => array('prefix' => 'img_132_72_', 'width' => 132, 'height' => 72));

	
	//News Entity Specifics
	public static $NEWS_MEDIA_CONFIGURATION = array('XS' => array('prefix' => 'img_132_72_', 'width' => 132, 'height' => 72));

	
	//Email Messages Entity Specifics
	const MARK_AS_READ = 1;
	
	//CACHING
	const ONE_YEAR_CACHE_TIME = 31536000; // 60*60*24*365
	const ONE_MONTH_CACHE_TIME = 2592000; // 60*60*24*30
	
	//Reports Constants
	const REPORT_MONTH_LIMIT = 5;
	
	//Uploads Dir Paths
	const UPLOADS_USERPOST_PATH_ALIAS = 'appwebroot.uploads.userpost';
	const UPLOADS_NEWS_PATH_ALIAS = 'appwebroot.uploads.news';
	const UPLOADS_USERS_PATH_ALIAS = 'appwebroot.uploads.users';
	const UPLOADS_PRODUCTS_PATH_ALIAS = 'appwebroot.uploads.products';

	public static $USER_MEDIA_CONFIGURATION = array(
	'L' =>array('prefix' => 'img_640_640_', 'width' => 640, 'height' => 640),
	'M' =>array('prefix' => 'img_400_350_', 'width' => 400, 'height' => 350),
	's' =>array('prefix' => 'img_150_120_', 'width' => 150, 'height' => 120),

		);
		
		
//User Entity Specific
/*	const USERS_SECURITY_SALT = 'g7h4hf%^fjdkdsdfds' ; //time in hours
	const USERS_ADMIN_USER_ID = 1;	
	const USERS_ADMIN_ROLE_ID = 1;
	const USERS_EDITOR_ROLE_ID = 2;
	const USERS_CONTRIBUTOR_ROLE_ID = 3;
	const USERS_MODERATOR_ROLE_ID = 4;
	const USERS_USER_ROLE_ID = 5;
	const USERS_MEDIA_CONTRIBUTOR_ROLE_ID = 6;
	const USERS_RESET_PASSWORD_KEY_EXPIRE_HOURS = 24 ; //time in hours
	const USERS_REGISTER_SOURCE_WEB = 'web';
	const USERS_REGISTER_SOURCE_FACEBOOK = 'facebook';
	
	
	
	//Template Entity Specifics
	const DEFAULT_TEMPLATE_NAME = "default";
	const TEMPLATES_LAYOUT_RELATIVE_BASE_PATH = "//layouts/templates";
	const TEMPLATE_ASSETS_RELATIVE_BASE_PATH = "/static/templates";
	
	//Email Messages Entity Specifics
	const MARK_AS_READ = 1;
	
	//Email Subjects
	const EMAIL_SUBJECT_POST_FEEDBACK_ADDED = 'Post Feedback Message Added';
	const EMAIL_SUBJECT_POST_ADMIN_APPROVAL = 'Post Approval';
	const EMAIL_SUBJECT_POST_ADMIN_APPROVED = 'Post Approved';
	const EMAIL_SUBJECT_TASK_ASSIGNED = 'New Task Assigned';
	const EMAIL_SUBJECT_TASK_COMMENT_ADDED = 'Task Comment Added';
	const EMAIL_SUBJECT_ASSET_ADMIN_APPROVAL = 'Asset Approval Needed';
	const EMAIL_SUBJECT_ASSET_ADMIN_APPROVED = 'Asset Approved';
	const EMAIL_SUBJECT_CRON_FEED_FETCHER_RESULT = 'Feed Fetcher Execution Result';
	const EMAIL_SUBJECT_CRON_WEATHER_FETCHER_RESULT = 'Weather Fetcher Execution Result';
	const EMAIL_SUBJECT_RACKSPACE_CDN = 'Rackspace CDN Execution Result';
	const EMAIL_SUBJECT_FORGOT_PASSWORD = 'Forgot Password';
	const GAME_TASK_DESCRIPTION = 'Please add some posts for the game.';
	const EMAIL_SUBJECT_USER_ACTIVATION = 'Account Activation';
	const EMAIL_SUBJECT_USER_FORGOT_PASSWORD = 'Reset your password';
	const EMAIL_SUBJECT_USER_CHANGE_PASSWORD = 'Password changed';
	const EMAIL_SUBJECT_USER_SEND_MESSAGE_TO_USER = 'Private Message received from member';
	
	//General Constants
	const TWITTER_URL = 'https://twitter.com/@';
	const NO_IMAGE_SELECTED = '/admin/template/css/fansunite/images/no_asset_image.jpg';
	const AUSTRAILIA_COUNTRY_ID = 12;
	
	//Reports Constants
	const REPORT_MONTH_LIMIT = 5;
	
	//Dashboard Constants
	const DASHBOARD_RECENT_COMMENTS_LIMIT = 5;
	const DASHBOARD_RECENT_FEEDS_LIMIT = 5;
	const DASHBOARD_UPCOMING_POSTS_LIMIT = 5;
	const DASHBOARD_UPCOMING_GAMES_LIMIT = 5;
	
	//Inbox Constants
	const INBOX_MESSSAGES_LIMIT = 10;
	
	//Frontend Post Listing - User, Topic & Game wise
	const POST_PAGE_POST_LISTING_COUNT = 8;*/
}

?>
