<div class="w-full bg-black">
    <h2 class="text-3xl text-white">Our Team</h2>
    @isset($teamMembers)
        @foreach($teamMembers as $member)
          <div class="text-white font-necto">
            <a href="{{ $member->url }}" class="text-white">{{ $member->name }}</a>
            <span class=""> {!! $member->position !!} </span>
          </div>
        @endforeach
    @endisset

    @isset($studentEditors)
        <div class="">
          <span class="d-block team-position team-hed">Student Editors</span>
          @foreach($studentEditors as $member)
          <div class="">
            <a href="{{ $member->url }}" class="text-white">{{ $member->name }}</a>
          </div>
          @endforeach
        </div>
    @endisset
      
</div>