@extends('layouts.shop_layout')
@section('title', __('Verify-Email-Title'))
@section('content')
    <div class="container">
        @if (session('resent'))
            <div class="alert alert-success" role="alert">
                {{__('Comfirm-Email-Sent')}}
            </div>
        @endif
        <form action="{{route('verification.resend')}}" method="POST">
            @csrf
            <button type="submit" class="btn btn-link">
                {{__('Resend-Email-Submit')}}
            </button>
        </form>
    </div>
@endsection
