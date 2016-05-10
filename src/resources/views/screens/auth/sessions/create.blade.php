@extends('prosper.core::layouts.clear')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-4 col-md-offset-4">

                <div class="panel panel-default">
                    <div class="panel-body">
                        <form method="post" action="{{ prosper_route('auth.sessions.store') }}">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="Email address" required>
                            </div>

                            <div class="form-group">
                                <input type="password" name="password" class="form-control" placeholder="Password" required>
                            </div>

                            <div class="checkbox">
                                <label>
                                    <input type="hidden" name="remember_me" value="0">
                                    <input type="checkbox" name="remember_me" value="1">
                                    Remember me
                                </label>
                            </div>

                            <button class="btn btn-success btn-block">
                                <i class="fa fa-lock"></i>
                                Sign-in
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

@stop