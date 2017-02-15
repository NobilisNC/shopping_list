var deleteProduct = function(document) {
  this.__URL__ = '/~nobilis/ProjetTut/index.php/';
  this.list = document.querySelector('#productsList');


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
}(document);


var amoutButtons = function(document) {
  this.__URL__ = '/~nobilis/ProjetTut/index.php/';

  this.list = document.querySelector('#productsList');

  this.init = function(){
    nodes = document.querySelectorAll(".product");
    nodes.forEach(function(n) {
      createButtons(n.children[1]);
    });


  }

  this.createButtons = function(node) {
    buttonSub = document.createElement('button');
    buttonAdd = document.createElement('button');
    amount = document.createElement('span');
    amount.innerHTML = node.innerHTML;
    node.innerHTML = '';
    buttonSub.className = 'button';
    buttonAdd.className = 'button';
    buttonSub.innerHTML = '-';
    buttonAdd.innerHTML = '+';


    node.insertBefore(buttonSub, node.firstChild);
    node.append(amount);
    node.append(buttonAdd);

    buttonAdd.addEventListener('click', this.send_addAmount);
    buttonSub.addEventListener('click', this.send_subAmount);


  }

  this.add = function(row) {
    createButtons(row.children[1]);

  }

  this.send_addAmount = function(e) {
    let amount = e.target.previousSibling.innerHTML;
    amount ++;
    let x = new XMLHttpRequest();
    x.open('GET', __URL__ + 'home/list/' + list.dataset.list_id + '/product/'+ e.target.parentElement.parentElement.dataset.product_id + '/amount/' + amount, true);
    x.onload = function() {
      if (x.status === 200) {
          setAmount(JSON.parse(x.responseText), e.target.previousSibling);
      }
    }
    x.send();


  }

  this.send_subAmount = function(e) {
    let amount = e.target.nextSibling.innerHTML;
    if(amount == 1) {

      return;
    }

    amount --;

    let x = new XMLHttpRequest();
    x.open('GET', __URL__ + 'home/list/' + list.dataset.list_id + '/product/'+ e.target.parentElement.parentElement.dataset.product_id + '/amount/' + amount, true);
    x.onload = function() {
      if (x.status === 200) {
          setAmount(JSON.parse(x.responseText), e.target.nextSibling);
      }
    }
    x.send();

  }

  this.setAmount = function(data, node) {
    if(data.status == true)
      node.innerHTML = data.amount;
  }

  this.init();

  return {
    add : this.add
  };
}(document);
