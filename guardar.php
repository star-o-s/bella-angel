<?php
$texto = htmlspecialchars($_POST['texto']);
$foto = $_FILES['foto'];

if ($foto['error'] === UPLOAD_ERR_OK) {
    $nombreArchivo = basename($foto['name']);
    $rutaDestino = 'imagenes/' . $nombreArchivo;

    if (!file_exists('imagenes')) {
        mkdir('imagenes', 0777, true);
    }

    if (move_uploaded_file($foto['tmp_name'], $rutaDestino)) {
        // Contenido HTML que se insertará en el álbum
        $bloque = <<<HTML

<div class="photo">
  <img src="$rutaDestino">
  <div class="photo-image">
    <div class="photo-image-text">$texto</div>
  </div>
</div>

HTML;

        file_put_contents('bloques.html', $bloque, FILE_APPEND);
        echo "Subido correctamente. <a href='index.html'>Volver a la galería</a>";
    } else {
        echo "Error al mover la imagen.";
    }
} else {
    echo "Error al subir la foto.";
}
?>