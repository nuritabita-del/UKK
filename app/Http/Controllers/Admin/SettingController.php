<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function edit()
    {
        $qrisImage = Setting::get('qris_image');
        $bcaNumber = Setting::get('bca_account_number', '1234 5678 90');
        $bcaName = Setting::get('bca_account_name', "Karen's Bakery");

        return view('admin.settings.edit', compact('qrisImage', 'bcaNumber', 'bcaName'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'qris_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:4096'],
            'bca_account_number' => ['nullable', 'string', 'max:50'],
            'bca_account_name' => ['nullable', 'string', 'max:100'],
        ]);

        if ($request->hasFile('qris_image')) {
            $old = Setting::get('qris_image');
            if ($old) {
                Storage::disk('public')->delete($old);
            }
            $path = $request->file('qris_image')->store('settings', 'public');
            Setting::set('qris_image', $path);
        }

        if ($request->has('bca_account_number')) {
            Setting::set('bca_account_number', $request->input('bca_account_number'));
        }

        if ($request->has('bca_account_name')) {
            Setting::set('bca_account_name', $request->input('bca_account_name'));
        }

        return back()->with('success', 'Pengaturan pembayaran berhasil diperbarui.');
    }
}
