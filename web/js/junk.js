Function.prototype.defaults = function()
{
  var _f = this;
  var _a = Array(_f.length-arguments.length).concat(
    Array.prototype.slice.apply(arguments));
  return function()
  {
    return _f.apply(_f, Array.prototype.slice.apply(arguments).concat(
      _a.slice(arguments.length, _a.length)));
  }
}

var formulateUrl = function(func,params)
{
	var url = 'index.php?id=' + func + '|';
	
	for(param in params) {
		url += params[param] + '|';
	}
	
	return url;
	
}.defaults([]);