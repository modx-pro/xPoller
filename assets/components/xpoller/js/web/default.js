function resetForms() {
    $.each($("form.xPolls"), function(){
        this.onsubmit = function() {
            var parent = $(this).parent();
            var data = $(this).serialize();
            var btn = $(document.activeElement,this);
            if (btn.is('button, input[type="submit"], input[type="image"]') && btn.is('[name]'))
            if (!$(this).children("input[name=oid]")) return false;
            data = data + '&xp_action=' + btn.val();
            $.ajax({
                type: "POST",
                url: document.location.href,
                data: data,
                success: function(html) {
                    parent.html(html);
                    resetForms();
                }
            });
            return false;
        };
    });
}
resetForms();