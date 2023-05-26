<?=
'<?xml version="1.0" encoding="UTF-8"?>'.PHP_EOL
?>

<rss version="2.0">
    <channel>
        <title>
            <![CDATA[ Tribune Travel ]]>
        </title>
        {{-- <atom:link href="https://tribune.travel/feed/" rel="self" type="application/rss+xml" /> --}}
        <link>
        <![CDATA[ https://tribune.travel ]]>
        </link>
        <description>
            <![CDATA[ Travel news and ideas from the top destinations of Puerto Vallarta, Riviera Nayarit, Cancun, Riviera Maya and Los Cabos at Mexico. ]]>
        </description>
        <language>en</language>
        <pubDate>{{ date("D, d M Y H:i:s O", strtotime(now() )) }}</pubDate>


        <image>
            <url>https://tribune.travel/img/favicon.png</url>
            <title>Tribune Travel</title>
            <link>https://tribune.travel</link>
            <width>32</width>
            <height>32</height>
        </image>

        @foreach($posts as $post)
        <item>
            <title>{{ $post->title }}</title>
            <link>{!!url('/').'/'.$post->url !!}</link>
            {{-- <dc:creator><![CDATA[{{$post->author_name}} ]]></dc:creator> --}}
            {{-- <category><![CDATA[{{ $post->category }}]]></category> --}}
            <description>
                <![CDATA[{!! $post->content !!}]]>
            </description>
            <pubDate>{{ date("D, d M Y H:i:s O", strtotime($post->post_date)) }} </pubDate>
            <author>{{$post->author_name}}</author>
            <guid isPermaLink="false">{{ url('/').'/'.$post->id_post }}</guid>
        </item>
        @endforeach
    </channel>
</rss>
