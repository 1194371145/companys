$(function()
{
    var sp = $('[data-id="export"] a');
    var sign = config.requestType == 'GET' ? '&' : '?';
    sp.attr('href', sp.attr('href')   + sign + 'onlybody=yes').modalTrigger({width:900,height:350, type:'iframe'});

});