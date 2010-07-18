//
// Widget opening/closing functionality
// Copyright (C) 2010 by mocapapa <mocapapa@g.pugpug.org>
// $Id: widget-collapse.js 90 2010-02-24 09:20:41Z mocapapa@g.pugpug.org $
// This file is going to be minified by the site http://dean.edwards.name/packer/.
// In this case, you can shrink variables by uncommenting 'document ready function' of JQuery
//
//$(document).ready(function(){
    var hostroot = PARAMS["HTTPHOST"]+"__"+PARAMS["BASEURL"].replace(/\//g,"_");
    var key = hostroot+"__widget_title_vals";
    var store = new Persist.Store("blog-enhanced");
    var titles = new Array();
    var title_vals = new Array();

    // load status
    store.get(key, function(ok, val) {
	    if (ok && val != null) {
		title_vals = val.toString().replace("\r\n","","g").split(",");
		// $("#debug").html("("+Persist.type + ")("+ key+")loaded("+val+")");
	    }
	});

    // collect titles of widgets
    var i=0;
    $(".portlet .header .expandButton").each(function(){
	    titles[i] = $(this).parent(".header").html().replace("\r\n"," ","g").split("  ")[0];
	    if (title_vals[i] != 0) {
		title_vals[i] = 1;
	    }
	    
	    //  alert(titles[i]+"="+title_vals[i]);
	    if (title_vals[i++] == 0) {
		$(this).parent().next(".content").hide();
		$(this).css("background-position", "0px 0px");
	    } else {
		$(this).css("background-position", "0px -18px");
	    }
	});
    
    //    $("#status").html(title_vals.join());
    
    // for (var i in titles) {
    //   alert(titles[i]+"=>"+title_vals[i]);
    // }
    
    // on click
    $(".portlet .header .expandButton").click(function(e){
	    var th = $(this).parent(".header").html().replace("\r\n"," ","g").split("  ")[0];
	    // alert(th);
	    
	    // invert val
	    for (var i in titles) {
		var ti = titles[i];
		var tv = title_vals[i];
		//   alert("["+ti+"]["+th+"]["+tv+"]");
		if (ti == th) {
		    // alert("["+ti+"]==["+th+"]["+tv+"]");
		    if (tv == 0) {
			$(this).parent().next(".content").slideDown();
			title_vals[i] = 1;
			$(this).css("background-position", "0px -18px");
			// $(this).parent().next(".content").css("visibility", "visible");
		    } else {
			// $(this).parent().next(".content").css("visibility", "hidden");
			$(this).parent().next(".content").slideUp();
			title_vals[i] = 0;
			$(this).css("background-position", "0px 0px");
		    }
		    // alert("["+ti+"]==["+th+"]["+title_vals[i]+"]");

		} else {
		    if (tv != 0) {
			title_vals[i] = 1;
		    }
		}
	    }
	    
	    //$("#status").html(title_vals.join());
	    
	    // save status
	    store.set(key, title_vals.join());
	    // $("#debug").html("("+Persist.type + ")("+ key+")saved("+val+")");
	    
	});
//    });
