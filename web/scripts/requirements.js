function Requirements()
{
	this.verify = function(callbackFunction)
	{
		//Verify the requirements
		
		callback = callbackFunction;
		
		$.get('index.php', {'id':'requirements'}, requirementsHandler);
		
		$.get('index.php', {'id':'requirements_template'}, requirementsTemplateHandler);
	};
	
	var requirements;
	var requirementsTemplate;
	var callback;
	
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
		window.requirementsCount = 0;
		
		for(requirement in window.requirements)
		{
			window.requirementsCount++;
		}
		
		for(requirement in window.requirements)
		{
			$.get('index.php', {'id':'check_requirement|' + requirement }, verifyRequirement);
		}
	};
	
	var verifyRequirement = function(data)
	{
		json = new JSON();
		results = json.decode(data);
		
		window.requirementsPassed = 0;
		
		for(result in results)
		{
			if(results[result])
			{
				$('#requirement_' + result).html($('#requirement_' + result).html() + ' [PASSED]');
			}
			else
			{
				$('#requirement_' + result).html($('#requirement_' + result).html() + ' [FAILED]');
			}
			
			window.requirementsPassed ++;
		}
		
		console.log(window.requirementsCount);
		console.log(window.requirementsPassed);
		
		if(window.requirementsPassed >= window.requirementsCount)
		{
			console.log('All requirements verified.');
			callback();
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