function editableText(options = {}) {
  this.__URL__ = '/~nobilis/ProjetTut/index.php/';

  this.type = options.type || 'text';
  this.type_data = options.type_data || '';

  this.static_field = options.node;

  if(this.type == 'textarea') {
    console.log('caca');
    this.field = document.createElement('textarea');
    this.field.className = this.type_data;
  } else {
    this.field = document.createElement('input');
    this.field.className = this.type_data;
  }

  this.edit_b = options.button;


  this.send_b = document.createElement('span');
  this.send_b.className = 'fa fa-check';


  this.cancel_b = document.createElement('span');
  this.cancel_b.className = 'fa fa-times';

  this.group = document.createElement('span');
  this.group.append(this.send_b);
  this.group.append(this.cancel_b);


  this.URL = options.url;



  this.init = function() {

  }

  this.send = function(e) {
    let text = this.field.value;
    console.log(text);
    var x = new XMLHttpRequest();
    x.open('POST', this.URL);
    //x.setRequestHeader('Content-Type', 'application/json');
    x.onload = (function() {
        if (x.status === 200) {
            this.response(JSON.parse(x.responseText));
        }
    }).bind(this);

    x.send(JSON.stringify({'data' : text}));
  }

  this.cancel =  function(e) {
    parent = this.group.parentElement


    parent.replaceChild(this.edit_b, this.group);


    parent = this.field.parentElement;
    parent.replaceChild(this.static_field, this.field);
  }

  this.edit =  function(e) {
    parent = this.edit_b.parentElement;

    parent.replaceChild(this.group, this.edit_b);



    parent = this.static_field.parentElement;
    parent.replaceChild(this.field, this.static_field);
    this.field.value = this.static_field.innerHTML.replace(/<br>/g, "\r");

  }

  this.response = function(data) {
    this.static_field.innerHTML = data.data;
    this.cancel()
  }

  this.input = function(e) {
    if(e.keyCode == 13)
      this.send();
  }

  this.init();

  this.cancel_b.addEventListener('click', this.cancel.bind(this));
  this.send_b.addEventListener('click', this.send.bind(this));
  this.edit_b.addEventListener('click', this.edit.bind(this));
  if(this.type == 'text')
    this.field.addEventListener('keydown', this.input.bind(this));


  return {

  };
}
