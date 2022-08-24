<?php

function images($image) //Regresa la url del repositorio de imagenes + el nombre de la imagen
{
    return config('constants.IMAGES_REPOSITORY') . $image;
}

function img_meta($data)
{
    $metadatos = unserialize($data);
    /* $ejemplo = '
        width="1280" 
        height="853" 
        src="https://test.tribune.travel/wp-content/uploads/2022/08/golf-in-puerto-vallarta-cover-1.jpeg.webp" 
        class="attachment-twentyseventeen-featured-image size-twentyseventeen-featured-image wp-post-image lazyautosizes lazyloaded" 
        alt="" 
        loading="lazy" 
        data-src="https://test.tribune.travel/wp-content/uploads/2022/08/golf-in-puerto-vallarta-cover-1.jpeg.webp" 
        decoding="async" 
        data-srcset="https://test.tribune.travel/wp-content/uploads/2022/08/golf-in-puerto-vallarta-cover-1.jpeg.webp 1280w, 
        https://test.tribune.travel/wp-content/uploads/2022/08/golf-in-puerto-vallarta-cover-1-300x200.jpeg.webp 300w, 
        https://test.tribune.travel/wp-content/uploads/2022/08/golf-in-puerto-vallarta-cover-1-1024x682.jpeg.webp 1024w, 
        https://test.tribune.travel/wp-content/uploads/2022/08/golf-in-puerto-vallarta-cover-1-768x512.jpeg.webp 768w" 
        data-sizes="auto" 
        data-src-webp="https://test.tribune.travel/wp-content/uploads/2022/08/golf-in-puerto-vallarta-cover-1.jpeg.webp" 
        data-srcset-webp="https://test.tribune.travel/wp-content/uploads/2022/08/golf-in-puerto-vallarta-cover-1.jpeg.webp 1280w, 
        https://test.tribune.travel/wp-content/uploads/2022/08/golf-in-puerto-vallarta-cover-1-300x200.jpeg.webp 300w, 
        https://test.tribune.travel/wp-content/uploads/2022/08/golf-in-puerto-vallarta-cover-1-1024x682.jpeg.webp 1024w,
        https://test.tribune.travel/wp-content/uploads/2022/08/golf-in-puerto-vallarta-cover-1-768x512.jpeg.webp 768w" 
        sizes="524px" 
        srcset="https://test.tribune.travel/wp-content/uploads/2022/08/golf-in-puerto-vallarta-cover-1.jpeg.webp 1280w, 
        https://test.tribune.travel/wp-content/uploads/2022/08/golf-in-puerto-vallarta-cover-1-300x200.jpeg.webp 300w, 
        https://test.tribune.travel/wp-content/uploads/2022/08/golf-in-puerto-vallarta-cover-1-1024x682.jpeg.webp 1024w, 
        https://test.tribune.travel/wp-content/uploads/2022/08/golf-in-puerto-vallarta-cover-1-768x512.jpeg.webp 768w"
    '; */
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
        $ruta = images($size['s3']['formats']['webp']) . ' ' . $size['width'] . 'w';
        array_push($allsizes, $ruta);
    }
    return implode(',', $allsizes);
}
