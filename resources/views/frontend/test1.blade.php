@extends('layouts.frontend.app')
@section('content')
<?php echo $shareData?>
用户名:{{$user['name']}}<br>
用户头像:{{$user['avatar']}}


@endsection