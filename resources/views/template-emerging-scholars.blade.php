{{--
  Template Name: Emerging Scholars
--}}

@extends('layouts.app')

@section('content')

<section class="conference-scholars-wrap bg-black p-20">
    <div class="bg-conference-200 rounded-[50px]">
  <h1 class="page-hed">{{ 'Emerging Scholars' }}</h1>
  
  @if($scholarItems)
    <div class="relative z-0 scholar-wrap m-20 mb-48 columns-1 gap-5 p-5 sm:columns-2 lg:columns-3 xl:columns-4">
    @foreach($scholarItems as $item)
      @if($item->placeholder)
        @include('components/scholar-placeholder', ['item' => $item])
        @include('components/scholar-item', ['item' => $item])
      @else
        @include('components/scholar-item', ['item' => $item])
      @endif
    @endforeach
    </div>
  @endif
  
</section>

</div>
@endsection
