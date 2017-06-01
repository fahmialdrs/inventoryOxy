@extends('layouts.app')
@section('title', 'Welcome')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">NDT Dive</div>
                    <div class="panel-body">
                        <p class="text-muted">
                            Silahkan memasukan nomer registrasi yang didapat ketika melakukan pendaftaran ujiriksa untuk mendapatkan laporan terkini mengenai progress ujiriksa.
                        </p>
                        <form class="form-horizontal" role="form" method="get" action="{{ route('homepage.result') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('no_registrasi') ? ' has-error' : '' }}">
                            <label for="no_registrasi" class="col-md-4 control-label">No Registrasi</label>

                            <div class="col-md-6">
                                <input id="no_registrasi" type="text" class="form-control" name="no_registrasi" value="{{ old('no_registrasi') }}" required autofocus>

                                @if ($errors->has('no_registrasi'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('no_registrasi') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div> 

                        <div class="form-group{{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">
                            <div class="col-md-offset-4 col-md-6">
                                {!! app('captcha')->display() !!}
                                {!! $errors->first('g-recaptcha-response', '<p class="help-block">:message</p>') !!}        
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                <i class="fa fa-search" aria-hidden="true"></i>
                                    Cari
                                </button>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection