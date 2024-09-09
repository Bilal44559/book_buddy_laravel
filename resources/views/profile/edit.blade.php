@extends('layouts.master')
@section('title', 'Profile')
@section('content')


    <div class="content-body">
        <div class="row">
            <div class="col-12">
                <!-- profile -->
                <div class="card">
                    <div class="card-header border-bottom">
                        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                            {{ __('Profile') }}
                        </h2>
                    </div>
                    <div class="card-body py-2 my-25">
                        <!-- form -->
                        <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
                            @csrf
                            @method('patch')
                            <div class="row">
                                <div class="col-12 col-sm-6 mb-1">
                                    <label class="form-label" for="name" :value="__('Name')">Name</label>
                                    <input type="text" class="form-control" id="accountFirstName" name="name"
                                        value="{{ old('name', auth()->user()->name) }}" required autofocus
                                        autocomplete="name" data-msg="Please enter first name" />
                                </div>
                                <div class="col-12 col-sm-6 mb-1">
                                    <label class="form-label" for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        placeholder="Email" value={{ old('email', auth()->user()->email) }}
                                        data-msg="Please enter your email" />
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary mt-1 me-1">Save changes</button>
                                    <button type="reset" class="btn btn-outline-secondary mt-1">Discard</button>
                                </div>
                            </div>
                        </form>
                        <!--/ form -->
                    </div>
                </div>
                <!-- Update Password -->
                <div class="card">
                    <div class="card-header border-bottom">
                        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                            {{ __('Update Password') }}
                        </h2>
                    </div>
                    <div class="card-body pt-1">
                        <!-- form -->
                        <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
                            @csrf
                            @method('put')
                            <div class="row">
                                <div class="col-12 col-sm-6 mb-1">
                                    <label class="form-label" for="account-old-password"
                                        :value="__('Current Password')">Current password</label>
                                    <div class="input-group form-password-toggle input-group-merge">
                                        <input type="password" class="form-control" id="account-old-password"
                                            name="current_password" placeholder="Enter current password"
                                            data-msg="Please current password" />
                                        <div class="input-group-text cursor-pointer">
                                            <i data-feather="eye"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-sm-6 mb-1">
                                    <label class="form-label" for="account-new-password" :value="__('New Password')">New
                                        Password</label>
                                    <div class="input-group form-password-toggle input-group-merge">
                                        <input type="password" id="account-new-password" name="password"
                                            class="form-control" placeholder="Enter new password" />
                                        <div class="input-group-text cursor-pointer">
                                            <i data-feather="eye"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 mb-1">
                                    <label class="form-label" for="account-retype-new-password">Retype New Password</label>
                                    <div class="input-group form-password-toggle input-group-merge">
                                        <input type="password" class="form-control" id="account-retype-new-password"
                                            name="password_confirmation" placeholder="Confirm your new password" />
                                        <div class="input-group-text cursor-pointer"><i data-feather="eye"></i></div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <p class="fw-bolder">Password requirements:</p>
                                    <ul class="ps-1 ms-25">
                                        <li class="mb-50">Minimum 8 characters long - the more, the better</li>
                                        <li class="mb-50">At least one lowercase character</li>
                                        <li>At least one number, symbol, or whitespace character</li>
                                    </ul>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary me-1 mt-1">{{ __('Save') }}</button>
                                    <button type="reset" class="btn btn-outline-secondary mt-1">Discard</button>
                                </div>
                            </div>
                        </form>
                        <!--/ form -->
                    </div>
                </div>
                <!-- deactivate account  -->
                <div class="card">
                    <div class="card-header border-bottom">
                        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                            {{ __('Delete Account') }}
                        </h2>
                    </div>
                    <div class="card-body py-2 my-25">
                        <div class="alert alert-warning">

                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Are you sure you want to delete your account?') }}
                            </h2>
                            <div class="alert-body fw-normal">
                                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                    {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                                </p>

                            </div>
                        </div>


                        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
                            @csrf
                            @method('delete')


                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="accountActivation"
                                    id="accountActivation" data-msg="Please confirm you want to delete account" />
                                <label class="form-check-label font-small-3" for="accountActivation">
                                    I confirm my account deactivation
                                </label>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-danger deactivate-account mt-1">
                                    {{ __('Delete Account') }}</button>
                            </div>
                        </form>

                    </div>
                </div>
                <!--/ profile -->
            </div>
        </div>

    </div>

@endsection
