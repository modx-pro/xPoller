<?php
/**
 * Get an Item
 */
class xPollerOptionGetProcessor extends modObjectGetProcessor {
	public $objectType = 'xpOption';
	public $classKey = 'xpOption';
	public $languageTopics = array('xpoller:default');
}

return 'xPollerOptionGetProcessor';