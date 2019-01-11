//$('#button1').click(function(){
//	//var button1 = document.getElementsByTagName("value1").value; alert(button1);
//	var button1 = $("input[name='value1']").val();alert(button1);
//});
//$(document).ready(function(){
//	  $("#button1").click(function(){
//	  $("#t1").toggle();
//      var button1 = $("input[name='value1']").val();alert(button1);
//	  
//       
//	  });
//	});
//$(document).ready(function(){
//	  $("#button2").click(function(){
//	  $("#t2").toggle();
//	  });
//	});

$(document).ready(function(){

    $('#test').find('input[type=checkbox]').bind('click', function(){

        $('#test').find('input[type=checkbox]').not(this).attr("checked", false);

    });

});
$(document).ready(function(){

    $('#test2').find('input[type=checkbox]').bind('click', function(){

        $('#test2').find('input[type=checkbox]').not(this).attr("checked", false);

    });

});



$(function(){
	$("input[type='radio']").click(function(){
	$("input[type='radio'][name='"+$(this).attr('name')+"']").parent().removeClass("checked");
	$(this).parent().addClass("checked");
	    });
	});  

$(document).ready(function(){
	  $("#button1").click(function(){
	  $("#t1").toggle();
      //var button1 = $("input[name='value1']").val();//alert(button1);
	  
       
	  });
	});
$(document).ready(function(){
	  $("#button2").click(function(){
	  $("#t2").toggle();
	  });
	});

$(document).ready(function(){
	  $("#button3").click(function(){
	  $("#t3").toggle();
	  });
	});
$(document).ready(function(){
	  $("#button4").click(function(){
	  $("#t4").toggle();
	  });
	});
$(document).ready(function(){
	  $("#button5").click(function(){
	  $("#t5").toggle();
	  });
	});
$(document).ready(function(){
	  $("#button6").click(function(){
	  $("#t6").toggle();
	  });
	});
$(document).ready(function(){
	  $("#button7").click(function(){
	  $("#t7").toggle();
	  });
	});



$(document).ready(function(){
	  $("#fac1").click(function(){
	  $("#f1").toggle();
	  });
	});
$(document).ready(function(){
	  $("#fac2").click(function(){
	  $("#f2").toggle();
	  });
	});
$(document).ready(function(){
	  $("#fac3").click(function(){
	  $("#f3").toggle();
	  });
	});
$(document).ready(function(){
	  $("#fac4").click(function(){
	  $("#f4").toggle();
	  });
	});
$(document).ready(function(){
	  $("#fac5").click(function(){
	  $("#f5").toggle();
	  });
	});
$(document).ready(function(){
	  $("#fac6").click(function(){
	  $("#f6").toggle();
	  });
	});
$(document).ready(function(){
	  $("#fac7").click(function(){
	  $("#f7").toggle();
	  });
	});
$(document).ready(function(){
	  $("#fac8").click(function(){
	  $("#f8").toggle();
	  });
	});





$(document).ready(function(){
	  $("#wel1").click(function(){
	  $("#w1").toggle();
	  });
	});
$(document).ready(function(){
	  $("#wel2").click(function(){
	  $("#w2").toggle();
	  });
	});
$(document).ready(function(){
	  $("#wel3").click(function(){
	  $("#w3").toggle();
	  });
	});
$(document).ready(function(){
	  $("#wel4").click(function(){
	  $("#w4").toggle();
	  });
	});
$(document).ready(function(){
	  $("#wel5").click(function(){
	  $("#w5").toggle();
	  });
	});
$(document).ready(function(){
	  $("#wel6").click(function(){
	  $("#w6").toggle();
	  });
	});
$(document).ready(function(){
	  $("#wel7").click(function(){
	  $("#w7").toggle();
	  });
	});
$(document).ready(function(){
	  $("#wel8").click(function(){
	  $("#w8").toggle();
	  });
	});
$(document).ready(function(){
	  $("#wel9").click(function(){
	  $("#w9").toggle();
	  });
	});
$(document).ready(function(){
	  $("#wel10").click(function(){
	  $("#w10").toggle();
	  });
	});
$(document).ready(function(){
	  $("#wel11").click(function(){
	  $("#w11").toggle();
	  });
	});
$(document).ready(function(){
	  $("#wel12").click(function(){
	  $("#w12").toggle();
	  });
	});
$(document).ready(function(){
	  $("#wel13").click(function(){
	  $("#w13").toggle();
	  });
	});
$(document).ready(function(){
	  $("#wel14").click(function(){
	  $("#w14").toggle();
	  });
	});
$(document).ready(function(){
	  $("#wel15").click(function(){
	  $("#w15").toggle();
	  });
	});
$(document).ready(function(){
	  $("#wel16").click(function(){
	  $("#w16").toggle();
	  });
	});
$(document).ready(function(){
	  $("#wel17").click(function(){
	  $("#w17").toggle();
	  });
	});
$(document).ready(function(){
	  $("#wel18").click(function(){
	  $("#w18").toggle();
	  });
	});
$(document).ready(function(){
	  $("#wel19").click(function(){
	  $("#w19").toggle();
	  });
	});
$(document).ready(function(){
	  $("#wel20").click(function(){
	  $("#w20").toggle();
	  });
	});
$(document).ready(function(){
	  $("#wel21").click(function(){
	  $("#w21").toggle();
	  });
	});


/*倒计时*/
//var maxtime = 25*60;
//function CountDown(){ 
//	if(maxtime>=0){ 
//	minutes = Math.floor(maxtime/60); 
//	seconds = Math.floor(maxtime%60); 
//	msg = "填写时间剩余"+minutes+"分"+seconds+"秒"; 
//	document.all["timer"].innerHTML=msg; 
//	if(maxtime == 5*60) alert('注意，还有5分钟!'); 
//	--maxtime; 
//	} 
//	else{ 
//	clearInterval(timer); 
//	//alert("时间到，结束!"); 
//	} 
//	} 
//	timer = setInterval("CountDown()",1000); 

