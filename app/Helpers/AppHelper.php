<?php

function images($image) //Regresa la url del repositorio de imagenes + el nombre de la imagen
{
    return config('constants.IMAGES_REPOSITORY') . $image;
}

function imgURL($data)
{
    if (!isset($data)) {
        return false;
    }
    $metadatos = unserialize($data);
    // return images($metadatos['file']);
    return images((isset($metadatos['s3']['formats']['webp'])) ? $metadatos['s3']['formats']['webp'] : $metadatos['file']);
}

function img_meta($data, $alt = false, $lazy = true)
{
    if (!isset($data)) {
        return false;
    }

    $metadatos = unserialize($data);
    $img_meta = [
        ($metadatos['image_meta']['title']) ? 'alt="' . $metadatos['image_meta']['title'] . '"' : 'title=""',
        // 'width="425"',
        // 'height="250"',
        'width="' . $metadatos['width'] . '"',
        'height="' . $metadatos['height'] . '"',
        'src="' . images((isset($metadatos['s3']['formats']['webp'])) ? $metadatos['s3']['formats']['webp'] : $metadatos['file']) . '"',
        ($alt) ? 'alt="' . $alt . '"' : 'alt="Alt Text"',
        ($lazy) ? 'loading="lazy"' : '',
        ($lazy) ? 'decoding="defer"' : '',
        // 'sizes="(max-width: 300px) 100vw, 300px"',
        'sizes="(max-width: 200px) 200px,(max-width: 425px) 425px, (max-width: 550px) 525px, (max-width: 800px) 800px, (max-width: 1024px) 1024px, 1024px"',
        'srcset="' . images((isset($metadatos['s3']['formats']['webp'])) ? $metadatos['s3']['formats']['webp'] : $metadatos['file']) . ' ' . $metadatos['width'] . 'w, ' . imgMetaSrcSet($metadatos['sizes']) . '"'
    ];
    return implode(" ", $img_meta);
}

function imgMetaSrcSet($metasizes)
{
    $allsizes = [];
    foreach ($metasizes as $size) {
        $ruta = images((isset($size['s3']['formats']['webp'])) ? $size['s3']['formats']['webp'] : $size['s3']['key']) . ' ' . $size['width'] . 'w';
        array_push($allsizes, $ruta);
    }
    return implode(',', $allsizes);
}

function imgMetaSizes($metasizes)
{
    $allsizes = [];
    foreach ($metasizes as $size) {
        $ruta = images((isset($size['s3']['formats']['webp'])) ? $size['s3']['formats']['webp'] : $size['s3']['key']) . ' ' . $size['width'] . 'w';
        array_push($allsizes, $ruta);
    }
    return implode(',', $allsizes);
}

function ValidateAvaliable($array)
{
    $horario = unserialize($array);
    $bandera = false;
    for ($i = 1; $i <= 7; $i++) {
        if ($horario[$i]['off'] != 1 && $horario[$i]['hours'] != '') {
            $bandera = true;
        }
    }
    return $bandera;
}
