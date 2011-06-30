function OneClick()
{
	var requirementsDone = function()
	{
		console.log('Callback: requirementsDone');
		
		Install(installerDone);
	};
	
	var installerDone = function()
	{
		$.get(makeUrl('getFinishedTemplate'), function(data) {
			
			$('body').fadeOut(function(){
				
				$('#content').html(data);
				$('body').fadeIn();
			});
		});
	};
	
	this.dispatch = function()
	{		
		VerifyRequirements(requirementsDone);
	};
}

oneclick = new OneClick();
$(document).ready(oneclick.dispatch);

console.log(oneclick);