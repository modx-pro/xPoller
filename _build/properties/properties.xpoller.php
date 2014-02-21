<?php

$properties = array();
if (empty($formOuterTpl)) {$formOuterTpl = "tpl.xPoller.form.outer";}
if (empty($resultOuterTpl)) {$resultOuterTpl = "tpl.xPoller.result.outer";}
if (empty($optionTpl)) {$optionTpl = "tpl.xPoller.option";}
if (empty($resultTpl)) {$resultTpl = "tpl.xPoller.result";}
if (empty($outputSeparator)) {$resultTpl = "\n";}
$tmp = array(
	'id' => array(
		'type' => 'textfield',
		'value' => '',
	),
	'formOuterTpl' => array(
		'type' => 'textfield',
		'value' => 'tpl.xPoller.form.outer',
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