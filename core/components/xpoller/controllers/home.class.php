<?php
/**
 * The home manager controller for xPoller.
 *
 */
class xPollerHomeManagerController extends xPollerMainController {
	/* @var xPoller $xPoller */
	public $xPoller;


	/**
	 * @param array $scriptProperties
	 */
	public function process(array $scriptProperties = array()) {
	}


	/**
	 * @return null|string
	 */
	public function getPageTitle() {
		return $this->modx->lexicon('xpoller');
	}


	/**
	 * @return void
	 */
	public function loadCustomCssJs() {
		$this->addJavascript($this->xPoller->config['jsUrl'] . 'mgr/widgets/tests.grid.js');
		$this->addJavascript($this->xPoller->config['jsUrl'] . 'mgr/widgets/questions.grid.js');
        $this->addJavascript($this->xPoller->config['jsUrl'] . 'mgr/widgets/options.grid.js');
		$this->addJavascript($this->xPoller->config['jsUrl'] . 'mgr/widgets/home.panel.js');
		$this->addJavascript($this->xPoller->config['jsUrl'] . 'mgr/sections/home.js');
		$this->addHtml('<script type="text/javascript">
		Ext.onReady(function() {
			MODx.load({ xtype: "xpoller-page-home"});
		});
		</script>');
	}


	/**
	 * @return string
	 */
	public function getTemplateFile() {
		return $this->xPoller->config['templatesPath'] . 'home.tpl';
	}
}