<?php

namespace App\Http\Controllers\backEnd;

use App\Http\Controllers\Controller;
use App\Models\PayType;
use App\Models\PayMethod;
use Illuminate\Http\Request;

class PayController extends Controller
{
    public function pay_Type_Index(Request $request)
    {
        $query = PayType::query();
        $status = $request->input('status', '1'); // Default to Active (1)
        if ($status !== 'all') {
            $query->where('status', $status);
        }
        $paymentTypes = $query->get();;

        return view('backEnd.pages.payment.pay-Type', compact('paymentTypes'));
    }

    public function storePaymentType(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:pay_types,name',
            'status' => 'required|in:0,1',
        ], [
            'name.required' => 'Payment type name is required.',
            'name.unique' => 'This payment type name already exists.',
            'status.required' => 'Status is required.',
        ]);

        $paymentType = new PayType();
        $paymentType->name = $request->name;
        $paymentType->status = $request->status;

        if ($paymentType->save()) {
            return response()->json([
                'success' => true,
                'message' => 'Payment type saved successfully.'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Failed to save payment type.'
        ], 500);
    }

    public function updatePaymentType(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:pay_types,name,' . $request->id,
            'status' => 'required|in:0,1',
        ], [
            'name.required' => 'Payment type name is required.',
            'name.unique' => 'This payment type name already exists.',
            'status.required' => 'Status is required.',
        ]);

        $paymentType = PayType::findOrFail($request->id);
        $paymentType->name = $request->name;
        $paymentType->status = $request->status;

        if ($paymentType->save()) {
            return response()->json([
                'success' => true,
                'message' => 'Payment type updated successfully.'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Failed to update payment type.'
        ], 500);
    }












    // Payment Method Index

    public function pay_Method_Index(Request $request)
    {
        $paymentMethods = PayMethod::all();
        $paymentTypes = PayType::where('status', '1')->get();
        return view('backEnd.pages.payment.pay-Method', compact('paymentMethods', 'paymentTypes'));
    }

    // public function productSubCategoryIndex(Request $request)
    // {
    //     $query = ProductSubCategory::with('productCategory');

    //     $status = $request->input('status', '1');

    //     if ($status !== 'all') {
    //         $query->where('status', $status);
    //     }

    //     $ProductSubCategories = $query->get();
    //     $productCategories = ProductCategory::where('status', 1)->get();

    //     return view(
    //         'backEnd.pages.product.productSubCategory',
    //         compact('ProductSubCategories', 'productCategories')
    //     );
    // }

    public function storePaymentMethod(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:pay_methods,name',
            'pay_type_id'      => 'required|exists:pay_types,id',
            'status'                  => 'required|in:0,1',
            // Mobile Banking
            'mbanking_number' => 'nullable|required_if:pay_type_id,1|unique:pay_methods,mbanking_number',

            // Bank
            'account_holder_name' => 'nullable|required_if:pay_type_id,2',
            'account_number' => 'nullable|required_if:pay_type_id,2|unique:pay_methods,account_number',
            'branch_name' => 'nullable|required_if:pay_type_id,2',
            'routing_number' => 'nullable',
        ], [
            'name.required' => 'Payment method name is required.',
            'name.unique'   => 'This payment method name already exists.',
            'pay_type_id.required'      => 'Please select a payment type.',
            'pay_type_id.exists'        => 'Selected payment type is invalid.',
            'status.required'                  => 'Status is required.',

            'mbanking_number.required_if' => 'Merchant/Personal Number is required.',
            'mbanking_number.unique' => 'This Merchant/Personal Number already exists.',

            'account_holder_name.required_if' => 'Account Holder Name is required.',
            'account_number.required_if' => 'Account Number is required.',
            'account_number.unique' => 'This Account Number already exists.',
            'branch_name.required_if' => 'Branch Name is required.',

        ]);

        $paymentMethod = new PayMethod();
        $paymentMethod->name = $request->name;
        $paymentMethod->pay_type_id      = $request->pay_type_id;
        $paymentMethod->note = $request->note;
        $paymentMethod->status                  = $request->status;

        if ($request->pay_type_id == 1) {
            $paymentMethod->mbanking_number = $request->mbanking_number;
            $paymentMethod->account_holder_name = null;
            $paymentMethod->account_number = null;
            $paymentMethod->routing_number = null;
            $paymentMethod->branch_name = null;
        } else {
            $paymentMethod->mbanking_number = null;
            $paymentMethod->account_holder_name = $request->account_holder_name;
            $paymentMethod->account_number = $request->account_number;
            $paymentMethod->routing_number = $request->routing_number;
            $paymentMethod->branch_name = $request->branch_name;
        }

        if ($paymentMethod->save()) {
            return response()->json([
                'success' => true,
                'message' => 'Payment method saved successfully.',
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Failed to save payment method.',
        ], 500);
    }

    public function updatePaymentMethod(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:pay_methods,name,' . $request->id,
            'pay_type_id'      => 'required|exists:pay_types,id',
            'status'                  => 'required|in:0,1',
            // Mobile Banking
            'mbanking_number' => 'nullable|required_if:pay_type_id,1|unique:pay_methods,mbanking_number,' . $request->id,

            // Bank
            'account_holder_name' => 'nullable|required_if:pay_type_id,2',
            'account_number' => 'nullable|required_if:pay_type_id,2|unique:pay_methods,account_number,' . $request->id,
            'branch_name' => 'nullable|required_if:pay_type_id,2',
            'routing_number' => 'nullable',
        ], [
            'name.required' => 'Payment method name is required.',
            'name.unique'   => 'This payment method name already exists.',
            'pay_type_id.required'      => 'Please select a payment type.',
            'pay_type_id.exists'        => 'Selected payment type is invalid.',
            'status.required'                  => 'Status is required.',

            'mbanking_number.required_if' => 'Merchant/Personal Number is required.',
            'mbanking_number.unique' => 'This Merchant/Personal Number already exists.',

            'account_holder_name.required_if' => 'Account Holder Name is required.',
            'account_number.required_if' => 'Account Number is required.',
            'account_number.unique' => 'This Account Number already exists.',
            'branch_name.required_if' => 'Branch Name is required.',

        ]);

        $paymentMethod = PayMethod::findOrFail($request->id);
        $paymentMethod->name = $request->name;
        $paymentMethod->pay_type_id = $request->pay_type_id;
        $paymentMethod->note = $request->note;
        $paymentMethod->status = $request->status;

        if ($request->pay_type_id == 1) {
            $paymentMethod->mbanking_number = $request->mbanking_number;
            $paymentMethod->account_holder_name = null;
            $paymentMethod->account_number = null;
            $paymentMethod->routing_number = null;
            $paymentMethod->branch_name = null;
        } else {
            $paymentMethod->mbanking_number = null;
            $paymentMethod->account_holder_name = $request->account_holder_name;
            $paymentMethod->account_number = $request->account_number;
            $paymentMethod->routing_number = $request->routing_number;
            $paymentMethod->branch_name = $request->branch_name;
        }

        if ($paymentMethod->save()) {
            return response()->json([
                'success' => true,
                'message' => 'Payment method updated successfully.',
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Failed to update payment method.',
        ], 500);
    }
}
