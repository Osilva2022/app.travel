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
    return images($metadatos['file']);
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
        'sizes="(max-width: 400px) 100vw, (max-width: 700px) 50vw, (max-width: 900px) 33vw, 1024px"',
        // 'sizes="(max-width: 200px) 180px,(max-width: 425px) 400px, (max-width: 550px) 480px, (max-width: 800px) 768px, (max-width: 1024px) 900px, 500px"',
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
