{{-- resources/views/frontend/partials/donate/style-22.blade.php --}}
<style>
  #kp-donate-22{--ink:#333;--muted:#666;color:var(--ink);font-family:Poppins,system-ui,-apple-system,"Segoe UI",Roboto,Helvetica,Arial;position:relative;isolation:isolate}
  #kp-donate-22,#kp-donate-22 *{box-sizing:border-box}
  #kp-donate-22 .wrap{max-width:420px;width:100%;margin:0 auto 24px;text-align:center}
  #kp-donate-22 h1{font-size:1.6rem;margin:0 0 10px}
  #kp-donate-22 .details{line-height:1.9;color:var(--muted);margin-bottom:18px}
  #kp-donate-22 .block{background:#fff;border:1px solid #ececec;border-radius:14px;padding:18px;box-shadow:0 8px 20px rgba(0,0,0,.06)}
  #kp-donate-22 .scan{font-size:1.2rem;margin:0 0 12px}
  #kp-donate-22 .qr{display:block;margin:10px auto 16px;width:220px;height:220px;border-radius:6px;border:6px solid #f1f1f1}
  #kp-donate-22 .cta{display:inline-block;margin-top:6px;background:#18a874;color:#fff;text-decoration:none;font-weight:800;border:2px solid #18a874;padding:12px 18px;border-radius:999px}
</style>
<div id="kp-donate-22">
  <div class="wrap">
    <h1>{{$setting->title}} Account Details</h1>
    <div class="block">
      @foreach($banks as $bank)
    <div class="details">
      Name– {{$bank->account_holder}}<br>
      Account no. {{$bank->account_number}}<br>
      IFSC– {{$bank->account_ifsc}}<br>
      Bank Name– {{$bank->bank_name}}<br>
      Messgae– {{$bank->message}}
    </div>
    @endforeach
    </div>
    <!-- <div class="block">
      <div class="scan">Scan this to Pay</div>
      <img class="qr" src="https://api.qrserver.com/v1/create-qr-code/?size=220x220&data=upi://pay?pa=peoples.association@upi&pn=People%27s%20Association&am=100" alt="UPI QR">
      <a class="cta" href="#">Click Here to Donate</a>
    </div> -->
  </div>
</div>
 