var deleteProduct = function(document) {
  this.__URL__ = '/PTUT/shopping_list/index.php/';
  this.list = document.querySelector('#productsList');
  console.log(this.list);

  this.init = function() {
    nodes = document.querySelectorAll(".deleteProduct");

    nodes.forEach(function(n) {
      n.addEventListener('click', send_del);
    })
  }

  this.send_del = function(e) {
    let x = new XMLHttpRequest();
    x.open('GET', __URL__ + 'home/list/' + list.dataset.list_id + '/deleteProduct/'+ e.target.dataset.product_id, true);
    x.onload = function() {
      if (x.status === 200) {
          del(JSON.parse(x.responseText));
      }
    }
    x.send();

  }

  this.del = function(data) {
    console.log(data);
    if(data.status == true) {
      let i = 1;


      for(; this.list.rows[i].dataset.product_id != data.product.id; i++)
        ;

      this.list.deleteRow(i);

      k$.growl({
        text  : 'Le produit : ' + data.product.name + ' a été supprimé',
        delay : 2000,
        type  : 'alert-green'
      });

    } else {
      k$.growl({
        text  : 'Erreur lors de la supression du produit',
        delay : 2000,
        type  : 'alert-red'
      });
    }
  }

  this.init();

  return {
    'delete' : this.send_del
  }
}(document)


var amoutButton = function(options = {}) {
  this.node = options.node;
  this.id_product = options.product;
  this.action = options.action;


  return {

  };
}
