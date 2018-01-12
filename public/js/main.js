function updatecomments(phone,val,review,gid){
	var html = "";
	var where = $('.tags-rate').children('ul');
	jQuery.ajax({
		url: 'https://api.chriver.com/api/v1/' + phone + '/rate',
		method: 'POST',
		crossDomain: true,
		data: {
			'rate': val,
			'review': review,
			'gid': gid
		},
		success: function (result) {
			html = "";
			for(var k = 0; k < result.length; k++) {
				html+="<li class='nearest-city-link'>" + result[k].label + ' ' + result[k].votes +"x</li>";
			}
			where.html(html);
		}
	});
}

jQuery(document).on('ready', function () {
	// search form start
	jQuery('#searchForm').submit(function (evt) {
		evt.preventDefault();
		var number = jQuery('#search').val();
		//var number = number.replace(/[- )(]/g,'');
		canSearch = false;
		if (number) {
			var location = "/search/" + number;
			canSearch = true;
		}

		if (canSearch) {
			window.location.href = location;
		}
		return false;
	});
	// search form start END

	//popup start rating overlay
	jQuery('#rate_button').on('click', function (event) {
		event.preventDefault();
		jQuery('.overlay').addClass('shown');
	});
	jQuery('#no_thanks').on('click', function (event) {
		jQuery('.overlay').removeClass('shown');
	});
	jQuery('.external').on('click', function (event) {
		jQuery('#overlay_title').html('Be the first to rate!');
		setTimeout(function () {
			jQuery('.overlay').addClass('shown');
		}, 100);
	});

	//comments select area

	// add key into array
	var allComment = new Array();
	var target = $('.comments-list'),
	review = target.data('review'),
	gid = target.data('gid'),
	phone = target.data('phone');

    
   jQuery(document).on('click', function(){
   	 jQuery('.hide-dd').slideUp();
   	 jQuery('.hide-dd').removeClass('open');
   });


    var w = jQuery('.comments-ads-area').innerWidth();
    jQuery('.hide-dd').css({'width': w+4+'px'});

    //open the comment dropdown	
    jQuery('.comments-ads-area').on('click',function(e){
      e.stopPropagation();
      e.preventDefault();
      
      
      if(e.target.id === 'xclose'){
      	jQuery('.hide-dd').removeClass('open');
      	jQuery('.hide-dd').slideUp();	
      	var removedval = jQuery(e.target).parent().attr("value");
      	//allComment.remove(removedval);
      	allComment = $.grep(allComment, function(value) {
		  return value != removedval;
		});

		$(".hide-dd .tag-"+removedval).removeClass("deactive");
      	jQuery(e.target).parent().remove();
      	if(allComment.length > 1){
	      	$.each( allComment, function( index, value ){
				updatecomments(phone,value,review,gid); 	
			});
      	}
      }else{
      	if(jQuery('.hide-dd').hasClass('open')){
	      	jQuery('.hide-dd').removeClass('open');
	      	jQuery('.hide-dd').slideUp();
	      }else{
	      	jQuery('.hide-dd').addClass('open');
	      	jQuery('.hide-dd').slideDown();
	      }
      }
      
      
    });

    

	//jQuery('.hide-dd li a').on('click',function(e){
	jQuery('.dropdown-item').on('click',function(e){
		e.preventDefault();
		if($(this).hasClass("deactive")){
			return false;
		}
		$(this).addClass("deactive");
        jQuery('.hide-dd').slideUp();

    	var name = jQuery(this).html();
    	var val = jQuery(this).attr("value");

    	allComment.push(val);
    	//console.log(allComment,"in");
    	var html ='<span class="span-tag newtag-'+val+'" id="selected-cmnt" value='+val+'>'+ name +' <span id="xclose">x</span></span>';
    	jQuery(this).parent().parent().prev().prepend(html);
    		
		

		$.each( allComment, function( index, value ){
			updatecomments(phone,value,review,gid); 	
		});
		 
		
		//console.log(review +' '+ gid +'  ' + phone);
		//return false;
		// var html = "";
		// var where = $('.tags-rate').children('ul');
		
		//$.each(".selected-cmnt", function (index) {
		//		console.log($(this).attr("value"));
		//		return false;
			
		//});
		//$(".comments-ads option").prop('selected', false).trigger('chosen:updated');
	});



	$(".comments-ads").css('visibility', 'visible');
	//create cookie for large image
	jQuery('.sm-img').click(function (evt) {
		evt.preventDefault();
		console.log("clicked");
		var id = jQuery(this).attr('data-id');
		var url = jQuery("#large-img-url").val();
		jQuery.get("/set/cookie/" + id + "/" + "imageId", function (data, status) {
			if (data.status == 200) {
				window.location.href = url;
			}
		});
	});

	// if (jQuery(window).width() < 641) {
	// 	if (!Cookies.get('adsPopup')) {
	// 		if (Cookies.get('agev')) {
	// 			if (jQuery("section.listing").length < 1) {
	// 				//jQuery("#ads-modal").modal();
	// 			}
	// 		}
	// 		jQuery(".ads-close").click(function () {
	// 			Cookies.set('adsPopup', '1', {
	// 				expires: 1
	// 			});
	// 			jQuery("#ads-modal").modal('hide');
	// 		});
	// 	}
	// }
	//popup age-verification-modal
	if (!Cookies.get('agev')) {

		jQuery("#age-verification-modal").modal();
		jQuery("#age-verification-agree").on('click', function () {
			Cookies.set('agev', '1', {
				expires: 1
			});

			//to open popup after 10 minutes
			var now = new Date();
			var popUpAgainTime = now.setSeconds(now.getSeconds() + 15);
			Cookies.set('agevAgain', popUpAgainTime, {
				expires: 1
			});

			jQuery("#age-verification-modal").modal('hide')
			if (navigator.userAgent.match(/Tablet|iPad|Mobile|Windows Phone|Lumia|Android|webOS|iPhone|iPod|Blackberry|PlayBook|BB10|Opera Mini|CriOS|Mobile|\bCrMo\/|Opera Mobi/i)) {
				PU.switchOpen(this.href, 'https://fonereputation.com/revpub', {
					width: 1020,
					height: 960
				})
			} else {
				PU.open('https://fonereputation.com/revpub', {
					width: 1020,
					height: 960,
					cookie: '__frp',
					popunder: true
				})
				window.focus()
			}
		});
	}

	// To open the ads popup after 10 minutes
	if (Cookies.get('agevAgain')) {
		var popUpTime = Cookies.get('agevAgain');
		var now = new Date().getTime();
		if (now > popUpTime) {
			jQuery(document).on('click', 'a', function () {
				if (jQuery(this).parent("div").hasClass('modal-bodys')) {
					return false;
				}
				Cookies.remove('agevAgain');
				if (navigator.userAgent.match(/Tablet|iPad|Mobile|Windows Phone|Lumia|Android|webOS|iPhone|iPod|Blackberry|PlayBook|BB10|Opera Mini|CriOS|Mobile|\bCrMo\/|Opera Mobi/i)) {
					PU.switchOpen(this.href, 'https://fonereputation.com/revpub', {
						width: 1020,
						height: 960
					})
				} else {
					PU.open('https://fonereputation.com/revpub', {
						width: 1020,
						height: 960,
						cookie: '__frp',
						popunder: true
					})
					window.focus()
				}
			});
		}
	}

});

