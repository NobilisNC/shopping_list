
  var name_bar    = document.getElementById("title");
  var list_name   = document.getElementById("listName");
  var edit_button = document.getElementById("nameEdit");

  var input_name = document.createElement('input');
  input_name.defaultValue = list_name.innerHTML;

  var send_name_button = document.createElement('i');
  send_name_button.className = "fa fa-check";
  send_name_button.onclick = sendName;

  var cancel_button = document.createElement('i');
  cancel_button.className = "fa fa-times";
  cancel_button.onclick = resetName;


  edit_button.onclick = editName;


  function editName() {
      while (name_bar.firstChild) name_bar.removeChild(name_bar.firstChild);
      name_bar.appendChild(input_name);
      name_bar.appendChild(send_name_button);
      name_bar.appendChild(cancel_button);


  }

  function resetName() {
    while (name_bar.firstChild) name_bar.removeChild(name_bar.firstChild);
    name_bar.appendChild(list_name);
    name_bar.appendChild(edit_button);
  }

  function sendName() {
    var new_name = input_name.value;

    var xhr = new XMLHttpRequest();
    xhr.open('POST', '{site_url()}/home/list/{$list->id}/changeName');
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.onload = function() {
        if (xhr.status === 200) {
            changeName(JSON.parse(xhr.responseText));
        }
    };

    xhr.send(JSON.stringify(
        { 'new_name' : new_name}


    ));


      resetName();
  }


  function changeName(data) {
    listName.innerHTML = data.name;
  }
