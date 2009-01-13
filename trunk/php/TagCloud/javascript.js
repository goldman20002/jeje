function f_initialisation() {
	var screen_x = window.innerWidth;
	var screen_y = window.innerHeight;
	var div = document.getElementById("svg");
	div.setAttribute("width",screen_x+"px");
	div.setAttribute("height",screen_y+"px");
}
