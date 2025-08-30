<?php

namespace App\Http\Controllers\Reviewer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Invoicer\Repositories\Contracts\InvoiceInterface as Invoice;
use App\Invoicer\Repositories\Contracts\ProductInterface as Product;
use App\Invoicer\Repositories\Contracts\ClientInterface as Client;
use App\Invoicer\Repositories\Contracts\EstimateInterface as Estimate;
use App\Invoicer\Repositories\Contracts\PaymentInterface as Payment;
use App\Invoicer\Repositories\Contracts\ExpenseInterface as Expense;
use App\Models\Application;
use App\Models\ClientRegisterModel;
use DB;


class ReviewerController extends Controller
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

    public function index(){
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
          
          
        return view('reviewer.home', compact( 'totalAgencyApplication', 
        'newapplication', 
        'monthapplication', 
        'approvedapplication', 
        'passed',
        'rejected',
        'applicationsByDistrict',
        'districts'));
    }
     public function paymentReview(){
        return view('reviewer.payment-to-review');
    }
    public function collectorStatement(){
        return view('reviewer.collector-statement-report-reviewer');
    }
    public function collectorReceiptReview(){
        return view('reviewer.collectors-receipt-reviewer');
    }
    public function checkbook_receipt_reviewer(){
        return view('reviewer.checkbook_receipt_reviewer');
    }
    public function cash_book_report_reviewer(){
        return view('reviewer.cash_book_report_reviewer');
    }
    public function dailyPaymentReceiptReportReviewer(){
        return view('reviewer.daily-payment-receipt-report-reviewer');
    }
    public function dailyReceiptReportTypeReviewer(){
        return view('reviewer.daily-receipt-report-type-reviewer');
    }
}



