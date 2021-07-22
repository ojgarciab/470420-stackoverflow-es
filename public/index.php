<!doctype html>
<html lang="es">
  <head>
    <!-- Meta tags requeridos -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Reproducción del problema</title>
  </head>
  <body>
    <h1>Reproducción del problema</h1>
    <div id="listado"></div>
  </body>
  <script>
    fetch('xml.php')
        .then(respuesta => respuesta.text())
        .then(texto => (new window.DOMParser()).parseFromString(texto, "text/xml"))
        .then(xml => {
            console.log(xml);
            construirListado(xml);
        });
    function construirListado(oXML) {
        // Crear tabla
        var oTabla = document.createElement("table");
        oTabla.border = "3";
        var oTHead = oTabla.createTHead();
        var oFila = oTHead.insertRow(-1);
        
        var oTH = document.createElement("TH");
        oTH.textContent = "IDNoticia";
        oFila.appendChild(oTH);
        
        oTH = document.createElement("TH");
        oTH.textContent = "Título";
        oFila.appendChild(oTH);

        oTH = document.createElement("TH");
        oTH.textContent = "Autor";
        oFila.appendChild(oTH);

        oTH = document.createElement("TH");
        oTH.textContent = "Fecha";
        oFila.appendChild(oTH);
        
        /*
        oFila = oTHead.insertRow(-1);
        oTH = document.createElement("TH");
        oTH.textContent = "Descripción";
        oFila.appendChild(oTH);*/
                    
        var oTBody = oTabla.createTBody();      
        var oPersonas = oXML.querySelectorAll("documento");
        for (var i = 0; i < oPersonas.length; i++) {
            oFila = oTBody.insertRow(-1);

            var oCelda = oFila.insertCell(-1);
            oCelda.textContent = oPersonas[i].querySelector("idnotici").textContent;

            oCelda = oFila.insertCell(-1);
            oCelda.textContent = (oPersonas[i].querySelector("titul").textContent);                            
        
            oCelda = oFila.insertCell(-1);
            oCelda.textContent = (oPersonas[i].querySelector("auto").textContent);

            oCelda = oFila.insertCell(-1);
            oCelda.textContent = (oPersonas[i].querySelector("fech").textContent);
                
            oFila = oTBody.insertRow(-1);
            oFila = oTBody.insertRow(-1);
            oCelda = oFila.insertCell(-1);
            // Combina para ocupar toda la fila
            oCelda.colspan = 4;             
            oCelda.textContent = (oPersonas[i].querySelector("descripcio").textContent);
            
        
            oCelda = oFila.insertCell(-1);      
            oCelda.textContent = (oPersonas[i].querySelector("img").textContent);
                
        }
        document.querySelector("#listado").innerHTML = "";
        document.querySelector("#listado").appendChild(oTabla);
    }

  </script>
</html>