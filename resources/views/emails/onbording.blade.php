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
            <td style="font-size: 24px; font-weight: bold;">Aarogyaa Bharat</td>
            <td style="text-align: right; font-size: 12px;">
              📞 (+91) 99214 07039<br>
              ✉️ support@aarogyaabharat.com
            </td>
          </tr>
        </table>
      </td>
    </tr>

    <!-- Welcome Header -->
    <tr>
      <td colspan="3" style="background: linear-gradient(135deg, #28a745 0%, #20c997 100%); color: white; padding: 30px 20px; text-align: center;">
        <div style="font-size: 28px; font-weight: bold;">Welcome to Aarogyaa Bharat!</div>
        <div style="font-size: 16px;">Your journey to better health starts here</div>
      </td>
    </tr>

    <!-- Greeting -->
    <tr>
      <td colspan="3" style="padding: 30px 20px; text-align: center;">
        <div style="font-size: 22px; font-weight: bold; color: #1e3c72;">
          Hello {{ $user->name ?? 'Valued Customer' }},
        </div>
        <p style="font-size: 15px; color: #555; line-height: 1.6;">
          We're excited to welcome you to the Aarogyaa  Bharat family. You're now part of a growing community that puts health first. We look forward to serving you!
        </p>
      </td>
    </tr>

    <!-- Call to Action -->
    <tr>
      <td colspan="3" style="padding: 0 20px 30px 20px; text-align: center;">
        <a href="https://www.aarogyaabharat.com" style="display: inline-block; background: #1e3c72; color: white; padding: 15px 30px; text-decoration: none; border-radius: 5px; font-weight: bold; margin: 10px;">
          Start Shopping
        </a>
        <a href="https://www.aarogyaabharat.com/profile" style="display: inline-block; border: 2px solid #1e3c72; color: #1e3c72; padding: 12px 25px; text-decoration: none; border-radius: 5px; font-weight: bold; margin: 10px;">
          Complete Profile
        </a>
      </td>
    </tr>


    <!-- Support Info -->
    <tr>
      <td colspan="3" style="background: #ffffff; padding: 20px;">
        <div style="font-weight: bold; color: #333; margin-bottom: 10px;">Need Help?</div>
        <div style="font-size: 13px; color: #666;">
          📞 Phone: +91 99214 07039<br>
          ✉️ Email: support@aarogyaabharat.com<br>
          🌐 Website: <a href="https://www.aarogyaabharat.com" style="color: #1e3c72;">www.aarogyaabharat.com</a><br>
          💬 Live Chat: 24/7 Available<br>
          📱 WhatsApp: +91 99214 07039
        </div>
      </td>
    </tr>

    <!-- Legal Footer -->
    <tr>
      <td colspan="3" style="background: #1e3c72; color: white; padding: 20px; text-align: center; font-size: 12px;">
        Aarogyaa Bharat Healthcare<br>
        This is an automated welcome email. For questions, contact support.<br>
        © {{ date('Y') }} Aarogyaa Bharat. All rights reserved.<br><br>
        {{-- <a href="https://www.aarogyaabharat.com/unsubscribe" style="color: #fff; text-decoration: underline;">Unsubscribe</a> --}}
      </td>
    </tr>

  </table>

</body>
</html>
