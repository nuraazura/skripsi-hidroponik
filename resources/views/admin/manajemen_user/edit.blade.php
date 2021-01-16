@extends('layouts.base')

@section('title', 'Edit User')

@section('content')
{{-- @include('sweet::alert') --}}

  <div class="container-fluid" id="container-wrapper">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Manajemen User</h1>
  </div>
    
  <form method="post" action="{{ route ('admin.manajemen_user.update', $data->id)}}" class="form-horizontal">
    @csrf
    @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
    {{--  @method('PATCH')  --}}
    <div class="col-lg-12">
    <div class="card mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      <h6 class="m-0 font-weight-bold text-primary">Manajemen User</h6>
    </div>
    <div class="card-body">
        <div class="form-group row">
          <label class="col-sm-2 col-form-label">Nama</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" name="name" value="{{$data->name}}">
          </div>
        </div>

        <div class="form-group row">
          <label class="col-sm-2 col-form-label">Email</label>
          <div class="col-sm-9">
            <input type="email" class="form-control" name="email" value="{{$data->email}}">
          </div>
        </div>
        
        <div class="form-group row">
          <label class="col-sm-2 col-form-label" rows="3">Alamat</label>
          <div class="col-sm-9">
          <textarea input type="text" class="form-control" name="alamat" rows="3">{{$data->alamat}}</textarea>
            {{--  <input type="text" class="form-control" name="name" value="" >  --}}
          </div>
        </div>

        <div class="form-group row">
          <label class="col-sm-2 col-form-label">No Hp</label>
          <div class="col-sm-9">
          <input type="text" class="form-control" name="no_hp" value="{{$data->no_hp}}">
          </div>
        </div>

        <div class="form-group row">
          <label class="col-sm-2 col-form-label">Password</label>
          <div class="col-sm-9">
            <input type="password" class="form-control" name="password" value="">
            <small>Kosongkan jika tidak ingin merubah password</small>
          </div>
        </div>

        {{-- <div class="modal-footer"> --}}
        <div class="card-footer text-right">
            <a href="{{route ('admin.manajemen_user.index')}}" style="color: white"><button type="button" class="btn btn-secondary">Batal</a></button>
            <button type="submit" class="btn btn-primary">Perbaharui</button>
        </div>
    </div>
    </div>
  </form>
  </div>
@endsection