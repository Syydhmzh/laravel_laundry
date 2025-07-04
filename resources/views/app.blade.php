<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>{{ $title ?? '' }}</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  @include('inc.css')
</head>

<body>

    @include('inc.header')
  <!-- ======= Sidebar ======= -->
  @include('inc.sidebar')

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Blank Page</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Pages</li>
          <li class="breadcrumb-item active">Blank</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <div class="content">
        @yield('content')
    </div>



  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>NiceAdmin</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      <!-- All the links in the footer should remain intact. -->
      <!-- You can delete the links only if you purchased the pro version. -->
      <!-- Licensing information: https://bootstrapmade.com/license/ -->
      <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
      Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->

@include('inc.js')

<script>
    const button = document.querySelector('.addRow');
    const tbody = document.querySelector('#tableL tbody');
    const select = document.querySelector('#id_service');
    // const selectN = document.querySelector('#notes');

    const grandTotal = document.getElementById('grandTotal');
    const grandTotalInput = document.getElementById('grandTotalInput');
    // const orderChange = document.getElementById('order_change');
    // const orderChangeDisplay = document.getElementById('order_change_display');
    // const orderPay = document.getElementById('order_pay');

    const orderChange = document.getElementById('order_change');
  const orderChangeDisplay = document.getElementById('order_change_display');
  const orderPay = document.getElementById('order_pay');
  const totalInput = document.getElementById('total');

  function pay(){
    //kembalian = bayar - total harga
    const pay = parseFloat(orderPay.value) || 0;
    const total = parseFloat(totalInput.value)||  0;


    const change = pay-total;
    orderChangeDisplay.value = change.toLocaleString('id-ID');
    orderChange.value = change;
   }
   orderPay.addEventListener('input', pay);

    let no = 1;
    button.addEventListener("click", function() {
        const selectedservice = select.options[select.selectedIndex];
        const serviceValue = selectedservice.value;
        // const noteValue = selectN.value;

        if (!serviceValue) {
            alert("Please select a service first!!");
            return;
        }
        const serviceName = selectedservice.textContent;
        const servicePrice = selectedservice.dataset.price;

        const tr = document.createElement("tr");
        tr.innerHTML = `
        <td>${no}</td>
        <td><input type='hidden' name='id_service[]' value='${serviceValue}'  class='id_services'>${serviceName}</td>
        <td>
        <input type='number' value='1' step='any' min='0' name='qty[]' class='qtys'>
        <input type='hidden' class='priceInput' value='${servicePrice}' name='price[]'>
        </td>
        <td><input type='hidden'  class='totals' name='subtotal[]' value='${servicePrice}'><span class='totalText'>${servicePrice}</span></td>

        <td><button class='btn btn-success btn-sm removeRow'>Delete</button></td>
        `;

        tbody.appendChild(tr);
        no++;

        select.value = "";
        updateGrandTotal();
    });

    tbody.addEventListener('click', function(e) {
        if (e.target.classList.contains('removeRow')) {
            e.target.closest("tr").remove();
        }
        updateNumber();
        updateGrandTotal();
    });

    tbody.addEventListener('input', function(e) {
        if (e.target.classList.contains('qtys')) {
            const row = e.target.closest("tr");
            const qty = parseFloat(e.target.value) || 0;
            const price = parseInt(row.querySelector('.priceInput').value);

            row.querySelector('.totalText').textContent = price * qty;
            row.querySelector('.totals').value = price * qty;

            updateGrandTotal();
        }
    });

    function updateNumber() {
        const rows = tbody.querySelectorAll("tr");
        rows.forEach(function(row, index) {
            row.cells[0].textContent = index + 1;
        });

        no = rows.length + 1;
    }

    function updateGrandTotal() {
        const totalCells = tbody.querySelectorAll('.totals');
        let grand = 0;
        totalCells.forEach(function(input) {
            grand += parseInt(input.value) || 0;
        });
        grandTotal.textContent = grand.toLocaleString('id-ID');
        grandTotalInput.value = grand;


    }


    paymentInput.addEventListener('input', function() {
        const paymentAmount = parseFloat(paymentInput.value) || 0;
        const totalAmount = parseFloat(grandTotalInput.value) || 0;
        const change = paymentAmount - totalAmount;

        changeDisplay.textContent = change >= 0 ? change.toLocaleString('id-ID') : '0';
    });
</script>

<script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env("MIDTRANS_CLIENT_KEY") }}"></script>
<script>

  document.getElementById('paymentForm').addEventListener('submit', function(e){
    e.preventDefault();

    const form = e.target;
    const method = form.querySelector('[name="payment_method"]:checked, [name="payment_method"]:focus') ?.value;

    const data ={
      order_pay: document.getElementById('order_pay').value,
      order_change: document.getElementById('order_change').value,
      payment_method: method,
      _token: '{{ csrf_token() }}'
    };
    const orderId = form.dataset.orderId;

    if (method === 'cash') {
      form.submit();
    }else{
      fetch(`/trans/${orderId}/snap`, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': data._token
        },
        body: JSON.stringify(data)
      })
      .then(res => res.json())
      .then(res => {
        if(res.token){
          snap.pay(res.token, {
            onSuccess: function(result){
              window.location.href = `trans`;
            },
            onPending: function(result){
              alert('Silahkan selesaikan pembayaran anda.');
            },
            onError: function(result){
              alert('Gagal');
            }
          });
        }else{
          alert("Gagal mengambil token pembayaran");
        }
      });
    }
  });
</script>


</body>

</html>
