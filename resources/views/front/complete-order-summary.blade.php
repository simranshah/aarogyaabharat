<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complete Order Summary</title>
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
            padding: 20px;
        }

        .container {
            background: white;
            border-radius: 12px;    
            max-width: 1200px;
            width: 100%;
            margin: 0 auto;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 40px;
            text-align: center;
        }

        .header h1 {
            font-size: 36px;
            margin-bottom: 10px;
        }

        .header p {
            font-size: 18px;
            opacity: 0.9;
        }

        .content {
            padding: 40px;
        }

        .order-info {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }

        .info-card {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            border-left: 4px solid #667eea;
        }

        .info-card h3 {
            color: #2c3e50;
            margin-bottom: 10px;
            font-size: 16px;
        }

        .info-card p {
            color: #6c757d;
            font-size: 14px;
        }

        .section {
            margin-bottom: 40px;
        }

        .section-title {
            font-size: 24px;
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #e9ecef;
        }

        .product-grid {
            display: grid;
            gap: 20px;
        }

        .product-card {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 20px;
            border: 1px solid #e9ecef;
        }

        .product-header {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }

        .product-image {
            width: 60px;
            height: 60px;
            border-radius: 8px;
            margin-right: 15px;
            overflow: hidden;
        }

        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .product-info h4 {
            color: #2c3e50;
            margin-bottom: 5px;
        }

        .product-info p {
            color: #6c757d;
            font-size: 14px;
        }

        .product-details {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 15px;
            margin-bottom: 15px;
        }

        .detail-item {
            text-align: center;
        }

        .detail-label {
            font-size: 12px;
            color: #6c757d;
            margin-bottom: 5px;
        }

        .detail-value {
            font-size: 16px;
            font-weight: 500;
            color: #2c3e50;
        }

        .price-breakdown {
            background: white;
            border-radius: 6px;
            padding: 15px;
            border: 1px solid #e9ecef;
        }

        .price-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .price-row.total {
            font-weight: bold;
            font-size: 16px;
            border-top: 1px solid #e9ecef;
            padding-top: 8px;
            margin-top: 8px;
        }

        .address-section {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 30px;
        }

        .address-title {
            font-size: 18px;
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 15px;
        }

        .address-content {
            color: #6c757d;
            line-height: 1.6;
        }

        .summary-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 8px;
            padding: 30px;
            margin-top: 30px;
        }

        .summary-title {
            font-size: 24px;
            margin-bottom: 20px;
            text-align: center;
        }

        .summary-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
        }

        .summary-item {
            text-align: center;
        }

        .summary-label {
            font-size: 14px;
            opacity: 0.9;
            margin-bottom: 5px;
        }

        .summary-value {
            font-size: 24px;
            font-weight: bold;
        }

        .actions {
            text-align: center;
            margin-top: 30px;
        }

        .btn {
            display: inline-block;
            padding: 12px 30px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 500;
            margin: 0 10px;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background: #667eea;
            color: white;
        }

        .btn-secondary {
            background: #6c757d;
            color: white;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .download-btn {
            position: fixed;
            top: 20px;
            right: 20px;
            background: #27ae60;
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .download-btn:hover {
            background: #219a52;
            transform: translateY(-2px);
        }

        @media (max-width: 768px) {
            .header {
                padding: 20px;
            }
            
            .header h1 {
                font-size: 24px;
            }
            
            .content {
                padding: 20px;
            }
            
            .order-info {
                grid-template-columns: 1fr;
            }
            
            .product-details {
                grid-template-columns: 1fr;
            }
            
            .summary-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <button class="download-btn" onclick="downloadPDF()">Download PDF</button>
    
    <div class="container">
        <div class="header">
            <h1>Complete Order Summary</h1>
            <p>Thank you for your order! Here's a complete summary of your purchase and rental items.</p>
        </div>
        
        <div class="content">
            <!-- Order Information -->
            <div class="order-info">
                @if($orderData)
                <div class="info-card">
                    <h3>Purchase Order</h3>
                    <p><strong>Order ID:</strong> {{$orderData->id}}</p>
                    <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($orderData->created_at)->format('d-m-Y H:i') }}</p>
                    <p><strong>Status:</strong> {{$orderData->status->name ?? 'Pending'}}</p>
                </div>
                @endif
                
                @if($rentalData)
                <div class="info-card">
                    <h3>Rental Order</h3>
                    <p><strong>Order ID:</strong> {{$rentalData->id}}</p>
                    <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($rentalData->created_at)->format('d-m-Y H:i') }}</p>
                    <p><strong>Tenure:</strong> {{$rentalData->tenure}} months</p>
                </div>
                @endif
            </div>

            <!-- Shipping Address -->
            <div class="address-section">
                <div class="address-title">Shipping Address</div>
                <div class="address-content">
                    @if($orderData && $orderData->orderAddress)
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
                    @elseif($rentalData && $rentalData->rentalAddress)
                        @php
                        $fullAddress = 
                                 ($rentalData->rentalAddress->house_number ? $rentalData->rentalAddress->house_number . ', ' : '') .
                                 ($rentalData->rentalAddress->society_name ? $rentalData->rentalAddress->society_name . ', ' : '') .
                                 ($rentalData->rentalAddress->locality ? $rentalData->rentalAddress->locality . ', ' : '') .
                                 ($rentalData->rentalAddress->landmark ? $rentalData->rentalAddress->landmark . ', ' : '') .
                                 ($rentalData->rentalAddress->pincode ? $rentalData->rentalAddress->pincode . ', ' : '') .
                                 ($rentalData->rentalAddress->city ? $rentalData->rentalAddress->city . ', ' : '') .
                                 ($rentalData->rentalAddress->state ? $rentalData->rentalAddress->state : '');
                        @endphp
                        {{$fullAddress}}
                    @endif
                </div>
            </div>

            <!-- Purchase Items -->
            @if($orderData && $orderData->orderItems->count() > 0)
            <div class="section">
                <h2 class="section-title">Purchase Items</h2>
                <div class="product-grid">
                    @foreach($orderData->orderItems as $orderItem)
                    <div class="product-card">
                        <div class="product-header">
                            <div class="product-image">
                                <img src="{{ asset('storage/' . $orderItem->product->image) }}" alt="{{ $orderItem->product->name }}">
                            </div>
                            <div class="product-info">
                                <h4>{{ $orderItem->product->name }}</h4>
                                <p>Purchase Item</p>
                            </div>
                        </div>
                        
                        <div class="product-details">
                            <div class="detail-item">
                                <div class="detail-label">Quantity</div>
                                <div class="detail-value">{{ $orderItem->quantity }}</div>
                            </div>
                            <div class="detail-item">
                                <div class="detail-label">Unit Price</div>
                                <div class="detail-value">Rs {{ $orderItem->price }}</div>
                            </div>
                            <div class="detail-item">
                                <div class="detail-label">GST</div>
                                <div class="detail-value">Rs {{ $orderItem->gst }}</div>
                            </div>
                            <div class="detail-item">
                                <div class="detail-label">Delivery Fees</div>
                                <div class="detail-value">Rs {{ $orderItem->delivery_and_installation_fees }}</div>
                            </div>
                        </div>
                        
                        <div class="price-breakdown">
                            <div class="price-row">
                                <span>Subtotal:</span>
                                <span>Rs {{ $orderItem->quantity * $orderItem->price }}</span>
                            </div>
                            <div class="price-row">
                                <span>GST:</span>
                                <span>Rs {{ $orderItem->gst }}</span>
                            </div>
                            <div class="price-row">
                                <span>Delivery & Installation:</span>
                                <span>Rs {{ $orderItem->delivery_and_installation_fees }}</span>
                            </div>
                            <div class="price-row total">
                                <span>Total:</span>
                                <span>Rs {{ $orderItem->total_amount }}</span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Rental Items -->
            @if($rentalData)
            <div class="section">
                <h2 class="section-title">Rental Items</h2>
                <div class="product-grid">
                    <div class="product-card">
                        <div class="product-header">
                            <div class="product-image">
                                <img src="{{ asset('storage/' . $rentalData->product->image) }}" alt="{{ $rentalData->product->name }}">
                            </div>
                            <div class="product-info">
                                <h4>{{ $rentalData->product->name }}</h4>
                                <p>Rental Item</p>
                            </div>
                        </div>
                        
                        <div class="product-details">
                            <div class="detail-item">
                                <div class="detail-label">Rental Period</div>
                                <div class="detail-value">{{ $rentalData->tenure }} months</div>
                            </div>
                            <div class="detail-item">
                                <div class="detail-label">Base Amount</div>
                                <div class="detail-value">Rs {{ $rentalData->base_amount }}</div>
                            </div>
                            <div class="detail-item">
                                <div class="detail-label">GST</div>
                                <div class="detail-value">Rs {{ $rentalData->gst_amount }}</div>
                            </div>
                            <div class="detail-item">
                                <div class="detail-label">Delivery Fees</div>
                                <div class="detail-value">Rs {{ $rentalData->delivery_fees }}</div>
                            </div>
                        </div>
                        
                        <div class="price-breakdown">
                            <div class="price-row">
                                <span>Base Amount:</span>
                                <span>Rs {{ $rentalData->base_amount }}</span>
                            </div>
                            <div class="price-row">
                                <span>GST ({{$rentalData->product->gst ?? 18}}%):</span>
                                <span>Rs {{ $rentalData->gst_amount }}</span>
                            </div>
                            <div class="price-row">
                                <span>Delivery Fees:</span>
                                <span>Rs {{ $rentalData->delivery_fees }}</span>
                            </div>
                            <div class="price-row total">
                                <span>Total:</span>
                                <span>Rs {{ $rentalData->total_amount }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- Summary Section -->
            <div class="summary-section">
                <h2 class="summary-title">Order Summary</h2>
                <div class="summary-grid">
                    @if($orderData)
                    <div class="summary-item">
                        <div class="summary-label">Purchase Total</div>
                        <div class="summary-value">Rs {{ $orderData->amount }}</div>
                    </div>
                    @endif
                    
                    @if($rentalData)
                    <div class="summary-item">
                        <div class="summary-label">Rental Total</div>
                        <div class="summary-value">Rs {{ $rentalData->total_amount }}</div>
                    </div>
                    @endif
                    
                    <div class="summary-item">
                        <div class="summary-label">Grand Total</div>
                        <div class="summary-value">
                            Rs {{ ($orderData ? $orderData->amount : 0) + ($rentalData ? $rentalData->total_amount : 0) }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="actions">
                <a href="{{ url('/') }}" class="btn btn-primary">Continue Shopping</a>
                <a href="{{ route('customers.profile') }}" class="btn btn-secondary">View Orders</a>
            </div>
        </div>
    </div>

    <script>
        async function downloadPDF() {
            const { jsPDF } = window.jspdf;
            
            try {
                const container = document.querySelector('.container');
                const canvas = await html2canvas(container, {
                    scale: 2,
                    useCORS: true,
                    backgroundColor: '#ffffff'
                });
                
                const pdf = new jsPDF({
                    orientation: 'portrait',
                    unit: 'mm',
                    format: 'a4'
                });
                
                const imgWidth = 180;
                const imgHeight = (canvas.height * imgWidth) / canvas.width;
                const x = (pdf.internal.pageSize.getWidth() - imgWidth) / 2;
                const y = 20;
                
                pdf.addImage(canvas.toDataURL('image/png'), 'PNG', x, y, imgWidth, imgHeight);
                
                pdf.save('complete-order-summary.pdf');
                
            } catch (error) {
                console.error('Error generating PDF:', error);
                alert('Error generating PDF. Please try again.');
            }
        }
    </script>
</body>
</html> 