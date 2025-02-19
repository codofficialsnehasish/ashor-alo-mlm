<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
        }
        .container {
            width: 100%;
            padding: 20px;
            margin: 0 auto;
        }
        .card {
            border: 1px solid #ddd;
            margin-bottom: 20px;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            background-color: #007bff;
            color: white;
            padding: 10px;
            border-radius: 6px;
            font-size: 1.2em;
        }
        .card-body {
            padding: 15px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 12px;
            text-align: left;
            font-size: 0.95em;
        }
        th {
            background-color: #f8f9fa;
        }
        .text-center {
            text-align: center;
        }
        .total-summary {
            font-weight: bold;
            margin-top: 20px;
            font-size: 1.1em;
        }
        .badge-active {
            background-color: #28a745;
            color: white;
            padding: 4px 8px;
            border-radius: 5px;
            font-size: 0.9em;
        }
        .btn-export {
            background-color: #007bff;
            color: white;
            padding: 10px 15px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 1em;
            display: inline-block;
        }
        .btn-export:hover {
            background-color: #0056b3;
        }
        .text-wrap {
            word-wrap: break-word;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-body text-center">
                <h3><strong>{{ $title }}</strong></h3>
            </div>
        </div>
        
        @php 
            $total_amount = 0;
            $total_user_count = 0;
        @endphp

        @if(!empty($groupedBusiness))
            @foreach ($groupedBusiness as $level => $business)
                <div class="card">
                    <div class="card-header text-center">
                        Level {{ $level }}
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table>
                                <thead>
                                    <tr>
                                        {{-- <th class="text-wrap">Sl. No.</th> --}}
                                        <th class="text-wrap">Name</th>
                                        <th class="text-wrap">Pos.</th>
                                        <th class="text-wrap">Phone</th>
                                        <th class="text-wrap">Sponsor ID</th>
                                        <th class="text-wrap">Date</th>
                                        <th class="text-wrap">Amount</th>
                                        <th class="text-wrap">Product</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $amount = 0 @endphp
                                    @if(!empty($business))
                                        @foreach($business as $item)
                                            @php 
                                                $amount += $item['total_business']->total_amount;
                                                $total_amount += $item['total_business']->total_amount;
                                                $total_user_count += 1;
                                            @endphp
                                            <tr>
                                                {{-- <td>{{ $loop->iteration }}</td> --}}
                                                <td>{{ $item['name'] }} ({{ $item['user_id'] }}) </td>
                                                <td>{{ $item['position'] }}</td>
                                                <td>{{ $item['phone'] }}</td>
                                                <td>{{ $item['sponsor_id'] }}</td>
                                                <td>{{ formated_date($item['total_business']->start_date, '-') }}</td>
                                                <td>{{ $item['total_business']->total_amount }}</td>
                                                <td>{{ get_products_by_order_id($item['total_business']->order_id) }}</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="5" class="text-right"><b>Total Amount -</b></td>
                                        <td><b>{{ $amount }}</b></td>
                                        <td></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif

        <div class="card">
            <div class="card-body text-center total-summary">
                <b>Total Member: <strong>{{ $total_user_count }}</strong></b> |
                <b>Total Amount: <strong>{{ $total_amount }}</strong></b>
            </div>
        </div>
    </div>
</body>
</html>
