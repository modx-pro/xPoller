xPoller.panel.Questions = function(config) {
    config = config || {};
	Ext.apply(config,{
		border: false
		,baseCls: 'modx-formpanel'
		,items: [{
			html: '<h2>'+_('xpoller_questions')+'</h2>'
			,border: false
			,cls: 'modx-page-header container'
            ,id: 'xpoller-questions-page-header',
		},{
			xtype: 'modx-panel'
			,bodyStyle: 'padding: 10px'
			,defaults: { border: false ,autoHeight: true }
			,border: true
			,activeItem: 0
			,hideMode: 'offsets'
			,items: [{
    			/*title: _('xpoller_questions')
				,*/items: [/*{
					html: _('xpoller_intro_msg')
					,border: false
					,bodyCssClass: 'panel-desc'
					,bodyStyle: 'margin-bottom: 10px'
				},*/{
					xtype: 'xpoller-grid-questions'
					,preventRender: true
				}]
			}]
		}],
        listeners: {
    		'added': { fn: function() {
            	MODx.Ajax.request({
        			url: xPoller.config.connector_url,
        			params: {
        				action: 'mgr/test/get',
        				id: this.config.test
        			},
        			listeners: {
        				'success': {
        					fn: function(r) {
        						//this.getForm().setValues(r.object);
                                console.log(r.object);
        						Ext.getCmp('xpoller-questions-page-header').getEl().update('<h2>' + r.object.name + ' — ' + _('xpoller_questions') + '</h2>');
        						this.fireEvent('ready', r.object);
        					},
        					scope: this
        				}
        			}
        		});
    		}, scope: this }
		}
	});
	xPoller.panel.Questions.superclass.constructor.call(this,config);
};
/*
Ext.extend(xPoller.panel.Questions,MODx.FormPanel, {
    setup: function() {
		if(!this.config.test) {
			return;
		}

		MODx.Ajax.request({
			url: this.config.url,
			params: {
				action: 'mgr/test/get',
				id: this.config.test
			},
			listeners: {
				'success': {
					fn: function(r) {
						//this.getForm().setValues(r.object);
                        console.log(r.object);
						Ext.getCmp('xpoller-questions-page-header').getEl().update('<h2>' + _('xpoller_questions') + ': ' + r.object.name + '</h2>');
						this.fireEvent('ready', r.object);
					},
					scope: this
				}
			}
		});
	}
});*/
Ext.extend(xPoller.panel.Questions,MODx.Panel);
Ext.reg('xpoller-panel-questions',xPoller.panel.Questions);