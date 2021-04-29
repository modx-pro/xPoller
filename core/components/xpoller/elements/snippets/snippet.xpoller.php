<?php
$xPoller = $modx->getService('xpoller','xPoller',$modx->getOption('xpoller_core_path',null,$modx->getOption('core_path').'components/xpoller/').'model/xpoller/',$scriptProperties);
if (!($xPoller instanceof xPoller)) return '';
$modx->regClientScript($modx->getOption('assets_url').'components/xpoller/js/web/default.js');

if (empty($formOuterTpl)) {$formOuterTpl = "tpl.xPoller.form.outer";}
if (empty($resultOuterTpl)) {$resultOuterTpl = "tpl.xPoller.result.outer";}
if (empty($optionTpl)) {$optionTpl = "tpl.xPoller.option";}
if (empty($resultTpl)) {$resultTpl = "tpl.xPoller.result";}
if (empty($outputSeparator)) {$resultTpl = "\n";}
if (empty($id)) {return $modx->lexicon("xpoller_question_err_ns");}
if ($_REQUEST['qid'] && $_REQUEST['qid'] != $id) return '';

$params = $_GET;
unset($params[$modx->getOption('request_param_alias')]);
unset($params[$modx->getOption('request_param_id')]);

if (!empty($_REQUEST['xp_action']) && $_REQUEST['qid'] && $modx->user->isAuthenticated($modx->context->key)) {
    $isAjax = isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest';

	if ($_REQUEST['xp_action'] == 'abstain') {
        $_REQUEST['oid'] = 0;
    } else {
        if ($_REQUEST['oid']) {
            $tmp = array('uid' => $modx->user->id, 'qid' => $id);
            if (!$modx->getObject('xpAnswer', $tmp)) {
                $tmp['oid'] = $_REQUEST['oid'];
                $answer = $modx->newObject('xpAnswer', $tmp);
                $answer->save();
                unset($tmp);
            }
        }
    }
    unset($params['qid']);
    unset($params['oid']);
    unset($params['uid']);
    unset($params['xp_action']);
	if (!$isAjax && empty($placeholders['message'])) {
		$modx->sendRedirect($modx->makeUrl($modx->resource->id, $modx->context->key, $params, 'full'));
	}
}

if (!$modx->user->isAuthenticated($modx->context->key)
  || $modx->getObject('xpAnswer', array('uid' => $modx->user->id, 'qid' => $id))) {
    $tpl = $resultTpl;
    $outerTpl = $resultOuterTpl;
} else {
    $tpl = $optionTpl;
    $outerTpl = $formOuterTpl;
}
$q = $modx->newQuery('xpOption');
$q->where(array('qid' => $id));
$q->select('`xpOption`.`id`, `xpOption`.`qid`, `xpOption`.`option`, `xpOption`.`rank`,
            `xpOption`.`right`, `xpQuestion`.`text`, COUNT(DISTINCT `xpAnswer`.`uid`) as `votes`,
            COUNT(DISTINCT `xpAllAnswers`.`id`) as `total`');
$q->leftJoin('xpQuestion', 'xpQuestion', array('`xpOption`.`qid` = `xpQuestion`.`id`'));
$q->leftJoin('xpAnswer',   'xpAnswer',   array('`xpAnswer`.`oid` = `xpOption`.`id`'));
$q->leftJoin('xpAnswer',   'xpAllAnswers', array('`xpAllAnswers`.`qid` = `xpQuestion`.`id`'));
$q->groupby('`xpOption`.`id`');
$q->sortby('`xpOption`.`id`', 'ASC');
$q->prepare();
/*
print "<pre>";
print $q->toSQL();
print "</pre>";*/
$q->stmt->execute();
$options = $q->stmt->fetchAll(PDO::FETCH_ASSOC);
if ($options) {
    $output = array();
    foreach ($options as $option) {
        if (empty($output['maxVotes'])) $output['maxVotes'] = $option['votes'];
        if ($output['maxVotes'] < $option['votes']) $output['maxVotes'] = $option['votes'];
    }
    if (empty($output['text'])) $output['text'] = $options[0]['text'];
    if (empty($output['id'])) $output['id'] = $options[0]['qid'];
    foreach ($options as $option) {
        $option['percentVotes'] = number_format(round(($option['votes'] / $output['maxVotes']) * 100, 2), 2, '.', '');
        $option['percent'] = number_format(round(($option['votes'] / $option['total']) * 100, 2), 2, ',', ' ');
        $output['options'][] = $xPoller->getChunk($tpl,$option);
    }
    $output['options'] = implode($outputSeparator, $output['options']);
    $output = $xPoller->getChunk($outerTpl, $output);
} else {
    $output = $modx->lexicon("xpoller_question_err_ns");
}

if (!empty($toPlaceholder)) {
    $modx->setPlaceholder($toPlaceholder,$output);
	return '';
}

if (!empty($isAjax)) {
    header('Content-type: text/html; charset=utf-8');
    @session_write_close();
	exit($output);
}
else {
	return $output;
}