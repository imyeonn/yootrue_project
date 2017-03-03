"use strict";
var interval = 3000;
var numberOfBlocks = 9;
var numberOfTarget = 3;
var targetBlocks = [];
var selectedBlocks = [];
var timer;

document.observe('dom:loaded', function(){
	$("start").observe("click",stopToStart);
	$("stop").observe("click",stopGame);
});

function stopToStart(){

    stopGame();
    startToSetTarget();
}

function stopGame(){
	$("state").innerHTML="Stop";
	$("answer").innerHTML="0/0";
	var blocks=$$(".block");
	for(var i=0;i<numberOfBlocks;i++){
		blocks[i].removeClassName("target");
		blocks[i].removeClassName("selected");
	}
	clearTimeout(timer);
	timer=0;
	targetBlocks=[];
	selectedBlocks=[];
}

function startToSetTarget(){
	$("state").innerHTML="Ready!";
	timer=0;
	targetBlocks=[];
	selectedBlocks=[];
	timer=setTimeout(setTargetToShow,interval);
}

function setTargetToShow(){
	$("state").innerHTML="Memorize!";
	var blocks=$$(".block");	
	for(var i=0;i<numberOfTarget;i++){
		var s = Math.floor(Math.random()*9);
		while(blocks[s].hasClassName("target")){
			s=Math.floor(Math.random()*9);
		}
		targetBlocks[i]=s;

		blocks[s].addClassName("target");
	}
	timer=setTimeout(showToSelect,interval);

}

function showToSelect(){
	$("state").innerHTML="Select!";
	var blocks=$$(".block");	
	var i;
	for(i=0;i<numberOfTarget;i++){
		blocks[targetBlocks[i]].removeClassName("target");
	}
	$("blocks").observe("click",function(event){
		var k;

		if(selectedBlocks.length+1>numberOfTarget){
		}
		else{
			var se=event.element().getAttribute("data-index");
			for(k=0;k<selectedBlocks.length;k++){
				if(selectedBlocks[k]==se){
					selectedBlocks.length=k;
					break;
				}
			}
			blocks[se].addClassName("selected");
			selectedBlocks[selectedBlocks.length]=se;
		}
	});
	/*for(i=0;i<numberOfBlocks;i++){
		blocks[i].observe("click",setSelect);
	}*/
	setTimeout(selectToResult,interval);
}

function selectToResult(){
	$("state").innerHTML="Checking";
	var blocks=$$(".block");	
	var i,j;
	var result=$("answer").innerHTML;
	var result1=result.split("/");
	var cor=result1[0];
	var tot=result1[1];
	for(i=0;i<selectedBlocks.length;i++){
		if(blocks[selectedBlocks[i]].hasClassName("selected")){
			blocks[selectedBlocks[i]].removeClassName("selected");
		}
	}
	for(i=0;i<numberOfTarget;i++){
		for(j=0;j<selectedBlocks.length;j++){
			if(targetBlocks[i]==selectedBlocks[j]){
				cor++;
			}
		}
		tot++;
	}
	result = cor+"/"+tot;
	$("answer").innerHTML=result;
	$("blocks").stopObserving();
	
	setTimeout(startToSetTarget,interval);


}
/*function setSelect(){
	var i,j,k;

	if(j>numberOfTarget){
	}
	else{
		for(k=0;k<j;k++){
			if(selectedBlocks[k]==i){
				break;
			}
		}
		selectedBlocks[j]=i;
		blocks[selectedBlocks[i]].addClassName("selected");
		j++;
	}

}*/