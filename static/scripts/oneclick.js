
function OneClick()
{
	var requirements;
	var requirementsTemplate;
	
	/**
	 * Processes the requirements if the data has been retreived
	 */
	var checkRequirements = function()
	{
		console.log('Checking requirements...');
		
		console.log(this.requirements);
		console.log(this.requirementsTemplate);
		
		if(this.requirements && this.requirementsTemplate)
		{
			console.log('Loading requirements...');
			loadRequirements();
		}
	};
	
	var loadRequirements = function()
	{
		$('#content').fadeOut('fast', function() {
			
			$("#content").html(window.requirementsTemplate);
			
			for(requirement in window.requirements){
				
				$('<li />').attr('id','requirement_' + requirement)
				           .html(window.requirements[requirement])
				           .appendTo('#requirements');
			}
			
			$('#content').fadeIn('fast');
		});
	};
	
	var requirementsHandler = function(data)
	{
		console.log(data);
		
		json = new JSON();
		
		requirements = json.decode(data);
		checkRequirements();
	};
	
	var requirementsTemplateHandler = function(data)
	{
		requirementsTemplate = data;
		checkRequirements();
	};
	
	this.dispatch = function()
	{		
		$.get('index.php', {'id':'requirements'}, requirementsHandler);
		
		$.get('index.php', {'id':'requirements_template'}, requirementsTemplateHandler);
	};
}

oneclick = new OneClick();
$(document).ready(oneclick.dispatch);

console.log(oneclick);