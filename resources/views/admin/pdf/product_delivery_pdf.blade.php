<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <style>
        @page {
            size: A4;
            margin: 20mm;
        }
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
        }
        .container {
            width: 100%;
            padding: 5px;
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
            table-layout: fixed;
            width: 100%;
            border-collapse: collapse;
            word-wrap: break-word;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 8px;
            font-size: 0.85em;
            word-break: break-word;
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
        <h3 class="text-center"><strong>{{ $title }}</strong></h3>

        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <td class="text-wrap">Place Date</td>
                        <th class="text-wrap">Order ID</th>
                        <th class="text-wrap">User Name</th>
                        <th class="text-wrap">User ID</th>
                        <th class="text-wrap">Total Price</th>
                        <th class="text-wrap">Payment Method</th>
                        <th class="text-wrap">Payment Status</th>
                        <th class="text-wrap">Order Status</th>
                        <th class="text-wrap">Delivered At</th>
                        <th class="text-wrap">Created By</th>
                    </tr>
                </thead>
                <tbody>
                    @if(!empty($orders))
                    @foreach($orders as $order)
                    <tr>
                        <td class="text-wrap">{{ format_datetime($order->created_at)  }}</td>
                        <td>#{{ $order->order_number  }}</td>
                        <td class="text-wrap">{{ $order->user->name ?? ''  }}</td>
                        <td>{{ get_user_id($order->buyer_id) }}</td>
                        <td>{{ $order->price_total }}</td>
                        <td>{{ $order->payment_method }}</td>
                        <td>{{ $order->payment_status }}</b></td>
                        <td>{{ $order->order_status }}</td>
                        <td>@if($order->status) {{ !empty($order->delivered_date) ? format_datetime($order->delivered_date) : format_datetime($order->updated_at) }} @endif</td>
                        <td class="text-wrap">{{ $order->placed_by }}</td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>

    </div>
</body>
</html>
