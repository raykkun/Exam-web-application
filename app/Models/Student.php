<?php

namespace App\Models;

class Student {
    public $name;
    public function __construct($name) {
        $this->name = $name;
    }

    public static function all(){
        return (
         [   
        
        'grades' => [
            ['subject_code' => 'IPA501', 'subject_name' => 'IPA', 'credits' => 4, 'score' => 92, 'grade_letter' => 'A-', 'grade_point' => 3.7],
            ['subject_code' => 'MTK502', 'subject_name' => 'Matematika', 'credits' => 3, 'score' => 88, 'grade_letter' => 'B+', 'grade_point' => 3.3],
            ['subject_code' => 'IND503', 'subject_name' => 'Bahasa Indonesia', 'credits' => 2, 'score' => 95, 'grade_letter' => 'A', 'grade_point' => 4.0],
            ['subject_code' => 'ENG504', 'subject_name' => 'Bahasa Inggris', 'credits' => 2, 'score' => 90, 'grade_letter' => 'A-', 'grade_point' => 3.7],
            ]
    
        ]
        );
    }
}

