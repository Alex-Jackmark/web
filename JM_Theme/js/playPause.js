function playPause(element) { 
	console.log("element = " + element);
	if (element.paused) 
		element.play(); 
	else 
		element.pause(); 
} 