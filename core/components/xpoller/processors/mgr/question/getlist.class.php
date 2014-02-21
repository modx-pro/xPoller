<?php
/**
 * Get a list of Items
 */
class xPollerQuestionGetListProcessor extends modObjectGetListProcessor {
	public $objectType = 'xpQuestion';
	public $classKey = 'xpQuestion';
	public $defaultSortField = 'rank';
	public $defaultSortDirection = 'ASC';
	public $renderers = '';


	/**
	 * @param xPDOQuery $c
	 *
	 * @return xPDOQuery
	 */
	public function prepareQueryBeforeCount(xPDOQuery $c) {
        if ($tid = $this->getProperty('tid')) {
            $c->where(array(
                'tid' => $tid
            ));
        }
        return parent::prepareQueryBeforeCount($c);
	}


	/**
	 * @param xPDOObject $object
	 *
	 * @return array
	 */
	public function prepareRow(xPDOObject $object) {
		$array = $object->toArray();

		return $array;
	}

}

return 'xPollerQuestionGetListProcessor';