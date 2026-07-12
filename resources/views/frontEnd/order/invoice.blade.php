<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Invoice {{ $order->order_no }}</title>

    <style>
        body {
            font-family: sans-serif;
            color: #303330;
            font-size: 13px;
        }

        .header-table {
            width: 100%;
            margin-bottom: 30px;
        }

        .header-table td {
            vertical-align: top;
        }

        .brand-title {
            font-size: 22px;
            font-weight: bold;
            color: #944c00;
            margin: 0 0 8px 0;
        }

        .text-muted {
            color: #5d605c;
            line-height: 1.6;
        }

        .text-right {
            text-align: right;
        }

        .text-left {
            text-align: end !important;
        }

        .invoice-label {
            font-size: 20px;
            font-weight: bold;
            margin: 0 0 4px 0;
        }

        .invoice-number {
            color: #944c00;
            font-weight: bold;
            letter-spacing: 1px;
            margin-bottom: 10px;
        }

        .section-title {
            font-size: 11px;
            font-weight: bold;
            letter-spacing: 1px;
            text-transform: uppercase;
            color: #797b78;
            margin-bottom: 8px;
        }

        .customer-name {
            font-weight: bold;
            font-size: 15px;
            margin: 0 0 4px 0;
        }

        .status-pill {
            background-color: #e6f5f3;
            border: 1px solid #b2e0da;
            border-radius: 20px;
            padding: 6px 16px;
            color: #006b63;
            font-weight: bold;
            font-size: 11px;
            text-transform: uppercase;
            display: inline-block;
        }

        table.items {
            width: 100%;
            border-collapse: collapse;
            margin: 25px 0;
        }

        table.items th {
            text-align: left;
            font-size: 10px;
            letter-spacing: 1px;
            text-transform: uppercase;
            color: #797b78;
            border-bottom: 1px solid #b1b2af;
            padding: 8px 6px;
        }

        table.items td {
            padding: 12px 6px;
            border-bottom: 1px solid #eee;
            vertical-align: top;
        }

        .item-title {
            font-weight: bold;
            font-size: 13px;
            margin: 0 0 3px 0;
        }

        .item-sub {
            color: #5d605c;
            font-size: 11px;
            margin: 0;
        }

        .summary-table {
            width: 260px;
            float: right !important;
            margin-top: 10px;
        }

        .summary-table td {
            padding: 6px 0;
        }

        .summary-total-label {
            font-weight: bold;
            font-size: 15px;
            border-top: 1px solid #b1b2af;
            padding-top: 12px;
        }

        .summary-total-value {
            font-weight: bold;
            font-size: 20px;
            color: #944c00;
            border-top: 1px solid #b1b2af;
            padding-top: 12px;
        }

        .coupon-text {
            color: #944c00;
        }

        .footer {
            clear: both;
            border-top: 1px solid #b1b2af;
            margin-top: 60px;
            padding-top: 15px;
            text-align: center;
            color: #5d605c;
            font-size: 11px;
            line-height: 1.6;
        }
    </style>
</head>

<body>

    @php
        $siteSettings = $siteSettings ?? \App\Models\SiteSetting::current();
        $logoPath = $logoPath ?? ($siteSettings->brand_logo_path ? public_path($siteSettings->brand_logo_path) : null);
    @endphp

    <table class="header-table">
        <tr>
            <td width="50%">
                <table cellpadding="0" cellspacing="0" style="margin-bottom:6px;">
                    <tr>
                        @if ($logoPath && file_exists($logoPath))
                            <td style="width:40px; vertical-align:middle; padding-right:8px;">
                                <img src="{{ $logoPath }}" alt="{{ $siteSettings->brand_logo_text }}"
                                    style="height:36px;">
                            </td>
                        @endif
                        <td style="vertical-align:middle;">
                            <span class="brand-title"
                                style="font-size:16px; font-weight:bold;">{{ $siteSettings->brand_logo_text }}</span>
                        </td>
                    </tr>
                </table>
                <p class="text-muted">
                    {{ $siteSettings->studio_location }}<br>
                    <strong>{{ $siteSettings->contact_email }}</strong>
                </p>
            </td>
            <td width="50%" class="text-right">
                <p class="invoice-label">INVOICE</p>
                <p class="invoice-number">#{{ $order->order_no }}</p>
                <p class="text-muted">
                    <strong>Date:</strong> {{ $order->created_at->format('F d, Y') }}<br>
                    <strong>Payment Method:</strong> {{ $order->payMethod->name ?? 'N/A' }}
                </p>
            </td>
        </tr>
    </table>

    <table class="header-table">
        <tr>
            <td width="50%">
                <p class="section-title">Bill To</p>
                <p class="customer-name">{{ $order->shipping_name }}</p>
                <p class="text-muted">
                    {{ $order->shipping_address }}<br>
                    {{ $order->shipping_zone }}
                </p>
                <p class="customer-name">{{ $order->shipping_mobile }}</p>
                <p style="color:#006b63; font-weight:bold;">{{ $order->shipping_email }}</p>
            </td>
            <td width="50%" class="text-right">
                <span class="status-pill">
                    Status: {{ ucfirst($order->status) }}
                </span>
            </td>
        </tr>
    </table>

    <table class="items">
        <thead>
            <tr>
                <th>Description</th>
                <th class="text-left">Qty</th>
                <th class="text-left">Price</th>
                <th class="text-left">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order->items as $item)
                <tr>
                    <td>
                        <p class="item-title">{{ $item->product->product_name ?? $item->product_name }}</p>
                    </td>
                    <td class="text-left">{{ $item->quantity }}</td>
                    <td class="text-left">{{ number_format($item->price, 2) }}</td>
                    <td class="text-left"><strong>{{ number_format($item->quantity * $item->price, 2) }}</strong></td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <table style="width:100%; border-collapse:collapse; margin-top:10px;">
        <tr>
            <td style="width:50%;"></td>
            <td style="width:50%; vertical-align:top;">
                <table class="summary-table" style="width:100%; float:none;">
                    <tr>
                        <td class="text-muted">Subtotal</td>
                        <td class="text-right">{{ number_format($order->subtotal, 2) }}</td>
                    </tr>
                    @if ($order->coupon_code)
                        <tr>
                            <td class="coupon-text">Coupon ({{ $order->coupon_code }})</td>
                            <td class="text-right coupon-text">-{{ number_format($order->discount_amount, 2) }}</td>
                        </tr>
                    @endif
                    <tr>
                        <td class="text-muted">Shipping</td>
                        <td class="text-right">
                            {{ $order->shipping_charge > 0 ? '' . number_format($order->shipping_charge, 2) : 'Free' }}
                        </td>
                    </tr>
                    <tr>
                        <td class="summary-total-label">Total</td>
                        <td class="text-right summary-total-value">{{ number_format($order->total, 2) }}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <div class="footer">
        Thank you for choosing <strong>{{ $siteSettings->brand_logo_text }}</strong> for your companion's care.<br>
        Premium Curation &bull; Sustainable Living &bull; Holistic Pet Wellness
    </div>

</body>

</html>
