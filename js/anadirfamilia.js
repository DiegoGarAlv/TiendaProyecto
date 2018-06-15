$("#formAnadirFamilia").submit(function(e){
    var bValido = true;
    var cod = document.getElementById("codigo").value.trim();
    var nom = document.getElementById("nombre").value.trim();
    
    var regexNum = /^[0-9]*$/;
    var regexLet = /[A-Za-z]/;    
    
    //Validacion codigo
    if(cod == "")
    {
        document.getElementById("codval").style.display=""; 
        document.getElementById("codval2").style.display="none";   
        bValido=false;             
    }
    else if(regexNum.test(cod) == false)
    {
        document.getElementById("codval").style.display="none";        
        document.getElementById("codval2").style.display="";  
        bValido=false;             
    }
    else
    {
        document.getElementById("codval").style.display="none";
        document.getElementById("codval2").style.display="none";                             
    }

    //validacion nombre
    if(nom == "")
    {
        document.getElementById("nomval").style.display="";
        document.getElementById("nomval2").style.display="none";           
        bValido=false;
    }
    else if(regexLet.test(nom) == false)
    {
        document.getElementById("nomval").style.display="none";        
        document.getElementById("nomval2").style.display="";  
        bValido=false;             
    }
    else
    {
        document.getElementById("nomval").style.display="none";
        document.getElementById("nomval2").style.display="none";           
    }     

    if(!bValido)
    {
        e.preventDefault();
    }
    else
    {
        document.getElementById("codval").style.display="none";
        document.getElementById("nomval").style.display="none";      
        
        document.getElementById("codval2").style.display="none";
        document.getElementById("nomval2").style.display="none"; 
    }     
});