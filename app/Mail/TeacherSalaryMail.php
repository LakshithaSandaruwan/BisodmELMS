<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class TeacherSalaryMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $teacher;
    protected $salaryDetails;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($teacher, $salaryDetails)
    {
        $this->teacher = $teacher;
        $this->salaryDetails = $salaryDetails;
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
        $pdfContent = PDF::loadView('pdf.salary', [
            'teacher' => $this->teacher,
            'salaryDetails' => $this->salaryDetails,
        ])->output();

        return $this->view('emails.salary')
                    ->attachData($pdfContent, 'salary_details.pdf', [
                        'mime' => 'application/pdf',
                    ]);
    }
}

