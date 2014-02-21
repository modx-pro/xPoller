<?php
/**
 * Remove an Item
 */
class xPollerTestRemoveProcessor extends modObjectRemoveProcessor {
	public $checkRemovePermission = true;
	public $objectType = 'xpTest';
	public $classKey = 'xpTest';
	public $languageTopics = array('xpoller');

}

return 'xPollerTestRemoveProcessor';