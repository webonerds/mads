<?php

class m140219_093233_change_active_to_status extends CDbMigration
{
	public function safeUp()
	{
			$this->getDbConnection()->createCommand("ALTER TABLE `categories` CHANGE `active` `status` TINYINT(1) DEFAULT 1 NOT NULL;")->execute();
		
	}

	public function safeDown()
	{
		echo "m140219_093233_change_active_to_status does not support migration down.\n";
		return false;
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}