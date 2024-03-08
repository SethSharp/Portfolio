@extends("layouts.main")

@section("content")
    <livewire:blogs.show-blog :blog="$blog" :prev="$prev" :next="$next"/>
@stop
