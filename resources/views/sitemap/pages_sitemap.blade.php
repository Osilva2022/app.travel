<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach ($posts as $post)
        <url>
            <loc>{{ url('/') }}/{{ $post->url }}</loc>
            <lastmod>{{ date("c", strtotime($post->post_date)) }}</lastmod>
            <changefreq>{{ $post->changeFrequency }}</changefreq>
            <priority>{{ $post->priority }}</priority>
        </url>
    @endforeach
</urlset>