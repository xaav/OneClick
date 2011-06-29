
function OneClick()
{
	var requirementsDone = function()
	{
		console.log('Callback: requirementsDone');
		
		installer = new Installer();
		installer.install(installerDone);
	};
	
	var installerDone = function()
	{
		console.log('Callback: installerDone');
	};
	
	this.dispatch = function()
	{		
		requirements = new Requirements();
		requirements.verify(requirementsDone);		
	};
}

oneclick = new OneClick();
$(document).ready(oneclick.dispatch);

console.log(oneclick);