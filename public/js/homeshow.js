

function showItem(gid) 
{

  var xhttp;
  var tyid="ty"+gid;
  var codeid="code"+gid;
  var qtyid="qty"+gid;
  var dscid="dsc"+gid;
  var txtItemid="txtItem"+gid;
  var spid="sp"+gid;
  var sptagid="sptag"+gid;
  var ty = document.getElementById(tyid).value;
  var code = document.getElementById(codeid).value;
   
 if(ty===".0")
{
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
    "<h5>Total SP: "+total2+"</h5>";
    
  }

  var qty = document.getElementById(qtyid).value;
  var dsc = document.getElementById(dscid).value;  
      

  if(code!=="")
  {
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() 
    {
    
      if (this.readyState == 4 && this.status == 200) 
      {

        var rtxt=this.responseText;
        var pos = rtxt.search(":");
          
        var mp = rtxt.slice(pos);
        var i,m="0";
        for(i=0;i<mp.length;i++)
        {
          if(mp[i]==="0"||mp[i]==="1"||mp[i]==="2"||mp[i]==="3"||mp[i]==="4"||mp[i]==="5"||mp[i]==="6"||mp[i]==="7"||mp[i]==="8"||mp[i]==="9")
            m=m+mp[i];

        }

        var mpn=parseInt(m);
        if(qty!==""&&dsc!==""&&rtxt!=="<span style=\"color:red;\">No Item Found!</span>")
        { 
      
          var sp=(mpn-dsc)*qty;
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
    xhttp.open("GET", "homeShow/"+code, true);
    xhttp.send();  
   
    
  }
  else
 
  {
    document.getElementById(txtItemid).innerHTML ="";
    document.getElementById(spid).innerHTML = "";
    document.getElementById("sps"+gid).value = "";
  }
  

} 
else
{
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
          "<h5>Total SP: "+total2+"</h5>";

  }

  var qty = document.getElementById(qtyid).value;
  var dsc = document.getElementById(dscid).value;  
      

  if(code!=="")
  {
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() 
    {
    
      if (this.readyState == 4 && this.status == 200) 
      {

        var rtxt=this.responseText;
        var pos = rtxt.search(":");
        
        var mp = rtxt.slice(pos);
        var i,m="0";
        for(i=0;i<mp.length;i++)
        {
          if(mp[i]==="0"||mp[i]==="1"||mp[i]==="2"||mp[i]==="3"||mp[i]==="4"||mp[i]==="5"||mp[i]==="6"||mp[i]==="7"||mp[i]==="8"||mp[i]==="9")
          m=m+mp[i];

        }

        var mpn=parseInt(m);
        if(qty!==""&&dsc!==""&&rtxt!=="<span style=\"color:red;\">No Item Found!</span>")
        { 
    
          var sp=(mpn*((100-dsc)/100))*qty;
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
    xhttp.open("GET", "homeShow/"+code, true);
    xhttp.send();  
   
  
  }
  else
  {
    document.getElementById(txtItemid).innerHTML ="";
    document.getElementById(spid).innerHTML = "";
    document.getElementById("sps"+gid).value = "";
  }
   
} 

}