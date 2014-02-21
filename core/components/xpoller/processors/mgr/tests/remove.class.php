<?php
/**
 * Remove an Items
 */
class xPollerTestRemoveProcessor extends modProcessor {
    public $checkRemovePermission = true;
	public $objectType = 'xpTest';
	public $classKey = 'xpTest';
	public $languageTopics = array('xpoller');

	public function process() {

        foreach (explode(',',$this->getProperty('items')) as $id) {
            $item = $this->modx->getObject($this->classKey, $id);
            $item->remove();
        }
        
        return $this->success();

	}

}

return 'xPollerTestRemoveProcessor';