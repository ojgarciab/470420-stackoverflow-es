<?php
/* Indicamos el tipo de datos que enviaremos */
header("Content-type: text/xml");

/* Creamos el documento XML */
$dom = new DOMDocument('1.0', 'utf-8');

/* Creamos el nodo raíz y lo agregamos al documento XML*/
$datos = $dom->createElement('datos');
$dom->appendChild($datos);

/* Estos son datos para simular los obtenidos de una base de datos */
$ejemplo = [
    [
        "idnoticia" => "1",
        "titulo" => "Noticia 1",
        "descripcion" => "Descripción noticia 1",
        "autor" => "Autor 1",
        "fecha" => "2021-01-01",
        "imagen" => "",
    ],
    [
        "idnoticia" => "2",
        "titulo" => "Noticia 2",
        "descripcion" => "Descripción noticia 2",
        "autor" => "Autor 2",
        "fecha" => "2021-02-02",
        "imagen" => "",
    ],
    [
        "idnoticia" => "3",
        "titulo" => "Noticia 3",
        "descripcion" => "Descripción noticia 3",
        "autor" => "Autor 3",
        "fecha" => "2021-03-03",
        "imagen" => "",
    ],
];

/* Uso "array_shift" en lugar de "mysqli_fetch_array" para emular recorrer los registros */
//while ($fila = mysqli_fetch_array($resultados)) {
while ($fila = array_shift($ejemplo)) {
    /* Creamos el elemento "documento" donde almacenaremos los valores de cada iteración */
    $documento = $dom->createElement('documento');
    /* Creamos y agregamos los elementos al nodo "documento" */
    $documento->appendChild($dom->createElement('idnotici', $fila['idnoticia']));
    $documento->appendChild($dom->createElement('titul', $fila['titulo']));
    $documento->appendChild($dom->createElement('descripcio', $fila['descripcion']));
    $documento->appendChild($dom->createElement('auto', $fila['autor']));
    $documento->appendChild($dom->createElement('fech', $fila['fecha']));
    $documento->appendChild($dom->createElement('img', base64_encode($fila['imagen'])));
    /* Agregamos el elemento "documento" al elemento raíz "datos" */
    $datos->appendChild($documento);
}

/* Enviamos el XML al navegador */
echo $dom->saveXML();
