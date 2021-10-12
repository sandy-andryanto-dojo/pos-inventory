
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Hello World">
        <meta name="author" content="Sandy Andryanto">
        <title> {{ env('APP_NAME', 'Laravel') }} - Print Report Customer Order</title>
        <!-- Bootstrap Core CSS -->
        <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">
    </head>
    <body onload="window.print()">
        <div class="">
            <div class="container-fluid table-responsive">
                <h1 class='text-center'>
                    SALE ORDER REPORT BY CUSTOMER
                </h1>
                <hr>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Customer Name</th>
                            <th>Total Items</th>
                            <th>Total Sale</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($data) > 0)
                            @foreach($data as $row)
                                <tr>
                                    <td>{{ $row->customer_name }}</td>
                                    <td>{{ $row->total_items }}</td>
                                    <td>{{ $row->total_cost }}</td>
                                </tr>
                            @endforeach
                        @else 
                        <tr class="text-center">
                            <td colspan="3">
                                -- No Data --
                            </td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html>