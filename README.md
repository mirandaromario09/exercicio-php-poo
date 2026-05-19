# Exercícios de POO em PHP — Introdução à Orientação a Objetos

Três exercícios práticos para consolidar os fundamentos de Programação Orientada a Objetos em PHP: classes, objetos, atributos, métodos e interação entre objetos.

---

## Estrutura

```
├── index_exercicio1.php   # Classe Bow — atributos e métodos simples
├── index_exercicio2.php   # Classe Player — métodos com parâmetros
├── index_exercicio3.php   # Classe Player — interação entre objetos
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

## Como executar

1. Coloque a pasta no `htdocs` do XAMPP
2. Inicie o Apache
3. Acesse no navegador:
   - `http://localhost/intrucao_poo/index_exercicio1.php`
   - `http://localhost/intrucao_poo/index_exercicio2.php`
   - `http://localhost/intrucao_poo/index_exercicio3.php`
