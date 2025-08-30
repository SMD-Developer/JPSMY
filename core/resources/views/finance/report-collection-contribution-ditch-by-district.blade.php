@extends('app')
<style>
    body {
   font-family: Arial, sans-serif;
   font-size: 12px;
}

table {
   width: 100%;
   border-collapse: collapse;
   font-size: 13px;
}

th, td {
   border: 1px solid black;
   padding: 5px;
   text-align: left;
}

th {
   background-color: #f0f0f0;
   text-align: center;
}

.scrollbar {
   overflow-x: auto;
}

.form-container {
   padding: 15px;
   border: 1px solid #ddd;
   border-radius: 8px;
   box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
   background: #fff;
}

.date-column {
    display: inline-block;
    min-width: 100px;
}

.spaced-column {
    padding: 8px 16px; 
    min-width: 150px; 
}

</style>

<title>{{$title}} | JPS</title>

@section('content')
<div class="col-md-12 content-header">
   <h5><i class="fa fa-file" aria-hidden="true"></i> {{$title}}</h5>
</div>
<section class="content">
   <div class="row">
       <div class="col-md-12">
        <div class="col-md-12">
<div class="report-header" style="padding: 20px; background: linear-gradient(135deg, #f6f8fa 0%, #ffffff 100%); border-bottom: 2px solid #0969da;">
    <div class="header-row" style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 15px;">
        <div class="date-time-info" style="font-size: 10px; color: #656d76; line-height: 1.4;">
            <p><strong>TARIKH:</strong> {{ $currentDate }}</p>
            <p><strong>MASA:</strong> {{ $currentTime }}</p>
        </div>
        <div class="main-title" style="text-align: center; flex: 1; padding: 0 20px;">
            <h1 style="font-size: 13px; font-weight: 600; color: #24292f; text-transform: uppercase; line-height: 1.3; margin-bottom: 5px;">
                KERAJAAN NEGERI SELANGOR DARUL EHSAN
            </h1>
            <h2 style="font-size: 12px; font-weight: 500; color: #656d76; text-transform: uppercase;">
                LAPORAN KUTIPAN CARUMAN PARIT MENGIKUT DAERAH PADA {{ $formattedStartDate }} HINGGA {{ $formattedEndDate }}
            </h2>
            @if ($isFilteredByDistrict && $selectedDistrictName)
                <h2 style="font-size: 12px; font-weight: 500; color: #656d76; text-transform: uppercase;">
                    DAERAH: {{ strtoupper($selectedDistrictName) }}
                </h2>
            @else
                <h2 style="font-size: 12px; font-weight: 500; color: #656d76; text-transform: uppercase;">
                    DAERAH: SEMUA DAERAH
                </h2>
            @endif
        </div>
        <div class="page-info" style="font-size: 10px; color: #656d76; text-align: right;">
            <p><strong>MUKA SURAT : 1/1</strong></p>
        </div>
    </div>

    <!-- Department Information Table -->
    <table class="department-info-table" style="width: 100%; border-collapse: collapse; margin: 20px 0; font-size: 11px;">
        <thead>
            <tr>
                <th style="background: #f0f0f0; color: #333; padding: 12px 15px; text-align: center; font-weight: 600; border: 1px solid #ccc; font-size: 11px; text-transform: uppercase;">MENERIMA</th>
                <th style="background: #f0f0f0; color: #333; padding: 12px 15px; text-align: center; font-weight: 600; border: 1px solid #ccc; font-size: 11px; text-transform: uppercase;">KOD</th>
                <th style="background: #f0f0f0; color: #333; padding: 12px 15px; text-align: center; font-weight: 600; border: 1px solid #ccc; font-size: 11px; text-transform: uppercase;">PERIHAL</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="padding: 10px 15px; border: 1px solid #ccc; vertical-align: middle; background: #f9f9f9; font-weight: 600; color: #333; text-align: center;"><strong>JABATAN</strong></td>
                <td style="padding: 10px 15px; border: 1px solid #ccc; vertical-align: middle; background: #ffffff; color: #333; font-weight: 500;">: 021000</td>
                <td style="padding: 10px 15px; border: 1px solid #ccc; vertical-align: middle; background: #ffffff; color: #333;">JABATAN PENGAIRAN & SALIRAN SELANGOR</td>
            </tr>
            <tr>
                <td style="padding: 10px 15px; border: 1px solid #ccc; vertical-align: middle; background: #f9f9f9; font-weight: 600; color: #333; text-align: center;"><strong>PTJ</strong></td>
                <td style="padding: 10px 15px; border: 1px solid #ccc; vertical-align: middle; background: #ffffff; color: #333; font-weight: 500;">: 21000000</td>
                <td style="padding: 10px 15px; border: 1px solid #ccc; vertical-align: middle; background: #ffffff; color: #333;">PENGARAH PENGAIRAN & SALIRAN</td>
            </tr>
        </tbody>
    </table>
