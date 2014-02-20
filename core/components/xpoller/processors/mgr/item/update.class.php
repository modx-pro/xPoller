<?php
/**
 * Update an Item
 */
class xPollerItemUpdateProcessor extends modObjectUpdateProcessor {
	public $objectType = 'xPollerItem';
	public $classKey = 'xPollerItem';
	public $languageTopics = array('xpoller');
	public $permission = 'edit_document';
}

return 'xPollerItemUpdateProcessor';
