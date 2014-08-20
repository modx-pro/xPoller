<?php
/**
 * Create an Item
 */
class xPollerOptionCreateProcessor extends modObjectCreateProcessor {
	public $objectType = 'xpOption';
	public $classKey = 'xpOption';
	public $languageTopics = array('xpoller');
	public $permission = 'new_document';


	/**
	 * @return bool
	 */
	public function beforeSet() {
        $right = $this->getProperty('right');
		$this->setProperty('right', !empty($right) && $right != 'false');
		$alreadyExists = $this->modx->getObject($this->classKey, array(
			'option' => $this->getProperty('option'),
            'qid' => $this->getProperty('qid')
		));
		if ($alreadyExists) {
			$this->modx->error->addField('option', $this->modx->lexicon('xpoller_option_err_ae'));
		} elseif ($this->getProperty('right') && $this->modx->getObject($this->classKey, array('right' => $this->getProperty('right'), 'qid' => $this->getProperty('qid')))) {
            $this->modx->error->addField('right', $this->modx->lexicon('xpoller_option_err_ae_right'));
		}

    	$this->setProperty('right', !empty($right) && $right != 'false');
		return !$this->hasErrors();
	}

}

return 'xPollerOptionCreateProcessor';