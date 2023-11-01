@extends('template.template')
@section('content')



<section id="create_pass">
    <div class="container">
        <div class="middle">
            <div class="card">
                <div class="card-header">
                    <h2>Enter A Password!</h2>

                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('account.updatePassword') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <label for="new_password">New Password:</label>
                                <input type="password" name="new_password" id="new_password">
                            </div>
                            <div class="col-md-12">
                                <label for="new_password_confirmation">Confirm Password:</label>
                                <input type="password" name="new_password_confirmation" id="new_password_confirmation">
                            </div>
                            <div class="col-md-12">
                                <button type="submit">Change Password</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection