 var Ajax = (function(options  = {}) {
   /**
     * options {
     *    url
     *    data
     *    success
     *   }
     *
     **/
  this.post = function(options) {
    var xhr = new XMLHttpRequest();
    xhr.open('POST', options.url);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.onload = function() {
        if (xhr.status === 200) {
            options.success(JSON.parse(xhr.responseText));
        }
    };

    xhr.send(JSON.stringify(options.data));
  }


  return {
    post: this.post
  }
})()
