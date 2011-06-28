
function OneClick()
{
	var requirementsDone = function()
	{
		console.log('Callback: requirementsDone');
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