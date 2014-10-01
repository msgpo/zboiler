define([
	'modules/creation'
], function(Creation) {
	
  var App = function(config) {

  };

  App.prototype = {
    init: function(config) {
      window.alert('app started');
    }
  };

  return App;
});
