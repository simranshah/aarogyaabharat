<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Aarogyaa Bharat</title>
</head>
<body style="margin: 0; padding: 20px; font-family: Arial, sans-serif; background-color: #f5f5f5;">

  <table style="width: 100%; max-width: 800px; margin: 0 auto; background: white; border-collapse: collapse; box-shadow: 0 0 10px rgba(0,0,0,0.1);">

    <!-- Header -->
    <tr>
      <td colspan="3" style="background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%); color: white; padding: 20px;">
        <table style="width: 100%;">
          <tr>
            <td style="font-size: 24px; font-weight: bold;">Aarogya Bharat</td>
            <td style="text-align: right; font-size: 12px;">
              📞 (+91) 99214 07039<br>
              ✉️ support@aarogyaabharat.com
            </td>
          </tr>
        </table>
      </td>
    </tr>

    <!-- Order Confirmation Header -->
    <tr>
      <td colspan="3" style="background: linear-gradient(135deg, #28a745 0%, #20c997 100%); color: white; padding: 30px 20px; text-align: center;">
        <div style="font-size: 28px; font-weight: bold;">✅ Order Confirmed!</div>
        <div style="font-size: 16px;">Thank you for your order. We're processing it now.</div>
      </td>
    </tr>

    <!-- Order Details -->
    <tr>
      <td colspan="3" style="padding: 20px; background: #f8f9fa;">
        <table style="width: 100%; border-collapse: collapse;">
          <tr>
            <td style="width: 50%; vertical-align: top; padding-right: 20px;">
              <div style="font-weight: bold; margin-bottom: 10px; color: #333;">Order Information</div>
              <div style="line-height: 1.6; font-size: 14px; color: #666;">
                <strong>Order ID:</strong> {{ $order->id ?? 'ORD-2024-001' }}<br>
                <strong>Order Date:</strong> {{ $order->created_at ?? now()->format('d/m/Y H:i') }}<br>
                <strong>Payment Method:</strong> {{ $order->payment_method ?? 'Online Payment' }}<br>
                <strong>Payment Status:</strong> <span style="color: #28a745; font-weight: bold;">{{ $order->payment_status ?? 'Paid' }}</span>
              </div>
            </td>
                         <td style="width: 50%; vertical-align: top;">
               <div style="font-weight: bold; margin-bottom: 10px; color: #333;">Delivery Information</div>
               <div style="line-height: 1.6; font-size: 14px; color: #666;">
                 <strong>Delivery Address:</strong><br>
                 @if(isset($order->orderAddress))
                   {{ $order->orderAddress->house_number ?? '' }} {{ $order->orderAddress->society_name ?? '' }}<br>
                   {{ $order->orderAddress->locality ?? '' }}<br>
                   {{ $order->orderAddress->landmark ?? '' }}<br>
                   {{ $order->orderAddress->city ?? '' }}, {{ $order->orderAddress->state ?? '' }}<br>
                   PIN: {{ $order->orderAddress->pincode ?? '' }}
                 @else
                   Customer Address<br>
                   City, State<br>
                   PIN: 000000
                 @endif<br><br>
                 <strong>Expected Delivery:</strong> {{ $order->orderAddress->expected_delivery ?? now()->addDays(3)->format('d/m/Y') }}<br>
                 <strong>Delivery Method:</strong> {{ $order->orderAddress->delivery_method ?? 'Standard Delivery' }}
               </div>
             </td>
          </tr>
        </table>
      </td>
    </tr>

    <!-- Order Items -->
    <tr>
      <td colspan="3" style="padding: 20px;">
        <div style="font-weight: bold; margin-bottom: 15px; color: #333; font-size: 18px;">Order Items</div>
        <table style="width: 100%; border-collapse: collapse; border: 1px solid #ddd;">
          <tr style="background: #f8f9fa;">
            <td style="padding: 12px; font-weight: bold; border-bottom: 1px solid #ddd;">Product</td>
            <td style="padding: 12px; font-weight: bold; border-bottom: 1px solid #ddd; text-align: center;">Quantity</td>
            <td style="padding: 12px; font-weight: bold; border-bottom: 1px solid #ddd; text-align: right;">Price</td>
            <td style="padding: 12px; font-weight: bold; border-bottom: 1px solid #ddd; text-align: right;">Total</td>
          </tr>
          @php
                $subtotal = 0;
                $tax = 0;
                $delivery_and_installation_fees = 0;
                $total = 0;
            @endphp
          @if(isset($order->orderItems) && count($order->orderItems) > 0)
            @foreach($order->orderItems as $item)
            <tr>
              <td style="padding: 12px; border-bottom: 1px solid #ddd;">{{ $item->product->name ?? 'Product Name' }}</td>
              <td style="padding: 12px; border-bottom: 1px solid #ddd; text-align: center;">{{ $item->quantity ?? 1 }}</td>
              <td style="padding: 12px; border-bottom: 1px solid #ddd; text-align: right;">₹{{ $item->product->our_price ?? '0.00' }}</td>
              <td style="padding: 12px; border-bottom: 1px solid #ddd; text-align: right;">₹{{ (($item->product->our_price + ($item->product->our_price * ($item->product->gst ?? 0)/100) + $item->product->delivery_and_installation_fees) ?? 0) * ($item->quantity ?? 1) }}</td>
            </tr>
            @php
                $subtotal += (($item->product->our_price) * ($item->quantity ?? 1));
                $tax += (($item->product->our_price * ($item->product->gst ?? 0)/100) * ($item->quantity ?? 1));
                $delivery_and_installation_fees += ($item->product->delivery_and_installation_fees ?? 0) * ($item->quantity ?? 1);
                $total += (($item->product->our_price + ($item->product->our_price * ($item->product->gst ?? 0)/100) + $item->product->delivery_and_installation_fees) ?? 0) * ($item->quantity ?? 1);
            @endphp
            @endforeach
          @else
            <tr>
              <td style="padding: 12px; border-bottom: 1px solid #ddd;">Sample Product</td>
              <td style="padding: 12px; border-bottom: 1px solid #ddd; text-align: center;">1</td>
              <td style="padding: 12px; border-bottom: 1px solid #ddd; text-align: right;">₹500.00</td>
              <td style="padding: 12px; border-bottom: 1px solid #ddd; text-align: right;">₹500.00</td>
            </tr>
          @endif
        </table>
      </td>
    </tr>

    <!-- Order Summary -->
    <tr>
      <td colspan="3" style="padding: 20px; background: #f8f9fa;">
        <table style="width: 100%; border-collapse: collapse;">
          <tr>
            <td style="width: 70%;"></td>
            <td style="width: 30%;">
              <table style="width: 100%; border-collapse: collapse;">
                <tr>
                  <td style="padding: 8px 0; border-bottom: 1px solid #ddd;">Subtotal:</td>
                  <td style="padding: 8px 0; border-bottom: 1px solid #ddd; text-align: right;">₹{{ $subtotal ?? '500.00' }}</td>
                </tr>
                <tr>
                  <td style="padding: 8px 0; border-bottom: 1px solid #ddd;">Shipping:</td>
                  <td style="padding: 8px 0; border-bottom: 1px solid #ddd; text-align: right;">₹{{ $delivery_and_installation_fees ?? '50.00' }}</td>
                </tr>
                <tr>
                  <td style="padding: 8px 0; border-bottom: 1px solid #ddd;">Tax:</td>
                  <td style="padding: 8px 0; border-bottom: 1px solid #ddd; text-align: right;">₹{{ $tax ?? '25.00' }}</td>
                </tr>
                <tr>
                  <td style="padding: 8px 0; font-weight: bold; font-size: 16px;">Total:</td>
                  <td style="padding: 8px 0; font-weight: bold; font-size: 16px; text-align: right; color: #1e3c72;">₹{{ $total ?? '575.00' }}</td>
                </tr>
              </table>
            </td>
          </tr>
        </table>
      </td>
    </tr>

    <!-- Order Status -->
    <tr>
      <td colspan="3" style="padding: 20px; text-align: center;">
        <div style="background: #e8f5e8; border: 1px solid #28a745; border-radius: 8px; padding: 20px; margin-bottom: 20px;">
          <div style="font-size: 18px; font-weight: bold; color: #28a745; margin-bottom: 10px;">📦 Order Status: Processing</div>
          <div style="color: #666; line-height: 1.6;">
            Your order has been confirmed and is being processed. We'll notify you when it ships!
          </div>
        </div>
      </td>
    </tr>



    <!-- Support Info -->
    <tr>
      <td colspan="3" style="background: #ffffff; padding: 20px;">
        <div style="font-weight: bold; color: #333; margin-bottom: 10px;">Questions About Your Order?</div>
        <div style="font-size: 13px; color: #666;">
          📞 Order Support: +91 99214 07039<br>
          ✉️ Email: orders@aarogyaabharat.com<br>
          🌐 Track Order: <a href="#" style="color: #1e3c72;">www.aarogyaabharat.com</a><br>
          💬 Live Chat: 24/7 Available<br>
          📱 WhatsApp: +91 99214 07039
        </div>
      </td>
    </tr>

    <!-- Legal Footer -->
    <tr>
      <td colspan="3" style="background: #1e3c72; color: white; padding: 20px; text-align: center; font-size: 12px;">
        Aarogyaa Bharat Healthcare<br>
        This is an automated order confirmation email. For order-related questions, contact our support team.<br>
        © {{ date('Y') }} Aarogyaa Bharat. All rights reserved.<br><br>
        {{-- <a href="https://www.aarogyaabharat.com/order-history" style="color: #fff; text-decoration: underline;">View All Orders</a> |  --}}
        <a href="https://www.aarogyaabharat.com/contact" style="color: #fff; text-decoration: underline;">Contact Support</a>
      </td>
    </tr>

  </table>

</body>
</html>
