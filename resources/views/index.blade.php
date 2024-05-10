@extends('layouts.app')

@section('title', 'User Registration Form')

@section('content')
    <h2 style="text-align: center;">@lang('myCustom.Form')</h2>

    @if (session('success'))
    <script>
        alert("{{ session('success') }}");
    </script>
    @endif

    @if (session('error'))
    <script>
        alert("{{ session('error') }}");
    </script>
    @endif
    
    <form action="{{ route('add') }}" method="post" enctype="multipart/form-data">
        @csrf
        <br />
        <label for="full_name">@lang('myCustom.FullName')</label>
        <input type="text" id="full_name" name="fullname" required><br><br>

        <label for="user_name">@lang('myCustom.UserName')</label>
        <input type="text" id="user_name" name="username" required><br><br>

        <label for="birthday">@lang('myCustom.Birthday')</label>
        <input type="date" id="birthday" name="birthdate" onchange="showActors(this.value)" required>
        <div id="Api_recall" class="Api_recall"></div>

        <br><label for="phone">@lang('myCustom.Phone')</label>
        <input type="tel" id="phone" name="phone" required><br><br>

        <label for="address">@lang('myCustom.Address')</label>
        <textarea id="address" name="address" required></textarea><br><br>

        <label for="email">@lang('myCustom.Email')</</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="password">@lang('myCustom.Password')</label>
        <input type="password" id="password" name="password" required><br><br>

        <label for="confirm_password">@lang('myCustom.ConfirmPassword')</label>
        <input type="password" id="confirm_password" name="confirm_password" required><br><br>

        <label for="user_image">@lang('myCustom.UserImage')</label>
        <input type="file" id="user_image" name="image" accept="image/*" required><br><br>


        <div style="text-align: center;">
            <input type="submit" value="@lang('myCustom.Register')">
        </div><br>

        <div
            style="background-color: #FA8072; color: black; text-align: center; padding: 10px; border: 2px solid red; margin-top: 10px;">
            @lang('myCustom.required')
        </div>
    </form>
@endsection
