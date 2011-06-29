function Install(callback) {
	
	$('body').fadeOut('fast', function() {
		
		$.getJSON(formulateUrl('getInstallerSteps'), function(steps) {
			
			names = [];
			
			for(step in steps) {
				
				names.push(step);
			}
			
			current = 0;
			
			var processNextStep = function () {
				$.getJSON(formulateUrl('processInstallerStepByName', [names[current]]), function(data) {
					current++;
					
					if(typeof(names[current]) != 'undefined') {
							processNextStep();
					}
					else {
						callback();
					}
				});
			}
			processNextStep();
			
		});
	});
}