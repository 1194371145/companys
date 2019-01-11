$(function() 
{
    var ty = $('[data-id="import"] a');var po = $('[data-id="export"] a');
    var sign = config.requestType == 'GET' ? '&' : '?';
    ty.attr('href', ty.attr('href')   + sign + 'onlybody=yes').modalTrigger({width:'600px',height:'200px', type:'iframe'});
    po.attr('href', po.attr('href')   + sign + 'onlybody=yes').modalTrigger({width:'60%',height:'350px', type:'iframe'});
  
});
function setWhite(acl)
{
    acl == 'custom' ? $('#whitelistBox').removeClass('hidden') : $('#whitelistBox').addClass('hidden');
}

