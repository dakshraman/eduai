<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Fee Receipt #{{ $payment->receipt_number ?? $payment->id }}</title>
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700" rel="stylesheet" />
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Inter', sans-serif; background: #f3f4f6; padding: 2rem; color: #1f2937; }
        .receipt { max-width: 700px; margin: 0 auto; background: #fff; border: 1px solid #e5e7eb; border-radius: 12px; overflow: hidden; }
        .header { background: #BFECFF; color: #fff; padding: 2rem; text-align: center; }
        .header h1 { font-size: 1.5rem; font-weight: 700; margin-bottom: 0.25rem; }
        .header p { font-size: 0.875rem; opacity: 0.9; }
        .body { padding: 2rem; }
        .info-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 1.5rem; }
        .info-group h3 { font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em; color: #6b7280; margin-bottom: 0.5rem; font-weight: 600; }
        .info-group p { font-size: 0.9rem; font-weight: 500; color: #1f2937; }
        .divider { border: none; border-top: 2px dashed #e5e7eb; margin: 1.5rem 0; }
        .details-table { width: 100%; border-collapse: collapse; margin-bottom: 1.5rem; }
        .details-table th { text-align: left; padding: 0.75rem; background: #f9fafb; border: 1px solid #e5e7eb; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em; color: #6b7280; font-weight: 600; }
        .details-table td { padding: 0.75rem; border: 1px solid #e5e7eb; font-size: 0.9rem; }
        .total-row td { background: #FFF6E3; font-weight: 700; font-size: 1rem; }
        .footer { border-top: 1px solid #e5e7eb; padding: 1.5rem 2rem; text-align: center; font-size: 0.8rem; color: #9ca3af; }
        .stamp { display: inline-block; border: 2px solid #BFECFF; color: #BFECFF; padding: 0.5rem 1.5rem; border-radius: 8px; font-weight: 700; text-transform: uppercase; font-size: 0.875rem; margin-top: 1rem; }
        .print-btn { display: block; margin: 1.5rem auto 0; padding: 0.625rem 2rem; background: #BFECFF; color: #fff; border: none; border-radius: 8px; font-size: 0.9rem; font-weight: 600; cursor: pointer; }
        .print-btn:hover { background: #9dd8f5; }
        @media print {
            body { background: #fff; padding: 0; }
            .receipt { border: none; border-radius: 0; box-shadow: none; }
            .print-btn { display: none !important; }
        }
    </style>
</head>
<body>
    <div class="receipt">
        <div class="header">
            <h1>{{ $school->name ?? 'School Name' }}</h1>
            <p>{{ $school->address ?? '' }}{{ $school->phone ? ' | ' . $school->phone : '' }}{{ $school->email ? ' | ' . $school->email : '' }}</p>
        </div>

        <div class="body">
            <h2 style="text-align:center; font-size:1.25rem; font-weight:700; margin-bottom:1.5rem; color:#BFECFF;">FEE RECEIPT</h2>

            <div class="info-grid">
                <div class="info-group">
                    <h3>Receipt Number</h3>
                    <p>{{ $payment->receipt_number ?? 'N/A' }}</p>
                </div>
                <div class="info-group">
                    <h3>Payment Date</h3>
                    <p>{{ $payment->payment_date ? \Carbon\Carbon::parse($payment->payment_date)->format('d M Y') : '-' }}</p>
                </div>
            </div>

            <hr class="divider">

            <div class="info-grid">
                <div class="info-group">
                    <h3>Student Name</h3>
                    <p>{{ $payment->student->user->name ?? '-' }}</p>
                </div>
                <div class="info-group">
                    <h3>Admission Number</h3>
                    <p>{{ $payment->student->admission_number ?? '-' }}</p>
                </div>
                <div class="info-group">
                    <h3>Class</h3>
                    <p>{{ $payment->student->class->name ?? '-' }}</p>
                </div>
                <div class="info-group">
                    <h3>Roll Number</h3>
                    <p>{{ $payment->student->roll_number ?? '-' }}</p>
                </div>
            </div>

            <hr class="divider">

            <table class="details-table">
                <thead>
                    <tr>
                        <th>Fee Category</th>
                        <th>Amount Due</th>
                        <th>Amount Paid</th>
                        <th>Payment Method</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $payment->feeStructure->feeCategory->name ?? '-' }}</td>
                        <td>{{ number_format($payment->feeStructure->amount ?? 0, 2) }}</td>
                        <td>{{ number_format($payment->amount_paid, 2) }}</td>
                        <td style="text-transform:capitalize;">{{ $payment->payment_method ?? '-' }}</td>
                    </tr>
                </tbody>
            </table>

            @if($payment->transaction_id)
                <div class="info-grid">
                    <div class="info-group">
                        <h3>Transaction ID</h3>
                        <p>{{ $payment->transaction_id }}</p>
                    </div>
                    <div class="info-group"></div>
                </div>
            @endif

            @if($payment->notes)
                <div style="margin-top:1rem;">
                    <h3 style="font-size:0.75rem; text-transform:uppercase; letter-spacing:0.05em; color:#6b7280; margin-bottom:0.5rem; font-weight:600;">Notes</h3>
                    <p style="font-size:0.9rem; color:#374151;">{{ $payment->notes }}</p>
                </div>
            @endif

            <hr class="divider">

            <div style="text-align:center; margin-top:1rem;">
                <div class="stamp">PAID</div>
            </div>
        </div>

        <div class="footer">
            <p>This is a computer-generated receipt. For queries, please contact the school administration.</p>
            <p style="margin-top:0.25rem;">Generated on {{ now()->format('d M Y, h:i A') }}</p>
        </div>
    </div>

    <button class="print-btn" onclick="window.print()">Print Receipt</button>
</body>
</html>
