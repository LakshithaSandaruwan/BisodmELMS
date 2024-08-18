<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class QuizReminderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $studentName;
    public $quizName;
    public $dueDate;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($studentName, $quizName, $dueDate)
    {
        $this->studentName = $studentName;
        $this->quizName = $quizName;
        $this->dueDate = $dueDate;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Quiz Reminder Mail',
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
            view: 'emails.quiz_reminder',
            with: [
                'studentName' => $this->studentName,
                'quizName' => $this->quizName,
                'dueDate' => $this->dueDate,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
