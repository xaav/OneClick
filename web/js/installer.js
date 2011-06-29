
function Installer()
{
	var callback;
	
	var fadeOutDone = function()
	{
		
	};
	
	this.install = function(callbackFunction)
	{
		callback = callbackFunction;
		$('body').fadeOut('fast', fadeOutDone);
	};
}