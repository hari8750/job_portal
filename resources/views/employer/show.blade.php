<h2>Company Profile</h2>

@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

<h3>{{ $profile->company_name ?? 'N/A' }}</h3>
<p><a href="{{ $profile->website ?? '#' }}" target="_blank">{{ $profile->website ?? 'N/A' }}</a></p>
<p>{{ $profile->description ?? 'N/A' }}</p>

@if($profile && $profile->logo)
    <img src="{{ asset('storage/logos/'.$profile->logo) }}" width="150">
@endif

<br>
<a href="{{ route('employer.profile.edit') }}">Edit Profile</a>
