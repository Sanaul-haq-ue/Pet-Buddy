<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation | PetBuddy</title>
</head>
<body style="margin:0; padding:0; background-color:#f4f4f0; font-family:'Helvetica Neue', Helvetica, Arial, sans-serif; color:#303330;">

    <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:#f4f4f0; padding: 40px 0;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0" border="0" style="max-width:600px; width:100%;">

                    {{-- ── Header / Brand ── --}}
                    <tr>
                        <td align="center" style="background: linear-gradient(135deg, #944c00, #ffaf72); border-radius: 16px 16px 0 0; padding: 36px 40px;">
                            <h1 style="margin:0; font-size:32px; font-weight:800; color:#ffffff; letter-spacing:-0.5px;">
                                🐾 PetBuddy
                            </h1>
                            <p style="margin:8px 0 0; font-size:14px; color:rgba(255,255,255,0.85); font-weight:500;">
                                Your pet deserves the best
                            </p>
                        </td>
                    </tr>

                    {{-- ── Success Banner ── --}}
                    <tr>
                        <td style="background:#ffffff; padding: 36px 40px 24px; text-align:center;">
                            <div style="width:64px; height:64px; background:linear-gradient(135deg,#944c00,#ffaf72); border-radius:50%; margin:0 auto 16px; display:flex; align-items:center; justify-content:center;">
                                <span style="font-size:28px; line-height:64px; display:block;">✓</span>
                            </div>
                            <h2 style="margin:0 0 8px; font-size:24px; font-weight:800; color:#303330;">
                                Order Placed Successfully!
                            </h2>
                            <p style="margin:0; font-size:15px; color:#5d605c;">
                                Thank you <strong style="color:#944c00;">{{ $order->shipping_name }}</strong>, your order has been received and is being processed.
                            </p>
                        </td>
                    </tr>

                    {{-- ── Order Info Banner ── --}}
                    <tr>
                        <td style="background:#ffffff; padding: 0 40px 24px;">
                            <div style="background:#fff7f0; border:1.5px solid #ffaf72; border-radius:12px; padding:16px 20px;">
                                <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                    <tr>
                                        <td style="font-size:13px; color:#5d605c;">
                                            <strong style="color:#303330;">Order No</strong><br>
                                            <span style="font-size:16px; font-weight:700; color:#944c00;">#{{ $order->order_no }}</span>
                                        </td>
                                        <td style="font-size:13px; color:#5d605c; text-align:center;">
                                            <strong style="color:#303330;">Order Date</strong><br>
                                            <span style="font-size:15px; font-weight:600; color:#303330;">{{ $order->created_at->format('d M Y') }}</span>
                                        </td>
                                        <td style="font-size:13px; color:#5d605c; text-align:right;">
                                            <strong style="color:#303330;">Est. Delivery</strong><br>
                                            <span style="font-size:15px; font-weight:600; color:#303330;">{{ $order->created_at->addDays(7)->format('d M Y') }}</span>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </td>
                    </tr>

                    {{-- ── Order Items ── --}}
                    <tr>
                        <td style="background:#ffffff; padding: 0 40px 24px;">
                            <h3 style="margin:0 0 16px; font-size:16px; font-weight:700; color:#303330; border-bottom:2px solid #f4f4f0; padding-bottom:10px;">
                                Items Ordered
                            </h3>

                            @foreach($order->items as $item)
                            <table width="100%" cellpadding="0" cellspacing="0" border="0" style="margin-bottom:14px;">
                                <tr>
                                    <td width="64" style="vertical-align:top;">
                                        <img src="{{ asset($item->product->image) }}"
                                             alt="{{ $item->product->product_name }}"
                                             width="64" height="64"
                                             style="border-radius:10px; object-fit:cover; display:block; border:1px solid #eee;">
                                    </td>
                                    <td style="padding-left:14px; vertical-align:top;">
                                        <p style="margin:0 0 4px; font-size:15px; font-weight:700; color:#303330;">
                                            {{ $item->product->product_name }}
                                        </p>
                                        <p style="margin:0; font-size:13px; color:#5d605c;">
                                            Qty: {{ $item->quantity }} &nbsp;•&nbsp;
                                            ৳{{ number_format($item->price, 2) }} each
                                        </p>
                                    </td>
                                    <td style="text-align:right; vertical-align:top;">
                                        <p style="margin:0; font-size:15px; font-weight:700; color:#944c00;">
                                            ৳{{ number_format($item->price * $item->quantity, 2) }}
                                        </p>
                                    </td>
                                </tr>
                            </table>
                            @endforeach
                        </td>
                    </tr>

                    {{-- ── Price Breakdown ── --}}
                    <tr>
                        <td style="background:#ffffff; padding: 0 40px 24px;">
                            <div style="background:#f9f9f7; border-radius:12px; padding:18px 20px;">
                                <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                    <tr>
                                        <td style="font-size:14px; color:#5d605c; padding-bottom:8px;">Subtotal</td>
                                        <td style="font-size:14px; color:#303330; font-weight:600; text-align:right; padding-bottom:8px;">৳{{ number_format($order->subtotal, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <td style="font-size:14px; color:#5d605c; padding-bottom:8px;">Shipping</td>
                                        <td style="font-size:14px; font-weight:600; text-align:right; padding-bottom:8px; color:{{ $order->shipping_charge > 0 ? '#303330' : '#16a34a' }};">
                                            {{ $order->shipping_charge > 0 ? '৳' . number_format($order->shipping_charge, 2) : 'Free' }}
                                        </td>
                                    </tr>
                                    @if($order->discount_amount > 0)
                                    <tr>
                                        <td style="font-size:14px; color:#5d605c; padding-bottom:8px;">Discount</td>
                                        <td style="font-size:14px; color:#16a34a; font-weight:600; text-align:right; padding-bottom:8px;">-৳{{ number_format($order->discount_amount, 2) }}</td>
                                    </tr>
                                    @endif
                                    <tr>
                                        <td colspan="2" style="border-top:1.5px solid #e5e5e0; padding-top:12px;"></td>
                                    </tr>
                                    <tr>
                                        <td style="font-size:17px; font-weight:800; color:#303330;">Total</td>
                                        <td style="font-size:17px; font-weight:800; color:#944c00; text-align:right;">৳{{ number_format($order->total, 2) }}</td>
                                    </tr>
                                </table>
                            </div>
                        </td>
                    </tr>

                    {{-- ── Shipping Address ── --}}
                    <tr>
                        <td style="background:#ffffff; padding: 0 40px 24px;">
                            <h3 style="margin:0 0 12px; font-size:16px; font-weight:700; color:#303330;">
                                Shipping Address
                            </h3>
                            <p style="margin:0; font-size:14px; color:#5d605c; line-height:1.7;">
                                <strong style="color:#303330;">{{ $order->shipping_name }}</strong><br>
                                {{ $order->shipping_address }}<br>
                                📞 {{ $order->shipping_mobile }}<br>
                                ✉️ {{ $order->shipping_email }}
                            </p>
                        </td>
                    </tr>

                    {{-- ── Payment Info ── --}}
                    <tr>
                        <td style="background:#ffffff; padding: 0 40px 32px;">
                            <h3 style="margin:0 0 12px; font-size:16px; font-weight:700; color:#303330;">
                                Payment Info
                            </h3>
                            <p style="margin:0; font-size:14px; color:#5d605c;">
                                <strong style="color:#303330;">Type:</strong> {{ $order->payType?->name ?? 'N/A' }}<br>
                                <strong style="color:#303330;">Method:</strong> {{ $order->payMethod?->name ?? 'N/A' }}
                            </p>
                        </td>
                    </tr>

                    {{-- ── Info Note ── --}}
                    <tr>
                        <td style="background:#ffffff; padding: 0 40px 32px;">
                            <div style="background:#fffbeb; border:1.5px solid #fcd34d; border-radius:12px; padding:14px 18px;">
                                <p style="margin:0; font-size:13px; color:#92400e;">
                                    ⏳ <strong>Please note:</strong> Your order is being reviewed and will be confirmed within <strong>24 hours</strong>. You will receive another email once confirmed.
                                </p>
                            </div>
                        </td>
                    </tr>

                    {{-- ── Footer ── --}}
                    <tr>
                        <td align="center" style="background:#303330; border-radius:0 0 16px 16px; padding:28px 40px;">
                            <p style="margin:0 0 6px; font-size:18px; font-weight:800; color:#ffaf72;">🐾 PetBuddy</p>
                            <p style="margin:0 0 12px; font-size:12px; color:rgba(255,255,255,0.5);">
                                Your pet deserves the best
                            </p>
                            <p style="margin:0; font-size:11px; color:rgba(255,255,255,0.35);">
                                This is an automated email. Please do not reply directly to this message.
                            </p>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>

</body>
</html>