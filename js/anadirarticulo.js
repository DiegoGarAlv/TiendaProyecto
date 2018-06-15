$("#formAnadirArticulos").submit(function(e){
    var bValido = true;
    var cod = document.getElementById("codigo").value.trim();
    var nom = document.getElementById("nombre").value.trim();
    var nomcor = document.getElementById("nombreCorto").value.trim();
    var des = document.getElementById("descripcion").value.trim();
    var pre = document.getElementById("precio").value.trim();
    var fam = document.getElementById("familia").value.trim();
    var sto = document.getElementById("stock").value.trim();
    var ima = document.getElementById("imagen").value.trim();
    
    var regexNum = /^[0-9]*$/;
    var regexLet = /[A-Za-z]/;
    var regexCor = /^[A-Za-z]{3}$/;
    
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

    //validacion nombre corto
    if(nomcor == "")
    {
        document.getElementById("nomcorval").style.display="";
        document.getElementById("nomcorval2").style.display="none";        
        bValido=false;
    }
    else if(regexCor.test(nomcor) == false)
    {
        document.getElementById("nomcorval").style.display="none";
        document.getElementById("nomcorval2").style.display="";        
        bValido=false;
    }
    else
    {
        document.getElementById("nomcorval").style.display="none";
        document.getElementById("nomcorval2").style.display="none";        
    }

    //validacion descripcion
    if(des == "")
    {
        document.getElementById("desval").style.display="";
        bValido=false;
    }
    else
    {
        document.getElementById("desval").style.display="none";
    }

    //validacion precio
    if(pre == "")
    {
        document.getElementById("preval").style.display="";
        document.getElementById("preval2").style.display="none";
        bValido=false;
    }
    else if(regexNum.test(pre) == false)
    {
        document.getElementById("preval").style.display="none";
        document.getElementById("preval2").style.display="";
        bValido=false;
    }
    else
    {
        document.getElementById("preval").style.display="none";
        document.getElementById("preval2").style.display="none";
    }

    //validacion familia
    if(fam == 0)
    {
        document.getElementById("famval").style.display="";
        bValido=false;
    }
    else
    {
        document.getElementById("famval").style.display="none";
    }

    //validacion stock
    if(sto == "")
    {
        document.getElementById("stoval").style.display="";
        document.getElementById("stoval2").style.display="none";
        bValido=false;
    }
    else if(regexNum.test(sto) == false)
    {
        document.getElementById("stoval").style.display="none";
        document.getElementById("stoval2").style.display="";
        bValido=false;
    }
    else
    {
        document.getElementById("stoval").style.display="none";
        document.getElementById("stoval2").style.display="none";
    }

    //validacion imagen
    if(ima == "")
    {
        document.getElementById("imgval").style.display="";
        bValido=false;
    }
    else
    {
        document.getElementById("imgval").style.display="none";
    }

    if(!bValido)
    {
        e.preventDefault();
    }
    else
    {
        document.getElementById("codval").style.display="none";
        document.getElementById("nomval").style.display="none";
        document.getElementById("nomcorval").style.display="none";
        document.getElementById("desval").style.display="none";
        document.getElementById("preval").style.display="none";
        document.getElementById("famval").style.display="none";
        document.getElementById("stoval").style.display="none";
        document.getElementById("imgval").style.display="none"; 
        
        document.getElementById("codval2").style.display="none";
        document.getElementById("nomval2").style.display="none";
        document.getElementById("nomcorval2").style.display="none";        
        document.getElementById("preval2").style.display="none";        
        document.getElementById("stoval2").style.display="none";
        document.getElementById("imgval2").style.display="none"; 
    }    
});