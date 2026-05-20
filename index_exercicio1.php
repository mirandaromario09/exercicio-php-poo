<?php

class Bow
{
    private $nomeBase;
    private $physicalDamage;
    private $criticalChance;
    private $attackSpeed;

    public function setNomeBase($nomeBase)
    {
        $this->nomeBase = $nomeBase;
    }
    public function getNomeBase()
    {
        return $this->nomeBase;
    }

    public function setPhysicalDamage($physicalDamage)
    {
        $this->physicalDamage = $physicalDamage;
    }
    public function getPhysicalDamage()
    {
        return $this->physicalDamage;
    }

    public function setCriticalChance($criticalChance)
    {
        $this->criticalChance = $criticalChance;
    }
    public function getCriticalChance()
    {
        return $this->criticalChance;
    }

    public function setAttackSpeed($attackSpeed)
    {
        $this->attackSpeed = $attackSpeed;
    }
    public function getAttackSpeed()
    {
        return $this->attackSpeed;
    }

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

$bow->setNomeBase("Short Bow");
$bow->setPhysicalDamage(10);
$bow->setCriticalChance(5);
$bow->setAttackSpeed(1.50);

$bow->atacar();

echo "DPS: " . $bow->mostrarDPS() . "<br>";

$bow->ehCritco();
