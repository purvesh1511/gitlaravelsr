<?php

namespace App\Services;

use App\Repositories\StudentRepository;
use App\Services\BaseService;

class StudentService extends BaseService {

    protected $student;

    public function __construct(StudentRepository $studentrepository)
    {
      $this->student = $studentrepository;
    }

}
