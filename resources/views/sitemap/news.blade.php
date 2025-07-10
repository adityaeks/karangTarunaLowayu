{!! '<?xml version="1.0" encoding="UTF-8"?>' !!}
<urlset
  xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
  xmlns:news="http://www.google.com/schemas/sitemap-news/0.9">

  @foreach($beritas as $berita)
    <url>
      <loc>{{ url('/detail/' . $berita->slug) }}</loc>
      <news:news>
        <news:publication>
          <news:name>Galow Tunas Bangsa</news:name>
          <news:language>id</news:language>
        </news:publication>
        <news:publication_date>{{ $berita->created_at->toIso8601String() }}</news:publication_date>
        <news:title><![CDATA[{{ $berita->name }}]]></news:title>
      </news:news>
    </url>
  @endforeach

</urlset>
