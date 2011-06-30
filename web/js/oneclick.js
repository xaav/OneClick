function OneClick()
{
	var requirementsDone = function()
	{
		console.log('Callback: requirementsDone');
		
		Install(installerDone);
	};
	
	var installerDone = function()
	{
		console.log('Callback: installerDone');
	};
	
	this.dispatch = function()
	{		
		VerifyRequirements(requirementsDone);
	};
}

oneclick = new OneClick();
$(document).ready(oneclick.dispatch);

console.log(oneclick);