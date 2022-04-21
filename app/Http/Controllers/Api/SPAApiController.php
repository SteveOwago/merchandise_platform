<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Customer;
use App\Models\IssueProduct;
use App\Models\Product;
use App\Models\Productbas;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SPAApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    //Brand Ambassadors
    public function IssueProductBA(Request $request)
    {
        //Chack if user is Brand Ambassador && product assigned to him/her

        // return count($productBa);
        abort_if(auth()->user()->role_id != 4, Response::HTTP_FORBIDDEN, '403 Forbidden');
        $product_id = Product::select('id')->where('product_code', $request->product_code)->first();
        if($product_id == null){
            return \Response::json([
                'message' => "Merchandise Is not Found",
                'status'=>0,
            ]);
        }
        $productBa = Productbas::where('assigned_to',auth()->user()->id)->whereIn('product_id',$product_id)->get();
        //Check if product is issued Out
        if (count($productBa)==0) {
            return \Response::json([
                'message' => "Merchandise Does not Belong to Brand Ambassador",
                'status'=>0,
            ]);
        }
        $product = Product::where('product_code', $request->product_code)->first();
        $issuedProduct = IssueProduct::where('product_id', $product->id)->first();
        // return $issuedProduct;
        if ($issuedProduct) {
            return \Response::json([
                'message' => "Merchandise Is Already Issued Out",
                'status'=>1,
            ]);
        } else {
            $batch = $product->batch_id;
            $issueProduct = IssueProduct::create([
                'ba_id' => auth()->user()->id,
                'batch_id' => $batch,
                'product_id' => $product->id,
                'category_id' => $product->category->id,
            ]);
            // Save Customer Data through Api.
            $productsIssued = IssueProduct::select('product_id')->where('ba_id',auth()->user()->id)->where('category_id',$product->category_id)->get();
            $remainingProducts = Productbas::where('assigned_to',auth()->user()->id)->whereNotIn('product_id',$productsIssued)->get();
            if ($request->has('customer_phone') || $request->has('customer_name')) {
                Customer::create([
                    'name' => $request->customer_name,
                    'phone' => $request->customer_phone,
                    'product_id' => $product->id,
                ]);
            }
            Activity::create([
                'title' => 'Merchandise Issued',
                'user_id' => auth()->user()->id,
                'description' => auth()->user()->name . ' have issued out ' . $product->product_code,
            ]);
            if ($issueProduct) {

                return \Response::json([
                    'message' => "Merchandise Found and Issued Successfully",
                    'merchandise_type'  => $product->category->title??'No Merchandise Type Registered for the Merchandise',
                    'remaining_items' => $remainingProducts?count($remainingProducts):0,
                    'issued_items' => $productsIssued?count($productsIssued):0,
                    //Status success
                    'status'=>1,
                ]);
            } else {
                return \Response::json([
                    'message' => "Merchandise Not Found",
                    // Status Unsuccessful
                    'status'=>0,
                ]);
            }
        }


    }
}