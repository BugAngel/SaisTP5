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
    private $username;  //用户名
    private $password;//密码
    private $id; //身份证号
    private $email; //邮箱
    private $birthday; //出生日期
    private $country;//感兴趣国家及其权重
    private $loginip;

    /**
     * @param array $country
     */
    public function setCountry($country)
    {
        $data=array();
        if($country[0]){
            $data["美国"]=1.0;
        }
        if($country[1]){
            $data["加拿大"]=1.0;
        }
        if($country[2]){
            $data["澳大利亚"]=1.0;
        }
        if($country[3]){
            $data["英国"]=1.0;
        }
        if($country[4]){
            $data["法国"]=1.0;
        }
        if($country[5]){
            $data["德国"]=1.0;
        }
        $this->country = $data;
    }

    public function toArray(){
        if($this->username==null || $this->password==null){
            return null;
        }
        $data=array();
        $data["username"]=$this->username;
        $data["password"]=$this->password;
        if($this->id!=null){
            $data["id"]=$this->id;
        }
        if($this->email!=null){
            $data["email"]=$this->email;
        }
        if($this->birthday!=null) {
            $data["birthday"] = date("Y-m-d", strtotime($this->birthday));
        }
        if($this->country!=null){
            $data["country"]=$this->country;
        }
        return $data;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
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
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
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