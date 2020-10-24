<?php
const users_file = "/data/users.txt";
const schools_file = "/data/schools.txt";
const votes_file = "/data/votes.txt";

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
                unset($temp);
                $_temp = explode(";", $row);
                foreach ($_temp as $item) {
                    $temp[] = htmlspecialchars($item, ENT_QUOTES, 'UTF-8');
                }
                $data[] = $temp;
            }
        }

        if (!isset($data)) $data = array();

        return $data;
    }

    public function addLine($data)
    {
        $content = file_get_contents($this->path);
        file_put_contents($this->path, $content . implode(";", $data) . PHP_EOL);
    }

    public function removeLine($data) 
    {
        $fileContent = file_get_contents($this->path);
        $dataFormatted = implode(";", $data);
        foreach (explode(PHP_EOL, $fileContent) as $row) 
        {
            if ($row != $dataFormatted) $content[] = $row;
        }

        if (!isset($content)) $content = array();
        file_put_contents($this->path, implode(PHP_EOL, $content));
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

    public function getSchool($id)
    {
        foreach ($this->schools as $school) {
            if ($school->id == $id) return $school;
        }
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


class VoteIndexes
{
    public const ID = 0;
    public const POST = 1;
    public const OWNER = 2;
}

class VoteHandler extends File
{
    public $votes;

    public function __construct($path)
    {
        parent::__construct($path);
        $this->votes = $this->getAllVotes();
    }

    private function getAllVotes()
    {
        foreach ($this->data as $row) {
            $votes[] = new Vote(
                $row[VoteIndexes::ID],
                $row[VoteIndexes::POST],
                $row[VoteIndexes::OWNER]
            );
        }

        if (!isset($votes)) $votes = array();

        return $votes;
    }

    public function getPostVotes($postId)
    {
        foreach ($this->votes as $vote) {
            if ($vote->post == $postId) $votes[] = $vote;
        }
        return isset($votes) ? $votes : array();
    }

    public function userHasVoted($userId, $postId)
    {
        return in_array($userId, array_column($this->getPostVotes($postId), 'owner'));
    }

    public function addVote($userId, $postId)
    {
        if (!$this->userHasVoted($userId, $postId)) {
            $this->addLine(array(generateToken(), $postId, $userId));
            return true;
        }
        return false;
    }

    public function removeVote($userId, $postId)
    {
        foreach ($this->votes as $vote) {
            if ($vote->post == $postId && $vote->owner == $userId) {
                $this->removeLine(array($vote->id, $vote->post, $vote->owner));
                return true;
            }
        }
        return false;
    }
}

class Vote
{
    public $id;
    public $post;
    public $owner;

    public function __construct($id, $post, $owner)
    {
        $this->id = $id;
        $this->post = $post;
        $this->owner = $owner;
    }
}
