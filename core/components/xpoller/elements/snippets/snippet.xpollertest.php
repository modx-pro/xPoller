<?php
$xPoller = $modx->getService('xpoller','xPoller',$modx->getOption('xpoller_core_path',null,$modx->getOption('core_path').'components/xpoller/').'model/xpoller/',$scriptProperties);
if (!($xPoller instanceof xPoller)) return '';
$modx->regClientScript($modx->getOption('assets_url').'components/xpoller/js/web/default.js');

if (empty($formOuterTpl)) {$formOuterTpl = "tpl.xPoller.form.test.outer";}
if (empty($resultOuterTpl)) {$resultOuterTpl = "tpl.xPoller.result.outer";}
if (empty($optionTpl)) {$optionTpl = "tpl.xPoller.option";}
if (empty($resultTpl)) {$resultTpl = "tpl.xPoller.result";}
if (empty($outputSeparator)) {$resultTpl = "\n";}
if (empty($id)) {return $modx->lexicon("xpoller_question_err_ns");}
if (!$modx->user->isAuthenticated($modx->context->key)) {return $modx->lexicon("xpoller_need_auth");}

$params = $_GET;
unset($params[$modx->getOption('request_param_alias')]);
unset($params[$modx->getOption('request_param_id')]);

if (!empty($_REQUEST['xp_action']) && $_REQUEST['qid'] && $modx->user->isAuthenticated($modx->context->key)) {
    $isAjax = isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest';

    if ($_REQUEST['oid']) {
        $tmp = array('uid' => $modx->user->id, 'qid' => $id);
        if (!$modx->getObject('xpAnswer', $tmp)) {
            $tmp['oid'] = $_REQUEST['oid'];
            $answer = $modx->newObject('xpAnswer', $tmp);
            $answer->save();
            unset($tmp);
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

$tpl = $optionTpl;
$outerTpl = $formOuterTpl;
/*
$c = $modx->newQuery('xpQuestion');
$c->where(array('`xpQuestion`.`tid`' => $id));
//$c->where(array('`xpAnswer`.`uid`' => $modx->user->id));
$c->select('`xpQuestion`.`id`,`xpAnswer`.`id`,`xpAnswer`.`uid`');
$c->leftJoin('xpAnswer', 'xpAnswer', array('`xpQuestion`.`id` = `xpAnswer`.`qid`'));
$c->groupby('`xpQuestion`.`id` HAVING `xpAnswer`.`uid`='.$modx->user->id);
$c->prepare();
print $c->toSQL();
*/
$c = $modx->newQuery('xpAnswer');
$c->where(array('`xpQuestion`.`tid`' => $id));
$c->where(array('`xpAnswer`.`uid`' => $modx->user->id));
$c->select('`xpAnswer`.`qid`');
$c->leftJoin('xpQuestion', 'xpQuestion', array('`xpAnswer`.`qid` = `xpQuestion`.`id`'));
$c->groupby('`xpQuestion`.`id`');
$c->prepare();

$c->stmt->execute();
$answered = $c->stmt->fetchAll(PDO::FETCH_ASSOC);
foreach ($answered as $tmp) {
    $awd[] = $tmp['qid'];
}
unset($tmp);


$q = $modx->newQuery('xpOption');
$q->where(array('`xpQuestion`.`tid`' => $id));
$q->where(array('`xpQuestion`.`id`:NOT IN' => $awd));
$q->select('`xpOption`.`id`, `xpOption`.`qid`, `xpOption`.`option`, `xpOption`.`rank`,
            `xpOption`.`right`, `xpQuestion`.`text`, COUNT(DISTINCT `xpAnswer`.`uid`) as `votes`');
$q->leftJoin('xpQuestion', 'xpQuestion', array('`xpOption`.`qid` = `xpQuestion`.`id`'));
$q->leftJoin('xpAnswer',   'xpAnswer',   array('`xpAnswer`.`oid` = `xpOption`.`id`'));
$q->groupby('`xpOption`.`id`');
$q->sortby('`votes`', 'DESC');
$q->prepare();
print "<pre>";
print $q->toSQL();
print "</pre>";
$q->stmt->execute();
$options = $q->stmt->fetchAll(PDO::FETCH_ASSOC);
if ($options) {
    $output = array();
    if (empty($output['maxVotes'])) $output['maxVotes'] = $options[0]['votes'];
    if (empty($output['text'])) $output['text'] = $options[0]['text'];
    if (empty($output['id'])) $output['id'] = $options[0]['qid'];
    foreach ($options as $option) {
        $option['percentVotes'] = round($option['votes'] / $output['maxVotes'] * 100, 2);
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