<?php
/**
 * Remove an Items
 */
class xPollerItemsRemoveProcessor extends modProcessor {
    public $checkRemovePermission = true;
	public $objectType = 'xPollerItem';
	public $classKey = 'xPollerItem';
	public $languageTopics = array('xpoller');

	public function process() {

        foreach (explode(',',$this->getProperty('items')) as $id) {
            $item = $this->modx->getObject($this->classKey, $id);
            $item->remove();
        }
        
        return $this->success();

	}

}

return 'xPollerItemsRemoveProcessor';