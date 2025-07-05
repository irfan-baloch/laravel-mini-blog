<title>{{ $metaTitle ?? config('app.name') }}</title>
<meta name="description" content="{{ $metaDescription ?? 'Default descriptoin here.' }}">
<meta name="keywords" content="{{ $metaKeywords ?? 'blog, laravel, php' }}">

{{-- Open Graphp for social sharing --}}
<meta property = "og:title" content="$metaTitle ?? config('app.name')" >
<meta property = "og:description" content="{{$metaDescription ?? 'Default blog description here.'}}" >
<meta property = "og:type" content="website" >
<meta property = "og:url" content="{{ url()->current() }}" >
<meta property = "og:image" content="{{ $metaImage ?? asset('default-og-image.jpg') }}" >