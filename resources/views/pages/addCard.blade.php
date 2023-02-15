@extends('master')
@section('title', 'View Cart')
@section('main-content')

    <div class="container">
        <div class="row d-flex justify-content-center align-items-center mt-5">
            <div class="col-xs-12 col-md-4 col-md-offset-4">
                <form action="{{ url('storeCardDetails') }}" method="POST">
                    @csrf
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="row mb-2">
                                <h3 class="text-center">Add Cards</h3>
                                <img class="img-responsive cc-img"
                                    src="http://www.prepbootstrap.com/Content/images/shared/misc/creditcardicons.png">
                            </div>
                        </div>
                        <div>
                            <div class="d-flex justify-content-center text-dark mb-1">SELECT CARD TYPE</div>
                            <div class="btn-group d-flex justify-content-center" role="group"
                                aria-label="Basic radio toggle button group">
                                <input type="radio" class="btn-check" name="cardType" value="debit" id="debit" autocomplete="off"
                                    checked>
                                <label class="btn btn-outline-primary" for="debit">Debit Card</label>

                                <input type="radio" class="btn-check" name="cardType" value="credit" id="credit" autocomplete="off">
                                <label class="btn btn-outline-primary" for="credit">Credit Card</label>
                            </div>
                            @error('cardType')
                                <div class="error" style="font-size: 14px;">{{ '*' . $message }}</div>
                            @enderror
                        </div>

                        <div class="panel-body">
                            <form role="form">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="form-group">
                                            <label>CARD NUMBER</label>
                                            <div class="input-group">
                                                <input type="tel" class="form-control" name="cardNumber"
                                                    placeholder="Valid Card Number" />
                                            </div>
                                            @error('cardNumber')
                                                <div class="error" style="font-size: 14px;">{{ '*' . $message }}</div>
                                            @enderror

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-7 col-md-7">
                                        <div class="form-group">
                                            <label><span class="visible-xs-inline">EXP</span> DATE</label>
                                            <input type="tel" class="form-control" name="expiresAt"
                                                placeholder="MM / YY" />

                                            @error('expiresAt')
                                                <div class="error" style="font-size: 14px;">{{ '*' . $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-xs-5 col-md-5 pull-right">
                                        <div class="form-group">
                                            <label>CVV CODE</label>
                                            <input type="tel" class="form-control" name="cvv" placeholder="CVV" />

                                            @error('cvv')
                                                <div class="error" style="font-size: 14px;">{{ '*' . $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" name="cardName" class="form-control"
                                                placeholder="Name on Card" />

                                            @error('cardName')
                                                <div class="error" style="font-size: 14px;">{{ '*' . $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="panel-footer">
                            <div class="row">
                                <div class="col-xs-12">
                                    <button class="btn btn-warning btn-lg btn-block">Add Card</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection
