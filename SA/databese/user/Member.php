<?php

namespace Repse\Sa\databese\user;

class Member{

    public bool $logged = false;
    public bool $remember = false;
    public bool $visible = false;
    public string $username = 'visitor';
    protected string $password;
    public ?int $memberID = null;
    public ?string $memberEmail = null;
    public ?string $activeMember = null;
    public string $permission = 'visit';
    public ?string $memberName = null;
    public ?string $memberSurname = null;
    public string $avatar = 'empty_profile.png';
    public $age;
    public ?string $location = null;
    public $resetToken;
    public $resetComplete;
    public int $bookmarkCount = 0;
    public ?array $bookmark = null;

    public function __construct(protected $db)
    {
        $this->memberID = isset($_SESSION['memberID']) ? $_SESSION['memberID'] : $this->memberID;
        $this->logged = isset($_SESSION['memberID']) ? true : $this->logged;
        $this->remember = isset($_SESSION['remeber']) ? $_SESSION['remeber'] : $this->remember;
        $this->visible = isset($_SESSION['visible']) ? $_SESSION['visible'] : $this->visible;
        $this->username = isset($_SESSION['username']) ? $_SESSION['username'] : $this->username;
        $this->permission = isset($_SESSION['permission']) ? $_SESSION['permission'] : $this->permission;
        $this->activeMember = isset($_SESSION['active']) ? $_SESSION['active'] : $this->activeMember;   
        // Personal changeble inside updateMember.blade.php
        $this->memberName = isset($_SESSION['name']) ? $_SESSION['name'] : $this->memberName;
        $this->memberSurname = isset($_SESSION['surname']) ? $_SESSION['surname'] : $this->memberSurname;
        $this->avatar = isset($_SESSION['avatar']) ? $_SESSION['avatar'] : $this->avatar;
        $this->memberEmail = isset($_SESSION['email']) ? $_SESSION['email'] : $this->memberEmail;
        $this->location = isset($_SESSION['location']) ? $_SESSION['location'] : $this->location;
        $this->bookmarkCount = isset($_SESSION['bookmark']) ? $_SESSION['bookmark'] : $this->bookmarkCount;
        $this->bookmark = isset($_SESSION['contentBook']) ? json_decode($_SESSION['contentBook'],true) : $this->bookmark;
    }

    public static function setSession(array $result) : void
    {
        foreach ($result as $key => $value) {
            $_SESSION[$key] = $value;
        }
    }

    public function checkRemember()
    { 
        if (isset($_COOKIE['remember']) && $this->remember) {
            $memberdata = $this->db->getMemeberData($_COOKIE['remember']);
            self::setSession($memberdata);
            header('Location: /member/'.$this->username.'?action=logged'); 
        }else {
            return null;
        }
    }

    protected function checkActivation()
    {
        // If user is active this do nothing 
        // frist step get all members from db
        // Display message if active is not YES
        if($this->logged && $this->activeMember != 'YES'){
            @$_SESSION = ['message'=> $this->message->add(md5('Active'),' <a href="reactivate?x='.$this->memberID.'&y=ActivasionHash">Poslat email znovu<')];
        }
    }

    public function isUnique($username,$email)
    {
        $stmt = $this->db->from('members')->select(['username','email']);
        // structure of result is ['$key' => ['username' => $username , 'email' => $email] , ... (etc)] 
        $result = $stmt->fetchAll('username', 'email');
        $emailSearch = array_search($email,array_column($result,'email'));
        $usernameSearch = array_search($username,array_column($result,'username'));
        
        if($emailSearch || $usernameSearch){
            return false;
        }
        //if username and email doenst exist in databese 
        return true;
    }

    public function exists($username)
    {
        $stmt = $this->db->from('members')->select('username')->where('username',$username)->execute();
        if(!$stmt){
            return false;
        }
        return true;
    }

    public function logout()
    {
        session_destroy();
        header('Location: /index');
    }
}
