<?=
'<?xml version="1.0" encoding="UTF-8"?>'.PHP_EOL
?>

<rss version="2.0"
xmlns:content="http://purl.org/rss/1.0/modules/content/"
xmlns:wfw="http://wellformedweb.org/CommentAPI/"
xmlns:dc="http://purl.org/dc/elements/1.1/"
xmlns:atom="http://www.w3.org/2005/Atom"
xmlns:sy="http://purl.org/rss/1.0/modules/syndication/"
xmlns:slash="http://purl.org/rss/1.0/modules/slash/"
>
    <channel>
        <title>
            Tribune Travel
        </title>
        <atom:link href="https://tribune.travel/feed/" rel="self" type="application/rss+xml" />
        <link>https://tribune.travel/</link>
        <description>Travel news and ideas from the top destinations of Puerto Vallarta, Riviera Nayarit, Cancun, Riviera Maya and Los Cabos at Mexico.</description>
        <language>en</language>
        <lastBuildDate>{{ date("D, d M Y H:i:s O", strtotime(now() )) }}</lastBuildDate>
        <sy:updatePeriod>  hourly	</sy:updatePeriod>
	    <sy:updateFrequency>   1	</sy:updateFrequency>
        <generator>https://wordpress.org/?v=6.2.2</generator>

        <image>
            <url>https://tribune.travel/img/favicon.png</url>
            <title>Tribune Travel</title>
            <link>https://tribune.travel/</link>
            <width>32</width>
            <height>32</height>
        </image>

        @foreach($posts as $post)
        <item>
            <title>{{ $post->title }}</title>
            <link>{!!url('/').'/'.$post->url !!}</link>
            <dc:creator><![CDATA[{{$post->author_name}} ]]></dc:creator>
            <pubDate>{{ date("D, d M Y H:i:s O", strtotime($post->post_date)) }} </pubDate>
            <guid isPermaLink="false">{{ url('/').'/'.$post->id_post }}</guid>
            {{-- <category><![CDATA[{{ $post->category }}]]></category> --}}
            <description><![CDATA[{!! $post->content !!}]]></description>
            <content:encoded><![CDATA[]]></content:encoded>
            {{-- <author>{{$post->author_name}}</author> --}}
        </item>
        @endforeach
    </channel>
</rss>
