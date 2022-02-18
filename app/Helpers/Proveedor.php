<?php

namespace Com\Daw2\Helpers;

class Proveedor{
    private $cif;
    private $codigo;
    private $nombre;
    private $direccion;
    private $website;
    private $pais;
    private $email;
    private $telefono;
    
    public function __construct(string $cif, string $codigo, string $nombre, string $direccion, string $website, string $pais, string $email) {
        self::checkCif($cif);
        $this->cif = $cif;        
        $this->codigo = $codigo;
        $this->nombre = $nombre;
        $this->direccion = $direccion;
        self::checkWebsite($website);
        $this->website = $website;
        $this->pais = $pais;
        self::checkEmail($email);
        $this->email = $email;
    }
    
    private static function checkCif(string $cif) : void{
        if(strlen($cif) != 9){
            throw new ArgumentoNoValidoException("La longitud del CIF debe ser de 9 caracteres");
        }
        elseif(!preg_match("/[A-S][0-9]{7}[A-Z0-9]/", $cif)){
            throw new ArgumentoNoValidoException("Formato del CIF: 'OPPNNNNNC'. O: Tipo de Organización  ; P: Código provincia  ; N: Número correlativo por provincia ; C: Dígito o letra de control. Recibido: ". $cif);
        }
        elseif($cif[1] == "0" && $cif[2] == 0){
            throw new ArgumentoNoValidoException("El código de provincia 00 no es válido.");
        }
        else{
            if($cif[0] == "K" || $cif[0] == "P" || $cif[0] == "Q" || $cif[0] == "S"){
                if(!preg_match("/[A-Z]/", $cif[8])){
                    throw new ArgumentoNoValidoException("Código de control no válido. Se esperaba una letra.");
                }
                elseif($cif[0] == "K" || $cif[0] == "P" || $cif[0] == "Q" || $cif[0] == "S"){
                    if(!is_numeric($cif[8])){
                        throw new ArgumentoNoValidoException("Código de control no válido. Se esperaba un número.");
                    }
                }
            }
        }
    }

    
    private static function checkCodigo(string $codigo) : void{
        if(strlen($codigo) == 0){
            throw new ArgumentoNoValidoException("Inserte un código");
        }
    }
    
    private static function checkWebsite(string $website) : void{
        if(!filter_var($website, FILTER_VALIDATE_URL)){
            throw new ArgumentoNoValidoException("La url insertada no es válida");
        }
    }    
    
    private static function checkEmail(string $email) : void{
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            throw new ArgumentoNoValidoException("El email insertado no es válido.");
        }
    }

    private static function checkTelefono(string $telefono) : void{
        if(!preg_match("/^[0-9]{9}$/", $telefono)){
            throw new ArgumentoNoValidoException("El teléfono debe tener una longitud de 9 caracteres numéricos");
        }
    }
    
    public function __set(string $name, $value){
        if($name == "pais" && isset($value) && is_string($value)){
            $this->$name = $value;
        }
        elseif($name == "direccion" && isset($value) && is_string($value)){
            $this->$name = $value;
        }
        elseif($name == "telefono"){
            self::checkTelefono($value);
            $this->$name = $value;
        }
        elseif($name == "email"){
            self::checkEmail($value);
            $this->$name = $value;
        }
        elseif($name == "website"){
            self::checkWebsite($value);
            $this->$name = $value;
        }
        elseif($name == "codigo"){
            self::checkCodigo($value);
            $this->$name = $value;
        }
        elseif($name == "cif"){
            self::checkCif($value);
            $this->$name = $value;
        }
        elseif($name == "nombre"){            
            $this->$name = $value;
        }
        else{
            throw new Exception("No puede establecer el valor de atributo $name");
        }
    }

    public function __get($name){
        if (property_exists(get_class($this), $name)) {
            return $this->$name;
        }
        else{
            return null;
        }
    }
    
    public static function getStdClass() : \stdClass{
        $std = new \stdClass();
        $std->cif = '';        
        $std->codigo = '';
        $std->nombre = '';
        $std->direccion = '';
        $std->website = '';
        $std->pais = '';
        $std->email = '';
        $std->telefono = '';
        return $std;
    }
    
    
    /*public function setCodigo(string $codigo): void {
        self::checkCodigo($codigo);
        $this->codigo = $codigo;
    }*/
    
    /*public function setTelefono(string $telefono): void {
        self::checkTelefono($telefono);
        $this->telefono = $telefono;
    }*/
    /*public function setEmail(string $email): void {
        self::checkEmail($email);
        $this->email = $email;
    }*/
        /*public function setWebsite(string $website): void {
        self::checkWebsite($website);
        $this->website = $website;
    }*/
    
    /*
    public function getCif() : string {
        return $this->cif;
    }

    public function getCodigo() : string {
        return $this->codigo;
    }

    public function getDireccion() : string{
        return $this->direccion;
    }

    public function getWebsite() : string{
        return $this->website;
    }

    public function getPais() : string{
        return $this->pais;
    }

    public function getEmail()  :string {
        return $this->email;
    }

    public function getTelefono() : string {
        return $this->telefono;
    }

    public function setCif(string $cif): void {
        self::checkCif($cif);
        $this->cif = $cif;
    }*/
    

}