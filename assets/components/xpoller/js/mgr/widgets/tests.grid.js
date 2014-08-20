xPoller.grid.Tests = function(config) {
    config = config || {};
    this.sm = new Ext.grid.CheckboxSelectionModel();
	Ext.applyIf(config,{
		id: 'xpoller-grid-tests'
		,url: xPoller.config.connector_url
		,baseParams: {
			action: 'mgr/test/getlist'
            ,type:  'test'
		}
		,fields: ['id','name','closed']
		,autoHeight: true
		,paging: true
		,remoteSort: true
        ,sm: this.sm
		,columns: [
			{header: _('id'),dataIndex: 'id',width: 40}
			,{header: _('name'),dataIndex: 'name',width: 400}
			/*,{header: _('xpoller_closed'),dataIndex: 'closed',width: 80}*/
		]
		,tbar: [{
			text: _('xpoller_test_create')
			,handler: this.createItem
			,scope: this
		}]
		,listeners: {
			rowDblClick: function(grid, rowIndex, e) {
				var row = grid.store.getAt(rowIndex);
				this.updateItem(grid, e, row);
			}
		}
	});
	xPoller.grid.Tests.superclass.constructor.call(this,config);
};
Ext.extend(xPoller.grid.Tests,MODx.grid.Grid,{
	windows: {}

	,getMenu: function() {
        var cs = this.getSelectedAsList();
        var m = [];
        if (cs.split(',').length > 1) {
            m.push({
    			text: _('xpoller_test_remove')
    			,handler: this.removeSelected
    		});
        } else {
    		m.push({
    			text: _('xpoller_questions')
    			,handler: this.setupQuestions
    		});
    		m.push({
    			text: _('xpoller_test_update')
    			,handler: this.updateItem
    		});
    		m.push('-');
    		m.push({
    			text: _('xpoller_test_remove')
    			,handler: this.removeItem
    		});
        }
		this.addContextMenuItem(m);
	}
	
	,createItem: function(btn,e) {
		if (!this.windows.createItem) {
			this.windows.createItem = MODx.load({
				xtype: 'xpoller-window-test-create'
				,listeners: {
					'success': {fn:function() { this.refresh(); },scope:this}
				}
			});
		}
		this.windows.createItem.fp.getForm().reset();
		this.windows.createItem.show(e.target);
	}
    
    ,setupQuestions: function(btn, e) {
        if (!this.menu.record || !this.menu.record.id) return false;
        
        location.href = '?a=' + MODx.request.a + '&action=questions&test=' + this.menu.record.id;
    }

    ,updateItem: function(btn,e,row) {
		if (typeof(row) != 'undefined') {this.menu.record = row.data;}
		var id = this.menu.record.id;

		MODx.Ajax.request({
			url: xPoller.config.connector_url
			,params: {
				action: 'mgr/test/get'
				,id: id
			}
			,listeners: {
				success: {fn:function(r) {
					if (!this.windows.updateItem) {
						this.windows.updateItem = MODx.load({
							xtype: 'xpoller-window-test-update'
							,record: r
							,listeners: {
								'success': {fn:function() { this.refresh(); },scope:this}
							}
						});
					}
					this.windows.updateItem.fp.getForm().reset();
					this.windows.updateItem.fp.getForm().setValues(r.object);
					this.windows.updateItem.show(e.target);
				},scope:this}
			}
		});
	}

	,removeItem: function(btn,e) {
		if (!this.menu.record) return false;
		
		MODx.msg.confirm({
			title: _('xpoller_test_remove')
			,text: _('xpoller_test_remove_confirm')
			,url: this.config.url
			,params: {
				action: 'mgr/test/remove'
				,id: this.menu.record.id
			}
			,listeners: {
				'success': {fn:function(r) { this.refresh(); },scope:this}
			}
		});
	}

    ,getSelectedAsList: function() {
        var sels = this.getSelectionModel().getSelections();
        if (sels.length <= 0) return false;

        var cs = '';
        for (var i=0;i<sels.length;i++) {
            cs += ','+sels[i].data.id;
        }
        cs = cs.substr(1);
        return cs;
    }

    ,removeSelected: function(act,btn,e) {
        var cs = this.getSelectedAsList();
        if (cs === false) return false;

        MODx.msg.confirm({
			title: _('xpoller_tests_remove')
			,text: _('xpoller_tests_remove_confirm')
			,url: this.config.url
			,params: {
                action: 'mgr/tests/remove'
                ,items: cs
            }
            ,listeners: {
                'success': {fn:function(r) {
                    this.getSelectionModel().clearSelections(true);
                    this.refresh();
                       var t = Ext.getCmp('modx-resource-tree');
                       if (t) { t.refresh(); }
                },scope:this}
            }
        });
        return true;
    }
});
Ext.reg('xpoller-grid-tests',xPoller.grid.Tests);




xPoller.window.CreateItem = function(config) {
	config = config || {};
	this.ident = config.ident || 'mecitem'+Ext.id();
	Ext.applyIf(config,{
		title: _('xpoller_test_create')
		,id: this.ident
		,height: 100
		,width: 475
		,url: xPoller.config.connector_url
		,action: 'mgr/test/create'
		,fields: [
			{xtype: 'textfield',fieldLabel: _('name'),name: 'name',id: 'xpoller-'+this.ident+'-name',anchor: '99%'}
		]
		,keys: [{key: Ext.EventObject.ENTER,shift: true,fn: function() {this.submit() },scope: this}]
	});
	xPoller.window.CreateItem.superclass.constructor.call(this,config);
};
Ext.extend(xPoller.window.CreateItem,MODx.Window);
Ext.reg('xpoller-window-test-create',xPoller.window.CreateItem);


xPoller.window.UpdateItem = function(config) {
	config = config || {};
	this.ident = config.ident || 'meuitem'+Ext.id();
	Ext.applyIf(config,{
		title: _('xpoller_test_update')
		,id: this.ident
		,height: 100
		,width: 475
		,url: xPoller.config.connector_url
		,action: 'mgr/test/update'
		,fields: [
			{xtype: 'hidden',name: 'id',id: 'xpoller-'+this.ident+'-id'}
			,{xtype: 'textfield',fieldLabel: _('name'),name: 'name',id: 'xpoller-'+this.ident+'-name',anchor: '99%'}
		]
		,keys: [{key: Ext.EventObject.ENTER,shift: true,fn: function() {this.submit() },scope: this}]
	});
	xPoller.window.UpdateItem.superclass.constructor.call(this,config);
};
Ext.extend(xPoller.window.UpdateItem,MODx.Window);
Ext.reg('xpoller-window-test-update',xPoller.window.UpdateItem);