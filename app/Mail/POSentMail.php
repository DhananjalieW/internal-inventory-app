<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Queue\SerializesModels;
use Barryvdh\DomPDF\Facade\Pdf;

class POSentMail extends Mailable
{
    use Queueable, SerializesModels;

    public $po;
    public $items;
    public $supplierName;

    public function __construct($po, $items, $supplierName)
    {
        $this->po = $po;
        $this->items = $items;
        $this->supplierName = $supplierName;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "Purchase Order {$this->po->po_number}",
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.po_sent',
            with: [
                'po' => $this->po,
                'items' => $this->items,
                'supplierName' => $this->supplierName,
            ],
        );
    }

    public function attachments(): array
    {
        // Generate PDF attachment
        $pdf = Pdf::loadView('pdf.po', [
            'po' => $this->po,
            'items' => $this->items,
        ]);

        return [
            Attachment::fromData(fn () => $pdf->output(), "PO-{$this->po->po_number}.pdf")
                ->withMime('application/pdf'),
        ];
    }
}
