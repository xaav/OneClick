
function Installer()
{
	var callback;
	
	var fadeOutDone = function()
	{
		alert('hello');
	};
	
	this.install = function(callbackFunction)
	{
		callback = callbackFunction;
		$('body').fadeOut('fast', fadeOutDone);
	};
}