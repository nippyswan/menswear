var id=0;

function addElement(html,id){

	var one=document.getElementById("one0");

	var newElement = document.createElement("div");
    newElement.setAttribute('id',id);
    newElement.setAttribute('class',"form-group form-row");
    newElement.innerHTML = html;
    one.appendChild(newElement);
	
}

function delItem(did){

    var elem = document.getElementById(did);
showItem(0);
elem.remove();

}


function addItem() {
	id++;
       var html = '<div class="col-md-2"><input id="code'+id+'" type="text" class="form-control form-control-sm" name="code[]" oninput="showItem('+id+')" required autofocus autocomplete="off"></div><div class="col-md-1"><input id="qty'+id+'" type="number" min="1" class="form-control form-control-sm" name="qty[]" required oninput="showItem('+id+')"><button onclick="delItem('+id+')">delete</button></div><input type="hidden" name="sps[]" id="sps'+id+'" /><div class="col-md-3" id="txtItem'+id+'"></div><div class="col-md-3"><span id="sptag'+id+'"></span> <span id="sp'+id+'"></span></div>';
    addElement(html,id);
}

