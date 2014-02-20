xPoller.page.Home = function(config) {
	config = config || {};
	Ext.applyIf(config,{
		components: [{
			xtype: 'xpoller-panel-home'
			,renderTo: 'xpoller-panel-home-div'
		}]
	}); 
	xPoller.page.Home.superclass.constructor.call(this,config);
};
Ext.extend(xPoller.page.Home,MODx.Component);
Ext.reg('xpoller-page-home',xPoller.page.Home);