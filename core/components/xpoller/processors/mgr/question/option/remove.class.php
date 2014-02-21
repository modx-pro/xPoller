<?php
/**
 * Remove an Item
 */
class xPollerOptionRemoveProcessor extends modObjectRemoveProcessor {
	public $checkRemovePermission = true;
	public $objectType = 'xpOption';
	public $classKey = 'xpOption';
	public $languageTopics = array('xpoller');

}

return 'xPollerOptionRemoveProcessor';