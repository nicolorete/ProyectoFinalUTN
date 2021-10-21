<?php

namespace DAO;

use Models\User as User;

interface IUserDAO
{

    function add(User $newUser);
    function getAll();
    function delete($value);
}
