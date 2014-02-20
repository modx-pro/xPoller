<?php
/**
 * Create an Item
 */
class xPollerItemCreateProcessor extends modObjectCreateProcessor {
	public $objectType = 'xPollerItem';
	public $classKey = 'xPollerItem';
	public $languageTopics = array('xpoller');
	public $permission = 'new_document';


	/**
	 * @return bool
	 */
	public function beforeSet() {
		$alreadyExists = $this->modx->getObject('xPollerItem', array(
			'name' => $this->getProperty('name'),
		));
		if ($alreadyExists) {
			$this->modx->error->addField('name', $this->modx->lexicon('xpoller_item_err_ae'));
		}

		return !$this->hasErrors();
	}

}

return 'xPollerItemCreateProcessor';