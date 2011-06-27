function Requirements()
{
	this.verify = function()
	{
		//Verify the requirements
		
		$.get('index.php', {'id':'requirements'}, requirementsHandler);
		
		$.get('index.php', {'id':'requirements_template'}, requirementsTemplateHandler);
	};
	
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
			
			$('#content').fadeIn('fast', verifyRequirements);
		});
	};
	
	var verifyRequirements = function()
	{
		for(requirement in window.requirements)
		{
			$.get('index.php', {'id':'check_requirement|' + requirement }, verifyRequirement);
		}
	};
	
	var verifyRequirement = function(data)
	{
		json = new JSON();
		results = json.decode(data);
		
		for(result in results)
		{
			if(results[result])
			{
				$('#requirement_' + result).html('PASSED');
			}
			else
			{
				$('#requirement_' + result).html('FAILED');
			}
		}
	};
	
	var requirementsHandler = function(data)
	{
		console.log(data);
		
		json = new JSON();
		
		window.requirements = json.decode(data);
		checkRequirements();
	};
	
	var requirementsTemplateHandler = function(data)
	{
		window.requirementsTemplate = data;
		checkRequirements();
	};
}