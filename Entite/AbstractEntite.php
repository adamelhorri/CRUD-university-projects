<?php


namespace EntitesTransat;


abstract class AbstractEntite {
    protected bool $presistant;

    /**
     * @return bool
     */
    public abstract function getPersistant() : bool;

    /**
     * @param bool $persistant
     */
    public abstract function setPersistant(bool $persistant ) : void;

}