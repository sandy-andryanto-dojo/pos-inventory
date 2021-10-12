<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Hello World">
        <meta name="author" content="Sandy Andryanto">
        <title> {{ env('APP_NAME', 'Laravel') }} - Print Invoice Purchase</title>
        <!-- Bootstrap Core CSS -->
        <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">
    </head>
    <body onload="{{ (int) $data->transaction->is_purchased == 1 ? 'window.print()' : '' }}">
        <div class="">
            <div class="container-fluid table-responsive">
                <h1></h1>
                <div class="row">
                    <div class="col-md-6 text-left">
                        <h1 class=''>
                            PURCHASE ORDER INVOICE
                        </h1>
                        <p></p>
                        <div class="text-left">
                            {!! CommonHelper::getConfig("header-invoice") !!}
                        </div>
                    </div>
                    <div class="col-md-6 text-right">
                        <img src="{{ CommonHelper::getCompanyLogo() }}" class="img img-responsive img-thumbnail" width="100">
                        <h1></h1>
                        <p><strong>{{ CommonHelper::getConfig("company-name") }}</strong></p>
                        <p>Address : {{ CommonHelper::getConfig("company-address") }}</p>
                        <p>Phone : {{ CommonHelper::getConfig("company-phone") }}, Email : {{ CommonHelper::getConfig("company-email") }}</p>
                    </div>
                </div>
                <hr>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th colspan="2">Record Date : {{ $data->transaction->record_date }}</th>
                            <th colspan="2">Print Date : {{ now() }}</th>
                        </tr>
                        <tr>
                            <th colspan="2">Invoice Date : {{ $data->transaction->invoice_date }}</th>
                            <th colspan="2">Invoice Number : {{ $data->transaction->invoice_number }}</th>
                        </tr>
                        <tr>
                            <th colspan="2">Supplier : {{ $data->supplier->name }}</th>
                            <th colspan="2">Casheir : {{ CommonHelper::getFullNameUser($data->transaction->user_id) }}</th>
                        </tr>
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Qty</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                       @if(count($data->details) > 0)
                            @foreach($data->details as $row)
                            <tr>
                                <td>{{ $row->product_sku }} - {{ $row->product_name }}</td>
                                <td>{{ $row->price }}</td>
                                <td>{{ $row->qty }}</td>
                                <td>{{ $row->total }}</td>
                            </tr>
                            @endforeach
                       @else
                       
                       @endif
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="2">Discount : {{ $data->transaction->discount }}</th>
                            <th colspan="2">Tax : {{ $data->transaction->tax }}</th>
                        </tr>
                        <tr>
                            <th colspan="2">Subtotal : {{ $data->transaction->subtotal }}</th>
                            <th colspan="2">Grand Total : {{ $data->transaction->grandtotal }}</th>
                        </tr>
                        @if(!is_null($data->bank))
                        <tr>
                            <th colspan="2">Credit Card Number : {{ $data->transaction->creditcard_number }}</th>
                            <th colspan="2">Bank : {{ $data->bank->name }}</th>
                        </tr>
                        @else
                        <tr>
                            <th colspan="2">Petty Cash : {{ $data->transaction->cash }}</th>
                            <th colspan="2">Change : {{ $data->transaction->change }}</th>
                        </tr>
                        @endif
                    </tfoot>
                </table>
                <div class="text-left">
                    <hr>
                    {!! CommonHelper::getConfig("footer-invoice") !!}
                </div>
            </div>
        </div>
    </body>
</html>