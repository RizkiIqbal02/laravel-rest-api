<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $customers = Customer::paginate(15);
        $customers = Customer::all();
        return response()->json([
            'data' => $customers
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $customer = Customer::create([
        //     'name' => $request->name,
        //     'id_number' => $request->id_number,
        //     'dob' => $request->dob,
        //     'email' => $request->email
        // ]);

        // return response()->json([
        //     'data' => $customer
        // ]);
        $name = $request->input('name');
        $id_number = $request->input('id_number');
        $dob = $request->input('dob');
        $email = $request->input('email');

        // Lakukan validasi data jika diperlukan
        if (!$name || !$email || !$id_number || !$dob) {
            return response()->json(['error' => 'Invalid data'], 400);
        }

        // Proses penambahan pelanggan ke dalam database atau penyimpanan lainnya
        $customer = new Customer();
        $customer->name = $name;
        $customer->id_number = $id_number;
        $customer->dob = $dob;
        $customer->email = $email;
        $customer->save();

        return response()->json(['message' => 'Customer added successfully'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $id = $request->query('id');


        $customer = Customer::find($id);

        if (!$customer){
            return response()->json(['error' => 'Customer with id '. $id . ' Not found'], 404);
        }
        return response()->json([
            'data' => $customer
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //

        $customer = Customer::find($id);



        if (!$customer) {
            return response()->json(['message' => 'Customer not found'], 404);
        }

        // Mengambil data baru dari request
        $data = $request->input();

        if (!$data) {
            return response()->json(['message' => 'masukan data yang ingin diubah'], 204);
        }
        // Lakukan validasi data jika diperlukan
        // ...

        // Lakukan operasi update
        $customer->update($data);

        return response()->json(['message' => 'Customer updated', 'data' => $customer]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = $request->input('id');

        $customer = Customer::find($id);

        if (!$customer) {
            return response()->json(['message' => 'Customer not found'], 404);
        }

        $customer->delete();

        return response()->json(['message' => 'Customer deleted']);
    }

}
