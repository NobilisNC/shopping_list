var productsInput = function(options = {}) {
  this.__URL__ = window.__URL__;


  this.list = document.querySelector('#productsList');
  this.node = document.querySelector('#productsInput');
  if(this.list == null || this.node == null) {
    console.log('[ERROR] = No #productsList or #productsInput found')
    return;
  }

  this.layout = document.createElement('div');
  this.layout.className = 'layout_abs';

  this.node.append(this.layout);

  this.field = this.node.querySelector('input#productsInputField');
  if(this.field == null) {
    this.field = document.createElement('input');
    this.field.idName = 'productsInputField';
    this.layout.append(this.field);
  }

  this.tooltip_box = document.createElement('div');
  this.tooltip_box.className = 'tooltip_box';


  this.productsList = document.createElement('ul');
  this.tooltip_box.append(this.productsList);

  this.layout.append(this.tooltip_box);

  this.products = [];
  this.selected = null;

  this.resetList = function() {
    this.products = [];
    this.selected = null;
    this.productsList.innerHTML =  '';
    this.tooltip_box.className = "no";
  }

  this.show = function(r) {
    this.resetList();

    if(r.status) {
    products = r.data.names;

    products.forEach(function(p) {
      let line = document.createElement('li');
      line.innerHTML = p.name;
      line.dataset.internal_id = p.id;

      this.productsList.append(line);
    }.bind(this));

    if(products.length > 0) {
      this.select();
      this.tooltip_box.className = '';
    }


  } else {
    console.log('Error');
  }

  }

  this.select = function(id) {
    this.selected = id || 0;
    this.productsList.childNodes.forEach(function(li){
      li.className = '';
    });

    this.productsList.children[this.selected].className = "selected";

  }

  this.send_action = function() {
      let id_prod = this.productsList.children[this.selected].dataset.internal_id;

      this.action(id_prod)

      this.resetList();
      this.field.value ='';
  }

  this.action = options.action;

  this._input = function(e) {
    if(e.target.value == '') {
      this.resetList();
      return;
    }
    let x = new XMLHttpRequest();
    x.open('GET', this.__URL__ + 'product/get/' + e.target.value, true);
    x.onload = function() {
      if (x.status === 200) {
          this.show(JSON.parse(x.responseText));
      }
    }.bind(this);
    x.send();
  }

  this._onKeyDown  = function(e) {

    if(e.keyCode == 13) {// Enter
      this.send_action();
    } else if (e.keyCode == 38 && this.selected > 0 && this.selected != null) { //up
      this.select(this.selected - 1);
    } else if (e.keyCode == 40 && this.selected < this.productsList.childElementCount - 1 && this.selected != null) { //Down
      this.select(this.selected + 1);

    }
   }



  this.field.addEventListener('input', this._input.bind(this));
  this.field.addEventListener('keydown', this._onKeyDown.bind(this));
  this.resetList();

  return {

  };

};
