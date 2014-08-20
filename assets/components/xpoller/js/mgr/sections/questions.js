xPoller.page.Questions = function(config) {
	config = config || {};
	Ext.applyIf(config,{
    	buttons: [{
			text: _('back'),
			id: 'xpoller-questions-btn-cancel',
			handler: function() {
				location.href = '?a=' + MODx.request.a + '&tab=1';
			},
			scope: this
		}],
		components: [{
			xtype: 'xpoller-panel-questions'
			,renderTo: 'xpoller-panel-questions-div'
            ,test: MODx.request.test
		}]
	}); 
	xPoller.page.Questions.superclass.constructor.call(this,config);
};
Ext.extend(xPoller.page.Questions,MODx.Component);
Ext.reg('xpoller-page-questions',xPoller.page.Questions);