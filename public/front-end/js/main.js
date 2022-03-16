/*price range*/

 $('#sl2').slider();

	var RGBChange = function() {
	  $('#RGB').css('background', 'rgb('+r.getValue()+','+g.getValue()+','+b.getValue()+')')
	};	
		
/*scroll to top*/

$(document).ready(function(){
	$(function () {
		$.scrollUp({
	        scrollName: 'scrollUp', // Element ID
	        scrollDistance: 300, // Distance from top/bottom before showing element (px)
	        scrollFrom: 'top', // 'top' or 'bottom'
	        scrollSpeed: 300, // Speed back to top (ms)
	        easingType: 'linear', // Scroll to top easing (see http://easings.net/)
	        animation: 'fade', // Fade, slide, none
	        animationSpeed: 200, // Animation in speed (ms)
	        scrollTrigger: false, // Set a custom triggering element. Can be an HTML string or jQuery object
					//scrollTarget: false, // Set a custom target element for scrolling to the top
	        scrollText: '<i class="fa fa-angle-up"></i>', // Text for element, can contain HTML
	        scrollTitle: false, // Set a custom <a> title if required.
	        scrollImg: false, // Set true to use image
	        activeOverlay: false, // Set CSS color to display scrollUp active point, e.g '#00FFFF'
	        zIndex: 2147483647 // Z-Index for the overlay
		});
	});
});

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function preqty(id){
	var qty = $('.qty-' + id).val()
	qty--
	var url = '/cart/' + id
	$.ajax({
		type: 'PUT',
		dataType: 'JSON',
		data: {qty, id},
		url: url,
		success: function(result){
			console.log(result)
			table(result)

		}
	})

}

function nextqty(id){
	var qty = $('.qty-' + id).val()
	qty++
	var url = '/cart/' + id
	$.ajax({
		type: 'PUT',
		dataType: 'JSON',
		data: {qty, id},
		url: url,
		success: function(result){
			console.log(result)
			table(result)

		}
	})
}

function table(array){
	var arr = ''
	$(array).map(function(i){
		array.forEach(element => {
			var x = element['price'] * element['qty']
			x = x.toLocaleString('it-IT', {style : 'currency', currency : 'VND'});
			$('.cart_total_price_' + element['id']).text(x)
			$('.qty-' + element['id']).val(element['qty'])
		});
	})
	return "hello"
}


function viewProduct(url){
	window.location.replace(url);
}

function removeCart(id, url){
	$.confirm({
        title: "Do you want delete!",
        buttons: {
            confirm : {
                btnClass: "btn-danger" ,
                keys: ["enter", "shift"],
                action : function (e) {
                    $.ajax({
                        type: 'DELETE',
                        dataType: 'JSON',
                        data: {id},
                        url: url,
                        success: function(result){
							console.log(result)
                            if(result === 1){
                                $.alert("Delete success!");
                                location.reload();
                            }
                        }
                    })
                },
            },
            cancel: function () {
                $.alert("Canceled!");
            }
        }
    });
}