
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Hello World">
        <meta name="author" content="Sandy Andryanto">
        <title> {{ env('APP_NAME', 'Laravel') }} - Print Report Fee</title>
        <!-- Bootstrap Core CSS -->
        <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">
    </head>
    <body onload="window.print()">
        <div class="">
            <div class="container-fluid table-responsive">
                <h1 class='text-center'>
                    FEE ORDER REPORT 
                </h1>
                <hr>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Invoice Date</th>
                            <th>Invoice Number</th>
                            <th>Casheir</th>
                            <th>Stakeholder</th>
                            <th>Notes</th>
                            <th>Description</th>
                            <th>Total Paid</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($data) > 0)
                            @foreach($data as $model)
                            <tr>
                                <td>{{ $model->created_at }}</td>
                                <td>{{ $model->invoice_number }}</td>
                                <td>{{ CommonHelper::getFullNameUser($model->user_id) }}</td>
                                <td>{{ isset($model->Stakeholder->name) ? $model->Stakeholder->name : "-" }}</td>
                                <td>{{ $model->notes }}</td>
                                <td>{{ $model->description }}</td>
                                <td> {{ $model->grandtotal }}</td>
                            </tr>
                            @endforeach
                        @else
                            <tr class='text-center'>
                                <td colspan='7'>
                                    -- No Items --
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html>