//Copyright 2015 Pareto Software, LLC, released under an MIT license: http://opensource.org/licenses/MIT
$( document ).ready(function() {
		// var testimonial_ok=false;
		//Inputs that determine what fields to show
		var stage = $('#live_form input:radio[name=stage]');
		// var testimonial=$('#live_form input:radio[name=testimonial]');

		//Wrappers for all fields
		var early = $('#live_form textarea[name="early_questions"]').parent();
		var mid = $('#live_form textarea[name="mid_questions"]').parent();
		var completed = $('#live_form textarea[name="completed_questions"]').parent();
		// var testimonial_parent = $('#live_form #div_testimonial');
		// var thanks_anyway  = $('#live_form #thanks_anyway');
		var all=early.add(mid).add(completed);

		stage.change(function(){
			var value=this.value;
			all.addClass('hidden'); //hide everything and reveal as needed

			if (value == 'Early'){
				early.removeClass('hidden');
				// document.getElementById("early_questions").setAttribute("required",null);
				// document.getElementById("early_online").removeAttribute("required");

			}
			else if (value == 'Mid'){
				mid.removeClass('hidden');
				//alert("Hello! I am an alert box!!");

				// document.getElementById("early_questions").required = false;
				//document.getElementById("early_questions").removeAttribute("required");
				// document.getElementById("early_online").removeAttribute("required");
			}
			else if (value == 'Completed'){
				completed.removeClass('hidden');
			}
		});
});
