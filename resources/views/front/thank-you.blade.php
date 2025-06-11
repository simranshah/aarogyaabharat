<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background-color: #f0f0f5;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .container {
            background: white;
            border-radius: 12px;    
            max-width: 100%;
            width: 100%;
            overflow: hidden;
            margin: 0 auto;
        }

        .main-content {
            display: flex;
            min-height: 500px;
  width: 100%;
        }

        .left-section {
            flex: 0 0 60%;
            padding: 60px 40px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .confetti-container {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 10;
        }

        .confetti {
            position: absolute;
            width: 8px;
            height: 8px;
            opacity: 0;
        }

        .confetti.square {
            background: #f39c12;
        }

        .confetti.circle {
            background: #e74c3c;
            border-radius: 50%;
        }

        .confetti.triangle {
            width: 0;
            height: 0;
            border-left: 4px solid transparent;
            border-right: 4px solid transparent;
            border-bottom: 8px solid #3498db;
        }

        .confetti.star {
            background: #9b59b6;
            clip-path: polygon(50% 0%, 61% 35%, 98% 35%, 68% 57%, 79% 91%, 50% 70%, 21% 91%, 32% 57%, 2% 35%, 39% 35%);
        }

        @keyframes confetti-fall {
            0% {
                opacity: 1;
                transform: translateY(-100vh) rotate(0deg);
            }
            100% {
                opacity: 0;
                transform: translateY(100vh) rotate(720deg);
            }
        }

        .confetti.animate {
            animation: confetti-fall 3s ease-out forwards;
        }

        .mascot {
            width: 180px;
            height: 180px;
            margin-bottom: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .mascot img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            border-radius: 8px;
        }

        .thank-you {
            font-size: 88px;
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 20px;
            letter-spacing: -1px;
        }

        .payment-status {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 40px;
            color: #27ae60;
            font-size: 18px;
            font-weight: 500;
        }

        .checkmark {
  width: 54px;
  height: 54px;
  /* background: #27ae60; */    /* you can drop or keep this if your GIF has transparency */
  /* border-radius: 50%; */
  display: flex;
  align-items: center;
  justify-content: center;
  /* margin-right: 12px; */
  overflow: hidden;
}

.checkmark img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}


       .home-button, .download-button {
            background: #f39c12;
            color: white;
            border: none;
            padding: 15px 40px;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            margin: 10px;
        }

        .download-button {
            background: #27ae60;
        }

        .home-button:hover {
            background: #e67e22;
            transform: translateY(-2px);
        }

        .right-section {
            flex: 0 0 40%;
            background: #f8f9fa;
            padding: 40px;
            border-left: 1px solid #e9ecef;
        }

         .order-summary {
            font-size: 24px;
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 30px;
            text-align: center;
            position: relative;
        }

        .download-icon {
            position: absolute;
            right: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 24px;
            height: 24px;
            cursor: pointer;
            transition: all 0.3s ease;
            fill: #6c757d;
        }

        .download-icon:hover {
            fill: #27ae60;
            transform: translateY(-50%) scale(1.1);
        }
        .order-details {
            margin-bottom: 30px;
        }

        .detail-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
            font-size: 14px;
            color: #6c757d;
        }

        .shipping-address {
            margin-bottom: 30px;
        }

        .address-label {
            font-size: 14px;
            color: #6c757d;
            margin-bottom: 5px;
        }

        .address-text {
            font-size: 14px;
            color: #2c3e50;
            line-height: 1.4;
        }

        .product-list {
            margin-bottom: 30px;
            max-height: 300px;
            overflow-y: auto;
            padding-right: 5px;
        }

        .product-list::-webkit-scrollbar {
            width: 6px;
        }

        .product-list::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 3px;
        }

        .product-list::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 3px;
        }

        .product-list::-webkit-scrollbar-thumb:hover {
            background: #a8a8a8;
        }

        .product-item {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            padding: 12px;
            background: white;
            border-radius: 8px;
            border: 1px solid #e9ecef;
        }

        .product-image {
            width: 50px;
            height: 50px;
            background: #c4c4c4;
            border-radius: 4px;
            margin-right: 15px;
        }

        .product-details {
            flex: 1;
        }

        .product-name {
            font-size: 14px;
            color: #2c3e50;
            margin-bottom: 2px;
        }

        .product-qty {
            font-size: 12px;
            color: #6c757d;
        }

        .product-price {
            font-size: 14px;
            font-weight: 500;
            color: #2c3e50;
        }

        .total-section {
            border-top: 1px solid #e9ecef;
            padding-top: 15px;
            margin-bottom: 30px;
        }

        .total-row {
            display: flex;
            justify-content: space-between;
            font-size: 16px;
            font-weight: bold;
            color: #2c3e50;
        }

        .confirmation-text {
            font-size: 12px;
            color: #6c757d;
            text-align: center;
            line-height: 1.4;
        }

        @media (max-width: 768px) {
            .main-content {
                flex-direction: column;
            }
            
            .right-section {
                border-left: none;
                border-top: 1px solid #e9ecef;
            }
            
            .thank-you {
                font-size: 36px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="main-content">
            <div class="left-section">
                <div class="confetti-container" id="confetti-container"></div>
                
                <div class="mascot">
                    <img src="\front\images\Mascot_Namaste.svg" alt="Mascot Character">
                </div>
                
                <h1 class="thank-you">Thank you !</h1>
                
                <div class="payment-status">
                    <div class="checkmark">
  <img src="\front\images\success.gif" alt="Success" />
</div>

                    Payment Done Successfully
                </div>
                
                <a href="{{url('/')}}"><button class="home-button" >Shop more</button></a>
                  {{-- <button class="download-button" onclick="downloadPDF()">Download Receipt</button> --}}
            </div>
            
            <div class="right-section">
                <h2 class="order-summary">
                    Order Summary
                    <svg class="download-icon" onclick="downloadPDF()" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 2C13.1 2 14 2.9 14 4V12L15.5 10.5L16.92 11.92L12 16.84L7.08 11.92L8.5 10.5L10 12V4C10 2.9 10.9 2 12 2ZM21 15L21 19C21 20.1 20.1 21 19 21H5C3.9 21 3 20.1 3 19V15H5V19H19V15H21Z"/>
                    </svg>
                </h2>
                
                <div class="order-details">
                    <div class="detail-row">
                        <span>Order ID: {{$orderData->id}}</span>
                        <span>Date:  {{ \Carbon\Carbon::parse($orderData->delivery_date)->format('d-m-Y') }}</span>
                    </div>
                </div>
                
                <div class="shipping-address">
                    <div class="address-label">Shipping Address:</div>
                    <div class="address-text">
                       {{-- {{$orderData->orderAddress->}} --}}
                       @php
                       $fullAddress = 
                                ($orderData->orderAddress->house_number ? $orderData->orderAddress->house_number . ', ' : '') .
                                ($orderData->orderAddress->society_name ? $orderData->orderAddress->society_name . ', ' : '') .
                                ($orderData->orderAddress->locality ? $orderData->orderAddress->locality . ', ' : '') .
                                ($orderData->orderAddress->landmark ? $orderData->orderAddress->landmark . ', ' : '') .
                                ($orderData->orderAddress->pincode ? $orderData->orderAddress->pincode . ', ' : '') .
                                ($orderData->orderAddress->city ? $orderData->orderAddress->city . ', ' : '') .
                                ($orderData->orderAddress->state ? $orderData->orderAddress->state : '');
                     @endphp
                     {{$fullAddress}}
                    </div>
                </div>
                
                <div class="product-list">
                    @foreach ($orderData->orderItems as $orderitems)
                    <div class="product-item">
                        <div class="product-image" >
                            <img style="width: 100%;height:100%;" src="{{ asset('storage/' . $orderitems->product->image) }}" alt="{{ $orderitems->product->name }}">
                        </div>
                        <div class="product-details">
                            <div class="product-name">{{ $orderitems->product->name }}</div>
                            <div class="product-qty">QTY: {{$orderitems->quantity}}</div>
                        </div>
                        <div class="product-price">Rs {{$orderitems->quantity * $orderitems->price}}</div>
                    </div>
                    @endforeach
                </div>
                
                <div class="total-section">
                    <div class="total-row">
                        <span>Total</span>
                        <span>Rs {{$orderData->amount}}</span>
                    </div>
                </div>
                
                <div class="confirmation-text">
                    Great choice! We've sent your order confirmation to<br>
                    your email. Tracking updates will follow soon.
                </div>
            </div>
        </div>
    </div>

    <script>
        // Confetti Animation
        function createConfetti() {
            const container = document.getElementById('confetti-container');
            const confettiTypes = ['square', 'circle', 'triangle', 'star'];
            const colors = ['#f39c12', '#e74c3c', '#3498db', '#9b59b6', '#2ecc71', '#f1c40f'];
            
            for (let i = 0; i < 100; i++) {
                const confetti = document.createElement('div');
                confetti.className = `confetti ${confettiTypes[Math.floor(Math.random() * confettiTypes.length)]}`;
                
                // Random positioning
                confetti.style.left = Math.random() * 100 + '%';
                confetti.style.animationDelay = Math.random() * 2 + 's';
                confetti.style.animationDuration = (Math.random() * 2 + 2) + 's';
                
                // Random colors for some shapes
                if (Math.random() > 0.5) {
                    const randomColor = colors[Math.floor(Math.random() * colors.length)];
                    if (confetti.classList.contains('square') || confetti.classList.contains('circle')) {
                        confetti.style.backgroundColor = randomColor;
                    }
                }
                
                container.appendChild(confetti);
                
                // Add animation class after a short delay
                setTimeout(() => {
                    confetti.classList.add('animate');
                }, 100);
            }
            
            // Clean up confetti after animation
            setTimeout(() => {
                container.innerHTML = '';
            }, 5000);
        }

        // Start confetti when page loads
        window.addEventListener('load', function() {
            setTimeout(createConfetti, 500);
        });

        // Redirect to home after 7 seconds
        setTimeout(function() {
            window.location.href = "{{ url('/') }}";
        }, 7000);

          // PDF Download Function
             async function downloadPDF() {
    const { jsPDF } = window.jspdf;
    
    try {
        // Capture the right section (Order Summary)
        const rightSection = document.querySelector('.right-section');
        const canvas = await html2canvas(rightSection, {
            scale: 2, // Higher quality
            useCORS: true,
            backgroundColor: '#f8f9fa'
        });
        
        // Create PDF
        const pdf = new jsPDF({
            orientation: 'portrait',
            unit: 'mm',
            format: 'a4'
        });
        
        const imgWidth = 180;
        const imgHeight = (canvas.height * imgWidth) / canvas.width;
        const x = (pdf.internal.pageSize.getWidth() - imgWidth) / 2;
        const y = 40; // Increased y to make space for logo and header
        
        // Add image to PDF
        pdf.addImage(canvas.toDataURL('image/png'), 'PNG', x, y, imgWidth, imgHeight);
        
        // Add header text (positioned below logo)
        pdf.setFontSize(22);
        pdf.setTextColor(44, 62, 80);
        pdf.text('Order Invoice', pdf.internal.pageSize.getWidth() / 2, 30, { align: 'center' });
        // Add company name (left) and support mail (right) under the header
        pdf.setFontSize(14);
        pdf.setTextColor(100, 100, 100);
        // Add margin top and bottom for header section
        const headerMarginTop = 20;
        const headerMarginBottom = 10;
        let currentY = headerMarginTop;

        // pdf.setFontSize(22);
        // pdf.setTextColor(44, 62, 80);
        // pdf.text('Order Invoice', pdf.internal.pageSize.getWidth() / 2, currentY, { align: 'center' });

        currentY += headerMarginBottom + 10; // 10 for spacing after header

        pdf.setFontSize(14);
        pdf.setTextColor(100, 100, 100);
        pdf.text('Aarogyaa Bharat', 15, currentY, { align: 'left' });
        pdf.text('support@aarogyaabharat.com', pdf.internal.pageSize.getWidth() - 15, currentY, { align: 'right' });
        // pdf.text('support@aarogyaabharat.com', pdf.internal.pageSize.getWidth() - 15, 40, { align: 'right' });
        
        // Add footer
        pdf.setFontSize(10);
        pdf.setTextColor(108, 117, 125);
        const footerY = pdf.internal.pageSize.getHeight() - 15;
        pdf.text('Thank you for your business!', pdf.internal.pageSize.getWidth() / 2, footerY, { align: 'center' });
        pdf.text(`Invoice generated on: ${new Date().toLocaleDateString()}`, pdf.internal.pageSize.getWidth() / 2, footerY + 5, { align: 'center' });
        
        // Download the PDF
        pdf.save('order-invoice.pdf');
        
    } catch (error) {
        console.error('Error generating PDF:', error);
        alert('Error generating PDF. Please try again.');
    }
}
</script>
</body>
</html>