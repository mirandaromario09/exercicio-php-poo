<?php

class Player
{
    public $nome;
    public $vida;
    public $dano;

    public function atacar()
    {
        echo "Romário atacou causando 20 de dano" . "<br>";
    }
    public function receberDano($valor)
    {
        $this->vida -= $valor;
    }
    public function mostrarVida()
    {
        echo "A vida atual é: " . $this->vida . "<br>";
    }
    public function estaVivo()
    {
        if ($this->vida > 0) {
            echo "O player esta vivo!";
        } else {
            echo "O player morreu!";
        }
    }
}

$player = new Player();

$player->nome = "Romario";
$player->vida = 100;
$player->dano = 20;

$player->atacar();

$player->receberDano(30);

$player->mostrarVida();

$player->estaVivo();
