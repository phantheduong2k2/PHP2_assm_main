<?php
namespace App\Controllers;

use App\Models\Question;
use App\Models\Quiz;
use App\Models\Subject;

class QuizController{
    public function index($subjectId = 0){
        if($subjectId > 0){
            $quizs = Quiz::where('subject_id', $subjectId)->get();
        }else{
            $quizs = Quiz::all();
        }

        return view('quiz.index', [
            'quizs' => $quizs,
            'subject' => $subjectId > 0 ? Subject::find($subjectId) : null
        ]);
    }

    public function addForm($subjectId = 0){
        $subjects = Subject::all();

        return view('quiz.add-form', [
            'subjects' => $subjects,
            'selectedSubjectId' => $subjectId
        ]);
    }

    public function saveAdd()
    {
        $subjectId = $_GET['subjectId'];
        $data = [
            'name' => $_POST['name'],
            'start_time' => $_POST['start_time'],
            'end_time' => $_POST['end_time'],
            'duration_minutes' => $_POST['duration_minutes'],
            'status' => isset($_POST['status']) ? 1 : 0,
            'is_shuffle' => isset($_POST['is_shuffle']) ? 1 : 0,
            'subject_id' => $subjectId
        ];
        $model = new Quiz();
        $quiz = $model->insert($data);
        header('location: ' . BASE_URL . 'quiz/cap-nhat?id=' . $quiz->id);
        die;
    }

    public function editForm(){
        $quizId = $_GET['id'];
        $quiz = Quiz::where(['id', '=', $quizId])->first();

        $questions = Question::where(['quiz_id', '=', $quiz->id])->get();
        include_once './app/views/quiz/edit-form.php';

    }
}
?>