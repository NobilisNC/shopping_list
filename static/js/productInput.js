var productsInput = function(document, Ajax, deleteProduct, amoutButtons) {
  this.__URL__ = '/~nobilis/ProjetTut/index.php/';


  this.list = document.querySelector('#productsList');
  this.node = document.querySelector('#productsInput');
  if(this.list == null || this.node == null) {
    console.log('[ERROR] = No #productsList or #productsInput found')
    return;
  }

  this.field = this.node.querySelector('input#productsInputField');
  if(this.field == null) {
    this.field = document.createElement('input');
    this.field.idName = 'productsInputField';
    this.node.append(this.field);
  }

  this.tooltip_box = document.createElement('div');
  //this.tooltip_box.className = 'tooltip_trigger';
  this.tooltip  = document.createElement('div');
  //this.tooltip.className = 'tooltip'

  this.productsList = document.createElement('ul');
  this.tooltip.append(this.productsList);

  this.tooltip_box.append(this.tooltip);
  this.node.append(this.tooltip_box);

  this.products = [];
  this.selected = null;

  this.resetList = function() {
    this.products = [];
    this.selected = null;
    this.productsList.innerHTML =  '';
  }

  this.show = function(data) {
    this.resetList();
    products = data.names;

    products.forEach(function(p) {
      let line = document.createElement('li');
      line.innerHTML = p.name;
      line.dataset.internal_id = p.id;
      productsList.append(line);
    });

    if(products.length > 0)
      this.select();
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
    x.open('GET', this.__URL__ + 'home/list/' + this.list.dataset.list_id + '/addProduct/'+ id_prod, true);
    x.onload = function() {
      if (x.status === 200) {
          this.add(JSON.parse(x.responseText));
      }
    }.bind(this);
    x.send();
  }

  this.add = function(data) {
    if(data.status == true) {
      let row   = this.list.insertRow(this.list.rows.length - 1);
      let cell1 = row.insertCell();
      let cell2 = row.insertCell();
      let cell3 = row.insertCell();
      let span = document.createElement('span');
      span.dataset.product_id = data.product.id;
      span.className = 'fa fa-trash';
      span.addEventListener('click', deleteProduct.delete.bind(this));

      cell1.innerHTML = data.product.name;
      cell2.innerHTML = 1;
      cell3.append(span);
      row.dataset.product_id = data.product.id;
      row.className = 'product';

      amoutButtons.add(row);

      k$.growl({
        text  : 'Le produit : ' + data.product.name + ' a été ajouté',
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

  return {

  };

}(document, Ajax, deleteProduct, amoutButtons)
