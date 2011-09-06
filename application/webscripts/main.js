function IrontouchGameSetup(){
	/*try {
		$("body select").msDropDown();
		} catch(e) {
		alert(e.message);
		}
	//$("body select").msDropDown({visibleRows:3, rowHeight:32});*/
	
	battleConsole = new BattleConsole();
	$('.spell').live('click', function(){
	    battleConsole.update();
	    //battleConsole.write(battleData);
	});
	$('#response').live('click', function(){
											$('.responsebox').hide();
											$('#response').live('click', function(){$('.responsebox').show();});
											});
	loadingTravelFinished();
	$('#loadingBattle').hide();
	$('.locationPicture').css('width', '200px');
	$('.locationPicture').css('height', 'auto');
	$('.attack-button').live('click', function(){
		loadingBattle();
		var monsterId = $(this).attr('id');
	    $.getJSON('/monster/attack/id/'+monsterId, function(data) {
	        //alert(data); //uncomment this for debug
	        //alert (data.item1+" "+data.item2+" "+data.item3); //further debug
	        console.log(data.updatedValues.player);
	        loadingBattleFinished(data);
	        
	    });
	});
	$('.travelLink').live('click', function(){
		loadingTravel();
	    $.getJSON('/player/travel/to/'+$(this).attr('id'), function(data) {
	        //alert(data); ncomment this for debug
	        //alert (data.item1+" "+data.item2+" "+data.item3); //further debug
	        console.log(data.traveled);
	        loadingTravelFinished(); 
	        
	    });
	});
	$('img.questSign').hover(function() { 
	    $(this).attr('src', '/media/game/quest-sign-small-hover.png');
	}, function() {
	    $(this).attr('src', '/media/game/quest-sign-small.png');
	});

}