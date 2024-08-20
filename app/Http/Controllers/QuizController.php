<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Question;
use App\Models\Enrollment;
use App\Models\QuizResult;
use Illuminate\Http\Request;

use App\Mail\QuizReminderMail;
use App\Models\Message;
use App\Models\QuestionAnswer;
use App\Models\SubjectMapping;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use function PHPUnit\Framework\isNull;
use App\Models\QuestionsStudentAnswers;

class QuizController extends Controller
{
    //
    public function SubmitQuiz(Request $request)
    {
        $submit = new Quiz();
        $submit->QuizName = $request->input('name');
        $submit->deadline = $request->input('deadline');
        $submit->subject_id = $request->input('subject_id');
        $submit->save();


        return redirect()->route('add-questions', ['quizid' => $submit->id]);
    }

    public function AddQuestions($quizId)
    {
        $quiz = Quiz::where('id', $quizId)->first();

        // $subjectMappings = DB::table('subject_mappings')
        //     ->join('grades', 'subject_mappings.grade_id', '=', 'grades.id')
        //     ->join('subjects', 'subject_mappings.subject_id', '=', 'subjects.id')
        //     ->join('teachers', 'subject_mappings.teacher_id', '=', 'teachers.id')
        //     ->join('batches', 'subject_mappings.batchId', '=', 'batches.id')
        //     ->select(
        //         'subject_mappings.*',
        //         'grades.Grade as grade_name',
        //         'subjects.subject_name as subject_name',
        //         'teachers.full_name as teacher_name',
        //         'batches.Year as batch_name'
        //     )
        //     ->where('subject_mappings.id', $quiz->subject_id)
        //     ->first();

        $questions = Question::where('quiz_id', $quizId)
            ->with('answers')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('Teacher.CreateQuizView', compact('quiz', 'questions'));
    }

    public function saveQuestion(Request $request)
    {
        $request->validate([
            'quiz_id' => 'required|exists:quizzes,id',
            'question' => 'required|string',
            'answers' => 'required|array|min:4|max:4',
            'answers.*' => 'required|string',
            'correct_answer' => 'required|in:1,2,3,4'
        ]);

        $question = new Question();
        $question->quiz_id = $request->input('quiz_id');
        $question->question = $request->input('question');
        $question->save();

        $answers = [];
        foreach ($request->input('answers') as $key => $answer) {
            $questionAnswer = new QuestionAnswer();
            $questionAnswer->question_id = $question->id;
            $questionAnswer->answer = $answer;
            $questionAnswer->is_correct = ($key + 1 == $request->input('correct_answer'));
            $questionAnswer->save();
            
            $answers[] = $questionAnswer;
        }

        return redirect()->back()->with('success', 'Student registered successfully!');
    }

    public function MyQuiz()
    {
        $userId = Auth::id();
        $studentId = Student::where('user_id', $userId)->pluck('id')->first();

        $subjectIds = Enrollment::where('student_id', $studentId)
            ->pluck('subject_id');

        $quizzes = Quiz::whereIn('subject_id', $subjectIds)
            ->get();

        $quizzes = DB::table('quizzes')
            ->join('subject_mappings', 'quizzes.subject_id', '=', 'subject_mappings.id')
            ->join('subjects', 'subject_mappings.subject_id', '=', 'subjects.id')
            ->join('teachers', 'subject_mappings.teacher_id', '=', 'teachers.id')
            ->join('batches', 'subject_mappings.batchId', '=', 'batches.id')
            ->join('grades', 'subject_mappings.grade_id', '=', 'grades.id')
            ->select(
                'quizzes.*',
                'grades.Grade as grade_name',
                'subjects.subject_name as subject_name',
                'batches.Year as batch_name'
            )
            ->whereIn('quizzes.subject_id', $subjectIds)
            ->get();

        return view('Student.TakeQuiz', compact('quizzes'));
    }

    public function ViewQuizQuestions($quizId)
    {
        $userId = Auth::id();
        $studentId = Student::where('user_id', $userId)->pluck('id')->first();

        $quizStAnswers = QuestionsStudentAnswers::where([
            ['quiz_id', $quizId],
            ['student_id', $studentId]
        ])->first();

        if ($quizStAnswers == null) {
            $questions = Question::where('quiz_id', $quizId)
                ->with('answers')
                ->orderBy('created_at', 'desc')
                ->get();

            $quiz = Quiz::where('id', $quizId)
                ->first();

            return view('Student.TakeQuestions', compact('questions', 'quiz'));
        }

        $CorrectAnswers = DB::table('questions_student_answers')
            ->join('question_answers', 'questions_student_answers.answer_id', '=', 'question_answers.id')
            ->select(
                'questions_student_answers.*'
            )
            ->where('question_answers.is_correct', true)
            ->where('questions_student_answers.student_id', $studentId)
            ->where('questions_student_answers.quiz_id', $quizId)
            ->count();

        $answersCount = DB::table('questions_student_answers')
            ->join('question_answers', 'questions_student_answers.answer_id', '=', 'question_answers.id')
            ->select(
                'questions_student_answers.*'
            )
            ->where('questions_student_answers.student_id', $studentId)
            ->where('questions_student_answers.quiz_id', $quizId)
            ->count();

        $quiz = Quiz::with(['questions.answers'])->findOrFail($quizId);

        $studentAnswers = QuestionsStudentAnswers::where('quiz_id', $quizId)
            ->where('student_id', $studentId)
            ->get()
            ->keyBy('question_id');

        if ($answersCount > 0) {
            $correctAnswerPercentage = ($CorrectAnswers / $answersCount) * 100;
        }

        return view('Student.QuizResultView', compact('quiz', 'studentAnswers', 'CorrectAnswers', 'answersCount', 'correctAnswerPercentage'));
    }

