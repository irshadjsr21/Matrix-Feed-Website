<title>{{ $SEO['title'] }}</title>


@if ($SEO['keywords'])
<meta name="keywords" content="{{ $SEO['keywords'] }}" />  
@endif

@if ($SEO['date'])
<meta property="article:published_time" content="{{ $SEO['date'] }}" />
@endif

@if ($SEO['description'])
  <meta name="description" itemprop="description" content="{{ $SEO["description"] }}" />
  <meta property="og:description"content="{{ $SEO["description"] }}" /> 
@endif

@if ($SEO['image'])
  <meta property="og:image"content="{{ $SEO['image'] }}" />
  <meta name="twitter:image" content="{{ $SEO['image'] }}"> 
@endif

@if(!$SEO['isMinimal'])
  <meta property="og:title"content="{{ $SEO['title'] }}" />
  <meta property="og:url"content="{{ $SEO['url'] }}" />
  <meta property="og:type"content="{{ $SEO['type'] }}" />
  <meta property="og:site_name"content="{{ $SEO['siteName'] }}" />
  <meta property="fb:app_id" content="{{ $SEO['fbId'] }}" />

  <meta name="twitter:card"content="summary" />
  <meta name="twitter:title"content="{{ $SEO['title'] }}" />
  <meta name="twitter:site"content="{{ $SEO['twitterUsername'] }}" />
  <meta name="twitter:creator" content="{{ $SEO['twitterUsername'] }}"/>
@endif