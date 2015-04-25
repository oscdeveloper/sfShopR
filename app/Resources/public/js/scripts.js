$(function(){

	
	$('table a.remove').click(function(){
		
		return confirm('Czy usunąć produkt?');
		
	});
	
	
	$('a.vote-up, a.vote-down').click(function(){

		var $link = $(this),
			url = $link.attr('href');
		
		$.getJSON(
			url,
			function(response){
				
				if (response.success) {
					$link.prev().html(response.nbVotes);
				} else {
					alert(response.message);
				}
			}	
		);
		
		return false;
	
	});
	
});