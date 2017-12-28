/**
 * 
 */

function code() {
	var pan=document.getElementById('pan');
pan.onclick=function() {
	this.src="code.php?tm="+Math.random();
}
}
 	
