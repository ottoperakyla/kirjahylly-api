(function(){
	var forms = document.querySelectorAll(".deleteForm");

	for (var i = 0; i < forms.length; i++) {
		forms[i].addEventListener('submit', function(event) {
			confirm("Are you sure?") ? this.submit() : event.preventDefault();
		});
	}
}());
