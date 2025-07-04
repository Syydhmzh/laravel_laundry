<?php

namespace App\Http\Controllers;

use App\Models\Customers;
use App\Models\TransOrders;
use App\Models\TransDetails;
use Illuminate\Http\Request;
use App\Models\TypeOfServices;
use Illuminate\Support\Carbon;
use Midtrans\Config;
use Midtrans\Snap;

class TransOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', false);
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }



    public function index()
    {
        $title = 'Transaksi_order';
        $datas = TransOrders::with('customer')->orderBy('id', 'desc')->get();
        return view('trans.index', compact('title', 'datas',));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //TR-01072025-001
        $today = Carbon::now()->format('dmy');
        $countDay = TransOrders::whereDate('created_at', Carbon::now())->count() + 1;
        $runningNumber = str_pad($countDay, 3, '0', STR_PAD_LEFT);
        $title = 'Tambah Transaksi Order';
        $ordercode = 'TR-' . $today . "-" . $runningNumber;

        $customers = Customers::orderBy('id', 'asc')->get();
        $services = TypeOfServices::orderBy('id', 'asc')->get();
        return view('trans.create', compact('title', 'ordercode', 'customers', 'services'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $transOrder = TransOrders::create([
            'id_customer' => $request->id_customer,
            'order_code' => $request->order_code,
            'order_end_date' => $request->order_end_date,
            'total' => $request->grand_total
        ]);

        foreach ($request->id_service as $key => $data) {
            $idTrans = $transOrder->id;
            TransDetails::create([
                'id_trans' => $idTrans,
                'id_service' => $request->id_service[$key],
                'qty' => $request->td_qty[$key],
                'subtotal' => $request->td_total[$key]
            ]);
        }
        return redirect()->to('trans');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        $title = "Detail trans";
        $details = TransOrders::with('customer', 'details.service')->where('id', $id)->get()->first();

        return view('trans.show', compact('title', 'details'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $delete = TransOrders::find($id);
        $delete->delete();
        return redirect()->to('trans')->with('success', 'Data level berhasil dihapus');
    }

    public function printStruk(string $id)
    {
        $details = TransOrders::with('customer', 'details.service')->where('id', $id)->get()->first();
        // return $details; //Debugging, hanya data saja
        // dd($details); //Debugging, semua object yg ada datanya
        return view('trans.print', compact('details'));
    }



    public function snap(Request $request, $id)
    {
        $order = TransOrders::with(['details', 'customer'])->findOrFail(($id));
        // dd($order);

        $params = [
            'transaction_details' => [
                'order_id' => rand(),
                'gross_amount' => $order->total,
            ],
            'customer_details' => [
                'first_name' => $order->customer->name ?? 'umum',
                'email' => $order->customer->email ?? 'dummy@gmail.com',

            ],
        ];
        $snap = Snap::createTransaction($params);
        return response()->json(['token' => $snap->token]);
    }
}
