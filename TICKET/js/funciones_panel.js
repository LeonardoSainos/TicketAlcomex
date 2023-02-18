function PasarValor()
{
document.getElementById("fecha").value = document.getElementById("fech").value;
}



const MarcarCheckBox = (validar) =>{
  var checkBox = document.getElementsByTagName('input');
  for( i=0;i<=checkBox.length; i++)
    {
        if(checkBox[i].type == "checkbox"){
            checkBox[i].checked= validar.checked;
        }
    }
}

 

function funcion_reiniciar( x)
{
	document.getElementById(x).reset();
}

 
 
 