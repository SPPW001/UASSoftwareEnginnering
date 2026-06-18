@extends('layouts.public')
@section('title','Login Staff')
@section('content')
<div class="row justify-content-center"><div class="col-md-5"><div class="card card-soft p-4"><h2 class="section-title">Staff Login</h2><form method="post" action="{{ route('login.post') }}">@csrf<div class="mb-3"><label>Email</label><input name="email" type="email" class="form-control" required></div><div class="mb-3"><label>Password</label><input name="password" type="password" class="form-control" required></div><button class="btn btn-forest w-100">Login</button></form><hr><p class="small text-muted">Admin: admin@zooland.test / password<br>Manager: manager@zooland.test / password</p></div></div></div>
@endsection
