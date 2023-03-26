<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Models\Student;

class StudentRepository extends BaseRepository {

    protected $student;

    public function __construct(Student $student)
    {
        parent::__construct($student);
    }

}
