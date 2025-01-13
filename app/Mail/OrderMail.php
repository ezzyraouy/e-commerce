<?php 

namespace App\Mail;

use App\Models\Order;
use Illuminate\Mail\Mailable;
use Barryvdh\DomPDF\Facade\Pdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class OrderMail extends Mailable
{
    public $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function build()
    {
        $pdfContent = $this->generatePdf();
        $xlsxContent = $this->generateXlsx();

        return $this->subject('Order Invoice')
                    ->view('emails.order') 
                    ->with(['order' => $this->order]) 
                    ->attachData($pdfContent, 'invoice.pdf', [
                        'mime' => 'application/pdf',
                    ])
                    ->attachData($xlsxContent, 'invoice.xlsx', [
                        'mime' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                    ]);
    }

    private function generatePdf()
    {
        $pdf = Pdf::loadView('pdf.invoice', [
            'order' => $this->order, 
        ]);

        return $pdf->output(); 
    }

    private function generateXlsx()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
    
        // Add Header Information
        $sheet->setCellValue('A1', 'Jabal Tareeq Company');
        $sheet->mergeCells('A1:H1');
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(16);
    
        $sheet->setCellValue('A2', 'Tax Invoice');
        $sheet->mergeCells('A2:H2');
        $sheet->getStyle('A2')->getFont()->setBold(true)->setSize(14);
    
        $sheet->setCellValue('A3', 'Tax No. (TIN): 31172212500003');
        $sheet->mergeCells('A3:H3');
    
        $sheet->setCellValue('A4', 'Order ID: ' . $this->order->id);
        $sheet->mergeCells('A4:H4');
    
        // Add Details Section
        $sheet->setCellValue('A6', 'Date: ' . $this->order->created_at);
        $sheet->mergeCells('A6:B6');
    
        $sheet->setCellValue('C6', 'Invoice Type: Credit');
        $sheet->mergeCells('C6:H6');
    
        $sheet->setCellValue('A7', 'Currency: SAR');
        $sheet->mergeCells('A7:B7');
    
        $sheet->setCellValue('C7', 'Invoice Center: Main Center - Jabal Tareeq Ltd.');
        $sheet->mergeCells('C7:H7');
    
        $sheet->setCellValue('A8', 'Customer Name: ' . $this->order->user->name . ' - Phone Number: ' . $this->order->user->phone);
        $sheet->mergeCells('A8:H8');
    
        // Add Space Before Table
        $sheet->setCellValue('A10', ' ');
    
        // Add Table Header
        $sheet->setCellValue('A11', '#');
        $sheet->setCellValue('B11', 'Nom du produit');
        $sheet->setCellValue('C11', 'Unité');
        $sheet->setCellValue('D11', 'Quantité');
        $sheet->setCellValue('E11', 'Prix (SAR)');
        $sheet->setCellValue('F11', 'Remise (SAR)');
        $sheet->setCellValue('G11', 'Taxe (15%)');
        $sheet->setCellValue('H11', 'Total (SAR)');
        $sheet->getStyle('A11:H11')->getFont()->setBold(true);
    
        // Initialize totals
        $totalBeforeDiscount = 0;
        $totalDiscount = 0;
        $totalExcludingVAT = 0;
        $totalVAT = 0;
        $grandTotal = 0;
    
        // Fill Data Rows
        $rowIndex = 12; // Start after the table header
        if ($this->order->OrderItems) {
            foreach ($this->order->OrderItems as $index => $item) {
                $price = $item->UnitProduct->price;
                $discount = $item->discount ?? 0;
                $subtotal = ($price - $discount) * $item->quantity;
                $tax = $subtotal * 0.15;
                $total = $subtotal + $tax;
    
                // Update totals
                $totalBeforeDiscount += $price * $item->quantity;
                $totalDiscount += $discount * $item->quantity;
                $totalExcludingVAT += $subtotal;
                $totalVAT += $tax;
                $grandTotal += $total;
    
                // Fill row
                $sheet->setCellValue("A{$rowIndex}", $index + 1);
                $sheet->setCellValue("B{$rowIndex}", $item->product->name);
                $sheet->setCellValue("C{$rowIndex}", $item->UnitProduct->unit->name);
                $sheet->setCellValue("D{$rowIndex}", $item->quantity);
                $sheet->setCellValue("E{$rowIndex}", number_format($price, 2));
                $sheet->setCellValue("F{$rowIndex}", number_format($discount, 2));
                $sheet->setCellValue("G{$rowIndex}", number_format($tax, 2));
                $sheet->setCellValue("H{$rowIndex}", number_format($total, 2));
    
                $rowIndex++;
            }
        }
    
        // Add Totals Section
        $sheet->setCellValue("G{$rowIndex}", 'Total Before Discount');
        $sheet->setCellValue("H{$rowIndex}", number_format($totalBeforeDiscount, 2));
        $rowIndex++;
    
        $sheet->setCellValue("G{$rowIndex}", 'Total Discount');
        $sheet->setCellValue("H{$rowIndex}", number_format($totalDiscount, 2));
        $rowIndex++;
    
        $sheet->setCellValue("G{$rowIndex}", 'Total (Excluding VAT)');
        $sheet->setCellValue("H{$rowIndex}", number_format($totalExcludingVAT, 2));
        $rowIndex++;
    
        $sheet->setCellValue("G{$rowIndex}", 'VAT (15%)');
        $sheet->setCellValue("H{$rowIndex}", number_format($totalVAT, 2));
        $rowIndex++;
    
        $sheet->setCellValue("G{$rowIndex}", 'Total (Including VAT)');
        $sheet->setCellValue("H{$rowIndex}", number_format($grandTotal, 2));
    
        // Write to memory
        $writer = new Xlsx($spreadsheet);
        ob_start();
        $writer->save('php://output');
        return ob_get_clean();
    }
    
}
