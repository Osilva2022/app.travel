<?php

$token = 'IGQVJYRnVVWlVKZADhDeVgyaEJ5dDh3QUp6RlFjRGhmaVlsLV9iNVdiMVBzbG1IVkdKZAjIyUUxxejFvSk41WHBKS19EMXJDXzczb3QwdkFlV0I0UEh0LXd4WGh4a2tQUTZAVZAEd4THk1M25Mbi1UNmpvUQZDZD';
$user_id = 'self';
$instagram_cnct = curl_init(); // инициализация cURL подключения
curl_setopt( $instagram_cnct, CURLOPT_URL, "https://api.instagram.com/v1/users/" . $user_id . "/media/recent?access_token=" . $token ); // подключаемся
curl_setopt( $instagram_cnct, CURLOPT_RETURNTRANSFER, 1 ); // просим вернуть результат
curl_setopt( $instagram_cnct, CURLOPT_TIMEOUT, 15 );
$media = json_decode( curl_exec( $instagram_cnct ) ); // получаем и декодируем данные из JSON
curl_close( $instagram_cnct ); // закрываем соединение

dd($media);

$limit = 4;

$size = 200;

foreach(array_slice($media->data, 0, $limit) as $data) {
	echo '<a href="' . $data->link . '" target="_blank">';
	echo '<img src="'. $data->images->low_resolution->url . '" height="'.$size.'" width="'.$size.'"/>';
	echo '</a>';
}

?>