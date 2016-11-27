<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Phone;

class PhoneController extends Controller
{

    public function index()
    {
      $phone = Phone::all();

      return response()->json($phone);
    }

    public function create(Request $r)
    {
      $phone = new Phone;
      $response = [];

      $phone->brand = $r->input('brand');
      $phone->type = $r->input('type');
      $phone->price = $r->input('price');
      $phone->save();

      $response['success'] = 1;
      $response['message'] = 'Data berhasil ditambahkan!';

      return response()->json($response);
    }

    public function show($id)
    {
      $phone = Phone::whereId($id)->first();
      $response = [];

      if ($phone == null) {
        $response['success'] = 0;
        $response['message'] = 'Data tidak ditemukan!';

        return response()->json($response);
      } else {
        $response['success'] = 1;
        $response['data'] = $phone;

        return response()->json($response);
      }
    }

    public function update(Request $r)
    {
      $id = $r->input('id');
      $phone = Phone::find($id);
      $response = [];

      $phone->brand = $r->input('brand');
      $phone->type = $r->input('type');
      $phone->price = $r->input('price');
      $phone->save();

      $response['success'] = 1;
      $response['message'] = 'Data berhasil diubah!';

      return response()->json($response);
    }

    public function delete($id)
    {
      $response = [];

      Phone::whereId($id)->delete();

      $response['success'] = 1;
      $response['message'] = 'Data berhasil dihapus!';

      return response()->json($response);
    }
}
