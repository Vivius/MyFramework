<?php
/**
 * IOC container permettant de créer des objets dynamiquement.
 */

namespace App\Core;

class Container
{
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
    public function resolve($dataType)
    {
        $dataType = trim($dataType, "\\");
        $obj = null;

        if(isset($this->singletonRegistry[$dataType])) {
            $className = $this->singletonRegistry[$dataType];
            if(class_exists($className))
                if(method_exists($className, "getInstance"))
                    $obj = $className::getInstance();
        } else if(isset($this->closureRegistry[$dataType])) {
            $obj = $this->closureRegistry[$dataType]();
        } else if(isset($this->typeRegistry[$dataType])) {
            $obj = $this->createObject($this->typeRegistry[$dataType]);
        }

        return $obj;
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
     * Container constructor.
     * @param $singletonRegistry
     * @param $typeRegistry
     * @param $closureRegistry
     */
    public function __construct($singletonRegistry, $typeRegistry, $closureRegistry)
    {
        $this->singletonRegistry = $singletonRegistry;
        $this->typeRegistry = $typeRegistry;
        $this->closureRegistry = $closureRegistry;
    }

    /**
     * Paires type/implémentation pour les singletons.
     * La classe singleton devra posséder la propriété getInstance.
     * @var array
     */
    private $singletonRegistry;

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
}