jQuery.fn.extend({
	 //全选
	  selected: function(obj,options) {
	  	$(obj).bind('click', function() {
	  		var defaults = {
	  		  	tableid:'.tableborder',
	  		  	type: 'checkbox'
		  	};
	  		$.extend(defaults,options);
	  		$(defaults.tableid +" input[type="+defaults.type+ "]").each(function() { this.checked = true; });
	  		$(defaults.tableid +" tr").each(function() {$(this).addClass("onchicked")});
	  	});
	  },
	  //不选
	  unselected: function(obj,options) {
		  	$(obj).bind('click', function() {
		  		var defaults = {
		  		  	tableid:'.tableborder',
		  		  	type: 'checkbox'
			  	};
		  		$.extend(defaults,options);
		  		$(defaults.tableid +" input[type="+defaults.type+ "]").each(function() { this.checked = false; });
		  		$(defaults.tableid +" tr").each(function() {$(this).removeClass("onchicked")});
		  	});
	 },
	 //返选
	 antiselected: function(obj,options) {
		  	$(obj).bind('click', function() {
		  		var defaults = {
		  		  	tableid:'.tableborder',
		  		  	type: 'checkbox'
			  	};
		  		$.extend(defaults,options);
		  		
		  		$(defaults.tableid +" input[type="+defaults.type+ "]").each(function() { 
		  			if(this.checked==true){
		  				this.checked = false;
		  				$(this).closest("tr").removeClass("onchicked");
		  			}else{
		  				this.checked=true;
		  				
		  				$(this).closest("tr").addClass("onchicked");
		  			}
		  		});

		  	});
	 },
	//顶部全选
	 selectedall: function(obj,options) {
		  	$(obj).bind('click', function() {
		  		var defaults = {
		  		  	tableid:'.tableborder',
		  		  	type: 'checkbox'
			  	};
		  		$.extend(defaults,options);
		  	    if(this.checked){  
		  	    	$(defaults.tableid +" input[type="+defaults.type+ "]").each(function() { this.checked = true; });
		  	    	$(defaults.tableid +" tr").each(function() {$(this).addClass("onchicked")});
		  	    }else{  
		  	    	$(defaults.tableid +" input[type="+defaults.type+ "]").each(function() { this.checked = false; });
		  	    	$(defaults.tableid +" tr").each(function() {$(this).removeClass("onchicked")});
		  	    }	
		  	});
	 }
});