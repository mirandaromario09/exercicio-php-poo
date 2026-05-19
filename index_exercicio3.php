<?php

class Player
{
    public $nome;
    public $vida;
    public $dano;

    public function atacar($alvo)
    {
        echo $this->nome . " atacou " . $alvo->nome . " causando " . $this->dano . " de dano<br>";
        $alvo->receberDano($this->dano);
    }

    public function receberDano($valor)
    {
        $this->vida = $this->vida - $valor;
    }

    public function mostrarVida()
    {
        echo "Vida atual: " . $this->vida . "<br>";
    }

    public function estaVivo()
    {
        if ($this->vida > 0) {
            echo "Player está vivo";
        } else {
            echo "Player morreu";
        }
    }
}

$player1 = new Player();

$player1->nome = "Romario";
$player1->vida = 100;
$player1->dano = 20;

$player2 = new Player();

$player2->nome = "Zana";
$player2->vida = 80;
$player2->dano = 15;

$player1->atacar($player2);

$player2->mostrarVida();

$player2->estaVivo();
