<?php 
namespace App\Mail;

use App\Models\Order;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Storage;

class OrderMail extends Mailable
{
    public $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function build()
    {
        // Generate CSV content
        $csvContent = $this->generateCsv();

        // Attach the CSV file
        return $this->subject('New Order')
                    ->view('emails.order')
                    ->with(['order' => $this->order])  // Pass the order to the view
                    ->attachData($csvContent, 'order_details.csv', [
                        'mime' => 'text/csv',
                    ]);
    }

    private function generateCsv()
    {
        $csv = "Order ID, Product Name, Unit, Quantity, Price, Discount, Tax, Subtotal, Total\n";
        $total = 0;

        foreach ($this->order->OrderItems as $item) {
            $price = $item->UnitProduct->price;
            $discount = $item->discount ?? 0;
            $tax = $item->tax ?? 0;
            $subtotal = ($price - $discount) * $item->quantity;
            $total += $subtotal + $tax;

            $csv .= "{$this->order->id}, " .
                    "{$item->product->name}, " .
                    "{$item->UnitProduct->unit->name}, " .
                    "{$item->quantity}, " .
                    number_format($price, 2) . " SAR, " .   
                    number_format($discount, 2) . " SAR, " .
                    number_format($tax, 2) . " SAR, " .
                    number_format($subtotal, 2) . " SAR, " .
                    number_format($subtotal + $tax, 2) . " SAR\n";
        }

        // Add the grand total at the end
        $csv .= "Grand Total,,,,,,,, " . number_format($total, 2) . " SAR\n";

        return $csv;
    }
}
