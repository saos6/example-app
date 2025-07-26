<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Quotation #{{ $quotation->id }}</title>
    <style>
        body {
            font-family: 'ipaexg', sans-serif;
            font-size: 12px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .header, .footer {
            text-align: center;
            margin-bottom: 20px;
        }
        .total {
            text-align: right;
            font-size: 14px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>見積書</h1>
    </div>

    <table>
        <tr>
            <th>見積もりID</th>
            <td>{{ $quotation->id }}</td>
        </tr>
        <tr>
            <th>顧客名</th>
            <td>{{ $quotation->customer->name }}</td>
        </tr>
        <tr>
            <th>担当者</th>
            <td>{{ $quotation->person->name }}</td>
        </tr>
        <tr>
            <th>見積もり日</th>
            <td>{{ $quotation->quotation_date }}</td>
        </tr>
    </table>

    <h2>商品詳細</h2>
    <table>
        <thead>
            <tr>
                <th>商品名</th>
                <th>数量</th>
                <th>単価</th>
                <th>金額</th>
            </tr>
        </thead>
        <tbody>
            @foreach($quotation->quotationItems as $item)
            <tr>
                <td>{{ $item->product->name }}</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ number_format($item->unit_price) }}</td>
                <td>{{ number_format($item->amount) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="total">
        合計金額: {{ number_format($quotation->total_amount) }} 円
    </div>

    <div class="footer">
        <p>ありがとうございます。</p>
    </div>
</body>
</html>