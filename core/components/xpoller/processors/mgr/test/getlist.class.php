<?php
/**
 * Get a list of Items
 */
class xPollerTestGetListProcessor extends modObjectGetListProcessor {
	public $objectType = 'xpTest';
	public $classKey = 'xpTest';
	public $defaultSortField = 'id';
	public $defaultSortDirection = 'DESC';
	public $renderers = '';


	/**
	 * @param xPDOQuery $c
	 *
	 * @return xPDOQuery
	 */
	public function prepareQueryBeforeCount(xPDOQuery $c) {
        return $c;
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

return 'xPollerTestGetListProcessor';