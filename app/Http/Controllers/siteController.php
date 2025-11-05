<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class siteController extends Controller
{
    public function index ()
 {
    return view ('site.home');
 }

    public function strukturorg ()
 {
    return view ('site.strukturorg');
 }

    public function layanan ()
 {
    return view ('site.layanan');
 }

     public function visimisi ()
 {
    return view ('site.visimisi');
 }
     public function checkConnection()
 {
      try {
         \DB::connection()->getPdo();
         return 'Koneksi ke database berhasil';
      } catch (Exception $e) {
         return 'Koneksi ke database gagal: ' . $e->getMessage();
      }
 }
}
