<?php

namespace Repse\Sa\databese\user;

use Repse\Sa\databese\DB;
use Repse\Sa\tool\Selector;

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
    public ?int $age = null;
    public ?string $location = null;
    public $resetToken;
    public $resetComplete;
    public int $bookmarkCount = 0;
    public ?array $bookmark = null;

    public function __construct(protected DB $db)
    {
        $this->memberID = isset($_SESSION['memberID']) ? $_SESSION['memberID'] : $this->memberID;
        $this->logged = isset($_SESSION['memberID']) ? true : $this->logged;
        $this->remember = isset($_SESSION['remeber']) ? $_SESSION['remeber'] : $this->remember;
        $this->visible = isset($_SESSION['visible']) ? $_SESSION['visible'] : $this->visible;
        $this->username = isset($_SESSION['username']) ? $_SESSION['username'] : $this->username;
        $this->permission = isset($_SESSION['permission']) ? $_SESSION['permission'] : $this->permission;
        $this->activeMember = isset($_SESSION['active']) ? $_SESSION['active'] : $this->activeMember;   
        // Personal changeble inside updateMember.blade.php
        $this->age = isset($_SESSION['age']) ? $_SESSION['age'] : $this->age;
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

    public function getUserData($username) 
    {
        if ($this->exists($username)) {
            $memberdata =  $this->db->getMemeberData($username);
            $this->avatar = $memberdata['avatar'];
            $this->memberName = $memberdata['name'];
            $this->memberSurname = $memberdata['surname'];
            $this->visible = $memberdata['visible'];
            $this->logged = false;
            $this->age = $memberdata['age'];
            $this->location = $memberdata['location']; 
        } 
            //$this->message->add(md5('usrnnotexist'),'Uživatel neexistuje')->style('danger');
            return null;
    }

    public function checkRemember()
    { 
        if (isset($_COOKIE['remember']) && $this->remember) {
            $memberdata = $this->db->getMemeberData($_COOKIE['remember']);
            self::setSession($memberdata);
            header('Location: /member/'.$this->username.'?action=logged'); 
        }
            return null;
    }

    protected function checkActivation()
    {
        // If user is active this do nothing 
        // frist step get all members from db
        // Display message if active is not YES
        if($this->logged && $this->activeMember != 'YES'){
            @$_SESSION = ['message'=> 'Active.<a href="reactivate?x='.$this->memberID.'&y=ActivasionHash">Poslat email znovu</a>'];
        }
    }

    public function activateMember(Selector $selector)
    {
        // Check hash in db table and given hash
        // URL/activate?x=MemberID&y=ActivasionHash
        $backup  = base64_encode('FailedActivation');
        $id = $selector->fristQueryValue;
        if('FailedActivation' != base64_decode($id)){
            $hash = $selector->secondQueryValue;
            $stmt = $this->db->con->from('members')->select('active')->where('memberID',$id)->execute();
            $data = $stmt->fetch();
            if($data == $hash){
                $set = ['active'=>'yes'];
                $query = $this->db->con->update('members', $set, $id)->execute();
                if($query){
                    header('Location: /activate?action='.$backup.'&x='.$id);
                }
            }
            header('Location: /activate?action='.$backup.'&x='.$id);
        }else{
            $failID = $selector->secondQueryValue;
            $set = ['active'=>'yes']; 
            $query = $this->db->con->update('members', $set, $failID)->execute();
            header('Location: /login?action=active');
        }
    }
 
    public function isUnique($username,$email)
    {
        $stmt = $this->db->con->from('members')->select(['username','email']);
        foreach($stmt as $row){
            $usernameSearch = in_array($username,$row); // now true
            $emailSearch = in_array($email,$row); // now false
            if ($usernameSearch || $emailSearch) {
                return 'false';
            }
                return null;
        }
    }

    public function exists($username)
    {
        $stmt = $this->db->con->from('members')->select('username')->where('username',$username)->execute();
        $result =  $stmt->fetchAll();
        if(empty($result))
        {
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
