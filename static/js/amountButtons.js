var amoutButtons = function(document) {
  this.__URL__ = '/~nobilis/ProjetTut/index.php/';

  this.list = document.querySelector('#productsList');

  this.init = function(){
    nodes = document.querySelectorAll(".product");
    nodes.forEach(function(n) {
      this.createButtons(n.children[1]);
    }.bind(this));


  }

  this.createButtons = function(node) {
    buttonSub = document.createElement('button');
    buttonAdd = document.createElement('button');
    amount = document.createElement('span');
    amount.innerHTML = node.innerHTML;
    amount.className = 'amount';
    node.innerHTML = '';
    buttonSub.className = 'button';
    buttonAdd.className = 'button';
    buttonSub.innerHTML = '-';
    buttonAdd.innerHTML = '+';


    node.insertBefore(buttonSub, node.firstChild);
    node.append(amount);
    node.append(buttonAdd);

    buttonAdd.addEventListener('click', this.send_addAmount.bind(this));
    buttonSub.addEventListener('click', this.send_subAmount.bind(this));

    this.updateButton(node)
  }

  this.add = function(row) {
    createButtons(row.children[1]);

  }

  this.send_addAmount = function(e) {
    let amount = e.target.previousSibling.innerHTML;
    amount ++;
    let x = new XMLHttpRequest();
    x.open('GET', this.__URL__ + 'home/list/' + this.list.dataset.list_id + '/product/'+ e.target.parentElement.parentElement.dataset.product_id + '/amount/' + amount, true);
    x.onload = function() {
      if (x.status === 200) {
          this.setAmount(JSON.parse(x.responseText), e.target.previousSibling);
      }
    }.bind(this);
    x.send();


  }

  this.send_subAmount = function(e) {
    let amount = e.target.nextSibling.innerHTML;
    if(amount == 1) {

      return;
    }


    amount --;

    let x = new XMLHttpRequest();
    x.open('GET', this.__URL__ + 'home/list/' + this.list.dataset.list_id + '/product/'+ e.target.parentElement.parentElement.dataset.product_id + '/amount/' + amount, true);
    x.onload = function() {
      if (x.status === 200) {
          setAmount(JSON.parse(x.responseText), e.target.nextSibling);
      }
    }.bind(this);
    x.send();

  }

  this.setAmount = function(data, node) {
    if(data.status == true)
      node.innerHTML = data.amount;

     this.updateButton(node.parentElement);
  }

  this.updateButton = function(node) {
    let amount = node.children[1].innerHTML;
    if (amount == 1)
      node.children[0].className = 'no';
    else
     node.children[0].className = '';
  }

  this.init();

  return {
    add : this.add
  };
}(document);
