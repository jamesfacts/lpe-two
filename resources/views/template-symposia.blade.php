{{--
  Template Name: Symposia Template
--}}

@extends('layouts.app')

@section('content')
  @while(have_posts()) @php(the_post())
    We have Symposia
    @include('partials.content-page')
  @endwhile
@endsection
