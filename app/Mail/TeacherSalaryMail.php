<?php

namespace App\Mail;

use Barryvdh\DomPDF\PDF;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class TeacherSalaryMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $teacher;
    protected $salaryDetails;
    protected $pdf;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($teacher, $salaryDetails, PDF $pdf)
    {
        $this->teacher = $teacher;
        $this->salaryDetails = $salaryDetails;
        $this->pdf = $pdf;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Salary Paysheet',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'emails.salary',
        );
    }

    /**
     * Build the message with attachments.
     *
     * @return $this
     */
    public function build()
    {
        $pdfContent = $this->pdf->loadView('pdf.salary', [
            'teacher' => $this->teacher,
            'salaryDetails' => $this->salaryDetails,
        ])->output();

        return $this->view('emails.salary')
                    ->attachData($pdfContent, 'salary_details.pdf', [
                        'mime' => 'application/pdf',
                    ]);
    }
}
