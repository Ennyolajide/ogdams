function notify(title,message,icon='',type='danger',delay=5000,onClose=null){
    $.notify(
        {   title: title, icon: icon, message: '<strong>'+message+'</strong><br/>' },
        {   type: type,
            animate: { enter: 'animated fadeInUp', exit: 'animated fadeOutRight' },
            placement: { from: "top", align: "center" },
            delay: delay,
            offset: 20,
            spacing: 20,
            z_index: 99999,
            onClose: onClose,
        }
    );
}
