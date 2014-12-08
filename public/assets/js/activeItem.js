(function(){
	var active = location.pathname.match(/\/(\w+)\/?/)[1];
	var links = document.querySelectorAll("li a");

	for (var i = 0; i < links.length; i++) {
		if(links[i].textContent.toLowerCase() == active) 
			links[i].parentNode.classList.add("active");
	}
}());
