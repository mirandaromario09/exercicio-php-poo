# Exercícios de POO em PHP — Introdução à Orientação a Objetos

Três exercícios práticos para consolidar os fundamentos de Programação Orientada a Objetos em PHP: classes, objetos, atributos, métodos e interação entre objetos.

---

## Estrutura

```
├── index_exercicio1.php   # Classe Bow — atributos e métodos simples
├── index_exercicio2.php   # Classe Player — métodos com parâmetros
├── index_exercicio3.php   # Classe Player — interação entre objetos
├── index_exercicio4.php    # Classe Player — sistema de cura entre objetos
├── index_exercicio5.php   # Classe Player — skill com custo de mana
└── README.md
```

---

## Exercício 1 — Classe Bow

**Arquivo:** `index_exercicio1.php`

Criação de uma classe com atributos e métodos básicos, sem interação com outros objetos.

### Classe `Bow`

| Atributo | Descrição |
|---|---|
| `$nomeBase` | Nome do arco |
| `$physicalDamage` | Dano físico |
| `$criticalChance` | Chance de crítico (0-100) |
| `$attackSpeed` | Velocidade de ataque |

| Método | Descrição |
|---|---|
| `atacar()` | Exibe o nome do arco seguido de "atacou" |
| `mostrarDPS()` | Calcula e retorna `physicalDamage * attackSpeed` |
| `ehCritco()` | Verifica se `criticalChance >= 5` e exibe "Alta chance de crítico!" ou "Baixa chance de crítico!" |

### Exemplo de saída

```
Short Bow atacou
DPS: 15
Alta chance de crítico!
```

### O que ensina

- Declaração de classe e atributos
- Diferença entre métodos que **exibem** (`echo`) e métodos que **retornam** (`return`)
- Uso do `$this` para acessar atributos dentro da classe

---

## Exercício 2 — Classe Player (versão simples)

**Arquivo:** `index_exercicio2.php`

Classe com métodos que recebem parâmetros e modificam os atributos do próprio objeto.

### Classe `Player`

| Atributo | Descrição |
|---|---|
| `$nome` | Nome do jogador |
| `$vida` | Pontos de vida |
| `$dano` | Dano causado |

| Método | Descrição |
|---|---|
| `atacar()` | Exibe "Romário atacou causando 20 de dano" |
| `receberDano($valor)` | Subtrai `$valor` da vida |
| `mostrarVida()` | Exibe a vida atual |
| `estaVivo()` | Verifica se `vida > 0` e exise "O player está vivo!" ou "O player morreu!" |

### Exemplo de saída

```
Romário atacou causando 20 de dano
A vida atual é: 70
O player está vivo!
```

### O que ensina

- Métodos que recebem parâmetros (`receberDano($valor)`)
- Modificação de atributos internos do objeto
- Condicionais (`if/else`) dentro de métodos

---

## Exercício 3 — Combate entre Players

**Arquivo:** `index_exercicio3.php`

Dois objetos da mesma classe interagem entre si — um player ataca o outro.

### Classe `Player`

| Atributo | Descrição |
|---|---|
| `$nome` | Nome do jogador |
| `$vida` | Pontos de vida |
| `$dano` | Dano causado por ataque |

| Método | Descrição |
|---|---|
| `atacar($alvo)` | Exibe "X atacou Y causando Z de dano" e chama `$alvo->receberDano($this->dano)` |
| `receberDano($valor)` | Subtrai `$valor` da vida |
| `mostrarVida()` | Exibe a vida atual |
| `estaVivo()` | Verifica se o player ainda está vivo |

### Fluxo do ataque

```
$player1->atacar($player2)
         │
         ├─ echo "Romario atacou Zana causando 20 de dano"
         │
         └─ $player2->receberDano(20)
                        │
                        └─ $player2->vida = 80 - 20 = 60
```

### Exemplo de saída

```
Romario atacou Zana causando 20 de dano
Vida atual: 60
Player está vivo
```

### O que ensina

- **Interação entre objetos**: um objeto chama métodos de outro objeto
- `$this` vs `$alvo`: dentro de `atacar($alvo)`, `$this` é quem ataca e `$alvo` é quem recebe
- Encadeamento de métodos: `atacar()` chama `receberDano()` do alvo

---

## Conceitos abordados

