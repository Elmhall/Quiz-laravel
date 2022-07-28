<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\Result;
use Illuminate\Http\Request;
use Illuminate\View\View;
use phpDocumentor\Reflection\Types\Collection;

class QuizController extends Controller
{

    public function index()
    {
        return view('quiz.index', [
            'quizzes' => Quiz::get()
        ]);
    }

    public function show(Request $request, $quiz_id){
        $page = $request->input('page');
        if (!$page) $page = 1;
        $questions_per_page = 3;

        $questions = Question::where('quiz_id', $quiz_id)->with('answers')->get()
            ->skip($questions_per_page * ($page - 1))
            ->take($questions_per_page);

        $previousAnswers = session('answers.'.$quiz_id);

        return view('quiz.show', [
            'quiz' => Quiz::find($quiz_id),
            'page' => $page,
            'questions' => $questions,
            'previousAnswers' => $previousAnswers,
        ]);
    }

    public function store(Request $request, $quiz_id)
    {
        // Validate and store the answers posted.
        if ($request->session()->get('answers.'.$quiz_id)) $answers = $request->session()->get('answers.'.$quiz_id);
        else $answers = [];
        foreach ($request->request as $key => $value){
            if ($key != "page" && $key != "_token" && $key != "action"){
                //Get the answers to the question and check if it is a valid answer.
                $answersToQuestion = Answer::where('question_id', $key)->get('id');
                if ($answersToQuestion->contains($value)){
                    $answers[$key] = $value;
                }elseif(is_array($value)){
                    $allIsValid = true;
                    foreach ($value as $item) {
                        if (!$answersToQuestion->contains($item)) $allIsValid = false;
                    }
                    if ($allIsValid)$answers[$key] = $value;
                }
            }
        }
        // Store the answers in the session_storage.
        $request->session()->put('answers.'.$quiz_id, $answers);

        $action = $request->request->get('action');
        $page = $request->request->get('page');
        $totalNumOfQuestions = Question::where('quiz_id', $quiz_id)->count();
        $totalNumOfPages = ceil($totalNumOfQuestions / 3);

        if ($action == "Next"){

            if ($page == $totalNumOfPages && count($answers) == $totalNumOfQuestions){
                return redirect()->route('quiz.submit', ['name' => $quiz_id]);
                }
            if ($page < $totalNumOfPages && (count($answers) / 3) >= $page){
                $page++;
            }
        }else if ($page != 1) {
            $page--;
        }

        return redirect()->route('quiz.show', ['name' => $quiz_id, 'page' => $page]);

    }

    public function submit(Request $request, $quiz_id){

        return view('quiz.submit', [
            'quiz' => Quiz::find($quiz_id),
        ]);
    }

    public function create(Request $request, $quiz_id){

        $request->validate([
            'email' => 'required|email',
            'name' => 'required|regex:/^[\pL\s]+$/u',
        ]);

        $quiz = Quiz::find($quiz_id);
        $answers = $request->session()->get('answers.'.$quiz_id);

        $scoreSum = 0;
        $correctQuestionsArray = array();
        foreach ($quiz->questions as $question){
            $correctAnswers = $question->answers->where('isCorrect', 1)->pluck('id')->toArray();

            if ($question->isMultipleChoice){
                if (count(array_diff($correctAnswers, $answers[$question->id])) == 0) {
                    array_push($correctQuestionsArray, $question->id);
                    $scoreSum++;
                }

            }else {
                $correctAnswers = $question->answers->where('isCorrect', 1)->pluck('id', 'question_id');
                if ($correctAnswers[$question->id] == $answers[$question->id]) {
                    array_push($correctQuestionsArray, $question->id);
                    $scoreSum++;
                }
            }
        }
        // Create the model
        Result::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'score' => $scoreSum
        ]);
        //Remove from session
        $request->session()->forget('answers.'.$quiz_id);

        return view('quiz.result', [
            'previousAnswers' => $answers,
            'quiz' => $quiz,
            'score' => $scoreSum,
            'correctQuestionsArray' => $correctQuestionsArray
        ]);

    }
}
