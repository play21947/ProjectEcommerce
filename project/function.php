<?php

    class DB_con{
        public function __construct(){
            $conn = mysqli_connect("localhost", 'root', '', 'database');
            $this->dbcon = $conn;

            if(mysqli_connect_errno()){
                echo "Connect with database is falied". mysqli_connect_error();
            }
        }

        public function Register($username, $password, $email){
            $fname = "";
            $age = "";
            $result = mysqli_query($this->dbcon, "INSERT INTO accounts (username, password, email, fname, age) VALUES ('$username','$password','$email', '$fname','$age')");
            return $result;
        }

        public function Check_Register($username){
            $result = mysqli_query($this->dbcon, "SELECT username FROM accounts WHERE username = ('$username')");
            return $result;
        }

        public function Check_role($ses){
            $result = mysqli_query($this->dbcon, "SELECT role FROM accounts WHERE username = ('$ses')");
            return $result;
        }

        // LOGIN
        public function Login($username){
            $result = mysqli_query($this->dbcon, "SELECT * FROM accounts WHERE username = ('$username')");
            return $result;
        }





        //shop
        public function Get_Product(){
            $result = mysqli_query($this->dbcon, "SELECT * FROM tblproduct");
            return $result;
        }
        
        public function Get_Product_ID($id){
            $result = mysqli_query($this->dbcon, "SELECT * FROM tblproduct WHERE id = ('$id')");
            return $result;
        }

        public function Add_product($name, $price, $url){
            $result = mysqli_query($this->dbcon, "INSERT INTO tblproduct (name, price, img) VALUES ('$name','$price','$url')");
            return $result;
        }




        //order

        public function Insert_Order($name_user, $name_product, $qty_product){
            $result = mysqli_query($this->dbcon, "INSERT INTO order_users (name_user, name_product, quantity) VALUES ('$name_user','$name_product','$qty_product')");
            return $result;
        }

        public function Get_Order(){
            $result = mysqli_query($this->dbcon, "SELECT * FROM order_users");
            return $result;
        }
        // delete Order

        public function Done_Order($id){
            $result = mysqli_query($this->dbcon, "DELETE FROM order_users WHERE id = ('$id')");
            return $result;
        }


 


        //tblbtn

        public function Get_btn(){
            $result = mysqli_query($this->dbcon, "SELECT * FROM tblbtn");
            return $result;
        }

        public function Update_btn($id){
            $result = mysqli_query($this->dbcon, "UPDATE tblbtn SET status = 0 WHERE id = ('$id')");
            return $result;
        }

        //custom 
        public function Get_Information($name){
            $result = mysqli_query($this->dbcon, "SELECT * FROM accounts WHERE username = ('$name')");
            return $result;
        }

        public function Update_Accounts($fname, $age, $email, $name, $phone){
            $result = mysqli_query($this->dbcon, "UPDATE accounts SET fname = ('$fname'), age = ('$age'), email = ('$email'), phone = ('$phone') WHERE username = ('$name')");
            return $result;
        }

        //account

        public function switch_name($ses){
            $result = mysqli_query($this->dbcon, "SELECT * FROM accounts WHERE username = ('$ses')");
            return $result;
        }

        public function Get_Account(){
            $result = mysqli_query($this->dbcon, "SELECT * FROM accounts");
            return $result;
        }
    }

?>