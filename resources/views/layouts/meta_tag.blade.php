{!! Meta::tag('title', 'الحواس') !!}
{!! Meta::tag('description', Helper::setting('site.description')) !!}
{!! Meta::tag('image', asset('storage/' . Helper::setting('site.og_image'))) !!}
{!! Meta::tag('url', Request::url()) !!}
{!! Meta::tag('locale', app()->getLocale()) !!}
{!! Meta::tag('robots', 'index, follow') !!}
{!! Meta::tag('canonical', Request::url()) !!}
{!! Meta::tag('type') !!}
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<meta name="csrf-token" content="{{ csrf_token() }}">
