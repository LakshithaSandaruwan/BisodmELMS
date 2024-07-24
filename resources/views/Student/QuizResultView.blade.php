<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Student Dashboard</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    @include('CDNs.AdminCDN')

</head>

<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">


        <div class="sidebar pe-4 pb-3">
            @include('Student.Include.Sidebar')
        </div>

        <div class="content">
            @include('Student.Include.Navbar')

            <div class="container mt-5">
                <div class="row">
                    <div class="overflow-hidden card table-nowrap table-card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                           <h5> {{ $quiz->QuizName }} - Results</h5>
                           <h5>Marks : {{ number_format($correctAnswerPercentage, 2) }}%</h5>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container">
                <h1></h1>

                @foreach ($quiz->questions as $question)
                    <div class="card mb-3">
                        <div class="card-header">
                            <strong>Question: {{ $question->question }}</strong>
                        </div>
                        <div class="card-body">
                            <ul>
                                @foreach ($question->answers as $answer)
                                    <li>

                                        @if ($answer->is_correct)
                                            <span class="badge bg-success">{{ $answer->answer }}</span>
                                        @else
                                        <span class="badge bg-danger">{{ $answer->answer }}</span>
                                        @endif
                                        @if (isset($studentAnswers[$question->id]) && $studentAnswers[$question->id]->answer_id == $answer->id)
                                            <span class="badge bg-primary"><i class="fa fa-check " aria-hidden="true"></i></span>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    @include('CDNs.AdminJS')
</body>

</html>
