<?php
const users_file = "/data/users.txt";
const schools_file = "/data/schools.txt";

class UserIndexes
{
    public const ID = 0;
    public const SCHOOL = 1;
    public const NICK = 2;
    public const FIRST_NAME = 3;
    public const LAST_NAME = 4;
    public const MAIL = 5;
    public const PASS = 6;
    public const AVATAR = 7;
    public const PERMISSION = 8;
}

class SchoolIndexes
{
    public const ID = 0;
    public const SHORT_NAME = 1;
    public const FULL_NAME = 2;
    public const LOCATION = 3;
    public const ICON = 4;
}


class File
{
    public $path;
    public $data;

    public function __construct($path)
    {
        $this->path = $path;
        $this->data = $this->getData();
    }

    private function getData()
    {
        $_data = explode(PHP_EOL, file_get_contents($this->path));
        foreach ($_data as $row) {
            if (!(trim($row) == "")) {
                $_temp = explode(";", $row);
                foreach ($_temp as $item) {
                    $temp[] = htmlspecialchars($item, ENT_QUOTES, 'UTF-8');
                }
                $data[] = $temp;
            }
        }
        return $data;
    }
}

class UsersHandler extends File
{
    public $users;

    public function __construct($path)
    {
        parent::__construct($path);
        $this->users = $this->getAllUsers();
    }

    private function getAllUsers()
    {
        foreach ($this->data as $row) {
            $users[] = new User(
                $row[UserIndexes::ID],
                $row[UserIndexes::NICK],
                $row[UserIndexes::MAIL],
                $row[UserIndexes::AVATAR],
                $row[UserIndexes::SCHOOL],
                $row[UserIndexes::PASS],
                $row[UserIndexes::PERMISSION],
            );
        }

        return $users;
    }
}

class User
{
    public $id;
    public $nickname;
    public $mail;
    public $avatar;
    public $school;
    public $password;
    public $permission;

    public function __construct($id, $nickname, $mail, $avatar, $school, $password, $permission)
    {
        $this->id = $id;
        $this->nickname = $nickname;
        $this->mail = $mail;
        $this->avatar = $avatar;
        $this->school = $school;
        $this->password = $password;
        $this->permission = $permission;
    }
}

class SchoolHandler extends File
{
    public $schools;

    public function __construct($path)
    {
        parent::__construct($path);
        $this->schools = $this->getAllSchools();
    }

    private function getAllSchools()
    {
        foreach ($this->data as $row) {
            $schools[] = new School(
                $row[SchoolIndexes::ID],
                $row[SchoolIndexes::SHORT_NAME],
                $row[SchoolIndexes::FULL_NAME],
                $row[SchoolIndexes::LOCATION],
                $row[SchoolIndexes::ICON],
            );
        }

        return $schools;
    }
}

class School
{
    public $id;
    public $short_name;
    public $full_name;
    public $location;
    public $icon;

    public function __construct($id, $short_name, $full_name, $location, $icon)
    {
        $this->id = $id;
        $this->short_name = $short_name;
        $this->full_name = $full_name;
        $this->location = $location;
        $this->icon = $icon;
    }
}
