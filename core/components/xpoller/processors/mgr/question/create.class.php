<?php
/**
 * Create an Item
 */
class xPollerQuestionCreateProcessor extends modObjectCreateProcessor {
	public $objectType = 'xpQuestion';
	public $classKey = 'xpQuestion';
	public $languageTopics = array('xpoller');
	public $permission = 'new_document';


	/**
	 * @return bool
	 */
	public function beforeSet() {
        $tid = $this->getProperty('tid') ? $this->getProperty('tid') : 0;
		$alreadyExists = $this->modx->getObject($this->classKey, array(
			'text' => $this->getProperty('text'),
            'tid' => $tid
		));
		if ($alreadyExists) {
			$this->modx->error->addField('text', $this->modx->lexicon('xpoller_question_err_ae'));
		}
        $c = $this->modx->newQuery($this->classKey, array('tid' => $tid));
        $c->sortby('rank','DESC');
        $c->limit(1);
        $c->prepare();
        $c->stmt->execute();
        $lastQuests = $c->stmt->fetchAll(PDO::FETCH_ASSOC);
        $lastQuest = array_shift($lastQuests);
        $rank = $lastQuest[$this->classKey.'_rank'] + 1;
        $this->setProperty('rank', $rank);
		return !$this->hasErrors();
	}

}

return 'xPollerQuestionCreateProcessor';