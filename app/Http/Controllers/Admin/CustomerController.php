<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateCustomerRequest;
use App\Models\Customer;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $customers = Customer::query();

        if ($request->search) {
            $customers = Customer::where('name', 'like', '%'.$request->search.'%');
        }

        $customers = $customers->paginate(10)->appends(['search' => $request->search]);

        $data = [
            'customers' => $customers,
        ];

        return view('admin.customer.index', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        $data = [
            'data_edit' => $customer,
        ];

        return view('admin.customer.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        try {
            DB::beginTransaction();

            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'username' => $request->username,
            ];

            if ($request->file('avatar')) {
                $name = time().'_'.$request->avatar->getClientOriginalName();
                $file_path = 'uploads/avatar/customer/'.$name;
                Storage::disk('public_uploads')->putFileAs('avatar/customer', $request->avatar, $name);
                $data['avatar'] = $file_path;
            }

            $customer->update($data);

            DB::commit();

            return redirect()->route('customers.index')->with('alert-success', 'Sửa người dùng thành công!');
        } catch (Exception) {
            DB::rollback();

            return redirect()->back()->with('alert-error', 'Sửa người dùng thất bại!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        try {
            DB::beginTransaction();

            $customer->destroy($customer->id);

            DB::commit();

            return redirect()->route('customers.index')->with('alert-success', 'Xóa người dùng thành công!');
        } catch (Exception $e) {
            DB::rollback();

            return redirect()->back()->with('alert-error', 'Xóa người dùng thất bại!');
        }
    }
}
