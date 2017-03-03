"use strict";

document.observe("dom:loaded", function() {
	/* Make necessary elements Dragabble / Droppables (Hint: use $$ function to get all images).
	 * All Droppables should call 'labSelect' function on 'onDrop' event. (Hint: set revert option appropriately!)
	 * 필요한 모든 element들을 Dragabble 혹은 Droppables로 만드시오 (힌트 $$ 함수를 사용하여 모든 image들을 찾으시오).
	 * 모든 Droppables는 'onDrop' 이벤트 발생시 'labSelect' function을 부르도록 작성 하시오. (힌트: revert옵션을 적절히 지정하시오!)
	 */
	var images = $$("#labs > img");

	for(var i=0; i<images.length; i++) {
		new Draggable(images[i], {revert: true});
	}

	Droppables.add("selectpad",{onDrop:labSelect});
	Droppables.add("labs", {onDrop: labSelect});
});
	
	
	
	
	

function labSelect(drag, drop, event) {
	/* Complete this event-handler function 
	 * 이 event-handler function을 작성하시오.
	 */

	var num = $$("#selectpad > img").length;

	if(drop.id == "selectpad" ) {
		if(drag.parentNode.id == "labs"){
			if(num < 3) {
				drop.appendChild(drag);	
				var li = document.createElement("li");
				
				li.innerHTML = drag.alt;
				$("selection").appendChild(li);
				$("selection").lastChild.pulsate({
					delay: 0.5,
					duration: 1.0
				});

			}
		}	
		else{						
			
		}	
	}

	if(drop.id == "labs" ) {
		if(drag.parentNode.id == "selectpad"){
			drop.appendChild(drag);
			var liall = $$("#selection > li");												
			var tmp;
			for(var i=0; i<liall.length; i++) {
				if(drag.alt == liall[i].innerHTML) {
					$("selection").removeChild($("selection").childNodes[i]);	
				}
			}
		}
		else{
			
		}

	}

	
	
	
}

