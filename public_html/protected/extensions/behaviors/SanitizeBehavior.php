<?php
/**
 * @file       SanitizeBehavior.php$
 * @created    14/11/2013 12:57:34 PM
 * @package    Thankful
 * @copyright  Copyright (C) 2014
 * @license    Proprietary
 * @author     Gagandeep Gambhir
 */

/**
 * SanitizeBehavior
 *
 * @uses      CActiveRecordBehavior
 */
class SanitizeBehavior extends CActiveRecordBehavior
{
    /** 
     * @var array purifyFields to do the purify
     */
    private $purifyFields = array();

    /**
     * @param array $columns
     */
    public function setPurifyFields(array $fields)
    {
        $this->purifyFields = $fields;
    }

    /**
     * @return array
     */
    public function getPurifyFields()
    {
        return $this->purifyFields;
    }
	/** 
     * @var array purifyFields to do the purify
     */
    private $stripcleanFields = array();

    /**
     * @param array $columns
     */
    public function setStripcleanFields(array $fields)
    {
        $this->stripcleanFields = $fields;
    }

    /**
     * @return array
     */
    public function getStripcleanFields()
    {
        return $this->stripcleanFields;
    }
	
	/** 
     * @var array purifyFields to do the purify
     */
    private $exceptFields = array('created_on', 'modified_on');

    /**
     * @param array $columns
     */
    public function setExceptFields(array $fields)
    {
        $this->exceptFields = array_merge($this->exceptFields, $fields);
    }

    /**
     * @return array
     */
    public function getExceptFields()
    {
        return $this->exceptFields;
    }

    /**
     * beforeSave
     *
     * @param CModelEvent $event
     * @access public
     */
    public function beforeSave($event)
    {
		//GeneralUtilities::debug($this->owner->tableSchema->columnNames);exit;
		//Applies purify
		foreach ($this->purifyFields as $purifyField)
		{
			$this->owner->{$purifyField} = Yii::app()->input->purify($this->owner->{$purifyField});
		}
		
		//Applies stripclean
		//Checks if it would be applied on all fields
		if ($this->stripcleanFields[0] == '*')
		{
			foreach ($this->owner->tableSchema->columnNames as $stripcleanField)
			{
				//Checks to exclude the except fields
				if (!in_array($stripcleanField, $this->exceptFields) 
							&& !in_array($stripcleanField, $this->purifyFields))
				{
					$this->owner->{$stripcleanField} = Yii::app()->input->stripClean($this->owner->{$stripcleanField});
				}
			}
		}
		else // Otherwise on specific fields
		{
			foreach ($this->stripcleanFields as $stripcleanField)
			{
				//Checks to exclude the except fields
				if (!in_array($stripcleanField, $this->exceptFields) 
							&& !in_array($stripcleanField, $this->purifyFields))
				{
					$this->owner->{$stripcleanField} = Yii::app()->input->stripClean($this->owner->{$stripcleanField});
				}
			}
		}
		
		return parent::beforeSave($event);
    }
}

