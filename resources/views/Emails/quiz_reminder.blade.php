<!DOCTYPE html>
<html>

<head>
    <title>Reminder: Pending Quiz for {{ $studentName }}</title>
</head>

<body>
    <p>Dear Parent and {{ $studentName }},</p>

    <p>This is a friendly reminder that {{ $studentName }} has not yet completed the following quiz:</p>

    <ul>
        <li><strong>Quiz Name:</strong> {{ $quizName }}<br>
            <strong>Due Date:</strong> {{ $dueDate }}
        </li>
    </ul>

    <p>It is important to complete this quiz to ensure {{ $studentName }} stays on track with their studies and avoids
        any impact on their grades. We encourage {{ $studentName }} to log in to the student portal and complete the
        quiz as soon as possible.</p>

    <p>If there are any issues or concerns regarding the quiz, please do not hesitate to reach out to us. We are here to
        support {{ $studentName }} in their academic journey.</p>

    <p>Thank you for your attention to this matter.</p>

    <p>Best regards,<br>
        BisodmELMS<br>
        +94 33 223 6224</p>
</body>

</html>
