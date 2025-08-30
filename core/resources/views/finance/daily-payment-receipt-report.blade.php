@extends('app')

<style>
    /* Excel-like styling */
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        font-size: 11px;
        background-color: #f8f9fa;
        margin: 0;
        padding: 0;
    }

    .report-container {
        width: 100%;
        max-width: 1200px;
        margin: 20px auto;
        background: white;
        border: 1px solid #d0d7de;
        box-shadow: 0 1px 3px rgba(16, 24, 40, 0.1);
        overflow: hidden;
    }

    /* Header Section */
    .report-header {
        padding: 20px;
        background: linear-gradient(135deg, #f6f8fa 0%, #ffffff 100%);
        border-bottom: 2px solid #0969da;
    }

    .header-row {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 15px;
    }

    .date-time-info {
        font-size: 10px;
        color: #656d76;
        line-height: 1.4;
    }

    .date-time-info strong {
        color: #24292f;
        font-weight: 600;
    }

    .main-title {
        text-align: center;
        flex: 1;
        padding: 0 20px;
    }

    .main-title h1 {
        font-size: 13px;
        font-weight: 600;
        color: #24292f;
        text-transform: uppercase;
        line-height: 1.3;
        margin-bottom: 5px;
    }

    .main-title h2 {
        font-size: 12px;
        font-weight: 500;
        color: #656d76;
        text-transform: uppercase;
    }

    .page-info {
        font-size: 10px;
        color: #656d76;
        text-align: right;
    }

    .page-info strong {
        color: #24292f;
        font-weight: 600;
    }

    /* Department Info Table - Excel Style */
    .department-info-table {
        width: 100%;
        border-collapse: collapse;
        margin: 20px 0;
        font-size: 11px;
    }

    .department-info-table th {
        background: #f0f0f0;
        color: #333;
        padding: 12px 15px;
        text-align: center;
        font-weight: 600;
        border: 1px solid #ccc;
        font-size: 11px;
        text-transform: uppercase;
    }

    .department-info-table td {
        padding: 10px 15px;
        border: 1px solid #ccc;
        vertical-align: middle;
    }

    .department-info-table .label-cell {
        background: #f9f9f9;
        font-weight: 600;
        color: #333;
        width: 15%;
        text-align: center;
    }

    .department-info-table .code-cell {
        background: #ffffff;
        width: 20%;
        color: #333;
        font-weight: 500;
    }

    .department-info-table .description-cell {
        background: #ffffff;
        width: 65%;
        color: #333;
    }

    /* Main Data Table - Excel Style */
    .main-data-table {
        width: 100%;
        border-collapse: collapse;
        margin: 20px 0;
        font-size: 10px;
    }

    .main-data-table th {
        background: #f0f0f0;
        color: #333;
        padding: 12px 8px;
        text-align: center;
        font-weight: 600;
        border: 1px solid #ccc;
        font-size: 10px;
        text-transform: uppercase;
        line-height: 1.2;
        vertical-align: middle;
    }

    .main-data-table td {
        padding: 8px;
        border: 1px solid #ccc;
        vertical-align: middle;
        background: white;
    }

    .main-data-table tbody tr:nth-child(even) {
        background: #f9f9f9;
    }

    .main-data-table tbody tr:hover {
        background: #e8f4f8;
    }

    /* Column specific styling */
    .main-data-table .col-bil {
        width: 4%;
        text-align: center;
        font-weight: 600;
        color: #333;
    }

    .main-data-table .col-resit {
        width: 10%;
        text-align: center;
        font-family: 'Courier New', monospace;
        color: #333;
    }

    .main-data-table .col-perihal {
        width: 20%;
        text-align: left;
        color: #333;
    }

    .main-data-table .col-nama {
        width: 15%;
        text-align: left;
        color: #333;
        font-weight: 500;
    }

    .main-data-table .col-kategori {
        width: 10%;
        text-align: center;
        color: #333;
        font-weight: 500;
    }

    .main-data-table .col-vot {
        width: 6%;
        text-align: center;
        font-family: 'Courier New', monospace;
        color: #333;
    }

    .main-data-table .col-kod {
        width: 8%;
        text-align: center;
        font-family: 'Courier New', monospace;
        color: #333;
    }

    .main-data-table .col-tarikh {
        width: 8%;
        text-align: center;
        color: #333;
        font-size: 9px;
    }

    .main-data-table .col-masa {
        width: 7%;
        text-align: center;
        color: #666;
        font-size: 9px;
    }

    .main-data-table .col-mod {
        width: 8%;
        text-align: center;
        color: #666;
        font-size: 9px;
    }

    .main-data-table .col-jenis {
        width: 7%;
        text-align: center;
        color: #666;
        font-size: 9px;
    }

    .main-data-table .col-kategori-bank {
        width: 12%;
        text-align: center;
        color: #666;
        font-size: 9px;
    }

    .main-data-table .col-jumlah {
        width: 8%;
        text-align: right;
        color: #333;
        font-size: 9px;
        font-weight: 500;
    }

    /* Action Buttons */
    .action-section {
        padding: 20px;
        background: #f6f8fa;
        border-top: 1px solid #d0d7de;
        text-align: right;
    }

    .btn-print {
        background: linear-gradient(135deg, #0969da 0%, #54aeff 100%);
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 6px;
        font-size: 11px;
        font-weight: 600;
        cursor: pointer;
        box-shadow: 0 1px 3px rgba(16, 24, 40, 0.1);
        transition: all 0.2s ease;
    }

    .btn-print:hover {
        background: linear-gradient(135deg, #0550ae 0%, #368ce7 100%);
        box-shadow: 0 3px 6px rgba(16, 24, 40, 0.15);
        transform: translateY(-1px);
    }

    /* Print Styles */
    @media print {
        body {
            background: white;
            font-size: 10px;
        }

        .report-container {
            border: none;
            box-shadow: none;
            margin: 0;
        }

        .action-section {
            display: none;
        }

        .main-data-table th,
        .department-info-table th {
            background: #f0f0f0 !important;
            color: black !important;
        }
    }

    .summary-table {
        width: 100%;
        border-collapse: collapse;
        margin: 20px 0;
        font-size: 10px;
    }

    .summary-table th {
        background: #f0f0f0;
        color: #333;
        padding: 12px 8px;
        text-align: center;
        font-weight: 600;
        border: 1px solid #ccc;
        font-size: 10px;
        text-transform: uppercase;
    }

    .summary-table td {
        padding: 8px;
        border: 1px solid #ccc;
        vertical-align: middle;
        background: white;
    }

    .summary-table tbody tr:nth-child(even) {
        background: #f9f9f9;
    }

    .summary-table tbody tr:hover {
        background: #e8f4f8;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .report-container {
            margin: 10px;
        }

        .header-row {
            flex-direction: column;
            text-align: center;
        }

        .main-data-table {
            font-size: 9px;
        }

        .main-data-table th,
        .main-data-table td {
            padding: 6px 4px;
        }
    }
</style>

<title>{{ trans('app.daily_payment_receipt_report') }} | JPS</title>

@section('content')
    <div class="col-md-12 content-header">
        <h5><i class="fa fa-list"></i> {{ trans('app.daily_payment_receipt_report_by') }}</h5>
    </div>

    <section>
        <div class="report-container">
            <!-- Header Section -->
            <div class="report-header">
                <div class="header-row">
                    <div class="date-time-info">
                        <p><strong>TARIKH:</strong> {{ $currentDate }}</p>
                        <p><strong>MASA:</strong> {{ $currentTime }}</p>
                    </div>
                    <div class="main-title">
                        <h1>KERAJAAN NEGERI SELANGOR DARUL EHSAN</h1>
                        <h2>LAPORAN TERIMAAN HARIAN MENGIKUT JENIS DARI {{ \Carbon\Carbon::parse($startDate)->format('d/m/Y') }} HINGGA {{ \Carbon\Carbon::parse($endDate)->format('d/m/Y') }}</h2>
                    </div>
                    <div class="page-info">
                        <p><strong>MUKA SURAT : 1/1</strong></p>
                    </div>
                </div>

                <!-- Department Information Table -->
                <table class="department-info-table">
                    <thead>
                        <tr>
                            <th>MENERIMA</th>
                            <th>KOD</th>
                            <th>PERIHAL</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="label-cell"><strong>JABATAN</strong></td>
                            <td class="code-cell">: 021000</td>
                            <td class="description-cell">JABATAN PENGAIRAN & SALIRAN SELANGOR</td>
                        </tr>
                        <tr>
                            <td class="label-cell"><strong>PTJ</strong></td>
                            <td class="code-cell">: 21000000</td>
                            <td class="description-cell">PENGARAH PENGAIRAN & SALIRAN</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Main Data Section -->
            <div style="padding: 0 20px;">
    <table class="main-data-table">
        <thead>
            <tr>
                <th class="col-bil">BIL.</th>
                <th class="col-resit">NOMBOR RESIT</th>
                <th class="col-perihal">PERIHAL</th>
                <th class="col-nama">NAMA PEMBAYAR</th>
                <th class="col-kategori">KATEGORI PEMBAYAR</th>
                <th class="col-vot">VOT DANA</th>
                <th class="col-kod">KOD HASIL</th>
                <th class="col-tarikh">TARIKH URUSNIAGA</th>
                <th class="col-masa">MASA URUSNIAGA</th>
                <th class="col-mod">Amaun (RM)</th>
                <th class="col-mod">MOD TERIMAAN</th>
                <th class="col-jenis">JENIS KAD</th>
                <th class="col-kategori-bank">KATEGORI TRANSAKSI PERBANKAN</th>
                <th class="col-jumlah">JUMLAH CAJ (RM)</th>
            </tr>
        </thead>
        <tbody>
            @php
                $grandTotal = 0;
            @endphp
            @foreach ($applications as $index => $application)
                @php
                    $grandTotal += $application->final_amount;
                    $amount = $application->final_amount / 2;
                @endphp
                <!-- First Row - G001 VOT -->
                <tr>
                    <td class="col-bil" rowspan="2">{{ $index + 1 }}</td>
                    <td class="col-resit" rowspan="2">{{ $application->receipt_numbers ?? 'N/A' }}</td>
                    <td class="col-perihal" rowspan="2">{{ $application->land_lot }}, MUKIM
                        {{ $application->state_name }}
                        DAERAH {{ $application->district_name }}, SELANGOR</td>
                    <td class="col-nama" rowspan="2">{{ $application->applicant ?? 'N/A' }}</td>
                    <td class="col-kategori" rowspan="2">{{ $application->account_type_name }}</td>
                    <td class="col-vot">G001</td>
                    <td class="col-kod">H0161304</td>
                    <td class="col-tarikh" rowspan="2">
                        {{ $application->payment_date ? date('d/m/Y', strtotime($application->payment_date)) : 'N/A' }}
                    </td>
                    <td class="col-masa" rowspan="2">
                        {{ $application->deposit_date ? date('H:i:s', strtotime($application->deposit_date)) : 'N/A' }}
                    </td>
                    <td class="col-mod">{{ number_format($amount, 2) }}</td>
                    <td class="col-jenis" rowspan="2">N/A</td>
                    <td class="col-jenis" rowspan="2">N/A</td>
                    <td class="col-kategori-bank" rowspan="2">{{ $application->methods ?? 'N/A' }}</td>
                    <td class="col-jumlah" rowspan="2">N/A</td>
                </tr>

                <!-- Second Row - L453 VOT -->
                <tr>
                    <td class="col-vot">L453</td>
                    <td class="col-kod">H0161304</td>
                    <td class="col-mod">{{ number_format($amount, 2) }}</td>
                </tr>
            @endforeach
            
            <!-- Grand Total Row -->
            <tr style="background-color: #f0f0f0; font-weight: bold;">
                <td colspan="9" style="text-align: right;">JUMLAH :</td>
                <td class="col-mod" style="text-align: right;">{{ number_format($grandTotal, 2) }}</td>
                <td colspan="4"></td>
            </tr>
        </tbody>
    </table>
</div>


            <div style="padding: 0 20px;">
            <h6>Ringkasan Terimaan Mengikut Vot Dana</h6>
            <table class="summary-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Vot Dana</th>
                        <th>Bil Urusniaga</th>
                        <th>Amaun (RM)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>G001</td>
                        <td>{{ count($applications) }}</td>
                        <td>{{ number_format($grandTotal / 2, 2) }}</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>L453</td>
                        <td>{{ count($applications) }}</td>
                        <td>{{ number_format($grandTotal / 2, 2) }}</td>
                    </tr>
                    <tr style="background-color: #f0f0f0; font-weight: bold;">
                        <td colspan="2">JUMLAH</td>
                        <td></td> 
                        <td>{{ number_format($grandTotal, 2) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

            <!-- Static Summary Section 2: Ringkasan Terimaan Mengikut Kod Hasil -->
            <div style="padding: 0 20px;">
                <h6>Ringkasan Terimaan Mengikut Kod Hasil</h6>
                <table class="summary-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kod Hasil</th>
                            <th>Vot Dana</th>
                            <th>Amaun</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>H0161304</td>
                            <td>G001</td>
                            <td>{{ number_format($grandTotal / 2, 2) }}</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>L431</td>
                            <td>{{ number_format($grandTotal / 2, 2) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div style="padding: 0 20px;">
                <h6>Ringkasan Terimaan Mengikut Mod Terimaan</h6>
                <table class="summary-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Ringkasan Terimaan</th>
                            <th>Bil Rekod</th>
                            <th>Amaun</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                          @php
                            // Calculate EFT payment statistics only
                            $eftCount = 0;
                            $eftAmount = 0;
                            
                            foreach ($applications as $application) {
                                $method = $application->methods ?? '';
                                $amount = $application->final_amount ?? 0;
                                
                                // Check if method is EFT (case insensitive)
                                if (stripos($method, 'EFT') !== false || stripos($method, 'transfer') !== false) {
                                    $eftCount++;
                                    $eftAmount += $amount;
                                }
                            }
                        @endphp
                        <tr>
                            <td>1</td>
                            <td>EFT</td>
                            <td>{{ $eftCount }}</td>
                            <td>RM {{ number_format($eftAmount, 2) }}</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Kad Kredit</td>
                            <td>N/A</td>
                            <td>N/A</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Kad Debit</td>
                            <td>N/A</td>
                            <td>N/A</td>
                        </tr>
                        <tr>
                            <td>JUMLAH</td>
                            <td></td>
                            <td>{{ $eftCount }}</td>
                            <td>RM {{ number_format($eftAmount, 2) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Static Summary Section 2: Ringkasan Terimaan Mengikut Mod Transaksi Perbankan -->
            <div style="padding: 0 20px;">
    <h6>Ringkasan Terimaan Mengikut Mod Transaksi Perbankan</h6>
    <table class="summary-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Ringkasan Mod Transaksi Perbankan</th>
                <th>Bil Rekod</th>
                <th>Amaun</th>
            </tr>
        </thead>
        <tbody>
            @php
                // Calculate B2B and B2C payment statistics
                $b2bCount = 0;
                $b2bAmount = 0;
                $b2cCount = 0;
                $b2cAmount = 0;
                
                foreach ($applications as $application) {
                    $method = $application->methods ?? '';
                    $amount = $application->final_amount ?? 0;
                    
                    // Check for B2B transactions
                    if (stripos($method, 'FPX_B2B') !== false) {
                        $b2bCount++;
                        $b2bAmount += $amount;
                    }
                    // Check for B2C transactions
                    elseif (stripos($method, 'FPX_B2C') !== false) {
                        $b2cCount++;
                        $b2cAmount += $amount;
                    }
                }
                
                $totalCount = $b2bCount + $b2cCount;
                $totalAmount = $b2bAmount + $b2cAmount;
            @endphp
            
            <tr>
                <td>1</td>
                <td>B2B</td>
                <td>{{ $b2bCount }}</td>
                <td>RM {{ number_format($b2bAmount, 2) }}</td>
            </tr>
            <tr>
                <td>2</td>
                <td>B2C</td>
                <td>{{ $b2cCount }}</td>
                <td>RM {{ number_format($b2cAmount, 2) }}</td>
            </tr>
            
            <tr style="background-color: #f0f0f0; font-weight: bold;">
                <td colspan="2">JUMLAH</td>
                <td>{{ $totalCount }}</td>
                <td>RM {{ number_format($totalAmount, 2) }}</td>
            </tr>
        </tbody>
    </table>
</div>

            <!-- Action Section -->
            <div class="action-section">
                <button onclick="window.print()" class="btn-print">{{ trans('app.print') }}</button>
            </div>
        </div>
    </section>
@endsection
