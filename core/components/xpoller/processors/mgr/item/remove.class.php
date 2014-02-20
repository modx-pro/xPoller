<?php
/**
 * Remove an Item
 */
class xPollerItemRemoveProcessor extends modObjectRemoveProcessor {
	public $checkRemovePermission = true;
	public $objectType = 'xPollerItem';
	public $classKey = 'xPollerItem';
	public $languageTopics = array('xpoller');

}

return 'xPollerItemRemoveProcessor';