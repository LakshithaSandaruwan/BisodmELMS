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

            <div class="container-fluid mt-5">
                <div class="row">
                    <div class="col-12 mb-3 mb-lg-5">
                        <h1>{{ $quiz->QuizName }}</h1>
                        <form action="/submit-quiz" method="POST">
                            @csrf
                            <input type="hidden" name="quiz_id" value="{{ $quiz->id }}">

                            @foreach ($questions as $question)
                                <div class="card mb-3">
                                    <div class="card-header">
                                        {{ $question->question }}
                                    </div>
                                    <div class="card-body">
                                        @foreach ($question->answers as $answer)
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio"
                                                    name="answers[{{ $question->id }}]" id="answer-{{ $answer->id }}"
                                                    value="{{ $answer->id }}" required>
                                                <label class="form-check-label" for="answer-{{ $answer->id }}">
                                                    {{ $answer->answer }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach

                            <button type="submit" class="btn btn-success">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    @include('CDNs.AdminJS')
</body>

</html>
