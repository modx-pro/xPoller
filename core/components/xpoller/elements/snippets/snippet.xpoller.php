<?php

$xPoller = $modx->getService('xpoller','xPoller',$modx->getOption('xpoller_core_path',null,$modx->getOption('core_path').'components/xpoller/').'model/xpoller/',$scriptProperties);
if (!($xPoller instanceof xPoller)) return '';

if (empty($formOuterTpl)) {$formOuterTpl = "tpl.xPoller.form.outer";}
if (empty($resultOuterTpl)) {$resultOuterTpl = "tpl.xPoller.result.outer";}
if (empty($optionTpl)) {$optionTpl = "tpl.xPoller.option";}
if (empty($resultTpl)) {$resultTpl = "tpl.xPoller.result";}
if (empty($outputSeparator)) {$resultTpl = "\n";}

if (empty($id) || !$question = $modx->getObject('xpQuestion', $id)) {return $modx->lexicon("xpoller_question_err_ns");}

if (!$modx->user->isAuthenticated($modx->context->key)
  || $modx->getObject('xpAnswer', array('uid' => $modx->user->id, 'qid' => $id))) {
    $tpl = $resultTpl;
    $outTpl = $resultOuterTpl;
} else {
    $tpl = $optionTpl;
    $outTpl = $formOuterTpl;
}
if (!empty($_REQUEST['xp_action']) && $_REQUEST['qid'] == $id && $modx->user->isAuthenticated($modx->context->key)) {
    $isAjax = isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest';

	$params = $_GET;
	unset($params[$modx->getOption('request_param_alias')]);
	unset($params[$modx->getOption('request_param_id')]);

	switch ($_REQUEST['xp_action']) {
        case 'abstain':
            $_REQUEST['oid'] = 0;
        case 'answer':
            $_REQUEST['uid'] = $modx->user->id;
            if (!$modx->getObject('xpAnswer', array('uid' => $_REQUEST['uid'], 'qid' => $_REQUEST['qid']))) {
                $answer = $modx->newObject('xpAnswer', $_REQUEST);
                $answer->save();
        	}
            unset($params['qid']);
            unset($params['oid']);
            unset($params['uid']);
            break;
	}
    
    unset($params['xp_action']);
	if (!$isAjax && empty($placeholders['message'])) {
		$modx->sendRedirect($modx->makeUrl($modx->resource->id, $modx->context->key, $params, 'full'));
	}
}

$options = $question->getMany('Options');
foreach ($options as $option) {
    $optionVotes = $modx->getCount('xpAnswer', array(
            'oid' => $option->id,
			'qid' => $id
        ));
    if ($optionVotes > $maxVotes) {
        $maxVotes = $optionVotes;
    }
    $optionsOut[] = array_merge($option->toArray(),array('votes' => $optionVotes));
}
foreach ($optionsOut as $k => $opt) {
    $opt['percentVotes'] = round($opt['votes'] / $maxVotes * 100, 2);
    $optionsOut[$k] = $xPoller->getChunk($tpl,$opt);
}
$questionArray = $question->toArray();
$questionArray['options'] = implode($outputSeparator, $optionsOut);
$output = $xPoller->getChunk($outTpl,$questionArray);

if (!empty($toPlaceholder)) {
    $modx->setPlaceholder($toPlaceholder,$output);
	return '';
}

if (!empty($isAjax)) {
    @session_write_close();
	exit($output);
}
else {
	return $output;
}