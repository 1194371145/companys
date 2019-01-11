$(function() 
{
    var /*scp = $('[class="train_reply"] a'),*/spp = $('[data-id="createtrain"] a')/*,tps = $('[data-id="createtrain"] a')*/;
    var sign = config.requestType == 'GET' ? '&' : '?';
   // scp.attr('href', scp.attr('href') + sign + 'onlybody=yes').modalTrigger({width:'80%', type:'iframe'});
    spp.attr('href', spp.attr('href')   + sign + 'onlybody=yes').modalTrigger({width:'45%', type:'iframe'});
    //tps.attr('href', spp.attr('href')   + sign + 'onlybody=yes').modalTrigger({width:'45%', type:'iframe'});
});