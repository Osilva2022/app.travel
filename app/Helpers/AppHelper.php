<?php

function images($image) //Regresa la url del repositorio de imagenes + el nombre de la imagen
{
    return config('constants.IMAGES_REPOSITORY') . $image;
}
