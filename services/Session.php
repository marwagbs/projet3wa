<?php

class Session {
    
    
    public static function start(): void {
        if (session_status() === PHP_SESSION_NONE)
        {
            session_start();
        }
    }
    
    public static function destroy(): void {
        $_SESSION['login']=[];
        unset($_SESSION['login']);
        //session_destroy();
        
    }
    
    public static function init(int $id, string $firstname, string $lastname , string $email , int $is_admin){
        $_SESSION['login']=[
            'id' =>  intval($id),
            'firstname' => $firstname,
            'lastname' => $lastname,
            'mail' => $email,
            'role' => $is_admin];
    }
    
    
    public static function setError(string $error = null): void{
        $_SESSION['error']=$error;
    }
    
    public static function getError(): ?string{
        return isset($_SESSION['error']) ? $_SESSION['error'] :null;
    }
    
    public static function isConnected(): bool{
        return isset($_SESSION['login']) ?? false;
    }
    
}