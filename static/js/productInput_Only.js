var productsInput = function(document, window, deleteProduct, amoutButtons) {
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
    products = r.data.names;

    products.forEach(function(p) {
      let line = document.createElement('li');
      line.innerHTML = p.name;
      line.dataset.internal_id = p.id;
      productsList.append(line);
    });

    if(products.length > 0) {
      this.select();
      this.tooltip_box.className = '';
    }

  }

  this.select = function(id) {
    this.selected = id || 0;
    this.productsList.childNodes.forEach(function(li){
      li.className = '';
    });

    this.productsList.children[this.selected].className = "selected";

  }

  this.send_add = function() {
    let id_prod = this.productsList.children[this.selected].dataset.internal_id;

    let x = new XMLHttpRequest();
    x.open('GET', this.__URL__ + 'useList/' + this.list.dataset.list_id + '/add/'+ id_prod +'/amount/5', true);
    x.onload = function() {
      if (x.status === 200) {
          this.add(JSON.parse(x.responseText));
      }
    }.bind(this);
    x.send();
  }

  this.add = function(response) {
    if(response.status == true) {
      let row   = this.list.insertRow(this.list.rows.length - 1);
      let cell1 = row.insertCell();
      let cell2 = row.insertCell();
      let cell3 = row.insertCell();

      cell1.innerHTML = 'unckecked';
      cell2.innerHTML = response.data.product.name;
      cell3.innerHTML = 1;

      row.dataset.product_id = response.data.product.id;
      row.className = 'product';

      amoutButtons.add(row);

      k$.growl({
        text  : 'Le produit : ' + response.data.product.name + ' a été ajouté',
        delay : 2000,
        type  : 'alert-green'
      });

      this.resetList();
      this.field.value ='';

    } else {

      k$.growl({
        text  : 'Erreur lors de l\'ajout du produit',
        delay : 2000,
        type  : 'alert-red'
      });
    }
  }


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
      this.send_add();
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

}(document, window)
