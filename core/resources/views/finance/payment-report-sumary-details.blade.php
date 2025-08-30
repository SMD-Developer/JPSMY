@extends('app')
<style>
    body {
        font-family: 'Calibri', Arial, sans-serif;
        font-size: 11px;
        background-color: #f8f9fa;
    }

    /* Excel-like table styling */
    table {
        width: 100%;
        border-collapse: collapse;
        font-size: 11px;
        background-color: white;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    th {
        background: linear-gradient(to bottom, #f8f9fa 0%, #e9ecef 100%);
        border: 2px solid #999999;
        border-right: 2px solid #999999;
        border-left: 2px solid #999999;
        padding: 8px 6px;
        text-align: center;
        font-weight: 600;
        font-size: 11px;
        color: #333;
        position: relative;
    }

    th::after {
        content: '';
        position: absolute;
        right: -1px;
        top: 0;
        bottom: 0;
        width: 2px;
        background-color: #999999;
        z-index: 1;
    }

    th:last-child::after {
        display: none;
    }

    td {
        border: 1px solid #999999;
        border-right: 2px solid #999999;
        border-left: 2px solid #999999;
        padding: 6px 8px;
        text-align: left;
        background-color: white;
        vertical-align: middle;
        position: relative;
    }

    td::after {
        content: '';
        position: absolute;
        right: -1px;
        top: 0;
        bottom: 0;
        width: 2px;
        background-color: #999999;
        z-index: 1;
    }

    td:last-child::after {
        display: none;
    }

    /* Excel-like hover effect */
    tbody tr:hover {
        background-color: #f0f8ff;
    }

    tbody tr:hover td {
        background-color: #f0f8ff;
    }

    /* Excel-like cell selection effect */
    td:hover {
        background-color: #e6f3ff !important;
        cursor: cell;
    }

    /* Zebra striping like Excel */
    tbody tr:nth-child(even) {
        background-color: #fafafa;
    }

    tbody tr:nth-child(even) td {
        background-color: #fafafa;
    }

    .scrollbar {
        overflow-x: auto;
        border: 2px solid #999999;
        border-radius: 3px;
    }

    .form-container {
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        background: white;
        margin: 15px 0;
    }

    .summary-box {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        border-radius: 10px;
        padding: 20px;
        margin-bottom: 25px;
        color: white;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .summary-box h6 {
        color: rgba(255, 255, 255, 0.9);
        font-size: 12px;
        margin-bottom: 5px;
    }

    .summary-box h4 {
        color: white;
        font-weight: bold;
        margin: 0;
    }

    .amount-column {
        text-align: right;
        font-weight: 500;
        font-family: 'Courier New', monospace;
    }

    .transaction-column {
        text-align: center;
        font-weight: 500;
    }

    .total-row {
        background: linear-gradient(to bottom, #28a745 0%, #20c997 100%) !important;
        font-weight: bold;
        color: white;
    }

    .total-row td {
        background: transparent !important;
        border-color: #999999;
        border-width: 2px;
        font-weight: bold;
    }

    .header-info {
        border: 2px solid #495057;
        padding: 15px;
        margin-bottom: 20px;
        background: linear-gradient(to right, #f8f9fa, #ffffff);
        border-radius: 5px;
    }

    .header-info table {
        box-shadow: none;
        margin: 0;
    }

    .header-info th {
        background: #495057;
        color: white;
        font-weight: bold;
    }

    /* Excel-like grid lines */
    .excel-grid {
        position: relative;
    }

    .excel-grid::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-image:
            linear-gradient(90deg, #e0e0e0 1px, transparent 1px),
            linear-gradient(180deg, #e0e0e0 1px, transparent 1px);
        background-size: 20px 20px;
        pointer-events: none;
        opacity: 0.3;
    }

    /* Excel-like column headers */
    .excel-column {
        background: linear-gradient(to bottom, #f1f3f4 0%, #e8eaed 100%);
        font-weight: 600;
        text-align: center;
        min-width: 80px;
    }

    /* Print button styling */
    .btn-primary {
        background: linear-gradient(45deg, #007bff, #0056b3);
        border: none;
        padding: 8px 16px;
        border-radius: 4px;
        font-size: 12px;
        font-weight: 600;
        box-shadow: 0 2px 4px rgba(0, 123, 255, 0.3);
        transition: all 0.2s ease;
    }

    .btn-primary:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(0, 123, 255, 0.4);
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .scrollbar {
            font-size: 10px;
        }

        th,
        td {
            padding: 4px;
            font-size: 10px;
        }
    }

    /* Print styles */
    @media print {
        body {
            background: white;
        }

        .form-container,
        .summary-box,
        .header-info {
            box-shadow: none;
            border: 1px solid #000;
        }

        .btn-primary {
            display: none;
        }
    }
</style>

<title>{{ $title ?? 'Payment Summary Report' }} | JPS</title>

@section('content')
    <div class="col-md-12 content-header">
        <h5><i class="fa fa-money" aria-hidden="true"></i> {{ $title ?? 'Payment Summary Report' }}</h5>
    </div>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <!-- Header Section -->
                <!--<div class="header-info">-->
                <!--    <div class="row">-->
                <!--        <div class="col-3">-->
                <!--            <p class="mb-0"><b>TARIKH : {{ now()->format('d/m/Y') }}</b></p>-->
                <!--            <p><b>MASA : {{ now()->format('H:i:s') }}</b></p>-->
                <!--        </div>-->
                <!--        <div class="col-6 text-center">-->
                <!--            <p class="mb-0"><b>KERAJAAN NEGERI SELANGOR DARUL EHSAN</b></p>-->
                <!--            <p><b>LAPORAN RINGKASAN PEMBAYARAN MENGIKUT TARIKH</b></p>-->
                <!--            <p><b>{{ \Carbon\Carbon::parse($reportData['start_date'])->format('d/m/Y') }} HINGGA-->
                <!--                    {{ \Carbon\Carbon::parse($reportData['end_date'])->format('d/m/Y') }}</b></p>-->
                <!--        </div>-->
                <!--        <div class="col-3">-->
                <!--            <p class="mb-0"><b>MUKA SURAT : 1/1</b></p>-->
                <!--        </div>-->
                <!--    </div>-->
                <!--</div>-->

    
                <!--<div class="header-info" style="background: white; color: black;">-->
                <!--    <table class="mb-2">-->
                <!--        <tr>-->
                <!--            <th class="excel-column" style="background: white; color: black;">MENERIMA</th>-->
                <!--            <th class="excel-column" style="border-left: hidden; border-right: hidden; background: white; color: black;">KOD</th>-->
                <!--            <th class="excel-column" colspan="7" style="background: white; color: black;">PERIHAL</th>-->
                <!--        </tr>-->
                <!--        <tr style="border-top: hidden; border-bottom: hidden;">-->
                <!--            <th class="excel-column" style="background: white; color: black;">JABATAN</th>-->
                <!--            <th class="excel-column" style="border-left: hidden; border-right: hidden; background: white; color: black;"> : 021000</th>-->
                <!--            <th class="excel-column" colspan="7" style="background: white; color: black;">JABATAN PENGAIRAN & SALIRAN SELANGOR</th>-->
                <!--        </tr>-->
                <!--        <tr>-->
                <!--            <th class="excel-column" style="background: white; color: black;">PTJ/PK</th>-->
                <!--            <th class="excel-column" style="border-left: hidden; border-right: hidden; background: white; color: black;"> : 02100000</th>-->
                <!--            <th class="excel-column" colspan="7" style="background: white; color: black;">PENGARAH PENGAIRAN & SALIRAN</th>-->
                <!--        </tr>-->
                <!--    </table>-->
                <!--</div>-->
                
                
                  <!-- Header Section -->
                <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
                    <tr>
                        <td style="width: 25%; padding: 8px; border: 1px solid #999; vertical-align: top;">
                            <strong>TARIKH :</strong> {{ $reportData['currentDate'] }}<br>
                            <strong>MASA :</strong> {{ $reportData['currentTime'] }}
                        </td>
                        <td
                            style="width: 50%; padding: 8px; border: 1px solid #999; text-align: center; vertical-align: middle;">
                            <strong>KERAJAAN NEGERI SELANGOR DARUL EHSAN</strong><br>
                            LAPORAN RINGKASAN PEMBAYARAN MENGIKUT TARIKH
                            {{ \Carbon\Carbon::parse($reportData['start_date'])->format('d/m/Y') }} HINGGA
                            {{ \Carbon\Carbon::parse($reportData['end_date'])->format('d/m/Y') }}
                        </td>
                        <td
                            style="width: 25%; padding: 8px; border: 1px solid #999; text-align: right; vertical-align: top;">
                            <strong>MUKA SURAT : 1/1</strong>
                        </td>
                    </tr>
                </table>

                <!-- Department Info Section -->
                <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
                    <thead>
                        <tr>
                            <th style="padding: 8px; border: 1px solid #999; background: #f0f0f0; text-align: center;">
                                MENERIMA</th>
                            <th style="padding: 8px; border: 1px solid #999; background: #f0f0f0; text-align: center;">KOD
                            </th>
                            <th style="padding: 8px; border: 1px solid #999; background: #f0f0f0; text-align: center;">
                                PERIHAL</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="padding: 8px; border: 1px solid #999; font-weight: bold;">JABATAN</td>
                            <td style="padding: 8px; border: 1px solid #999;">: 021000</td>
                            <td style="padding: 8px; border: 1px solid #999;">JABATAN PENGAIRAN & SALIRAN SELANGOR</td>
                        </tr>
                        <tr>
                            <td style="padding: 8px; border: 1px solid #999; font-weight: bold;">PTJ</td>
                            <td style="padding: 8px; border: 1px solid #999;">: 21000000</td>
                            <td style="padding: 8px; border: 1px solid #999;">PENGARAH PENGAIRAN & SALIRAN</td>
                        </tr>
                    </tbody>
                </table>

                <!-- Summary Statistics -->
                <div class="summary-box">
                    <div class="row">
                        <div class="col-md-4">
                            <h6><strong>JUMLAH HARI:</strong></h6>
                            <h4>{{ count($reportData['payments']) }}</h4>
                        </div>
                        <div class="col-md-4">
                            <h6><strong>JUMLAH TRANSAKSI:</strong></h6>
                            <h4>{{ number_format($reportData['total_payments']) }}</h4>
                        </div>
                        <div class="col-md-4">
                            <h6><strong>JUMLAH KESELURUHAN:</strong></h6>
                            <h4>RM {{ number_format($reportData['total_amount'], 2) }}</h4>
                        </div>
                    </div>
                </div>

                <!-- Main Report Table -->
                <div class="form-container excel-grid">
                    <div class="scrollbar">
                        <table>
                            <thead>
                                <tr>
                                    <th class="excel-column">@lang('app.bil')</th>
                                    <th class="excel-column">TARIKH PEMBAYARAN</th>
                                    <th class="excel-column">JUMLAH TRANSAKSI</th>
                                    <th class="excel-column">JUMLAH AMAUN (RM)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $grandTotalAmount = 0;
                                    $grandTotalTransactions = 0;
                                @endphp
                                @foreach ($reportData['payments'] as $index => $payment)
                                    <tr>
                                        <td class="transaction-column">{{ $index + 1 }}</td>
                                        <td>{{ $payment->payment_date ? \Carbon\Carbon::parse($payment->payment_date)->format('d/m/Y') : 'N/A' }}
                                        </td>
                                        <td class="transaction-column">{{ number_format($payment->transaction_count) }}
                                        </td>
                                        <td class="amount-column">{{ number_format($payment->total_amount, 2) }}</td>
                                    </tr>
                                    @php
                                        $grandTotalAmount += $payment->total_amount;
                                        $grandTotalTransactions += $payment->transaction_count;
                                    @endphp
                                @endforeach

                                <!-- Total Row -->
                                <tr class="total-row">
                                    <td colspan="2" class="text-center"><strong>JUMLAH KESELURUHAN</strong></td>
                                    <td class="transaction-column">
                                        <strong>{{ number_format($grandTotalTransactions) }}</strong></td>
                                    <td class="amount-column"><strong>{{ number_format($grandTotalAmount, 2) }}</strong>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Method Summary -->
                    @if (!empty($reportData['method_summary']))
                        <div class="mt-4">
                            <h6><strong>RINGKASAN MENGIKUT KAEDAH PEMBAYARAN:</strong></h6>
                            <div class="row">
                                @foreach ($reportData['method_summary'] as $method => $summary)
                                    <div class="col-md-3 mb-2">
                                        <div class="card">
                                            <div class="card-body p-2">
                                                <h6 class="card-title">{{ $method ?? 'N/A' }}</h6>
                                                <p class="card-text">
                                                    <small>Bilangan: {{ $summary['count'] }}</small><br>
                                                    <strong>RM {{ number_format($summary['total_amount'], 2) }}</strong>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Status Summary -->
                    @if (!empty($reportData['status_summary']))
                        <div class="mt-4">
                            <h6><strong>RINGKASAN MENGIKUT STATUS:</strong></h6>
                            <div class="row">
                                @foreach ($reportData['status_summary'] as $status => $summary)
                                    <div class="col-md-3 mb-2">
                                        <div class="card">
                                            <div class="card-body p-2">
                                                <h6 class="card-title">{{ $status ?? 'N/A' }}</h6>
                                                <p class="card-text">
                                                    <small>Bilangan: {{ $summary['count'] }}</small><br>
                                                    <strong>RM {{ number_format($summary['total_amount'], 2) }}</strong>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Print Button -->
                    <div class="d-flex justify-content-end mt-3">
                        <button type="button" class="btn btn-primary" onclick="window.print()">
                            <i class="fa fa-print"></i> @lang('app.print')
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
