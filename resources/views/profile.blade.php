@extends('layouts.app')

@section('content')
    <div class="container">
        @if(session('success'))
            <span class="alert alert-success d-flex justify-content-center p-2">{{ session('success') }}</span>
        @endif
        <div class="d-flex">
            <div>
                <div class="avatar d-flex justify-content-center align-items-center overflow-hidden rounded-circle mb-3"
                     style="width: 200px;height: 200px;background-color: rgba(0, 0, 0, 0.8);">
                    <img src="{{asset('/storage/'. $user_path)}}" alt="avatar" class="img-fluid h-100 m-3"
                         id="userAvatar">
                </div>
                <form action="{{route('profile.upload')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="custom-file mb-2">
                        <input type="file" name="avatar"
                               class="custom-file-input  @error('avatar') is-invalid @enderror"
                               id="myAvatar">
                        @error('avatar')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                        <label class="custom-file-label bg-dark text-light" for="myAvatar">Choose file</label>
                    </div>
                    <button type="submit" class="btn btn-light mb-2">Upload</button>
                </form>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card mb-5">
                        <div class="card-header border-dark text-danger font-weight-bold">
                            Hello {{ Auth::user()->name }}</div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('profile.update', ['form' => 1]) }}">
                                @csrf
                                @method('PUT')
                                <div class="form-group row">
                                    <label for="email"
                                           class="col-md-4 col-form-label text-md-right font-weight-bold">{{ __('Name') }}</label>
                                    <div class="col-md-6">
                                        <input id="email" type="text"
                                               class="form-control border-dark @error('name') is-invalid @enderror"
                                               name="name"
                                               value="{{ $user->name }}" required autofocus>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="email"
                                           class="col-md-4 col-form-label text-md-right font-weight-bold">{{ __('New E-mail Address') }}</label>
                                    <div class="col-md-6">
                                        <input id="email" type="email"
                                               class="form-control border-dark @error('email') is-invalid @enderror"
                                               name="email"
                                               value="{{ $user->email }}" required autofocus>
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="password"
                                           class="col-md-4 col-form-label text-md-right font-weight-bold">{{ __('Password') }}</label>
                                    <div class="col-md-6">
                                        <input id="password" type="password"
                                               class="form-control border-dark @error('password') is-invalid @enderror"
                                               name="password">
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <div class="col-md-8 offset-md-4">
                                        <button type="submit" class="btn btn-dark">
                                            {{ __('Update') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card mb-5">
                        <div class="card-body border-dark">
                            <form method="POST" action="{{ route('detail.update', ['form' => 2]) }}">
                                @csrf
                                @method('PUT')
                                <div class="form-group row">
                                    <label for="phone"
                                           class="col-md-4 col-form-label text-md-right font-weight-bold">{{ __('Phone') }}</label>
                                    <div class="col-md-6">
                                        <input id="phone" type="text"
                                               class="form-control border-dark @error('phone') is-invalid @enderror"
                                               name="phone"
                                               value="{{ $user->detail->phone }}" autofocus>
                                        @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="address"
                                           class="col-md-4 col-form-label text-md-right font-weight-bold">{{ __('Address') }}</label>
                                    <div class="col-md-6">
                                        <input id="address" type="text"
                                               class="form-control border-dark @error('address') is-invalid @enderror"
                                               name="address" value="{{ $user->detail->address }}" autofocus>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="city"
                                           class="col-md-4 col-form-label text-md-right font-weight-bold">{{ __('City') }}</label>
                                    <div class="col-md-6">
                                        <input id="city" type="text"
                                               class="form-control border-dark @error('city') is-invalid @enderror"
                                               name="city"
                                               value="{{ $user->detail->city }}" autofocus>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="country"
                                           class="col-md-4 col-form-label text-md-right font-weight-bold">{{ __('Country') }}</label>
                                    <div class="col-md-6">
                                        <input id="country" type="text"
                                               class="form-control border-dark @error('country') is-invalid @enderror"
                                               name="country" value="{{ $user->detail->country }}" autofocus>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="profession"
                                           class="col-md-4 col-form-label text-md-right font-weight-bold">{{ __('Professions') }}</label>
                                    <div class="col-md-6">
                                        <select
                                            class="mdb-select colorful-select js-example-basic-multiple w-100 border-dark"
                                            name="professions[]"
                                            multiple="multiple">
                                            @foreach($professions as $value)
                                                <option value="{{ $value['id'] }}"
                                                        @if(in_array($value['id'], $user->professions->pluck('id')->all())) selected @endif>{{ $value['name'] }}</option>
                                                --}}
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <div class="col-md-8 offset-md-4">
                                        <button type="submit" class="btn btn-dark">
                                            {{ __('Update') }}
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
