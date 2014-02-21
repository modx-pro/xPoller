<?php
/**
 * Update an Item
 */
class xPollerQuestionUpdateProcessor extends modObjectUpdateProcessor {
	public $objectType = 'xpQuestion';
	public $classKey = 'xpQuestion';
	public $languageTopics = array('xpoller');
	public $permission = 'edit_document';
}

return 'xPollerQuestionUpdateProcessor';
