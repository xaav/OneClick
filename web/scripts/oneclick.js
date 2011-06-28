
function OneClick()
{
	this.dispatch = function()
	{		
		requirements = new Requirements();
		requirements.verify();
		
		
	};
}

oneclick = new OneClick();
$(document).ready(oneclick.dispatch);

console.log(oneclick);