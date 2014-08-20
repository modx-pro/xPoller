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
        $right = $this->getProperty('right');
		$this->setProperty('right', !empty($right) && $right != 'false');
		$alreadyExists = $this->modx->getObject($this->classKey, array(
            'id:!=' => $this->getProperty('id'),
			'option' => $this->getProperty('option'),
            'qid' => $this->getProperty('qid')
		));
		if ($alreadyExists) {
			$this->modx->error->addField('option', $this->modx->lexicon('xpoller_option_err_ae'));
		} elseif ($this->getProperty('right') && $this->modx->getObject($this->classKey, array(
             'id:!=' => $this->getProperty('id'),
             'right' => 1,
             'qid' => $this->getProperty('qid')))) {
            $this->modx->error->addField('right', $this->modx->lexicon('xpoller_option_err_ae_right'));
		}

        if ($this->hasErrors()) {
            return false;
        }
		return !$this->hasErrors();
	}

}

return 'xPollerOptionUpdateProcessor';
