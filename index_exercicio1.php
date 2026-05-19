<?php

class Bow
{

    public $nomeBase;
    public $physicalDamage;
    public $criticalChance;
    public $attackSpeed;

    public function atacar()
    {
        echo $this->nomeBase . " atacou" . "<br>";
    }

    public function mostrarDPS()
    {
        return $this->physicalDamage * $this->attackSpeed;
    }

    public function ehCritco()
    {
        if ($this->criticalChance >= 5) {
            echo "Alta chance de crítico!";
        } else {
            echo "Baixa chance de crítico!";
        }
    }
}

$bow = new Bow();

$bow->nomeBase = "Short Bow";
$bow->physicalDamage = 10;
$bow->criticalChance = 5;
$bow->attackSpeed = 1.50;

$bow->atacar();

echo "DPS: " . $bow->mostrarDPS() . "<br>";

$bow->ehCritco();
