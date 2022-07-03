<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Question extends Model{
    protected $table = 'questions';

    public function getAnswers(){
        return Answer::where('question_id', '=', $this->id)->get();
    }
}
?>