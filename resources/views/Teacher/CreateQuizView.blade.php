<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>DASHMIN - Bootstrap Admin Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    @include('CDNs.AdminCDN')
</head>

<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">
        <div class="sidebar pe-4 pb-3">
            @include('Teacher.Include.Sidebar')
        </div>
        <div class="content">
            @include('Teacher.Include.Navbar')

            <div class="container-fluid mt-5">
                <div class="row">
                    <div class="col-12 mb-3 mb-lg-5">


                        <!-- Validation Errors -->
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form id="questionForm" action="{{ route('saveQuestion') }}" method="POST">
                            @csrf
                            <input type="hidden" name="quiz_id" value="{{ $quiz->id }}">

                            <div class="overflow-hidden card table-nowrap table-card">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <input type="text" class="form-control" name="question" id="question"
                                        placeholder="Type a question" required>
                                </div>
                                <div class="card-body text-center">
                                    <div class="row">
                                        @for ($i = 1; $i <= 4; $i++)
                                            <div class="col-3">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" name="answers[]"
                                                        placeholder="Answer {{ $i }}" required>
                                                    <div class="input-group-text">
                                                        <input type="radio" name="correct_answer"
                                                            value="{{ $i }}" required>
                                                    </div>
                                                </div>
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <input type="submit" value="Add" class="btn btn-success">
                                </div>
                            </div>
                        </form>

                        <!-- Display Questions -->
                        <div id="questionsList" class="mt-5">
                            @foreach ($questions as $question)
                                <div class="card mb-3">
                                    <div class="card-header">
                                        <strong>{{ $question->question }}</strong>
                                    </div>
                                    <div class="card-body">
                                        <ul>
                                            @foreach ($question->answers as $answer)
                                                <li>{{ $answer->answer }}
                                                    @if ($answer->is_correct)
                                                        <span class="text-success fw-bold"><i class="fa fa-check" aria-hidden="true"></i></span>
                                                    @endif
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>
    @include('CDNs.AdminJS')
</body>

</html>
