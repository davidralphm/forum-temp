<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <b>{{ $error }}</b>
        @endforeach
    @endif

    @if (Session::has('message-success'))
        <b>{{ Session::get('message-success') }}</b>
    @endif

    <b>Name : {{ $user->name }}</b><br><hr>
    <b>Email : {{ $user->email }}</b><br><hr>
    <b>Role : {{ $user->role }}</b><br><hr>
    <b>About : {{ $user->about }}</b><br><hr>
    <b>Image URL : {{ $user->image_url }}</b><br><hr>

    @if (!empty($user->image_url) && $user->image_url !== '')
        <h3>Profile Image</h3>
        <img src="/storage/uploads/{{ $user->image_url }}" alt="Profile Image"><br><br>
        
        <a href="/user/deleteImage">Delete profile image</a>
    @endif

    <h2>Edit Account</h2>

    <form action="/user/editAccount" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}

        <input type="text" name="name" id="name" placeholder="Your Name"
            @if (old('name'))
                value="{{ old('name') }}"
            @else
                value="{{ $user->name }}"
            @endif
        ><br><br>

        <textarea name="about" id="about" cols="30" rows="10" placeholder="About">@if (old('about')){{ old('about') }}@else{{ $user->about }}@endif</textarea><br><br>
        
        <input type="file" name="image" id="image"><br><br>

        <input type="submit" value="Save Changes">
    </form><hr>

    <h2>Change Password</h2>

    <form action="/user/changePassword" method="post">
        {{ csrf_field() }}

        <input type="password" name="password" id="password" placeholder="Current password"><br><br>
        <input type="password" name="new_password" id="new_password" placeholder="New password"><br><br>
        <input type="password" name="new_password_confirmation" id="new_password_confirmation" placeholder="Confirm new password"><br><br>

        <input type="submit" value="Change Password">
    </form><hr>

    <h2>Delete Account</h2>

    <form action="/user/deleteAccount" method="post">
        {{ csrf_field() }}

        <input type="password" name="password" id="password" placeholder="Enter password"><br><br>

        <input type="submit" value="Delete Account">
    </form><hr>

    <a href="/logout">Logout</a>
</body>
</html>