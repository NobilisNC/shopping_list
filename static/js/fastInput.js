var fastInput = function(options = {}) {
  this.node = options.node || document.querySelector('.fastInput');
  if(this.node == undefined)
    return undefined;

  this._onKeyDown = function(e) {
      if(e.keyCode == 13 ) {
        
      }
  }


  return {

  };
}
