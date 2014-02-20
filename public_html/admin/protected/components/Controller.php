<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/main',
	 */
	public $layout='//layouts/main';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();
	
	/**
	 * Function to apply filters (ACL's)
	 * 
	 * @return array
	 */
	public function filters()
    {
        return array(
            'accessControl',
        );
    }
	
	/**
	 * We are by default forcing all the controllers & action to be validated
	 * for Admin users unless overridden
	 * 
	 * @return array
	 */
	public function accessRules()
    {
		return array(
            array('allow',
                'users' => array('@'),
				'expression' => 'Yii::app()->user->checkControllerAccess()',
            ),
            array('deny',
                'users' => array('*'),
            ),
        );
    }
	
	public function init()
	{
		//Gets current template_name value as per the current URL.
		$url = Yii::app()->getBaseUrl(true);
		
		$hostName = str_replace((Yii::app()->request->isSecureConnection ? 'https' : 'http') . '://', '', $url);
		
		parent::init();
	}
	
	/**
	 * Gets the states as per given country_id in POST request.
	 */
	public function actionGetStatesByCountry()
	{
		if (isset($_POST['country_id']) && !empty($_POST['country_id']))
		{
			ControllerHelper::OutputJSON(States::model()->getStatesByCountry($_POST['country_id']));
		}
	}
}