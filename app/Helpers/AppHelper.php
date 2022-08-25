<?php

function images($image) //Regresa la url del repositorio de imagenes + el nombre de la imagen
{
    return config('constants.IMAGES_REPOSITORY') . $image;
}

function img_meta($data)
{
    if (!isset($data)) {
        return false;
    }
    $metadatos = unserialize($data);
    $img_meta = [
        'width="' . $metadatos['width'] . '"',
        'height="' . $metadatos['height'] . '"',
        'src="' . images((isset($metadatos['s3']['formats']['webp'])) ? $metadatos['s3']['formats']['webp'] : $metadatos['file']) . '"',
        'alt="' . $metadatos['image_meta']['caption'] . '"',
        'loading="lazy"',
        'decoding="async"',
        'sizes="(max-width: 180) 150px, (max-width: 320px) 300px, (max-width: 480px) 440px, (max-width: 800px) 768px, 1024px"',
        'srcset="' . images((isset($metadatos['s3']['formats']['webp'])) ? $metadatos['s3']['formats']['webp'] : $metadatos['file']) . ' ' . $metadatos['width'] . 'w, ' . imgMetaSizes($metadatos['sizes']) . '"'
    ];
    return implode(" ", $img_meta);
}

function imgMetaSizes($metasizes)
{
    $allsizes = [];
    foreach ($metasizes as $size) {
        $ruta = images((isset($size['s3']['formats']['webp'])) ? $size['s3']['formats']['webp'] : $size['file']) . ' ' . $size['width'] . 'w';
        array_push($allsizes, $ruta);
    }
    return implode(',', $allsizes);
}
