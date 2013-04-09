(function ($) {
	Drupal.behaviors.myBehavior = {
		attach: function (context, settings) {
			// Code starts
			$('body').click(function() {
				alert('Hello world');
			});
			// Code ends
		}
	};
})(jQuery);
