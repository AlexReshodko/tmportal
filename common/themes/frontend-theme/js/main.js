$.extend($.expr[':'], {
  'containsi': function(elem, i, match, array)
  {
    return (elem.textContent || elem.innerText || '').toLowerCase()
    .indexOf((match[3] || "").toLowerCase()) >= 0;
  }
});

var Utils = {
    getID: function(str){
        return parseInt(str.replace(/[^0-9\.]/g, ''), 10);
    }
}

var NotificationManager = {
    TYPE_INFO: 'info',
    TYPE_SUCCESS: 'success',
    TYPE_WARNING: 'warning',
    TYPE_ERROR: 'danger',
    showMessage: function(type, message){
        type = type || NotificationManager.TYPE_INFO;
    	$.notify({
        	icon: "ti-info",
        	message: message

        },{
            type: type,
            timer: 4000,
            placement: {
                from: 'top',
                align: 'center'
            }
        });
	},
    showMessages: function (messages) {
        $.each(messages, function (type, message) {
            NotificationManager.showMessage(type, message);
        });
    }
}

var MainApp = {
    afterAjaxListViewUpdate: function(){}
}