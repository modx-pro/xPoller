<?php
/**
 * Update an Item
 */
class xPollerOptionUpdateProcessor extends modObjectUpdateProcessor {
	public $objectType = 'xpOption';
	public $classKey = 'xpOption';
	public $languageTopics = array('xpoller');
	public $permission = 'edit_document';
    
    public function beforeSet() {
		$alreadyExists = $this->modx->getObject($this->classKey, array(
			'option' => $this->getProperty('option'),
            'qid' => $this->getProperty('qid')
		));
		if ($alreadyExists) {
			$this->modx->error->addField('option', $this->modx->lexicon('xpoller_option_err_ae'));
		}
        $right = $this->getProperty('right');
    	$this->setProperty('right', !empty($right) && $right != 'false');
		return !$this->hasErrors();
	}

}

return 'xPollerOptionUpdateProcessor';
