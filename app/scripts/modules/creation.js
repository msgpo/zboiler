$(function() {

	//creation button clicked, hides itself, goes to step one
	$('.btn-create-bundle').click(function() {
		window.alert('create');
		$(this).fadeOut(100);
		$(".creation-create-group, .step-navigator").fadeIn();
	});
});
