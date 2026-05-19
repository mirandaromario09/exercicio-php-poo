<?php

class Player
{
    public $nome;
    public $vida;
    public $mana_pull;
    public $custo_mana;
    public $dano;

    public function usarSkill($alvo)
    {
        
        if ($this->mana_pull >= $this->custo_mana) {
            $alvo->receberDano($this->dano);
            $this->mana_pull -= $this->custo_mana;
            echo "O " . $this->nome . " Atacou o " . $alvo->nome . " e causou " . $this->dano . " de dano" . "<br>";
        } else {
            echo $this->nome . " não teve mana o suficiente para o ataque";
        }
    }
    public function receberDano($valor)
    {
        $this->vida -= $valor;
    }
    public function mostrarStatus()
    {
        echo "Vida: " . $this->vida . "<br>";
        echo "Mana: " . $this->mana_pull . "<br>";
    }
}

$player1 = new Player();

$player1->nome = "Witch";
$player1->vida = 100;
$player1->mana_pull = 100;
$player1->custo_mana = 30;
$player1->dano = 40;

$player2 = new Player();

$player2->nome = "kitavas";
$player2->vida = 80;
$player2->mana_pull = 0;
$player2->dano = 10;

$player1->usarSkill($player2);

$player1->mostrarStatus();

$player2->mostrarStatus();