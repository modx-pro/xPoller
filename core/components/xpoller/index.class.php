<?php

/**
 * Class xPollerMainController
 */
abstract class xPollerMainController extends modExtraManagerController {
	/** @var xPoller $xPoller */
	public $xPoller;


	/**
	 * @return void
	 */
	public function initialize() {
		$corePath = $this->modx->getOption('xpoller_core_path', null, $this->modx->getOption('core_path') . 'components/xpoller/');
		require_once $corePath . 'model/xpoller/xpoller.class.php';

		$this->xPoller = new xPoller($this->modx);

		$this->addCss($this->xPoller->config['cssUrl'] . 'mgr/main.css');
		$this->addJavascript($this->xPoller->config['jsUrl'] . 'mgr/xpoller.js');
		$this->addHtml('<script type="text/javascript">
		Ext.onReady(function() {
			xPoller.config = ' . $this->modx->toJSON($this->xPoller->config) . ';
			xPoller.config.connector_url = "' . $this->xPoller->config['connectorUrl'] . '";
		});
		</script>');

		parent::initialize();
	}


	/**
	 * @return array
	 */
	public function getLanguageTopics() {
		return array('xpoller:default');
	}


	/**
	 * @return bool
	 */
	public function checkPermissions() {
		return true;
	}
}


/**
 * Class IndexManagerController
 */
class IndexManagerController extends xPollerMainController {

	/**
	 * @return string
	 */
	public static function getDefaultController() {
		return 'home';
	}
}