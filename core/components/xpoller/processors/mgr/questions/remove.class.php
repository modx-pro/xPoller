<?php
/**
 * Remove an Items
 */
class xPollerQuestionRemoveProcessor extends modProcessor {
    public $checkRemovePermission = true;
	public $objectType = 'xpQuestion';
	public $classKey = 'xpQuestion';
	public $languageTopics = array('xpoller');

	public function process() {

        foreach (explode(',',$this->getProperty('items')) as $id) {
            $item = $this->modx->getObject($this->classKey, $id);
            $item->remove();
        }
        
        return $this->success();

	}

}

return 'xPollerQuestionRemoveProcessor';