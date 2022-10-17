<?=
'<?xml version="1.0" encoding="UTF-8"?>'.PHP_EOL
?>
<rss version="2.0">
    <channel>
        <title><![CDATA[ Tribune Travel ]]></title>
        <link><![CDATA[ https://tribune.travel/feed ]]></link>
        <description><![CDATA[ Noticias e ideas de viaje de los principales destinos de Puerto Vallarta, Riviera Nayarit, Cancún, Riviera Maya y Los Cabos en México. Hoteles, restaurantes. ]]></description>
        <language>en</language>
        <pubDate>{{ now() }}</pubDate>

        @foreach($posts as $post)
            <item>
                <title><![CDATA[{{ $post->title }}]]></title>
                <link>{{ $post->url }}</link>
                <description><![CDATA[{!! $post->content !!}]]></description>
                <category>{{ $post->category }}</category>
                <author>{{$post->author_name}} </author>
                <guid>{{ $post->post_id }}</guid>
                <pubDate>{{ $post->post_date }}</pubDate>
            </item>
        @endforeach
    </channel>
</rss>
