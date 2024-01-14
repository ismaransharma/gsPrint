@extends('site.myAccount.myAccTemplate')
@section('content')

<div id="myAccount">
    <div class="card">
        <div class="card-body">
            <form action="{{ route('profile.update') }}" method="post">
                @csrf
                @method('put')
                @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif

                <!-- Display error messages -->
                @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <div class="row">
                    <div class="col-md-12">
                        <label for="name">Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                            value="{{ $user->name }}" id="name" name="name">
                    </div>
                    <div class="col-md-12">
                        <label for="email">Email</label>
                        <input type="text" class="form-control @error('email') is-invalid @enderror"
                            value="{{ $user->email }}" id="email" name="email">
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-10 wd">
                                <label for="current_password">Current Password</label>
                                <input type="password" id="password"
                                    class="form-control @error('current_password') is-invalid @enderror"
                                    id="current_password" name="current_password">
                            </div>
                            <div class="col-md-2 togglePassUp">
                                <span class="togglePass" onclick="togglePassword()">
                                    <i id="eyeIcon" class="fa-solid fa-eye"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-10 wd">
                            <label for="password">New Password</label>
                            <input type="password" id="password_confirmation"
                                class="form-control @error('password_confirmation') is-invalid @enderror"
                                name="password_confirmation">
                        </div>
                        <div class="col-md-2 togglePassUp">
                            <span class="togglePass" onclick="togglePasswordConfirm()">
                                <i id="eyeIconConfirm" class="fa-solid fa-eye"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-10 wd">
                            <label for="password_confirmation2">Confirm New Password</label>
                            <input type="password" id="password_confirmation2"
                                class="form-control @error('password_confirmation') is-invalid @enderror"
                                name="password">
                        </div>
                        <div class="col-md-2 togglePassUp">
                            <span class="togglePass" onclick="togglePasswordConfirm2()">
                                <i id="eyeIconConfirm2" class="fa-solid fa-eye"></i>
                            </span>
                        </div>
                    </div>
                </div>
        </div>

        <button type="submit" class="btn btn-primary">Update Profile</button>
        </form>
    </div>
</div>
</div>


@endsection