<div class="w-full bg-black">
    <h2 class="text-3xl text-white">Our Team</h2>
    
    @isset($our_team_members)
        @foreach($our_team_members as $member)
          <div class="text-white font-necto">
            <a href="{{ $member->url }}" class="text-white">{{ $member->name }}</a>
            <span class=""> {!! $member->position !!} </span>
          </div>
        @endforeach
    @endisset

    @isset($student_editors)
        <div class="">
          <span class="d-block team-position team-hed">Student Editors</span>
          @foreach($student_editors as $member)
          <div class="">
            <a href="{{ $member->url }}" class="text-white">{{ $member->name }}</a>
          </div>
          @endforeach
        </div>
    @endisset
      
</div>