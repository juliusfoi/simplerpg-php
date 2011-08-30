/*
 * 	Copyright 2011 by Julius Foitzik
 * 
   	This file is part of SimpleRPG.
 
    SimpleRPG is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    SimpleRPG is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with SimpleRPG.  If not, see <http://www.gnu.org/licenses/>.
*/

function updatePlayer(player){
	$("div.player").children("span.playerHealth").text("Health "+player.health).effect("highlight", {}, 3000);
	$("div.player").children("span.playerExperience").text("XP "+player.experience).effect("highlight", {}, 3000);
}

function updateMonster(monster){
	//$("div.monster").children("span.monsterName").text(monster.name+"  ").effect("highlight", {}, 3000);
	$("div.monster").children("span.monsterHealth").text(monster.health+"  ").effect("highlight", {}, 3000);
	//$("div.monster").children("span.monsterAttackDamage").text(monster.attackDamage+"  ").effect("highlight", {}, 3000);
}
function loadingBattle(){
	$('#loadingBattle').show();
}

function loadingBattleFinished(data){
	var player = data.updatedValues.player;
	var monster = data.updatedValues.monster;
	console.log(player);
	console.log(monster);
	updatePlayer(player);
	updateMonster(monster);
	$('#loadingBattle').hide();
}

function loadingTravel(){
	$('#loadingTravel').show();
}

function loadingTravelFinished(){
	$('#loadingTravel').hide();
}

function arrayToParamString(data){
	paramstring = '';
	for(param in data)
	{
		paramstring += '/'+data[param][0]+'/'+data[param][1];
	}
	return paramstring;
}

function Player(player){
	this.player = player;
}
Player.prototype.update = function updatePlayer(player){
	$("div.player").children("span.playerHealth").text("Health "+player.health).effect("highlight", {}, 3000);
	$("div.player").children("span.playerExperience").text("XP "+player.experience).effect("highlight", {}, 3000);
};
Player.prototype.heal = function healPlayer(player){
	return;
};

function URL(options){
	this.options = options;
}
/*URL.prototype.constructor = function(options){
	for(param in options.params){
		params += "/" + param.nam;
	}
	return "/" + options.controller + "/" + options.action + params;
};*/

function BattleConsole(){
	this.spell = new Object;
	this.spell.name = 'attack';
	this.player = new Object;
	this.player.id = '1';
	this.monster = new Object;
	this.monster.id = '1';
	this.messageStack = [];
	this.baseURI = '/monster/battle';
}

BattleConsole.prototype.update = function (){
	params = [ ['monsterId', this.monster.id], ['playerId', this.player.id], ['spellName', this.spell.name] ];
	params = this.baseURI + arrayToParamString(params);
	$.getJSON(params, function(data) {
		entry = '<div class="battleLogEntry">You hit the enemy for ' + data.updatedValues.damageDealt.toString() + ' damage!</div>';
		$(entry).appendTo($('.battleLogEntry:last'));
		//alert(entry);
    });
};
