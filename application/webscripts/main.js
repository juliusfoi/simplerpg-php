function IrontouchGameSetup(){
	$('#loadingBattle').hide();
	$('#attack-button').live('click', function(){
		loadingBattle();
	    $.getJSON('/monster/attack/id/1', function(data) {
	        //alert(data); //uncomment this for debug
	        //alert (data.item1+" "+data.item2+" "+data.item3); //further debug
	        console.log(data.updatedValues.player);
	        loadingBattleFinished(data);
	        
	    });
	});
}