<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Aarogyaa Bharat - Rental Confirmation</title>
</head>
<body style="margin: 0; padding: 20px; font-family: Arial, sans-serif; background-color: #f5f5f5;">

  <table style="width: 100%; max-width: 600px; margin: 0 auto; background: white; border-collapse: collapse; box-shadow: 0 0 10px rgba(0,0,0,0.1); border-radius: 8px; overflow: hidden;">

    <!-- Header with Logo and Rental Confirmed Badge -->
    <tr>
      <td style="background: #4a5fc1; color: white; padding: 20px; position: relative;">
        <table style="width: 100%;">
          <tr>
            <td style="vertical-align: top;">
              <div style="font-size: 24px; font-weight: bold; color: white;">आरोग्य</div>
              <div style="font-size: 24px; font-weight: bold; color: white;">Bharat</div>
            </td>
            <td style="text-align: right; vertical-align: top;">
              <div style="background: #28a745; color: white; padding: 8px 16px; border-radius: 20px; display: inline-block; font-size: 14px; font-weight: bold;">
                ✓ Rental Confirmed
              </div>
            </td>
          </tr>
        </table>
      </td>
    </tr>

    <!-- Greeting -->
    <tr>
      <td style="padding: 20px; border-bottom: 1px solid #eee;">
        <div style="font-size: 16px; color: #333; margin-bottom: 10px;">
          <strong>Hi {{ $order->user->name ?? 'Customer' }},</strong>
        </div>
        <div style="font-size: 14px; color: #666; line-height: 1.5;">
          Thank you for renting with Aarogyaa Bharat.<br>
          You've successfully rented an <strong>{{ $order->product->name ?? 'Medical Equipment' }}</strong> for <strong>{{ $order->tenure }} months</strong>.<br>
          We'll deliver it within 24-48 hours.
        </div>
      </td>
    </tr>

    <!-- Two Column Layout -->
    <tr>
      <td style="padding: 0;">
        <table style="width: 100%; border-collapse: collapse;">
          <tr>
            <!-- Left Column - Rental Information -->
            <td style="width: 50%; vertical-align: top; padding: 20px; border-right: 1px solid #eee;">
              <div style="font-weight: bold; margin-bottom: 15px; color: #333; font-size: 16px;">Rental Information</div>
              <div style="line-height: 1.8; font-size: 14px; color: #666;">
                <div style="margin-bottom: 8px;"><strong>Rental ID:</strong> #{{ $order->id }}</div>
                <div style="margin-bottom: 8px;"><strong>Order Date:</strong> {{ $order->created_at->setTimezone('Asia/Kolkata')->format('d/m/Y H:i') }}</div>
                <div style="margin-bottom: 8px;"><strong>Tenure:</strong> {{ $order->tenure }} months</div>
                <div style="margin-bottom: 8px;"><strong>Last Rental Date:</strong> {{ $order->last_rental_date ? $order->last_rental_date->format('d/m/Y') : 'N/A' }}</div>
                <div style="margin-bottom: 8px;"><strong>Payment Method:</strong> Online Payment (Razorpay)</div>
                <div><strong>Payment Status:</strong> <span style="color: #28a745; font-weight: bold;">Paid</span></div>
              </div>
            </td>
            
            <!-- Right Column - Product Information -->
            <td style="width: 50%; vertical-align: top; padding: 20px;">
              <div style="font-weight: bold; margin-bottom: 15px; color: #333; font-size: 16px;">Product Information</div>
              <div style="line-height: 1.8; font-size: 14px; color: #666;">
                <div style="margin-bottom: 8px;"><strong>Product:</strong> {{ $order->product->name ?? 'Medical Equipment' }}</div>
                <div style="margin-bottom: 8px;"><strong>Customer:</strong> {{ $order->user->name ?? 'Customer' }}</div>
                <div style="margin-bottom: 8px;"><strong>Status:</strong> <span style="color: #28a745; font-weight: bold;">{{ ucfirst($order->status) }}</span></div>
                <div><strong>Total Amount:</strong> ₹{{ number_format((($order->base_amount/$order->tenure)+($order->gst_amount/$order->tenure ?? 0) + $order->deposit+$order->delivery_fees) ?? 0, 2) }}</div>
              </div>
            </td>
          </tr>
        </table>
      </td>
    </tr>

    <!-- Two Column Layout - Shipping & Delivery -->
    <tr>
      <td style="padding: 0; background: #f8f9fa;">
        <table style="width: 100%; border-collapse: collapse;">
          <tr>
            <!-- Left Column - Shipping Information -->
            <td style="width: 50%; vertical-align: top; padding: 20px; border-right: 1px solid #eee;">
              <div style="font-weight: bold; margin-bottom: 15px; color: #333; font-size: 16px;">Shipping Information</div>
              <div style="line-height: 1.8; font-size: 14px; color: #666;">
                @if(isset($order->rentalAddress))
                  <div style="margin-bottom: 8px;"><strong>Deliver to:</strong></div>
                  <div style="margin-bottom: 8px;">{{ $order->rentalAddress->house_number ?? '' }} {{ $order->rentalAddress->society_name ?? '' }}</div>
                  <div style="margin-bottom: 8px;">{{ $order->rentalAddress->locality ?? '' }}</div>
                  <div style="margin-bottom: 8px;">{{ $order->rentalAddress->landmark ?? '' }}</div>
                  <div style="margin-bottom: 8px;">{{ $order->rentalAddress->city ?? '' }}, {{ $order->rentalAddress->state ?? '' }}</div>
                  <div style="margin-bottom: 8px;">PIN: {{ $order->rentalAddress->pincode ?? '' }}</div>
                  <div>Phone: {{ $order->rentalAddress->phone ?? '' }}</div>
                @else
                  <div style="margin-bottom: 8px;"><strong>Deliver to:</strong></div>
                  <div style="margin-bottom: 8px;">Customer Address</div>
                  <div style="margin-bottom: 8px;">City, State</div>
                  <div>PIN: 000000</div>
                @endif
              </div>
            </td>
            
            <!-- Right Column - Delivery Details -->
            <td style="width: 50%; vertical-align: top; padding: 20px;">
              <div style="font-weight: bold; margin-bottom: 15px; color: #333; font-size: 16px;">Delivery Details</div>
              <div style="line-height: 1.8; font-size: 14px; color: #666;">
                <div style="margin-bottom: 8px;"><strong>Expected Delivery:</strong> Within 24-48 hours</div>
                <div style="margin-bottom: 8px;"><strong>Delivery Method:</strong> Standard Delivery</div>
                <div style="margin-bottom: 8px;"><strong>Delivery Partner:</strong> Aarogyaa Bharat Logistics</div>
                <div><strong>Tracking:</strong> Available after dispatch</div>
              </div>
            </td>
          </tr>
        </table>
      </td>
    </tr>

    <!-- Products Table -->
    <tr>
      <td style="padding: 20px;">
        <table style="width: 100%; border-collapse: collapse; border: 1px solid #ddd;">
          <tr style="background: #f8f9fa;">
            <th style="padding: 12px; text-align: left; border-right: 1px solid #ddd; font-size: 14px; color: #333; width: 5%;">SL</th>
            <th style="padding: 12px; text-align: left; border-right: 1px solid #ddd; font-size: 14px; color: #333; width: 35%;">Products</th>
            <th style="padding: 12px; text-align: center; border-right: 1px solid #ddd; font-size: 14px; color: #333; width: 12%;">Tenure</th>
            <th style="padding: 12px; text-align: right; border-right: 1px solid #ddd; font-size: 14px; color: #333; width: 12%;">Rate</th>
            <th style="padding: 12px; text-align: right; border-right: 1px solid #ddd; font-size: 14px; color: #333; width: 12%;">GST</th>
            <th style="padding: 12px; text-align: right; font-size: 14px; color: #333; width: 24%;">Total</th>
          </tr>
          <tr>
            <td style="padding: 12px; text-align: center; border-right: 1px solid #ddd; border-bottom: 1px solid #ddd;">1</td>
            <td style="padding: 12px; border-right: 1px solid #ddd; border-bottom: 1px solid #ddd; font-weight: 500;">{{ $order->product->name ?? 'Medical Equipment' }}</td>
            <td style="padding: 12px; text-align: center; border-right: 1px solid #ddd; border-bottom: 1px solid #ddd;">{{ $order->tenure }} months</td>
            <td style="padding: 12px; text-align: right; border-right: 1px solid #ddd; border-bottom: 1px solid #ddd;">₹{{ number_format($order->base_amount/$order->tenure ?? 0, 2) }}</td>
            <td style="padding: 12px; text-align: right; border-right: 1px solid #ddd; border-bottom: 1px solid #ddd;">₹{{ number_format($order->gst_amount/$order->tenure ?? 0, 2) }}</td>
            <td style="padding: 12px; text-align: right; border-bottom: 1px solid #ddd; font-weight: bold; color: #4a5fc1;">₹{{ number_format((($order->base_amount/$order->tenure)+($order->gst_amount/$order->tenure ?? 0) + $order->deposit+$order->delivery_fees) ?? 0, 2) }}</td>
          </tr>
        </table>
      </td>
    </tr>

    <!-- Support Section -->
    <tr>
      <td style="padding: 20px; background: #f8f9fa; border-top: 1px solid #eee;">
        <div style="font-weight: bold; color: #333; margin-bottom: 10px; font-size: 16px;">Support</div>
        <div style="font-size: 14px; color: #666; line-height: 1.6;">
          <div style="margin-bottom: 8px;">📞 <strong>Rental Support:</strong> +91 99214 07039</div>
          <div style="margin-bottom: 8px;">✉️ <strong>Email:</strong> rentals@aarogyaabharat.com</div>
          <div style="margin-bottom: 8px;">🌐 <strong>Track Rental:</strong> <a href="#" style="color: #4a5fc1;">www.aarogyaabharat.com</a></div>
          <div style="margin-bottom: 8px;">💬 <strong>Live Chat:</strong> 24/7 Available</div>
          <div>📱 <strong>WhatsApp:</strong> +91 99214 07039</div>
        </div>
      </td>
    </tr>

    <!-- Footer -->
    <tr>
      <td style="background: #4a5fc1; color: white; padding: 20px; text-align: center;">
        <div style="font-size: 16px; font-weight: bold; margin-bottom: 8px;">Aarogyaa Bharat Healthcare</div>
        <div style="font-size: 12px; margin-bottom: 10px;">
          This is an automated rental confirmation email. For rental related questions, contact our support team.
        </div>
        <div style="font-size: 12px; margin-bottom: 15px;">
          © {{ date('Y') }} Aarogyaa Bharat. All rights reserved.
        </div>
        <div style="border-top: 1px solid rgba(255,255,255,0.2); padding-top: 15px;">
          <a href="#" style="color: white; text-decoration: underline; margin-right: 15px;">View My Rentals</a>
          <span style="color: rgba(255,255,255,0.7);">|</span>
          <a href="{{ url('/') }}" style="color: white; text-decoration: underline; margin-left: 15px;">Contact Support</a>
        </div>
      </td>
    </tr>

  </table>

</body>
</html>