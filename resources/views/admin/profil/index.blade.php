@extends('layouts.base')

@section('title', 'Profil')

@section('content')
{{-- @include('sweet::alert') --}}

  <div class="container-fluid" id="container-wrapper">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Profil</h1>
  </div>
    
  {{-- <form method="post" action="{{route('admin.profil.index')}}" class="form-horizontal"> --}}
    {{-- @csrf --}}
    {{--  @method('PATCH')  --}}
    <form action="" class="form-horizontal">
    <div class="col-lg-12">
    <div class="card mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      <h6 class="m-0 font-weight-bold text-primary">Profil</h6>
    </div>
    <div class="card-body">
        <div class="form-group row">
          <label class="col-sm-2 col-form-label">Nama</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" name="name" value="{{$user->name}}" disabled>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-sm-2 col-form-label">Email</label>
          <div class="col-sm-9">
            <input type="email" class="form-control" name="email" value="{{$user->email}}" disabled>
          </div>
        </div>
        
        <div class="form-group row">
          <label class="col-sm-2 col-form-label" rows="3">Alamat</label>
          <div class="col-sm-9">
          <textarea input type="text" class="form-control" name="address" rows="3" disabled>{{$user->alamat}}</textarea>
            {{--  <input type="text" class="form-control" name="name" value="" >  --}}
          </div>
        </div>

        <div class="form-group row">
          <label class="col-sm-2 col-form-label">No Hp</label>
          <div class="col-sm-9">
          <input type="text" class="form-control" name="name" value="{{$user->no_hp}}" disabled>
          </div>
        </div>
        {{-- <div class="modal-footer"> --}}
        <div class="card-footer text-right">
            <a href="{{route('admin.beranda.index')}}" style="color: white"><button type="button" class="btn btn-secondary">Kembali</a></button>
            <a href="{{route('admin.profil.edit', $user->id)}}" style="color: white"><button type="button" class="btn btn-primary">Edit</a></button>
        </div>
    </div>
    </div>
  </form>
  </div>
@endsection