(function(){
	var forms = document.querySelectorAll(".borrowForm");

	for (var i = 0; i < forms.length; i++) {
		forms[i].addEventListener('submit', function(event) {
			event.preventDefault();

			var is_borrowed = this.getAttribute('data-status') == 1 ? 1 : 0;
			var book_id = this.getAttribute('data-bookId');

			console.log(is_borrowed);

			if (is_borrowed) {
				// do return
				var return_url = "books/" + book_id + "/return";
				$.post(return_url, {
					book_id: book_id
				})
				.done(function() {
					window.location.href = "/books";
				})
				console.log("doing return here");
			} else {
				// do borrow
				var user_id = prompt("Enter user id");

				if (user_id != null) {
					var borrow_url = "books/" + book_id + "/borrowAs/" + user_id;

					$.post(borrow_url, {
						book_id: book_id,
						user_id: user_id
					})
					.done(function() {
						window.location.href = "/books";
					}).fail(function() {
						console.error("POST attempt to", borrow_url, "failed");
					});
				} 
			}



		});
	}
}());
