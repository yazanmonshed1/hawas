<div class="card-background-blue-img">
    <div class="profile-img-div text-center pt-4">
        <img class="card-img-top profile-img" src="{{ asset('storage/' . $user->avatar) }}" alt="Card image cap">
    </div>
    <div class="edit-profile-div">
        <a href="{{route('profile')}}">
            <i class="far fa-edit edit-profile-icon"></i>
        </a>
    </div>
    <div class="profile-info-div pb-2">
        <p class="mb-1 text-center student-name">
            {{ $user->name }}
        </p>
        <p class="mb-1 text-center student-class">
            {{ $user->grade->name }}
        </p>
        <p class="mb-1 text-center school-name">
            {{ $user->grade->school->name }}
        </p>
    </div>

</div>
