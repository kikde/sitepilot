@php
  $tenantName = $tenant->name ?? 'Tenant';
  $tenantSlug = $tenant->slug ?? 'tenant';
  $num = $invoice->number ?? ('INV-'.$invoice->id);
  $issued = $invoice->created_at;
  $due = $invoice->due_date;
  $status = strtoupper($invoice->status ?? 'DUE');
@endphp
<!doctype html>
<html>
<head>
  <meta charset="utf-8" />
  <style>
    body { font-family: DejaVu Sans, Helvetica, Arial, sans-serif; font-size: 12px; color: #111; }
    .header { display:flex; justify-content:space-between; align-items:flex-start; margin-bottom:16px; }
    .muted { color:#666; font-size: 12px; }
    table { width:100%; border-collapse: collapse; }
    th, td { border:1px solid #ddd; padding:8px; }
    th { background:#f5f5f5; text-align:left; }
    .badge { display:inline-block; padding:4px 8px; border-radius: 9999px; font-size: 11px; }
    .badge-success { background:#dcfce7; color:#166534; }
    .badge-warning { background:#fef9c3; color:#854d0e; }
  </style>
  <title>Invoice {{ $num }}</title>
  <meta http-equiv="Content-Security-Policy" content="default-src 'self' 'unsafe-inline' data:; img-src data: *;" />
  <base target="_blank">
  <meta name="color-scheme" content="light only" />
</head>
<body>
  <div class="header">
    <div>
      <h2 style="margin:0;">Invoice {{ $num }}</h2>
      <div class="muted">{{ $tenantName }} ({{ $tenantSlug }})</div>
    </div>
    <div>
      <div class="muted">Issued: {{ $issued }}</div>
      <div class="muted">Due: {{ $due ?: '—' }}</div>
      <div class="muted">Status:
        <span class="badge {{ ($invoice->status ?? '') === 'paid' ? 'badge-success' : 'badge-warning' }}">{{ $status }}</span>
      </div>
    </div>
  </div>

  <table>
    <thead>
      <tr>
        <th>Description</th>
        <th>Amount</th>
        <th>Currency</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>Subscription charge</td>
        <td>{{ number_format($invoice->amount, 2) }}</td>
        <td>{{ $invoice->currency }}</td>
      </tr>
    </tbody>
  </table>

  <p class="muted" style="margin-top:12px;">Thank you for your business.</p>
</body>
</html>

