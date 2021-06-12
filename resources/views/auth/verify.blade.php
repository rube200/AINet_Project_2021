@extends('layouts.shop_layout')
@section('title', __('Verify-Email-Title'))
@section('content')
    <div class="container">
        <div class="align-items-center card col-sm-4 mx-auto">
            @if (session('resent'))
                <div class="alert alert-success" role="alert">
                    {{__('Comfirm-Email-Sent')}}
                </div>
            @endif
            <form action="{{route('verification.resend')}}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">
                            {{__('Resend-Email-Submit')}}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
