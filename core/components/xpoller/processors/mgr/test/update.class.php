<?php
/**
 * Update an Item
 */
class xPollerTestUpdateProcessor extends modObjectUpdateProcessor {
	public $objectType = 'xpTest';
	public $classKey = 'xpTest';
	public $languageTopics = array('xpoller');
	public $permission = 'edit_document';
}

return 'xPollerTestUpdateProcessor';