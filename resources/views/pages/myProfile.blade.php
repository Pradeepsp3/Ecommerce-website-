@extends('master')
@section('title', 'My Profile')
<link rel="stylesheet" href="{{ asset('assets/css/myProfile.css') }}">
@section('main-content')
    @if ($message = Session::get('profileupdated'))
        <div class="alert alert-success">
            {{ $message }}
            <button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if ($message = Session::get('cardAdded'))
        <div class="alert alert-success">
            {{ $message }}
            <button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="container rounded bg-white mt-5 mb-5">
        <form action="{{ url('updateProfile/' . $user->id) }}" method="POST">
            @csrf
            @method('patch')
            <div class="row">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">Profile Settings</h4>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-12"><label class="labels">Name</label><input type="text" class="form-control"
                                placeholder="first name" name='name' value="{{ $user->name }}"></div>
                        @error('name')
                            <div class="error">{{ '*' . $message }}</div>
                        @enderror
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6"><label class="labels">Mobile Number</label><input type="text"
                                class="form-control" name='phone' placeholder="enter phone number"
                                value="{{ $user->phone }}"></div>
                        @error('phone')
                            <div class="error">{{ '*' . $message }}</div>
                        @enderror
                        <div class="col-md-6"><label class="labels">Email ID</label><input type="text"
                                class="form-control" name='email' placeholder="enter email id"
                                value="{{ $user->email }}"></div>
                        @error('email')
                            <div class="error">{{ '*' . $message }}</div>
                        @enderror
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12"><label class="labels">Address Line 1</label><input type="text"
                                class="form-control" name='address' placeholder="enter address line 1"
                                value="{{ $user->address }}"></div>
                        @error('address')
                            <div class="error">{{ '*' . $message }}</div>
                        @enderror
                        <div class="col-md-12"><label class="labels">Address Line 2</label><input type="text"
                                class="form-control" name='address1' placeholder="enter address line 2"
                                value="{{ $user->address2 }}"></div>
                        @error('address2')
                            <div class="error">{{ '*' . $message }}</div>
                        @enderror
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6"><label class="labels">City</label><input type="text" class="form-control"
                                name='city' placeholder="city" value="{{ $user->city }}"></div>
                        @error('city')
                            <div class="error">{{ '*' . $message }}</div>
                        @enderror
                        <div class="col-md-6"><label class="labels">State</label><input type="text" class="form-control"
                                value="{{ $user->state }}" name='state' placeholder="state"></div>
                        @error('state')
                            <div class="error">{{ '*' . $message }}</div>
                        @enderror
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6"><label class="labels">Country</label><input type="text"
                                class="form-control" name='country' placeholder="country" value="{{ $user->country }}">
                        </div>
                        @error('country')
                            <div class="error">{{ '*' . $message }}</div>
                        @enderror
                        <div class="col-md-6"><label class="labels">zipcode</label><input type="text"
                                class="form-control" value="{{ $user->zipcode }}" name='zipcode' placeholder="zipcode">
                        </div>
                        @error('zipcode')
                            <div class="error">{{ '*' . $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <div class="row mt-3 d-flex col-md-10">
                            <div class="col-md-5 text-info d-flex justify-content-end align-items-center fs-4">Select to
                                View
                                Added Cards:</div>
                            <div class="btn-group col-md-5" role="group" aria-label="Basic radio toggle button group">
                                <input type="radio" class="btn-check" name="cardType" value="debit" id="debit"
                                    autocomplete="off" onclick="debitCardView()">
                                <label class="btn btn-outline-primary" for="debit">Debit Card</label>

                                <input type="radio" class="btn-check" name="cardType" value="credit" id="credit"
                                    autocomplete="off" onclick="creditCardView()">
                                <label class="btn btn-outline-primary" for="credit">Credit Card</label>
                            </div>
                        </div>
                        <div id="creditView" style="display:none">
                            <div class="row">
                                @foreach ($cards as $card)
                                    @if ($card->card_type == 'credit')
                                        <div class="col-sm-6">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h5 class="card-title">{{ $card->name_on_card }}</h5>
                                                    <p class="card-text">{{ $card->card_no }}</p>
                                                    <p class="card-text">{{ $card->expires_at }}</p>
                                                    <a href="" class="btn btn-primary">Remove Card</a>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                        <div id="debitView" style="display:none">
                            <div class="row">
                                @foreach ($cards as $card)
                                    @if ($card->card_type == 'debit')
                                        <div class="col-sm-6">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h5 class="card-title">{{ $card->name_on_card }}</h5>
                                                    <p class="card-text">{{ $card->card_no }}</p>
                                                    <p class="card-text">{{ $card->expires_at }}</p>
                                                    <a href="" class="btn btn-primary">Remove Card</a>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="mt-5 text-center"><a href="{{ url('addCard/' . $user->id) }}"
                            class="btn btn-warning me-2">Add Card Details</a> <input type="submit"
                            class="btn btn-primary profile-button" value="Save Profile">
                    </div>
                </div>
            </div>
        </form>
    </div>
    </div>
    </div>
@endsection
