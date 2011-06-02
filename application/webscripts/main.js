function IrontouchGameSetup(){
	loadingTravelFinished();
	$('#loadingBattle').hide();
	$('.locationPicture').css('width', '200px');
	$('.locationPicture').css('height', 'auto');
	$('.attack-button').bind('click', function(){
		loadingBattle();
		var monsterId = $(this).attr('id');
	    $.getJSON('/monster/attack/id/'+monsterId, function(data) {
	        //alert(data); //uncomment this for debug
	        //alert (data.item1+" "+data.item2+" "+data.item3); //further debug
	        console.log(data.updatedValues.player);
	        setTimeout(loadingBattleFinished(data), 2000);
	        
	    });
	});
	$('.travelLink').bind('click', function(){
		loadingTravel();
	    $.getJSON('/player/travel/to/home', function(data) {
	        //alert(data); //uncomment this for debug
	        //alert (data.item1+" "+data.item2+" "+data.item3); //further debug
	        console.log(data.traveled);
	        setTimeout(loadingTravelFinished(), 2000); 
	        
	    });
	});
}