<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/18
 * Time: 14:38
 */
namespace app\index\model;

class User
{
    private $account;  //用户名
    private $password;//密码
    private $email; //邮箱
    private $birthday; //出生日期
    private $country;//感兴趣国家及其权重
    private $loginip;

    /**
     * @param array $country
     */
    public function setCountry($country)
    {
        if($country==null)
        {
            return;
        }
        $data=array();
        foreach ($country as $value) {
            $data[$value]=1.0;
        }
        $this->country = $data;
    }

    public function toArray(){
        if($this->account==null || $this->password==null){
            return null;
        }
        $data=array();
        $data["account"]=$this->account;
        $data["password"]=$this->password;
        if($this->email!=null){
            $data["email"]=$this->email;
        }
        if($this->birthday!=null) {
            $data["birthday"] = date("Y-m-d", strtotime($this->birthday));
        }
        if($this->country!=null){
            $data["country"]=$this->country;
        }
        if($this->loginip!=null){
            $data["loginip"]=$this->loginip;
        }
        return $data;
    }

    /**
     * @return mixed
     */
    public function getAccount()
    {
        return $this->account;
    }

    /**
     * @param mixed $username
     */
    public function setAccount($account)
    {
        $this->account = $account;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * @param mixed $birthday
     */
    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;
    }

    /**
     * @return array
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param mixed $loginip
     */
    public function setLoginip($loginip)
    {
        $this->loginip = $loginip;
    }
}