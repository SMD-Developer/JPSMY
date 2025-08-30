<!-- @extends('app') -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<style>
    /* General Styles */
    body {
        font-family: "Poppins", sans-serif;
        line-height: 1.5;
        margin: 20px;
        color: #333;
        font-weight: 400;
    }

    /*.content-header h5 {*/
    /*    font-weight: 600;*/
    /*    color: #ff7700;*/
    /*}*/

    /* Container */
    .form-container {
        /*max-width: 1000px;*/
        margin: 0 auto;
        padding: 20px;
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    /* Table Styles */
    .table-header {
        background-color: #eef5f9;
        font-weight: 600;
        text-align: center;
    }

    .table td, .table th {
        vertical-align: middle;
        text-align: center;
    }

    /* Scrollbar for Table */
    .scrollbar {
        overflow-x: auto;
        margin-bottom: 15px;
    }

    .scrollbar table {
        min-width: 100%;
    }

    /* Pagination Controls */
    .pagination-controls {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 10px;
    }

    .dropdowns {
        width: 80px;
        display: inline-block;
    }

    .page-navigation {
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .page-navigation span, .page-navigation i {
        background-color: #f5f5f5;
        padding: 5px 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 14px;
        cursor: pointer;
    }

    .page-navigation span:hover, .page-navigation i:hover {
        background-color: #ddd;
    }

    /* Summary Section */
    .summary-bar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 10px;
        padding: 10px;
        background-color: #eef5f9;
        border-radius: 5px;
        font-weight: 600;
        color: #333;
    }

    .highlight-text {
        color: #ff7700;
        font-weight: 600;
    }

    /* Section Header */
    .section-header {
        background-color: #eef5f9;
        padding: 10px;
        border-radius: 5px 5px 0 0;
        font-weight: 600;
        color: #333;
        /*margin-bottom: 20px;*/
    }

    /* Buttons */
    .buttons button {
        margin-right: 10px;
        font-weight: 500;
    }
    
    

    
    body {
      font-family: Arial, sans-serif;
      font-size: 12px;
    }
    table {
      width: 100%;
      border-collapse: collapse;
    }
    th, td {
      border: 1px solid black !important;
      padding: 5px;
      text-align: left;
    }
    .header-table {
      text-align: center;
      border: none;
      margin-bottom: 20px;
    }
    .section-title {
      font-weight: bold;
      text-align: center;
      padding: 10px 0;
    }
    .note {
      text-align: center;
      font-size: 12px;
      font-weight: bold;
      color: orange;
    }
    .summary-table th, .summary-table td {
      text-align: center;
    }
    .total-row td {
      font-weight: bold;
    }
    
    
        }
    table {
      width: 100%;
      border-collapse: collapse;
    }
    th, td {
      border: 1px solid black;
      padding: 8px;
      text-align: left;
    }
    /*th {*/
    /*  background-color: #f2f2f2;*/
    /*}*/
    .header {
      text-align: center;
      font-weight: bold;
      margin-bottom: 10px;
    }
    .total-row td {
      font-weight: bold;
      text-align: right;
    }
    .total-row td:first-child {
      text-align: left;
    }
    .note {
      font-size: 12px;
      font-weight: bold;
      color: orange;
      text-align: left;
    }
    .last td{
        text-align: center;
    }
    
    
    
    
    
    
        /*    }*/
        /*.header {*/
        /*    text-align: center;*/
        /*}*/
        /*.header h2, .header h3, .header h4 {*/
        /*    margin: 5px 0;*/
        /*}*/
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }
        /*th {*/
        /*    background-color: #f2f2f2;*/
        /*    text-align: center;*/
        /*}*/
        .section-title {
            font-weight: bold;
            margin: 20px 0 10px;
        }
        .no-border td {
            border: none;
        }
        .center {
            text-align: center;
        }
        
        
        
        table {
            border-collapse: collapse;
            width: 100%;
            font-size: 13px;
        }
        td {
            border: 1px solid black;
            vertical-align: top;
        }
        .design-cell {
            text-align: left;
            padding: 10px;
        }
        .box-container {
            display: flex;
            align-items: center;
            margin: 10px 0;
        }
        .box {
            width: 20px;
            height: 20px;
            border: 1px solid black;
            margin-right: 10px;
        }
        .line-text {
            flex: 1;
        }
        th {
            background-color: #f0f0f0;
        }
</style>

<title>@lang('app.new_assignment') | JPS</title>

