<?php

class Player
{
    public $nome;
    public $vida;
    public $cura;

    public function curar($alvo)
    {
        echo "O " . $this->nome . " Curou o " . $alvo->nome . " em " . $this->cura . " de vida" . "<br>";
        $alvo->receberCura($this->cura);
    }
    public function receberCura($valor)
    {
        $this->vida = $this->vida + $valor;
    }
    public function mostrarVida()
    {
        echo "Vida atual: " . $this->vida . "<br>";
    }
    public function estaVivo()
    {
        if ($this->vida > 0) {
            echo "Esta vivo!";
        } else {
            echo "Morreu!";
        }
    }
}

$player1 = new Player();

$player1->nome = "Templar";
$player1->vida = 100;
$player1->cura = 25;

$player2 = new Player();

$player2->nome = "Marauder";
$player2->vida = 40;
$player2->cura = 0;

$player1->curar($player2);

$player2->mostrarVida();

$player2->estaVivo();
