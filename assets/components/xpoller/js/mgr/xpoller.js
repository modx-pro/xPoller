var xPoller = function(config) {
	config = config || {};
	xPoller.superclass.constructor.call(this,config);
};
Ext.extend(xPoller,Ext.Component,{
	page:{},window:{},grid:{},tree:{},panel:{},combo:{},config: {},view: {}
});
Ext.reg('xpoller',xPoller);

xPoller = new xPoller();