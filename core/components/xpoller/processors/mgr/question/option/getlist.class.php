<?php
/**
 * Get a list of Items
 */
class xPollerOptionGetListProcessor extends modObjectGetListProcessor {
	public $objectType = 'xpOption';
	public $classKey = 'xpOption';
	public $defaultSortField = 'rank';
	public $defaultSortDirection = 'DESC';
	public $renderers = '';


	/**
	 * @param xPDOQuery $c
	 *
	 * @return xPDOQuery
	 */
	public function prepareQueryBeforeCount(xPDOQuery $c) {
        if ($qid = $this->getProperty('qid')) {
            $c->where(array(
                'qid' => $qid
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

return 'xPollerOptionGetListProcessor';