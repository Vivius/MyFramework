<?php
/**
 * IOC container permettant de créer des objets dynamiquement.
 * Cette classe est un singleton.
 */

namespace App\Core;

class Container
{
    /**
     * Instance unique du container.
     * @var Container
     */
    private static $instance;

    /**
     * Ensemble de la configuration du container.
     * @var array
     */
    private $config;

    /**
     * Paires type/implémentation pour les singletons.
     * La classe singleton devra posséder la propriété getInstance.
     * @var array
     */
    private $singletonRegistry;

    /**
     * Ensemble des singletons déjà enregistrés.
     * @var array
     */
    private $singletonInstances;

    /**
     * Paires type/implémentation pour les types classiques.
     * @var array
     */
    private $typeRegistry;

    /**
     * Paires type/implémentation ayant pour implémentation une closure définissant la méthode de construction.
     * @var array
     */
    private $closureRegistry;

    /**
     * Container constructor.
     */
    private function __construct()
    {
        $this->config = include_once "../Config/TypesContainer.php";
        $this->singletonRegistry = $this->config["singletons"];
        $this->typeRegistry = $this->config["types"];
        $this->closureRegistry = $this->config["closures"];
        $this->singletonInstances = [];
    }

    /**
     * Permet d'obtenir l'instance unique du Container pour cette application.
     * @return Container
     */
    public static function getInstance()
    {
        if(is_null(self::$instance))
            self::$instance = new Container();
        return self::$instance;
    }

    /**
     * Création d'un objet.
     * @param $dataType
     * @return null|object
     */
    public function make($dataType)
    {
        return $this->resolve($dataType);
    }

    /**
     * Injecte automatiquement les objets demandés pour une méthode puis l'exécute.
     * @param $class
     * @param $method
     */
    public function invoke($class, $method) {
        $args = null;

        $reflectionMethod = new \ReflectionMethod($class, $method);
        $tags = $reflectionMethod->getParameters();
        foreach ($tags as $tag) {
            $args[] = self::resolve($tag->getType());
        }
        if(!is_null($args)){
            $reflectionMethod->invokeArgs(new $class(), $args);
        } else {
            $reflectionMethod->invoke(new $class());
        }
    }

    /**
     * Création automatique d'un objet grâce à son constructeur.
     * @param $dataType
     * @return null|object
     * @throws \Exception
     */
    private function createObject($dataType)
    {
        $args = null;
        $obj = null;

        if(!class_exists($dataType)) {
            throw new \Exception($dataType." class does not exist");
        }
        $reflectionClass = new \ReflectionClass($dataType);
        $constructor = $reflectionClass->getConstructor();
        if(!is_null($constructor)) {
            $tags = $constructor->getParameters();
            foreach($tags as $tag) {
                $args[] = $this->resolve($tag->getType());
            }
        }
        if(!is_null($args)) {
            $obj = $reflectionClass->newInstanceArgs($args);
        } else {
            $obj = $reflectionClass->newInstanceArgs();
        }
        return $obj;
    }

    /**
     * Trouve l'implémentation d'un type donné dans les tableaux de types, singletons et closures.
     * @param $dataType
     * @return null|object
     */
    private function resolve($dataType)
    {
        $dataType = trim($dataType, "\\");
        $obj = null;

        if(isset($this->singletonInstances[$dataType])){
            $obj = $this->singletonInstances[$dataType];
        } else if(isset($this->singletonRegistry[$dataType])) {
            $obj = $this->createObject($this->singletonRegistry[$dataType]);
            $this->singletonInstances[$dataType] = $obj;
        } else if(isset($this->closureRegistry[$dataType])) {
            $obj = $this->closureRegistry[$dataType]();
        } else if(isset($this->typeRegistry[$dataType])) {
            $obj = $this->createObject($this->typeRegistry[$dataType]);
        }

        return $obj;
    }
}