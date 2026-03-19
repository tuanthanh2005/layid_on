{!! '<' . '?xml version="1.0" encoding="UTF-8"?' . '>' !!}
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc>{{ url('/') }}</loc>
        <lastmod>{{ now()->toIso8601String() }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
    </url>

    @foreach($posts as $post)
    <url>
        <loc>{{ url('/blog/' . $post->slug) }}</loc>
        <lastmod>{{ $post->updated_at->toIso8601String() }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
    @endforeach

    @foreach($geminiTricks as $trick)
    <url>
        <loc>{{ url('/gemini-business-free/' . $trick->slug) }}</loc>
        <lastmod>{{ $trick->updated_at->toIso8601String() }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
    @endforeach

    @foreach($utilities as $utility)
    <url>
        <loc>{{ url($utility->slug ?? 'tools/' . $utility->id) }}</loc>
        <lastmod>{{ $utility->updated_at->toIso8601String() }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.7</priority>
    </url>
    @endforeach

    @foreach($courses as $course)
    <url>
        <loc>{{ url('/courses/' . ($course->slug ?? $course->id)) }}</loc>
        <lastmod>{{ $course->updated_at->toIso8601String() }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.7</priority>
    </url>
    @endforeach

    @foreach($products as $product)
    <url>
        <loc>{{ url('/store/' . ($product->slug ?? $product->id)) }}</loc>
        <lastmod>{{ $product->updated_at->toIso8601String() }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.7</priority>
    </url>
    @endforeach
</urlset>
