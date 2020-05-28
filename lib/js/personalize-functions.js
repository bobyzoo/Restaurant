function popover_notice(text, color, position) {
    bs4pop.notice(text, //mensage
        {
            type: color, //primary, secondary, success, danger, warning, info, light, dark
            position: position, //topleft, topcenter, topright, bottomleft, bottomcenter, bottonright, center,
            appendType: 'append',
            closeBtn: 'true',
            className: ''
        });
}