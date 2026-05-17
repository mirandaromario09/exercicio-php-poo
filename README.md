# Introdução à POO em PHP

Estudo prático de Programação Orientada a Objetos em PHP, do básico até um exemplo mais próximo do mundo real.

Cada bloco é independente. Dá pra ir na ordem ou pular direto pro que interessar.

---

## Bloco 1 — Classe, Objeto, Visibilidade

Uma classe é um molde. Um objeto é uma cópia desse molde com valores próprios.

A classe `Usuario` tem:
- **Atributos públicos** (`$nome`, `$email`) — qualquer um pode acessar
- **Atributo privado** (`$senha`) — só a própria classe enxerga
- **Construtor** — roda automaticamente quando usamos `new`
- **Método privado** (`verificarSenha()`) — uso interno
- **Método público** (`login()`) — expõe uma operação sem vazar a senha

Se tentar acessar `$user->senha` ou `$user->verificarSenha('x')` diretamente, o PHP lança erro. Isso é **encapsulamento**: o objeto controla o que expõe.

## Bloco 2 — Encapsulamento com Getters e Setters

Nem sempre queremos expor propriedades diretamente. Usamos getters e setters pra ter controle.

A classe `Produto` mostra:
- `getNome()` / `getPreco()` — leitura controlada
- `setPreco()` — validação na escrita (impede preço negativo)
- `aplicarDesconto()` — regra de negócio dentro do próprio objeto

Se tentar `$p->preco = -50`, não funciona (é private). Se tentar `$p->setPreco(-10)`, lança exceção.

## Bloco 3 — Herança

Uma classe pode estender outra, herdando métodos e propriedades. Reaproveitamento de código.

```
Funcionario (nome, salarioBase, calcularSalario())
  ├── Desenvolvedor (ganha bônus por linguagem)
  └── Designer (salário fixo)
```

- `protected` permite que as filhas enxerguem o atributo, mas continua escondido de fora
- `parent::__construct()` chama o construtor da classe pai
- Os métodos `getCargo()` e `calcularSalario()` são **sobrescritos** em cada filha

## Bloco 4 — Classes Abstratas

Uma classe abstrata não pode ser instanciada diretamente. Serve como contrato: define o que as filhas **devem** implementar.

A classe `Pagamento` define:
- `getValor()` — método concreto, compartilhado por todas as formas de pagamento
- `processar()` — abstrato, cada forma implementa do seu jeito
- `taxa()` — abstrato, cartão cobra 3%, boleto é zero

`new Pagamento(100)` dá erro — não faz sentido instanciar "pagamento" genérico.

## Bloco 5 — Polimorfismo

Polimorfismo = "muitas formas". Um mesmo método se comporta diferente dependendo do objeto.

A interface `Notificavel` define o contrato `enviar()`. Três classes implementam:
- `EmailNotificacao` — envia e-mail
- `SMSNotificacao` — envia SMS
- `PushNotificacao` — envia push notification

A função `dispararAlerta()` não liga pra **qual** canal é. Ela só chama `enviar()`. Cada implementação faz sua parte. Isso é polimorfismo na prática.

## Bloco 6 — Traits

Traits são como "copiar e colar" métodos entre classes que não compartilham a mesma hierarquia. Úteis pra não repetir código.

A trait `Logavel` define `log()`. As classes `Pedido` e `Fatura` usam `use Logavel` e ganham o método automaticamente, sem precisar estender uma classe em comum.

## Bloco 7 — Métodos e Propriedades Estáticos

`static` pertence à classe, não ao objeto. Útil pra contadores, helpers, configuração global, etc.

A classe `Config` armazena pares chave/valor. Não precisa instanciar:

```php
Config::set('db.host', 'localhost');
$host = Config::get('db.host');
```

## Bloco 8 — Exemplo Integrado

Um mini-sistema de pedidos juntando vários conceitos:

- `ItemPedido` — modelo simples com subtotal
- `StatusPedido` — enum com os estados possíveis
- `PedidoCompra` — classe principal que usa trait `Logavel`, propriedades estáticas (contador de IDs), validação de estado e formatação de resumo

---

## Como rodar

```bash
php index.php
```

Ou coloca no servidor web e acessa pelo navegador.

---

