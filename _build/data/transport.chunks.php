<?php

$chunks = array();

$tmp = array(
	'tpl.xPoller.form.outer' => array(
		'file' => 'form.outer',
		'description' => '',
	),
	'tpl.xPoller.form.test.outer' => array(
		'file' => 'form.test.outer',
		'description' => '',
	),
	'tpl.xPoller.result.outer' => array(
		'file' => 'result.outer',
		'description' => '',
	),
	'tpl.xPoller.option' => array(
		'file' => 'option',
		'description' => '',
	),
	'tpl.xPoller.result' => array(
		'file' => 'result',
		'description' => '',
	),
);

// Save chunks for setup options
$BUILD_CHUNKS = array();

foreach ($tmp as $k => $v) {
	/* @avr modChunk $chunk */
	$chunk = $modx->newObject('modChunk');
	$chunk->fromArray(array(
		'id' => 0,
		'name' => $k,
		'description' => @$v['description'],
		'snippet' => file_get_contents($sources['source_core'].'/elements/chunks/chunk.'.$v['file'].'.tpl'),
		'static' => BUILD_CHUNK_STATIC,
		'source' => 1,
		'static_file' => 'core/components/'.PKG_NAME_LOWER.'/elements/chunks/chunk.'.$v['file'].'.tpl',
	),'',true,true);

	$chunks[] = $chunk;

	$BUILD_CHUNKS[$k] = file_get_contents($sources['source_core'].'/elements/chunks/chunk.'.$v['file'].'.tpl');
}

unset($tmp);
return $chunks;