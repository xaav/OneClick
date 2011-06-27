function JSON()
{
	this.encode = function(data)
	{
		//
	};
	
	this.decode = function(data)
	{
		return eval('(' + data + ')');
	};
}