    public function SubmitQuizAnswers(Request $request)
    {
        $userId = Auth::id();
        $studentId = Student::where('user_id', $userId)->pluck('id')->first();

        $request->validate([
            'quiz_id' => 'required|exists:quizzes,id',
            'answers' => 'required|array',
        ]);

        foreach ($request->input('answers') as $questionId => $answerId) {
            QuestionsStudentAnswers::create([
                'student_id' => $studentId,
                'quiz_id' => $request->input('quiz_id'),
                'question_id' => $questionId,
                'answer_id' => $answerId,
            ]);
        }

        $CorrectAnswers = DB::table('questions_student_answers')
            ->join('question_answers', 'questions_student_answers.answer_id', '=', 'question_answers.id')
            ->select(
                'questions_student_answers.*'
            )
            ->where('question_answers.is_correct', true)
            ->where('questions_student_answers.student_id', $studentId)
            ->where('questions_student_answers.quiz_id', $request->input('quiz_id'))
            ->count();

        $answersCount = DB::table('questions_student_answers')
            ->join('question_answers', 'questions_student_answers.answer_id', '=', 'question_answers.id')
            ->select(
                'questions_student_answers.*'
            )
            ->where('questions_student_answers.student_id', $studentId)
            ->where('questions_student_answers.quiz_id', $request->input('quiz_id'))
            ->count();

        $quizResult = new QuizResult();
        $quizResult->student_id = $studentId;
        $quizResult->quiz_id = $request->input('quiz_id');
        $quizResult->total_answers = $answersCount;
        $quizResult->total_Correct_answers = $CorrectAnswers;
        $quizResult->save();

        return redirect()->route('view-questions', $request->input('quiz_id'))->with('success', 'Quiz submitted successfully!');
    }

    public function viewQuizes()
    {
        $userId = Auth::id();
        $teacherId = Teacher::where('user_id', $userId)->pluck('id')->first();
        $subjects = SubjectMapping::where('teacher_id', $teacherId)->pluck('id');

        $quizes = Quiz::whereIn('subject_id', $subjects)->get();

        $quizesWithCounts = $quizes->map(function ($quiz) {
            $quizResultsCount = QuizResult::where('quiz_id', $quiz->id)->count();
            $quiz->results_count = $quizResultsCount;
            return $quiz;
        });

        //dd(['quizes' => $quizesWithCounts]);
        return view('Teacher.Quizes', ['quizes' => $quizesWithCounts]);
    }

    public function StudentQuizResults($id)
    {
        $results = QuizResult::where('quiz_id', $id)
            ->Join('students', 'quiz_results.student_id', '=', 'students.id')
            ->select('quiz_results.*', 'students.FullName')
            ->get();

        $subjectId = Quiz::where('id', $id)->pluck('subject_id')->first();

        $AllStudents = Enrollment::where('subject_id', $subjectId)->pluck('student_id');

        $SubmittedStudents = QuizResult::where('quiz_id', $id)->pluck('student_id');

        $NotSubmittedStudents = Enrollment::where('subject_id', $subjectId)
            ->whereNotIn('student_id', $SubmittedStudents)
            ->Join('students', 'enrollments.student_id', '=', 'students.id')
            ->select('students.FullName', 'students.email', 'students.PerentEmail', 'students.id')
            ->get();

        return view('Teacher.MCQResults', compact('results', 'NotSubmittedStudents', 'id'));
    }

    public function SendNotifyEmail($id, $stId)
    {
        // Fetch student and parent email addresses
        $student = Student::find($stId);
        $parentEmail = $student->PerentEmail;
        $studentEmail = $student->email;
        $studentUserId = $student->user_id;

        $quiz = Quiz::find($id);
        $quizName = $quiz->QuizName;
        $deadline = $quiz->deadline;

        // Single quiz data
        $quizName = $quizName;
        $dueDate = $deadline;

        $message = new Message();
        $message->to_user = $studentUserId;
        $message->message = "Hi $student->FullName, Please complete your quiz ($quizName) as soon as possible. Contact us if you need assistance.";
        $message->header = "Quiz Reminder!!!";
        $message->save();

        Mail::to($studentEmail)
            ->cc($parentEmail)
            ->send(new QuizReminderMail($student->FullName, $quizName, $dueDate));

        return redirect()->back()->with('success', 'Notified successfully!');
    }
}