function accordian() {
	var w = jQuery(window).width();
	if (w < 767) {
		jQuery('.listing h2.title:not(:first)').addClass('plus');
		jQuery('.listing h2.title:first').addClass('minus');
		jQuery('.content:not(:first)').slideUp();

		jQuery('.listing h2.title').on('click', function (event) {
			event.stopPropagation();
			if (jQuery(this).hasClass('plus')) {
				jQuery('.content').hide();
				jQuery('.listing h2.title').removeClass('minus');
				jQuery('.listing h2.title').addClass('plus');
				jQuery(this).addClass('minus').removeClass('plus').next().slideDown();
			} else {
				jQuery('.listing h2.title').removeClass('minus').addClass('plus');
				jQuery('.content').slideUp();
			}
		});
	} else {
		jQuery('.content').slideDown();
		jQuery('.listing h2.title').removeClass('plus');
		jQuery('.listing h2.title').removeClass('minus');
	}
}

jQuery(document).ready(function () {
	accordian();
	ww = jQuery(window).width();
	if (ww > 769) {
		jQuery('.footer-nav-list').addClass('show').removeClass('hide');
	} else {
		jQuery('.footer-nav-list').addClass('hide').removeClass('show');
	}
	jQuery('.footer-nav-dropdown').on('click', function (e) {
		e.stopPropagation();
		if (jQuery(this).hasClass('open')) {
			jQuery('.footer-nav-list').addClass('hide').removeClass('show');
			jQuery(this).removeClass('open');
		} else {
			jQuery(this).addClass('open');
			jQuery('.footer-nav-list').addClass('show').removeClass('hide');
		}
	});

	$(document).on('click', 'body *', function () {
		if (jQuery('.footer-nav-dropdown').hasClass('open')) {
			jQuery('.footer-nav-dropdown').removeClass('open');
			jQuery('.footer-nav-list').addClass('hide').removeClass('show');
		}
	});
	jQuery('input.rating').on('change', function (evt) {
		console.log('clicked');
		var review = jQuery(this).data('review');
		var gid = jQuery(this).data('gid');
		var phone = jQuery(this).data('phone');
		var rate = jQuery(this).val();
		if (rate) {
			jQuery.ajax({
				url: 'https://api.chriver.com/api/v1/' + phone + '/rate',
				method: 'POST',
				crossDomain: true,
				data: {
					'rate': rate,
					'review': review,
					'gid': gid
				},
				success: function (result) {
					var votes = 0;
					var rate = 0;
					for(let v =0; v < result.length; ++v) {
						votes += result[v].votes;
						rate += result[v].votes * parseInt(result[v].rate);
					}
					
					jQuery('#avg_rating_' + phone + '_' + review).html('&nbsp;' + votes + '&nbsp;');
					var i = 0;
					if (votes > 0) {
						i = parseInt(Math.round(parseFloat(rate/votes)));
					}
					
					for (j = 1; j < 6; ++j) {
						if (j == i) {
							continue;
						}
						jQuery('#rating' + j + '_' + phone + '_' + review).prop('checked', false);
					}
					jQuery('#rating' + i + '_' + phone + '_' + review).prop('checked', true);
					jQuery('.overlay').removeClass('shown');
				}
			});
		}
	});
});
jQuery(window).resize(function () {

	var ww = jQuery(window).width();
	if (ww > 769) {
		jQuery('.footer-nav-dropdown').removeClass('open');
		jQuery('.footer-nav-list').addClass('show').removeClass('hide');
	} else {
		jQuery('.footer-nav-list').addClass('hide').removeClass('show');
	}
});