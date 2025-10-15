<h2>Edit Company Profile</h2>

<form action="{{ route('employer.profile.update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <label>Company Name:</label>
    <input type="text" name="company_name" value="{{ old('company_name', $profile->company_name ?? '') }}" required>
    <br>

    <label>Website:</label>
    <input type="url" name="website" value="{{ old('website', $profile->website ?? '') }}">
    <br>

    <label>Description:</label>
    <textarea name="description">{{ old('description', $profile->description ?? '') }}</textarea>
    <br>

    <label>Logo:</label>
    <input type="file" name="logo">
    <br>
    @if($profile && $profile->logo)
        <img src="{{ asset('storage/logos/'.$profile->logo) }}" width="100">
    @endif
    <br>

    <button type="submit">Update Profile</button>
</form>
