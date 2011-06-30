function VerifyRequirements(callback) {
	
	var requirements;
	var requirementsTemplate;
	
	var requirementsLoaded = function() {
		
		if(requirements && requirementsTemplate) {
			
			$('#content').fadeOut('fast', function() {
				
				$("#content").html(requirementsTemplate);
				
				for(requirement in requirements){
					
					$('<li />').attr('id','requirement_' + requirement)
					           .html(requirements[requirement])
					           .appendTo('#requirements');
				}
				
				$('#content').fadeIn('fast', function() {
					
					requirementsCount = 0;
					
					for(requirement in requirements)
					{
						requirementsCount++;
					}
					
					requirementsPassed = 0;
					
					for(requirement in requirements)
					{
						$.getJSON(makeUrl('check_requirement', [requirement]), function(results){					
							
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
								
								requirementsPassed ++;
							}
							
							console.log(window.requirementsCount);
							console.log(window.requirementsPassed);
							
							if(window.requirementsPassed >= window.requirementsCount)
							{
								console.log('All requirements verified.');
								callback();
							}
						});
					}
				});
			});
		}
	}
	
	$.getJSON(makeUrl('requirements'), function(data) {
		
		requirements = data;
		requirementsLoaded();
	});
	
	$.get(makeUrl('requirements_template'), function(data){
		
		requirementsTemplate = data;
		requirementsLoaded();
	});
}