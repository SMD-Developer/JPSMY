    <!-- @extends('app') -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>
     /* Body Styles */
body {
    font-family: 'Poppins', Arial, sans-serif !important;
    font-size: 12px !important;
    line-height: 1.5 !important;
    color: #333 !important;
    font-weight: 400 !important;
    /* margin: 20px !important; */
}

/* General Table Styles */
table {
    width: 100% !important;
    border-collapse: collapse !important;
    font-size: 13px !important;
    margin: 20px 0 !important;
}

th, td {
    border: 1px solid #000 !important;
    padding: 8px !important;
    text-align: left !important;
    vertical-align: top !important;
}

th {
    background-color: #f0f0f0 !important;
    text-align: center !important;
}

/* Section Titles & Headers */
.section-title {
    font-weight: bold !important;
    margin: 20px 0 10px !important;
    text-align: center !important;
    padding: 10px 0 !important;
}

.header {
    text-align: center !important;
    font-weight: bold !important;
    margin-bottom: 10px !important;
}

/* Special Rows */
.total-row td {
    font-weight: bold !important;
    text-align: right !important;
}

.total-row td:first-child {
    text-align: left !important;
}

.summary-table th, 
.summary-table td,
.last td {
    text-align: center !important;
}

/* Notes */
.note {
    font-size: 12px !important;
    font-weight: bold !important;
    color: orange !important;
    text-align: left !important;
}

/* No Border Rows */
.no-border td {
    border: none !important;
}

/* Scrollable Table */
.scrollbar {
    overflow-x: auto !important;
    margin-bottom: 15px !important;
}

.scrollbar table {
    min-width: 100% !important;
}

/* Form Container */
.form-container {
    margin: 0 auto !important;
    padding: 20px !important;
    background: #fff !important;
    border-radius: 10px !important;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1) !important;
}

/* Table Headers */
.table-header {
    background-color: #eef5f9 !important;
    font-weight: 600 !important;
    text-align: center !important;
}

/* Section Header */
.section-header {
    background-color: #eef5f9 !important;
    padding: 10px !important;
    border-radius: 5px 5px 0 0 !important;
    font-weight: 600 !important;
    color: #333 !important;
}

/* Pagination Controls */
.pagination-controls {
    display: flex !important;
    justify-content: space-between !important;
    align-items: center !important;
    margin-top: 10px !important;
}

/* Button Row Fix */
.row.px-2.mb-3 {
    display: flex !important;
    flex-wrap: nowrap !important;
    justify-content: flex-end !important;
    gap: 8px !important;
    overflow-x: auto !important;
    white-space: nowrap !important;
    padding: 8px 0 !important;
}

.row.px-2.mb-3 .btn {
    flex-shrink: 0 !important;
    min-width: max-content !important;
    margin: 0 !important;
    padding: 8px 16px !important;
}

/* Summary Section */
.summary-bar {
    display: flex !important;
    justify-content: space-between !important;
    align-items: center !important;
    margin-top: 10px !important;
    padding: 10px !important;
    background-color: #eef5f9 !important;
    border-radius: 5px !important;
    font-weight: 600 !important;
    color: #333 !important;
}

.highlight-text {
    color: #ff7700 !important;
    font-weight: 600 !important;
}

/* Design Cell & Boxes */
.design-cell {
    text-align: left !important;
    padding: 10px !important;
}

.box-container {
    display: flex !important;
    align-items: center !important;
    margin: 10px 0 !important;
}

.box {
    width: 20px !important;
    height: 20px !important;
    border: 1px solid black !important;
    margin-right: 10px !important;
}

.line-text {
    flex: 1 !important;
}

/* Responsive Design */
@media (max-width: 768px) {
    body {
        margin: 10px !important;
    }
    
    .form-container {
        padding: 15px !important;
    }
    
    .row.px-2.mb-3 {
        justify-content: flex-start !important;
    }
    
    .row.px-2.mb-3 .btn {
        padding: 6px 12px !important;
        font-size: 14px !important;
    }
}
</style>

<title>@lang('app.assignments_not_taken') | JPS</title>

@section('content')
<div class="col-md-12 content-header">
    <h5><i class="fa fa-file" aria-hidden="true"></i> @lang('app.assignments_not_taken')</h5>
</div>

<section class="content" >
    <div class="row">
        <div class="col-md-12">
            <div style="max-width: 100%; padding: 15px; border: 1px solid #ddd; border-radius: 8px; box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1); background: #fff;">
                <div style="overflow-x: auto; max-width: 100%;">
                    <table border="1" cellspacing="0" cellpadding="5" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>#</th>
                                <!--<th>@lang('app.modul')</th>-->
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
                                <td>1</td>
                                <!--<td>AR</td>-->
                                <!--<td>Kemaskini Slip Bank</td>-->
                                <td>25CQPP050100009</td>
                                <td>25CQPP0500009</td>
                                <td>021000</td>
                                <td>PP0501 - PENYATA PEMUNGUT-AUTO</td>
                                <td>CIMB BANK BERHAD</td>
                                <td>63,512.00</td>
                                <td>LULUS</td>
                                <td>NOORAZINI BINTI NAZIRUDDIN</td>
                                <td>10/01/2025</td>
                                <td>0</td>
                                <td><a href="{{ route('collectors-statement-send-report-finance') }}" class="btn btn-success">@lang('app.view')</a></td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <!--<td>AR</td>-->
                                <!--<td>Kemaskini Slip Bank</td>-->
                                <td>25CQPP050100008</td>
                                <td>25CQPP0500008</td>
                                <td>021000</td>
                                <td>PP0501 - PENYATA PEMUNGUT-AUTO</td>
                                <td>CIMB BANK BERHAD</td>
                                <td>7,286.00</td>
                                <td>LULUS</td>
                                <td>NOORAZINI BINTI NAZIRUDDIN</td>
                                <td>09/01/2025</td>
                                <td>1</td>
                                <td><a href="{{ route('collectors-statement-send-report-finance') }}" class="btn btn-success">@lang('app.view')</a></td>
                            </tr>
                             <tr>
                                <td>3</td>
                                <!--<td>AR</td>-->
                                <!--<td>Kemaskini Slip Bank</td>-->
                                <td>25CQPP050100009</td>
                                <td>25CQPP0500009</td>
                                <td>021000</td>
                                <td>PP0501 - PENYATA PEMUNGUT-AUTO</td>
                                <td>CIMB BANK BERHAD</td>
                                <td>63,512.00</td>
                                <td>LULUS</td>
                                <td>NOORAZINI BINTI NAZIRUDDIN</td>
                                <td>10/01/2025</td>
                                <td>2</td>
                                <td><a href="{{ route('collectors-statement-send-report-finance') }}" class="btn btn-success">@lang('app.view')</a></td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <!--<td>AR</td>-->
                                <!--<td>Kemaskini Slip Bank</td>-->
                                <td>25CQPP050100008</td>
                                <td>25CQPP0500008</td>
                                <td>021000</td>
                                <td>PP0501 - PENYATA PEMUNGUT-AUTO</td>
                                <td>CIMB BANK BERHAD</td>
                                <td>7,286.00</td>
                                <td>LULUS</td>
                                <td>NOORAZINI BINTI NAZIRUDDIN</td>
                                <td>09/01/2025</td>
                                <td>3</td>
                                <td><a href="{{ route('collectors-statement-send-report-finance') }}" class="btn btn-success">@lang('app.view')</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
    </div>
</div>
</section> 
                   

@endsection


