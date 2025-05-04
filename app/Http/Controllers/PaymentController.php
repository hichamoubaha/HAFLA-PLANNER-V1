<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function showPaymentForm(Booking $booking)
    {
        // Check if user has permission to make payments
        if (!in_array(Auth::user()->role, ['user', 'client'])) {
            return redirect()->route('bookings.index')->with('error', 'You do not have permission to make payments.');
        }

        if ($booking->payment_status === 'paid') {
            return redirect()->route('bookings.index')->with('error', 'This booking has already been paid.');
        }

        return view('payments.payment', compact('booking'));
    }

    public function processPayment(Request $request, Booking $booking)
    {
        // Check if user has permission to make payments
        if (!in_array(Auth::user()->role, ['user', 'client'])) {
            return redirect()->route('bookings.index')->with('error', 'You do not have permission to make payments.');
        }

        $request->validate([
            'payment_method' => 'required|in:credit_card,paypal,bank_transfer',
            'amount' => 'required|numeric|min:0',
        ]);

        try {
            DB::beginTransaction();

            // Here you would integrate with your payment gateway (e.g., Stripe, PayPal)
            // For now, we'll simulate the payment
            $transactionId = 'TXN-' . time() . '-' . rand(1000, 9999);

            // Update booking with payment details
            $booking->update([
                'payment_status' => 'paid',
                'amount' => $request->amount,
                'payment_method' => $request->payment_method,
                'transaction_id' => $transactionId,
                'paid_at' => now()
            ]);

            DB::commit();

            return redirect()->route('bookings.index')->with('success', 'Payment successful! Your booking is now confirmed.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Payment failed. Please try again.');
        }
    }

    public function cancelPayment(Booking $booking)
    {
        try {
            $booking->update([
                'payment_status' => 'pending',
                'amount' => null,
                'payment_method' => null,
                'transaction_id' => null,
                'paid_at' => null
            ]);

            return redirect()->route('bookings.index')->with('success', 'Payment cancelled successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to cancel payment.');
        }
    }
}
