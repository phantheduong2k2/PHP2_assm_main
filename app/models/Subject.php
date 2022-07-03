<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Subject extends Model{
    protected $table = 'subjects';
    public function quizs(){
        return $this->hasMany(Quiz::class, 'subject_id', 'id');
    }
}
?>