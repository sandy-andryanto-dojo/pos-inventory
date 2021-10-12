
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Hello World">
        <meta name="author" content="Sandy Andryanto">
        <title> {{ env('APP_NAME', 'Laravel') }} - Print Report Purchase Order</title>
        <!-- Bootstrap Core CSS -->
        <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">
    </head>
    <body onload="window.print()">
        <div class="">
            <div class="container-fluid table-responsive">
                <h1 class='text-center'>
                    PURCHASE ORDER REPORT 
                </h1>
                <hr>
                @if(count($data) > 0)
                        @foreach($data as $model)
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th colspan="2">Invoice Date : {{ $model->created_at }}</th>
                                    <th colspan="2">Invoice Number : {{ $model->invoice_number }}</th>
                                </tr>
                                <tr>
                                    <th colspan="2">Supplier : {{ isset($model->Supplier->name) ? $model->Supplier->name : "-" }}</th>
                                    <th colspan="2">Casheir : {{ CommonHelper::getFullNameUser($model->user_id) }}</th>
                                </tr>
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Qty</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $details = \App\Models\TransactionDetail::where("transaction_id", $model->id)->get(); @endphp
                                @if(count($details) > 0)
                                    @foreach($details as $detail)
                                        <tr>
                                            <td>{{ isset($detail->Product->sku) ? $detail->Product->sku : null }} - {{ isset($detail->Product->name) ? $detail->Product->name : null }}</td>
                                            <td>{{ $detail->price }}</td>
                                            <td>{{ $detail->qty }}</td>
                                            <td>{{ $detail->total }}</td>
                                        </tr>
                                    @endforeach
                                @else
                                <tr class='text-center'>
                                    <td colspan='4'>
                                        -- No Items --
                                    </td>
                                </tr>
                                @endif
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="2">Discount : {{ $model->discount }}</th>
                                    <th colspan="2">Tax : {{ $model->tax }}</th>
                                </tr>
                                <tr>
                                    <th colspan="2">Subtotal : {{ $model->subtotal }}</th>
                                    <th colspan="2">Grand Total : {{ $model->grandtotal }}</th>
                                </tr>
                                @if(!is_null($model->bank_id))
                                <tr>
                                    <th colspan="2">Credit Card Number : {{ $model->creditcard_number }}</th>
                                    <th colspan="2">Bank : {{ $model->Bank->name }}</th>
                                </tr>
                                @else
                                <tr>
                                    <th colspan="2">Petty Cash : {{ $model->cash }}</th>
                                    <th colspan="2">Change : {{ $model->change }}</th>
                                </tr>
                                @endif
                            </tfoot>
                        </table>
                        <hr>
                    @endforeach
                @endif
            </div>
        </div>
    </body>
</html>