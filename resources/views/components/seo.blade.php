<title>{{ $SEO['title'] }}</title>

<meta name="description" itemprop="description" content='{{ $SEO["description"] }}' />

@if ($SEO['keywords'])
  <meta name="keywords" content="{{ $SEO['keywords'] }}" />  
@endif

@if ($SEO['date'])
  <meta property="article:published_time" content="{{ $SEO['date'] }}" />
@endif

<meta property="og:description"content='{{ $SEO["description"] }}' />
<meta property="og:title"content="{{ $SEO['title'] }}" />
<meta property="og:url"content="{{ $SEO['url'] }}" />
<meta property="og:type"content="{{ $SEO['type'] }}" />
<meta property="og:site_name"content="{{ $SEO['siteName'] }}" />
<meta property="og:image"content="{{ $SEO['image'] }}" />
<meta property="fb:app_id" content="{{ $SEO['fbId'] }}" />

<meta name="twitter:card"content="summary" />
<meta name="twitter:title"content="{{ $SEO['title'] }}" />
<meta name="twitter:site"content="{{ $SEO['twitterUsername'] }}" />
<meta name="twitter:creator" content="{{ $SEO['twitterUsername'] }}"/>