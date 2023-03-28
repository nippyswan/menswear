

function showItem(gid) 
{

  var xhttp;
  
  var codeid="code"+gid;
  var qtyid="qty"+gid;
 
  var txtItemid="txtItem"+gid;
  var spid="sp"+gid;
  var sptagid="sptag"+gid;
  
  var code = document.getElementById(codeid).value;
   

  if (code.length == 0) 
  { 
    document.getElementById(txtItemid).innerHTML = "";
    var j;
    var total=0;
    var spch=[];
    var spnum=[];

    for(j=0;j<=id;j++)
    {
      var child=document.getElementById("sp"+j);
      var chk=document.getElementById("one0").contains(child);
      if(chk==true)
      {
        spch[j]=document.getElementById("sp"+j).innerHTML;
        if(spch[j]!=="")
        {
          spnum[j]=parseFloat(spch[j]);
          total=total+spnum[j]; 
        }           
      }
             
    }

    var total2=total.toFixed(2);
   
    document.getElementById("total").innerHTML = 
    "<h5>Total Amount: "+total2+"</h5>";
    
  }

  var qty = document.getElementById(qtyid).value;
  
      

  if(code!=="")
  {
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() 
    {
    
      if (this.readyState == 4 && this.status == 200) 
      {

        var rtxt=this.responseText;
        var pos = rtxt.search(":");
          
        var cp = rtxt.slice(pos);
        var i,m="0";
        for(i=0;i<cp.length;i++)
        {
          if(cp[i]==="0"||cp[i]==="1"||cp[i]==="2"||cp[i]==="3"||cp[i]==="4"||cp[i]==="5"||cp[i]==="6"||cp[i]==="7"||cp[i]==="8"||cp[i]==="9")
            m=m+cp[i];

        }

        var mpn=parseInt(m);
        if(qty!==""&&rtxt!=="<span style=\"color:red;\">No Item Found!</span>")
        { 
      
          var sp=mpn*qty;
          var sp2=sp.toFixed(2);
        
          document.getElementById(sptagid).innerHTML = 
          "<strong>Total Amount: </strong>";
          document.getElementById(spid).innerHTML = sp2;
           document.getElementById("sps"+gid).value = sp2;
          
          var j;
          var total=0;
          var spch=[];
          var spnum=[];

          for(j=0;j<=id;j++)
          {
            var child=document.getElementById("sp"+j);
            var chk=document.getElementById("one0").contains(child);
            if(chk==true)
            {
              spch[j]=document.getElementById("sp"+j).innerHTML;
              if(spch[j]!=="")
              {
                spnum[j]=parseFloat(spch[j]);
                total=total+spnum[j]; 
              }           
            }
             
          }

          var total2=total.toFixed(2);
   
          document.getElementById("total").innerHTML = 
          "<h5>Total SP: "+total2+"</h5>";
     

        }
        else 
        {
          document.getElementById(sptagid).innerHTML = ""; 
          document.getElementById(spid).innerHTML = "";
          document.getElementById("sps"+gid).value = "";
          
          document.getElementById("total").innerHTML = "";    
        }  
        document.getElementById(txtItemid).innerHTML = rtxt;
      
       

      }
    };
    xhttp.open("GET", "shareShow/"+code, true);
    xhttp.send();  
   
    
  }
  else
 
  {
    document.getElementById(txtItemid).innerHTML ="";
    document.getElementById(spid).innerHTML = "";
    document.getElementById("sps"+gid).value = "";
   
  }
  

} 
