{{--
  Template Name: Emerging Scholars
--}}

@extends('layouts.app')

@section('content')

<section class="conference-scholars-wrap bg-black px-4 lg:pt-5">
    <div class="bg-conference-200 rounded-[50px]">
  <h1 class="pt-14 pr-5 pl-6 pb-6 text-4xl font-tiempos 
             sm:pl-14 lg:text-[3.45rem] ">{{ 'Emerging Scholars' }}</h1>
  
  @if($scholarItems)
    <div class="relative z-0 scholar-wrap pb-24 columns-1 gap-5 p-5  max-w-[1350px]
                sm:columns-2 sm:mx-8 lg:columns-3 xl:ml-12 xl:columns-4 ">
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
