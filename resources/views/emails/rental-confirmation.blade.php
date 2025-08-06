<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Aarogyaa Bharat - Rental Confirmation</title>
</head>
<body style="margin: 0; padding: 20px; font-family: Arial, sans-serif; background-color: #f5f5f5;">

  <table style="width: 100%; max-width: 800px; margin: 0 auto; background: white; border-collapse: collapse; box-shadow: 0 0 10px rgba(0,0,0,0.1);">

    <!-- Header -->
    <tr>
      <td colspan="3" style="background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%); color: white; padding: 20px;">
        <table style="width: 100%;">
          <tr>
            <td style="font-size: 24px; font-weight: bold;">Aarogyaa Bharat</td>
            <td style="text-align: right; font-size: 12px;">
              📞 (+91) 99214 07039<br>
              ✉️ support@aarogyaabharat.com
            </td>
          </tr>
        </table>
      </td>
    </tr>

    <!-- Rental Confirmation Header -->
    <tr>
      <td colspan="3" style="background: linear-gradient(135deg, #28a745 0%, #20c997 100%); color: white; padding: 30px 20px; text-align: center;">
        <div style="font-size: 28px; font-weight: bold;">🏥 Rental Confirmed!</div>
        <div style="font-size: 16px;">Your medical equipment rental has been successfully processed.</div>
      </td>
    </tr>

    <!-- Rental Details -->
    <tr>
      <td colspan="3" style="padding: 20px; background: #f8f9fa;">
        <table style="width: 100%; border-collapse: collapse;">
          <tr>
            <td style="width: 50%; vertical-align: top; padding-right: 20px;">
              <div style="font-weight: bold; margin-bottom: 10px; color: #333;">Rental Information</div>
              <div style="line-height: 1.6; font-size: 14px; color: #666;">
                <strong>Rental ID:</strong> #{{ $order->id }}<br>
                <strong>Rental Date:</strong> {{ $order->created_at->format('d/m/Y H:i') }}<br>
                <strong>Tenure:</strong> {{ $order->tenure }} months<br>
                <strong>Last Rental Date:</strong> {{ $order->last_rental_date ? $order->last_rental_date->format('d/m/Y') : 'N/A' }}<br>
                <strong>Status:</strong> <span style="color: #28a745; font-weight: bold;">{{ ucfirst($order->status) }}</span>
              </div>
            </td>
            <td style="width: 50%; vertical-align: top;">
              <div style="font-weight: bold; margin-bottom: 10px; color: #333;">Product Information</div>
              <div style="line-height: 1.6; font-size: 14px; color: #666;">
                <strong>Product:</strong> {{ $order->product->name ?? 'Medical Equipment' }}<br>
                <strong>Customer:</strong> {{ $order->user->name ?? 'Customer' }}<br>
                <strong>Payment Method:</strong> Online Payment (Razorpay)<br>
                <strong>Payment Status:</strong> <span style="color: #28a745; font-weight: bold;">Paid</span>
              </div>
            </td>
          </tr>
        </table>
      </td>
    </tr>

    <!-- Delivery Address -->
    <tr>
      <td colspan="3" style="padding: 20px; background: #f8f9fa;">
        <table style="width: 100%; border-collapse: collapse;">
          <tr>
            <td style="width: 50%; vertical-align: top; padding-right: 20px;">
              <div style="font-weight: bold; margin-bottom: 10px; color: #333;">Delivery Information</div>
              <div style="line-height: 1.6; font-size: 14px; color: #666;">
                @if(isset($order->rentalAddress))
                  <strong>Delivery Address:</strong><br>
                  {{ $order->rentalAddress->house_number ?? '' }} {{ $order->rentalAddress->society_name ?? '' }}<br>
                  {{ $order->rentalAddress->locality ?? '' }}<br>
                  {{ $order->rentalAddress->landmark ?? '' }}<br>
                  {{ $order->rentalAddress->city ?? '' }}, {{ $order->rentalAddress->state ?? '' }}<br>
                  PIN: {{ $order->rentalAddress->pincode ?? '' }}<br>
                  Phone: {{ $order->rentalAddress->phone ?? '' }}
                @else
                  <strong>Delivery Address:</strong><br>
                  Customer Address<br>
                  City, State<br>
                  PIN: 000000
                @endif
              </div>
            </td>
            <td style="width: 50%; vertical-align: top;">
              <div style="font-weight: bold; margin-bottom: 10px; color: #333;">Delivery Details</div>
              <div style="line-height: 1.6; font-size: 14px; color: #666;">
                <strong>Expected Delivery:</strong> Within 24-48 hours<br>
                <strong>Delivery Method:</strong> Standard Delivery<br>
                <strong>Delivery Partner:</strong> Aarogyaa Bharat Logistics<br>
                <strong>Tracking:</strong> Available after dispatch
              </div>
            </td>
          </tr>
        </table>
      </td>
    </tr>

    <!-- Rental Summary -->
    <tr>
      <td colspan="3" style="padding: 20px; background: #f8f9fa;">
        <table style="width: 100%; border-collapse: collapse;">
          <tr>
            <td style="width: 70%;"></td>
            <td style="width: 30%;">
              <table style="width: 100%; border-collapse: collapse;">
                <tr>
                  <td style="padding: 8px 0; border-bottom: 1px solid #ddd;">Base Amount:</td>
                  <td style="padding: 8px 0; border-bottom: 1px solid #ddd; text-align: right;">₹{{ number_format($order->base_amount ?? 0, 2) }}</td>
                </tr>
                <tr>
                  <td style="padding: 8px 0; border-bottom: 1px solid #ddd;">GST (18%):</td>
                  <td style="padding: 8px 0; border-bottom: 1px solid #ddd; text-align: right;">₹{{ number_format($order->gst_amount ?? 0, 2) }}</td>
                </tr>
                <tr>
                  <td style="padding: 8px 0; border-bottom: 1px solid #ddd;">Delivery Fees:</td>
                  <td style="padding: 8px 0; border-bottom: 1px solid #ddd; text-align: right;">₹{{ number_format($order->delivery_fees ?? 0, 2) }}</td>
                </tr>
                <tr>
                  <td style="padding: 8px 0; font-weight: bold; font-size: 16px;">Total:</td>
                  <td style="padding: 8px 0; font-weight: bold; font-size: 16px; text-align: right; color: #1e3c72;">₹{{ number_format($order->total_amount ?? 0, 2) }}</td>
                </tr>
              </table>
            </td>
          </tr>
        </table>
      </td>
    </tr>

    <!-- Rental Status -->
    <tr>
      <td colspan="3" style="padding: 20px; text-align: center;">
        <div style="background: #e8f5e8; border: 1px solid #28a745; border-radius: 8px; padding: 20px; margin-bottom: 20px;">
          <div style="font-size: 18px; font-weight: bold; color: #28a745; margin-bottom: 10px;">🏥 Rental Status: Active</div>
          <div style="color: #666; line-height: 1.6;">
            Your medical equipment rental is now active. We'll deliver the equipment within 24-48 hours.
          </div>
        </div>
      </td>
    </tr>

    <!-- Call to Action -->
    <tr>
      <td colspan="3" style="padding: 0 20px 30px 20px; text-align: center;">
        <a href="#" style="display: inline-block; background: #1e3c72; color: white; padding: 15px 30px; text-decoration: none; border-radius: 5px; font-weight: bold; margin: 10px;">
          View My Rentals
        </a>
        <a href="{{ url('/') }}" style="display: inline-block; border: 2px solid #1e3c72; color: #1e3c72; padding: 12px 25px; text-decoration: none; border-radius: 5px; font-weight: bold; margin: 10px;">
          Continue Shopping
        </a>
      </td>
    </tr>

    <!-- Support Info -->
    <tr>
      <td colspan="3" style="background: #ffffff; padding: 20px;">
        <div style="font-weight: bold; color: #333; margin-bottom: 10px;">Questions About Your Rental?</div>
        <div style="font-size: 13px; color: #666;">
          📞 Rental Support: +91 99214 07039<br>
          ✉️ Email: rentals@aarogyaabharat.com<br>
          🌐 Track Rental: <a href="#" style="color: #1e3c72;">www.aarogyaabharat.com</a><br>
          💬 Live Chat: 24/7 Available<br>
          📱 WhatsApp: +91 99214 07039
        </div>
      </td>
    </tr>

    <!-- Legal Footer -->
    <tr>
      <td colspan="3" style="background: #1e3c72; color: white; padding: 20px; text-align: center; font-size: 12px;">
        Aarogyaa Bharat Healthcare<br>
        This is an automated rental confirmation email. For rental-related questions, contact our support team.<br>
        © {{ date('Y') }} Aarogyaa Bharat. All rights reserved.<br><br>
        <a href="#" style="color: #fff; text-decoration: underline;">View All Rentals</a> | 
        <a href="{{ url('/') }}" style="color: #fff; text-decoration: underline;">Contact Support</a>
      </td>
    </tr>

  </table>

</body>
</html> 