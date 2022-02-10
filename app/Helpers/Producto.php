<?php

namespace Com\Daw2\Helpers;


/*
 * IES Pazo da Mercé
 * Desenvolvemento Web Contorno Servidor
 */

/**
 * Description of Producto
 *
 * @author profesor
 */

class Producto {
    private $codigo;
    private $nombre;
    private $descripcion;
    private $proveedor;
    private $categoria;
    private $coste;
    private $margen;
    private $stock;
    private $iva;
    private $_productosRelacionados;
    
    public function __construct(string $codigo, string $nombre, string $descripcion, Proveedor $p, Categoria $cat, int $stock, float $coste, float $margen, float $iva) {
        self::checkStock($stock);
        $this->_productosRelacionados = array();
        $this->codigo = $codigo;
        $this->nombre = $nombre;
        $this->proveedor = $p;
        $this->stock = $stock;
        self::checkCoste($coste);
        $this->coste = $coste;
        self::checkMargen($margen);
        $this->margen = $margen;
        self::checkIva($iva);
        $this->iva = $iva;
        $this->descripcion = $descripcion;
        $this->categoria = $cat;
    }
    
    public static function checkStock(int $stock) : void{
        if($stock < 0){
            throw new ArgumentoNoValidoException("El stock no puede ser menor que cero");
        }
    }
        
    private static function checkCodigo(string $codigo) : void {
        if(!preg_match("/[a-zA-z0-9]{1,10}/", $codigo)){
            throw new ArgumentoNoValidoException("Código debe contener números y letras y tener una longitud entre 1 y 10 caracteres");
        }
    }
    
    private static function checkNombre(string $nombre) : void{
        if(strlen($nombre) === 0){
            throw new ArgumentoNoValidoException("Nombre debe tener un tamaño mayor que cero");
        }
    }
    
    private static function checkCoste(float $coste) : void {
        if($coste < 0){
            throw new ArgumentoNoValidoException("El coste debe ser un valor mayor o igual que cero");
        }
    }
    
    private static function checkMargen(float $margen) : void {
        if($margen < 0){
            throw new ArgumentoNoValidoException("El margen debe ser un valor mayor o igual que uno");
        }
    }        
    
    private static function checkIva(int $iva) : void{
        if($iva != 0 && $iva != 4 && $iva != 10 && $iva != 21){
            throw new ArgumentoNoValidoException("Sólo se permite un IVA del 0, 4, 10 o 21");
        }
    }
    
    public function agregarProductoRelacionado(Producto $p) : void{
        $this->_productosRelacionados[] = $p;
    }
    
    public function getPrecioVenta(bool $conIva) : float{
        $ivaAplicar = ($conIva) ? (1 + $this->iva/100) : 1;
        return $this->coste * $this->margen * $ivaAplicar;
    }
    
    public function descontarStock(int $unidades) : void{
        self::checkDescontarStock($unidades);        
        $this->stock -= $unidades;        
    }
    
    private static function checkDescontarStock(int $unidades) : void{
        if($unidades < 0){
            throw new ArgumentoNoValidoException("Debe descontar una cantidad positiva de artículos. Use agregar stock si quiere añadir stock.");
        }
        elseif($unidades > $this->stock){
            throw new SinStockException("Intentamos descontar $unidades unidades de producto. El stock es $this->stock");
        }
    }
    
    public function agregarStock(int $unidades) : void{                
        self::checkAgregarStock($unidades);
        $this->stock += $unidades;        
    }
    
    private static function checkAgregarStock(int $unidades) : void{
        if($unidades < 0){
            throw new ArgumentoNoValidoException("Debe agregar una cantidad positiva de artículos. Use descontar stock si quiere eliminar stock.");
        }       
    }
       
    public function __set($name, $value){
        if($name == "codigo"){
            self::checkCodigo($value);
            $this->$name = $value;  
        }
        elseif($name == "nombre"){
            self::checkNombre($value);
            $this->$name = $value;
        }
        elseif($name == "descripcion"){
            if(!is_string($value)){
                throw new ArgumentoNoValidoException("La descripción debe ser del tipo string");
            }
            $this->$name = $value;
        }
        elseif($name == "proveedor"){
            if(!is_a($value, "Proveedor")){
                throw new ArgumentoNoValidoException("El campo proveedor debe recibir un objeto de la clase Proveedor");
            }
            $this->$name = $value;
        }
        elseif($name == "categoria"){
            if(!is_a($value, "Categoria")){
                throw new ArgumentoNoValidoException("El campo cateogira debe recibir un objeto de la clase Categoria");
            }
            $this->$name = $value;
        }
        elseif($name == "coste"){
            self::checkCoste($value);
            $this->$name = $value;
        }
        elseif($name == "margen"){
            self::checkMargen($value);
            $this->$name = $value;
        }
        elseif($name == "iva"){
            self::checkIva($value);
            $this->$name = $value;
        }
        else{
            throw new Exception("No puede establecer el valor del parámetro $name");
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
    
    /*public function getCodigo() : string {        
        return $this->codigo;
    }

    public function getNombre() : string {
        return $this->nombre;
    }

    public function getDescripcion() : string {
        return $this->descripcion;
    }

    public function getProveedor() : Proveedor {
        return $this->proveedor;
    }

    public function getCategoria() : Categoria {
        return $this->categoria;
    }

    public function getCoste() : float{
        return $this->coste;
    }

    public function getMargen() : float {
        return $this->margen;
    }

    public function getStock() : int {
        return $this->stock;
    }

    public function getIva() : int {
        return $this->iva;
    }*/
    
    /*public function setIva(int $iva): void {
        self::checkIva($iva);
        $this->iva = $iva;        
    }*/
        
    /*public function setDescripcion(string $descripcion): void {
        $this->descripcion = $descripcion;
    }*/

    /*public function setProveedor(Proveedor $proveedor): void {
        $this->proveedor = $proveedor;
    }*/

    /*public function setCategoria(Categoria $categoria): void {
        $this->categoria = $categoria;
    }*/

    /*public function setCoste(float $coste): void {
        $this->coste = $coste;
    }*/
    
    /*
    public function setCodigo(string $codigo): void {        
        self::checkCodigo($codigo);
        $this->codigo = $codigo;        
    }
  */  
   /*public function setNombre(string $nombre): void {
        self::checkNombre($nombre);
        $this->nombre = $nombre;        
    }*/
    
      /*public function setMargen(float $margen): void {
        $this->margen = $margen;
    }*/
}