</div>
        </div>
           <!--<div class="form-container">-->
               
           <!--    <div class="scrollbar">-->
           <!--        <table>-->
           <!--            <thead>-->
           <!--                <tr>-->
           <!--                    <th>@lang('app.bil')</th>-->
           <!--                    <th>@lang('app.date')</th>-->
           <!--                    <th>@lang('app.reference_no')</th>-->
           <!--                    <th>@lang('app.account_type')</th>-->
           <!--                    <th>@lang('app.applicant_name')</th>-->
           <!--                    <th>@lang('app.district')</th>-->
           <!--                    <th>@lang('app.lot_pt')</th>-->
           <!--                    <th>@lang('app.total_contribution')</th>-->
           <!--                </tr>-->
           <!--            </thead>-->
           <!--            <tbody>-->
           <!--             @foreach ($applications as $index => $application)-->
           <!--             <tr>-->
           <!--                 <td>{{ $index + 1 }}</td>-->
           <!--                 {{-- <td>{{ date('d/m/Y', strtotime($application->created_at)) }}</td> --}}-->
           <!--                 <td class="date-column">-->
           <!--                                 @if ($application->deposit_date)-->
           <!--                                     <div class="date">-->
           <!--                                         {{ \Carbon\Carbon::parse($application->deposit_date)->format('d/m/Y') }}-->
           <!--                                     </div>-->
           <!--                                     <div class="time">-->
           <!--                                         {{ \Carbon\Carbon::parse($application->deposit_date)->format('h:i A') }}-->
           <!--                                     </div>-->
           <!--                                 @else-->
           <!--                                     N/A-->
           <!--                                 @endif-->
           <!--                             </td>-->
           <!--                 <td>{{ $application->refference_no ?? 'N/A' }}</td>-->
           <!--                 <td>{{ $application->account_type_name }}</td>-->
           <!--                 <td>{{ $application->applicant ?? 'N/A' }}</td>-->
           <!--                 <td  class="spaced-column">{{ $application->district_name }}</td>-->
           <!--                 <td class="spaced-column">{{ $application->land_lot ?? 'N/A' }}</td>-->
           <!--                 <td>RM {{ number_format($application->final_amount, 2) }}</td>-->
                            <!-- Add other fields -->
           <!--             </tr>-->
           <!--         @endforeach-->
           <!--              <tr style="font-weight: bold;">-->
           <!--                         <td colspan="7" style="border-right: none;text-align:end;">JUMLAH &nbsp;&nbsp;&nbsp;-->
           <!--                         </td>-->
           <!--                         <td style="border-left: none;">-->
           <!--                             {{ number_format($applications->sum('final_amount'), 2) }}-->
           <!--                         </td>-->
           <!--                     </tr>-->
           <!--            </tbody>-->
           <!--        </table>-->
           <!--    </div>-->
           <!--    <div class="d-flex justify-content-end mt-3">-->
           <!--        <button type="button" class="btn btn-primary" onclick="window.print()">@lang('app.print')</button>-->
           <!--    </div>-->
           <!--</div>-->
           <div class="form-container">
    <div class="scrollbar">
        <table style="border: 1px solid #000; border-collapse: collapse;">
            <thead>
                <tr>
                    <th style="border: 1px solid #000; padding: 8px; background-color: #f0f0f0; text-align: center;">@lang('app.bil')</th>
                    <th style="border: 1px solid #000; padding: 8px; background-color: #f0f0f0; text-align: center;">@lang('app.date')</th>
                    <th style="border: 1px solid #000; padding: 8px; background-color: #f0f0f0; text-align: center;">@lang('app.reference_no')</th>
                    <th style="border: 1px solid #000; padding: 8px; background-color: #f0f0f0; text-align: center;">@lang('app.account_type')</th>
                    <th style="border: 1px solid #000; padding: 8px; background-color: #f0f0f0; text-align: center;">@lang('app.applicant_name')</th>
                    <th style="border: 1px solid #000; padding: 8px; background-color: #f0f0f0; text-align: center;">@lang('app.district')</th>
                    <th style="border: 1px solid #000; padding: 8px; background-color: #f0f0f0; text-align: center;">@lang('app.lot_pt')</th>
                    <th style="border: 1px solid #000; padding: 8px; background-color: #f0f0f0; text-align: center;">@lang('app.total_contribution')</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($applications as $index => $application)
                <tr>
                    <td style="border: 1px solid #000; padding: 8px; text-align: center;">{{ $index + 1 }}</td>
                    <td style="border: 1px solid #000; padding: 8px;">
                        @if ($application->deposit_date)
                            <div style="text-align: center;">
                                {{ \Carbon\Carbon::parse($application->deposit_date)->format('d/m/Y') }}
                            </div>
                            <div style="text-align: center;">
                                {{ \Carbon\Carbon::parse($application->deposit_date)->format('h:i A') }}
                            </div>
                        @else
                            N/A
                        @endif
                    </td>
                    <td style="border: 1px solid #000; padding: 8px;">{{ $application->refference_no ?? 'N/A' }}</td>
                    <td style="border: 1px solid #000; padding: 8px;">{{ $application->account_type_name }}</td>
                    <td style="border: 1px solid #000; padding: 8px;">{{ $application->applicant ?? 'N/A' }}</td>
                    <td style="border: 1px solid #000; padding: 8px;">{{ $application->district_name }}</td>
                    <td style="border: 1px solid #000; padding: 8px;">{{ $application->land_lot ?? 'N/A' }}</td>
                    <td style="border: 1px solid #000; padding: 8px; text-align: right;">RM {{ number_format($application->final_amount, 2) }}</td>
                </tr>
                @endforeach
                <tr style="font-weight: bold;">
                    <td colspan="7" style="border: 1px solid #000; text-align: end; padding: 8px;">JUMLAH &nbsp;&nbsp;&nbsp;</td>
                    <td style="border: 1px solid #000; text-align: right; padding: 8px;">
                        RM {{ number_format($applications->sum('final_amount'), 2) }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-end mt-3">
        <button type="button" class="btn btn-primary" onclick="window.print()">@lang('app.print')</button>
    </div>
</div>
       </div>
   </div>
</section>




@endsection