| Conceito | Exercício |
|---|---|
| Classe e objeto (`new`) | 1, 2, 3 |
| Atributos (`public`) | 1, 2, 3 |
| Métodos (`function`) | 1, 2, 3 |
| `$this` | 1, 2, 3 |
| Parâmetros em métodos | 2, 3 |
| Métodos com retorno (`return`) | 1 |
| Interação entre objetos | 3 |
| Condicionais em métodos | 1, 2, 3 |

---

---

## Exercício 4 — Sistema de Cura entre Players

**Arquivo:** `index_exercicio4.php`

Um player cura outro player, demonstrando interação entre objetos com efeito positivo (cura em vez de dano).

### Classe `Player`

| Atributo | Descrição |
|---|---|
| `$nome` | Nome do jogador |
| `$vida` | Pontos de vida |
| `$cura` | Quantidade de cura que o player pode aplicar |

| Método | Descrição |
|---|---|
| `curar($alvo)` | Exibe "O Templar Curou o Marauder em 25 de vida" e chama `$alvo->receberCura($this->cura)` |
| `receberCura($valor)` | Soma `$valor` à vida do alvo |
| `mostrarVida()` | Exibe a vida atual |
| `estaVivo()` | Verifica se o player ainda está vivo |

### Fluxo da cura

```
$player1->curar($player2)
         │
         ├─ echo "O Templar Curou o Marauder em 25 de vida"
         │
         └─ $player2->receberCura(25)
                        │
                        └─ $player2->vida = 40 + 25 = 65
```

### Exemplo de saída

```
O Templar Curou o Marauder em 25 de vida
Vida atual: 65
Esta vivo!
```

### O que ensina

- **Interação com efeito positivo**: em vez de causar dano, um objeto aumenta atributos de outro
- **Reutilização de métodos**: `receberCura()` é chamado internamente por `curar()`, similar ao `receberDano()` do exercício 3
- **Assimetria de responsabilidade**: quem cura (`$this`) tem o atributo `$cura`; quem recebe (`$alvo`) não precisa ter

---

## Exercício 5 — Skill com Custo de Mana

**Arquivo:** `index_exercicio5.php`

Um player usa uma skill que consome mana. O ataque só acontece se houver mana suficiente.

### Classe `Player`

| Atributo | Descrição |
|---|---|
| `$nome` | Nome do jogador |
| `$vida` | Pontos de vida |
| `$mana_pull` | Quantidade atual de mana |
| `$custo_mana` | Mana necessária para usar a skill |
| `$dano` | Dano causado pela skill |

| Método | Descrição |
|---|---|
| `usarSkill($alvo)` | Verifica se há mana suficiente. Se sim, causa dano, subtrai o custo de mana e exibe a mensagem. Se não, exibe "não teve mana o suficiente" |
| `receberDano($valor)` | Subtrai `$valor` da vida |
| `mostrarStatus()` | Exibe a vida e a mana atuais |

### Fluxo da skill

```
$player1->usarSkill($player2)
         │
         ├─ mana (100) >= custo (30)? SIM
         │
         ├─ $player2->receberDano(40)
         │
         ├─ $player1->mana = 100 - 30 = 70
         │
         └─ echo "O Witch Atacou o kitavas e causou 40 de dano"
```

### Exemplo de saída

```
O Witch Atacou o kitavas e causou 40 de dano
Vida: 100
Mana: 70
Vida: 40
Mana: 0
```

### O que ensina

- **Condição para execução**: o método `usarSkill()` só executa o ataque se `mana_pull >= custo_mana`
- **Gerenciamento de recurso**: a mana é consumida ao usar a skill (`$this->mana_pull -= $this->custo_mana`)
- **Duas responsabilidades no mesmo método**: verificar condição **e** executar ação
- **Player sem mana**: `$player2` não tem mana (`mana_pull = 0`) e não possui `custo_mana`, ilustrando que cada objeto pode ter configurações diferentes

---

## Como executar

1. Coloque a pasta no `htdocs` do XAMPP
2. Inicie o Apache
3. Acesse no navegador:
   - `http://localhost/intrucao_poo/index_exercicio1.php`
   - `http://localhost/intrucao_poo/index_exercicio2.php`
   - `http://localhost/intrucao_poo/index_exercicio3.php`
