function PrintDoc() {

        document.getElementById("hid").style.visibility = "hidden";
        document.getElementById("hid1").style.visibility = "hidden";
         document.getElementById("hidb").style.visibility = "hidden";
        window.print();
        //setTimeout("window.close()", 100000); 
        //setTimeout(function(){window.close();    }, 100000); 

        document.getElementById("hid").style.visibility = "visible";
        document.getElementById("hid1").style.visibility = "visible";
         document.getElementById("hidb").style.visibility = "visible";


    }
  
 