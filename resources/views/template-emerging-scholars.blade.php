{{--
  Template Name: Emerging Scholars
--}}

@extends('layouts.app')

@section('content')
<section class="conference-scholars-wrap">
  <h1 class="page-hed">{{ 'Emerging Scholars' }}</h1>
  @if($scholarItems)
    <div class="grid workshop-contain d-md-none">
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

  @if($scholarItems)
    <div class="d-none d-md-flex d-xl-none workshop-contain">
      <div class="row">
        @foreach($scholarItems->chunk($scholarItemsThreeCol) as $items_column)
          @if($loop->iteration === 1)
            <div class="col-4 pl-0 pr-col">
          @elseif($loop->iteration === 2)
            <div class="col-4 border-col">
          @else
            <div class="col-4 pr-0 pl-col">
          @endif
          
            @foreach($items_column as $item)
            @if($item->placeholder)
                @include('components/scholar-placeholder', ['item' => $item])
                @include('components/scholar-item', ['item' => $item])
              @else
                @include('components/scholar-item', ['item' => $item])
              @endif
            @endforeach    
            </div>    
         @endforeach
      </div>
    </div>

    <div class="d-none d-xl-flex workshop-contain">
      <div class="row">
        @foreach($scholarItems->chunk($scholarItemsFourCol) as $items_column)
          @if($loop->iteration === 2)
            <div class="col-3 border-col">
          @elseif($loop->iteration === 3)
            <div class="col-3 border-col-right">
          @else
            <div class="col-3">
          @endif
          
            @foreach($items_column as $item)
            @if($item->placeholder)
                @include('components/scholar-placeholder', ['item' => $item])
                @include('components/scholar-item', ['item' => $item])
              @else
                @include('components/scholar-item', ['item' => $item])
              @endif
            @endforeach    
            </div>    
         @endforeach
      </div>
    </div>
  @endif
  
</section>
@endsection
