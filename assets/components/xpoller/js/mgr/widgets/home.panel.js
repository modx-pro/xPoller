xPoller.panel.Home = function(config) {
	config = config || {};
	Ext.apply(config,{
		border: false
		,baseCls: 'modx-formpanel'
		,items: [{
			html: '<h2>'+_('xpoller')+'</h2>'
			,border: false
			,cls: 'modx-page-header container'
		},{
			xtype: 'modx-tabs'
			,bodyStyle: 'padding: 10px'
			,defaults: { border: false ,autoHeight: true }
			,border: true
			,activeItem: 0
			,hideMode: 'offsets'
			,items: [{
    			title: _('xpoller_polls')
				,items: [/*{
					html: _('xpoller_intro_msg')
					,border: false
					,bodyCssClass: 'panel-desc'
					,bodyStyle: 'margin-bottom: 10px'
				},*/{
					xtype: 'xpoller-grid-questions'
					,preventRender: true
				}]
			/*},{
    			title: _('xpoller_tests')
				,items: [/ *{
					html: _('xpoller_intro_msg')
					,border: false
					,bodyCssClass: 'panel-desc'
					,bodyStyle: 'margin-bottom: 10px'
				},* /{
					xtype: 'xpoller-grid-tests'
					,preventRender: true
				}]*/
			}]
		}]
	});
	xPoller.panel.Home.superclass.constructor.call(this,config);
};
Ext.extend(xPoller.panel.Home,MODx.Panel);
Ext.reg('xpoller-panel-home',xPoller.panel.Home);
