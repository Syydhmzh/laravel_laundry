<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Struk|Laundry</title>
  <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">
</head>

<body>
<div class="invoice">
    <div class="invoice-header">
      <h3>My Laundry</h3>
      <h2>Bersih & Murah</h2>
      <br class="info text-center">
      Jl. Warakas I Gg.24 No. 50, Jakarta Utara</br>
      <strong>Telp:</strong> 0896-8796-0758<br
    </div>
</div>
    <div class="line"></div>
    <div class="invoice-details">
      <div class="row">
        <span>
            {{ $details->created_at->format('d.m.Y') }}
        </span>
        <span>
            {{ $details->created_at->format('H:i') }}
        </span>
      </div>
      <div class="row">
        <span>Kasir</span>
        <span>{{ auth()->user()->name }}</span>
      </div>

      <div class="row">
        <span>Order ID</span>
        <span>{{$details->order_code ?? ''}}</span>
      </div>
    </div>
    <div class="line"></div>
    <div class="products">
        @foreach ($details->details as $detail)
        <div class="item">
            <strong>{{ $detail->service->service_name }}</strong>
            <div class="item-quatity">
            <span>{{ $detail->qty }}x @ {{ number_format($detail->service->price) }}</span>
            <span>{{ $detail->subtotal }}</span>
            </div>
        </div>
        @endforeach
    </div>
    <div class="line"></div>
    <div class="summary">
      <div class="row">
        <span>Sub Total </span>
       <span> Rp. {{ number_format($details->total) }}</span>
      </div>

    </div>
    <div class="line"></div>
    <footer class="text-center">
      Terimakasih telah berbelanja di Kedai Cookies.
    </footer>
  </div>
  <script>
    window.onload = function () {
      window.print();
      setTimeout(function () {
        window.close();
      }, 1000);
    };
  </script>
</body>

</html>
