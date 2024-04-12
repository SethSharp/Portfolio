@extends("layouts.beth-main")

@section('title', 'Home - ' . config('app.name'))

@push('meta')
    <meta name="description"
          content="Hey I am Bethany">
@endpush

@section("content")
    <div class="z-10">
        <x-body.enter-wrapper>
            <b class="text-primary-600"> Welcome! </b>
            <br/>
            Hi! I am Bethany Frankis and this is my site!
        </x-body.enter-wrapper>
    </div>
@stop
