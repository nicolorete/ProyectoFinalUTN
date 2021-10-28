<?php

namespace DAO;

use Models\Student as Student;

interface IStudentDAO
{

    function add(Student $newStudent);
    function getAll();
    function deleteById($id);
    function deleteByEmail($email);
    
}
