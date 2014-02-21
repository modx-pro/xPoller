<?php
/**
 * Create an Answer
 */
class xPollerAnswerCreateProcessor extends modObjectCreateProcessor {
	public $objectType = 'xpAnswer';
	public $classKey = 'xpAnswer';
	public $languageTopics = array('xpoller');


	/**
	 * @return bool
	 */
	public function beforeSet() {
        if (!$uid = $this->modx->user->id) {
                $this->modx->error->addField('uid', $this->modx->lexicon('xpoller_answer_err_auth'));
        }
        if ($this->getProperty('abstain')) {
            $this->setOption('oid', 0);
        }
		$alreadyExists = $this->modx->getObject($this->classKey, array(
			'uid' => $uid,
			'qid' => $this->getOption('qid'),
			'oid' => $this->getOption('oid')
		));
		if ($alreadyExists) {
			$this->modx->error->addField('uid', $this->modx->lexicon('xpoller_answer_err_ae'));
		}
		return !$this->hasErrors();
	}

}

return 'xPollerAnswerCreateProcessor';