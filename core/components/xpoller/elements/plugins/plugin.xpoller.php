<?php

switch ($modx->event->name) {

	case 'OnManagerPageInit':
		$cssFile = MODX_ASSETS_URL.'components/xpoller/css/mgr/main.css';
		$modx->regClientCSS($cssFile);
		break;

}