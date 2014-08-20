<?php
$properties = array();

$tmp = array(
    'id' => array(
		'type' => 'textfield',
		'value' => '',
	),
	'formOuterTpl' => array(
		'type' => 'textfield',
		'value' => 'tpl.xPoller.form.test.outer',
	),
	'resultOuterTpl' => array(
		'type' => 'textfield',
		'value' => 'tpl.xPoller.result.outer',
	),
	'optionTpl' => array(
    	'type' => 'textfield',
		'value' => 'tpl.xPoller.option',
	),
	'resultTpl' => array(
    	'type' => 'textfield',
		'value' => 'tpl.xPoller.result',
	),
	'outputSeparator' => array(
		'type' => 'textfield',
		'value' => "\n",
	),
	'toPlaceholder' => array(
		'type' => 'combo-boolean',
		'value' => false,
	),
);

foreach ($tmp as $k => $v) {
	$properties[] = array_merge(
		array(
			'name' => $k,
			'desc' => PKG_NAME_LOWER . '_prop_' . $k,
			'lexicon' => PKG_NAME_LOWER . ':properties',
		), $v
	);
}

return $properties;