@section('content')
<div class="col-md-12 content-header">
    <h5><i class="fa fa-file" aria-hidden="true"></i> @lang('app.new_assignment')</h5>
</div>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div style="max-width: 100%; padding: 15px; border: 1px solid #ddd; border-radius: 8px; box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1); background: #fff;">
                <div style="overflow-x: auto; max-width: 100%;">
                    <table border="1" cellspacing="0" cellpadding="5" style="width: 100%;">
                        <thead>
                            <tr>
                                <!--<th>Process</th>-->
                                <th>#</th>
                                <th>@lang('app.modul')</th>
                                <!--<th>@lang('app.process')</th>-->
                                <th>@lang('app.record_no')</th>
                                <th>@lang('app.reference_no')</th>
                                <th>@lang('app.department')</th>
                                <th>@lang('app.description_table')</th>
                                <th>@lang('app.bank/Company/Individu')</th>
                                <th>@lang('app.amount_table')</th>
                                <th>@lang('Status')</th>
                                <th>@lang('app.manager_name')</th>
                                <th>@lang('app.date')</th>
                                <th>@lang('app.day_no')</th>
                                <th>@lang('app.take_task')</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <!--<td>Masuk Slip Bank</td>-->
                                <td>1</td>
                                <td>AR</td>
                                <!--<td>Masuk Slip Bank</td>-->
                                <td>25CQPP050100009</td>
                                <td>25CQPP0500009</td>
                                <td>021000</td>
                                <td>PP0501 - PENYATA PEMUNGUT-AUTO</td>
                                <td>CIMB BANK BERHAD</td>
                                <td>63,512.00</td>
                                <td>Untuk Kelulusan</td>
                                <td>NOORAZINI BINTI NAZIRUDDIN</td>
                                <td>10/01/2025</td>
                                <td>0</td>
                                <td><a href="{{ route('collectors_receipt_approver') }}" class="btn btn-success">@lang('app.view')</a></td>
                            </tr>
                            <tr>
                                <!--<td>Masuk Slip Bank</td>-->
                                <td>2</td>
                                <td>AR</td>
                                <!--<td>Masuk Slip Bank</td>-->
                                <td>25CQPP050100008</td>
                                <td>25CQPP0500008</td>
                                <td>021000</td>
                                <td>PP0501 - PENYATA PEMUNGUT-AUTO</td>
                                <td>CIMB BANK BERHAD</td>
                                <td>7,286.00</td>
                                <td>Untuk Kelulusan</td>
                                <td>NOORAZINI BINTI NAZIRUDDIN</td>
                                <td>09/01/2025</td>
                                <td>1</td>
                                <td><a href="{{ route('collectors_receipt_approver') }}" class="btn btn-success">@lang('app.view')</a></td>
                            </tr>
                                            <tr>
                                <!--<td>Masuk Slip Bank</td>-->
                                <td>3</td>
                                <td>AR</td>
                                <!--<td>Masuk Slip Bank</td>-->
                                <td>25CQPP050100009</td>
                                <td>25CQPP0500009</td>
                                <td>021000</td>
                                <td>PP0501 - PENYATA PEMUNGUT-AUTO</td>
                                <td>CIMB BANK BERHAD</td>
                                <td>63,512.00</td>
                                <td>Untuk Kelulusan</td>
                                <td>NOORAZINI BINTI NAZIRUDDIN</td>
                                <td>10/01/2025</td>
                                <td>2</td>
                                <td><a href="{{ route('collectors_receipt_approver') }}" class="btn btn-success">@lang('app.view')</a></td>
                            </tr>
                            <tr>
                                <!--<td>Masuk Slip Bank</td>-->
                                <td>4</td>
                                <td>AR</td>
                                <!--<td>Masuk Slip Bank</td>-->
                                <td>25CQPP050100008</td>
                                <td>25CQPP0500008</td>
                                <td>021000</td>
                                <td>PP0501 - PENYATA PEMUNGUT-AUTO</td>
                                <td>CIMB BANK BERHAD</td>
                                <td>7,286.00</td>
                                <td>Untuk Kelulusan</td>
                                <td>NOORAZINI BINTI NAZIRUDDIN</td>
                                <td>09/01/2025</td>
                                <td>3</td>
                                <td><a href="{{ route('collectors_receipt_approver') }}" class="btn btn-success">@lang('app.view')</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
    </div>
</div>
</section> 
                   

@endsection


