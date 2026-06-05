<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PaymentProofController extends Controller
{
    /**
     * User mengupload bukti transfer
     */
    public function upload(Request $request, Order $order)
    {
        // Hanya pemilik order yang boleh upload
        abort_if($order->user_id !== auth()->id(), 403);

        // Hanya order transfer yang bisa upload bukti
        abort_if($order->payment_method !== 'transfer', 400);

        $request->validate([
            'payment_proof' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'payment_proof.required' => 'Silakan pilih file bukti transfer.',
            'payment_proof.image'    => 'File harus berupa gambar.',
            'payment_proof.mimes'    => 'Format gambar: JPG atau PNG.',
            'payment_proof.max'      => 'Ukuran gambar maksimal 2MB.',
        ]);

        // Hapus bukti lama jika ada
        if ($order->payment_proof) {
            Storage::disk('public')->delete($order->payment_proof);
        }

        $path = $request->file('payment_proof')->store('payment_proofs', 'public');

        $order->update(['payment_proof' => $path]);

        return back()->with('success', 'Bukti transfer berhasil diupload. Kami akan memverifikasi pembayaran Anda.');
    }

    /**
     * Admin melihat bukti transfer di detail pesanan
     * (hanya dipanggil lewat view — tidak perlu method khusus,
     *  cukup tampilkan $order->payment_proof di blade)
     */
}
