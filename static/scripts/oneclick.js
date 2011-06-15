
function checkRequirements()
{
	if(window.requirements && window.requirementsTemplate) {
		
		$('#content').fadeOut('fast', function() {
			
			$("#content").html(window.requirementsTemplate);
			
			for(requirement in window.requirements){
				
				$('<li />').attr('id','requirement_' + requirement)
				           .html(window.requirements[requirement])
				           .appendTo('#requirements');
			}
			
			$('#content').fadeIn('fast');
		});
	}
}


$(document).ready(function() {
	
	$.get('index.php', { id : "requirements" }, function (data) {
		
		window.requirements = eval(data);
		checkRequirements();
	});
	
	$.get('index.php', { id: 'requirements_template' }, function(data) {
		
		window.requirementsTemplate = data;
		checkRequirements();
	});
});