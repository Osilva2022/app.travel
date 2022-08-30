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

function img_meta($data, $alt = null, $lazy = true)
{
    if (!isset($data)) {
        return false;
    }
    $metadatos = unserialize($data);
    $img_meta = [
        'title="' . $metadatos['image_meta']['title'] . '"',
        'width="' . $metadatos['width'] . '"',
        'height="' . $metadatos['height'] . '"',
        'src="' . images((isset($metadatos['s3']['formats']['webp'])) ? $metadatos['s3']['formats']['webp'] : $metadatos['file']) . '"',
        'alt="' . $alt . '"',
        ($lazy) ? 'loading="lazy"' : '',
        ($lazy) ? 'decoding="defer"' : '',
        'sizes="(max-width: 320px) 300px, (max-width: 480px) 440px, (max-width: 800px) 768px, (max-width: 1024px) 900px, 1024px"',
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
