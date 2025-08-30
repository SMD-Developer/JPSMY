<?php

namespace App\Http\Controllers;

use App\Invoicer\Repositories\Contracts\InvoiceInterface as Invoice;
use App\Invoicer\Repositories\Contracts\ProductInterface as Product;
use App\Invoicer\Repositories\Contracts\ClientInterface as Client;
use App\Invoicer\Repositories\Contracts\EstimateInterface as Estimate;
use App\Invoicer\Repositories\Contracts\PaymentInterface as Payment;
use App\Invoicer\Repositories\Contracts\ExpenseInterface as Expense;
use Illuminate\View\View;
use App\Models\Application;
use App\Models\ClientRegisterModel;
use DB;

use Illuminate\Http\Request;

class ApproverController extends Controller
{
    
    protected $invoice, $product, $client, $estimate, $payment, $expense;
    /**
     * Create a new controller instance.
     */
    public function __construct(Invoice $invoice, Product $product, Client $client, Estimate $estimate, Payment $payment, Expense $expense)
    {
        $this->invoice      = $invoice;
        $this->product      = $product;
        $this->client       = $client;
        $this->estimate     = $estimate;
        $this->payment      = $payment;
        $this->expense      = $expense;
    }


     public function approverHome()
     {
        
        $totalapplication = DB::table('applications')->count(); // Total applications
        $newapplication = DB::table('applications')->where('status', 'pending')->count(); 
        $totalAgencyApplication = DB::table('applications')
        ->join('client_register', 'applications.user_id', '=', 'client_register.client_id')
        ->where('client_register.accountType', '=', 3)
        ->count();
        $monthapplication = DB::table('applications')
            ->whereMonth('created_at', date('m'))
            ->count(); 
        $approvedapplication = DB::table('applications')->where('status', 'approved')->count(); 
        $passed = DB::table('applications')->where('status', 'approved')->count();
        $rejected = DB::table('applications')->where('status', 'rejected')->count();
        
        $applicationsByDistrict = DB::table('applications')
            ->select('district', DB::raw('count(*) as total'))
            ->groupBy('district')
            ->get();
         
            $districtCounts = DB::table('applications')
            ->select('district', DB::raw('count(*) as count'))
            ->groupBy('district')
            ->get();
            
        // Get district names
        $districts = [];
        foreach ($districtCounts as $item) {
            $districtInfo = DB::table('district')
                ->where('iddaerah', $item->district)
                ->first();
                
            if ($districtInfo) {
                $districts[] = [
                    'name' => $districtInfo->daerah,
                    'count' => $item->count
                ];
            }
        }
        return view('approver.home', compact( 'totalAgencyApplication', 
        'newapplication', 
        'monthapplication', 
        'approvedapplication', 
        'passed',
        'rejected',
        'applicationsByDistrict',
        'districts'));
    }
    
    public function approve(){
        $canFinanceApproverApplicationDetails = auth('admin')->user()->hasPermission('applications.view-details');
        $applications = Application::with('client')
        ->orderBy('created_at', 'desc')
        ->get();
        return view('approver.approve', compact('applications', 'canFinanceApproverApplicationDetails'));
    }
    
     public function approved_statement_approver(){
        return view('approver.approved_statement_approver');
    }
    
        public function collectors_statement_report_approver(){
        return view('approver.collectors_statement_report_approver');
    }
    
         public function collectors_receipt_approver(){
        return view('approver.collectors_receipt_approver');
    }
    
        public function cash_book_report_approver(){
        return view('approver.cash_book_report_approver');
    }

        public function checkbook_receipt_approver(){
        return view('approver.checkbook_receipt_approver');
    }
    
    public function dailyPaymentReceiptReportApprover(){
        return view('approver.daily-payment-receipt-report-approver');
    }

    public function dailyReceiptReportTypeApprover(){
        return view('approver.daily-receipt-report-type-approver');
    }
}







