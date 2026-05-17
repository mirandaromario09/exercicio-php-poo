<?php

class Usuario
{
    public string $nome;
    public string $email;
    private string $senha;

    public function __construct(string $nome, string $email, string $senha)
    {
        $this->nome = $nome;
        $this->email = $email;
        $this->senha = password_hash($senha, PASSWORD_DEFAULT);
    }

    public function exibirDados(): string
    {
        return "{$this->nome} <{$this->email}>";
    }

    private function verificarSenha(string $senha): bool
    {
        return password_verify($senha, $this->senha);
    }

    public function login(string $senha): string
    {
        if ($this->verificarSenha($senha)) {
            return "Bem-vindo de volta, {$this->nome}!";
        }
        return "Senha incorreta.";
    }
}

echo "--- BLOCO 1: Classe e Objeto ---\n";

$user = new Usuario('Carlos Daniel', 'carlos@email.com', '123456');
echo $user->exibirDados() . "\n";
echo $user->login('123456') . "\n";
echo $user->login('senha_errada') . "\n";

echo "\n\n";


class Produto
{
    private string $nome;
    private float $preco;

    public function __construct(string $nome, float $preco)
    {
        $this->nome = $nome;
        $this->setPreco($preco);
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function getPreco(): float
    {
        return $this->preco;
    }

    public function setPreco(float $preco): void
    {
        if ($preco <= 0) {
            throw new InvalidArgumentException('Preço precisa ser positivo.');
        }
        $this->preco = $preco;
    }

    public function aplicarDesconto(float $percentual): void
    {
        if ($percentual < 0 || $percentual > 100) {
            throw new InvalidArgumentException('Percentual inválido.');
        }
        $this->preco -= $this->preco * ($percentual / 100);
    }
}

echo "--- BLOCO 2: Encapsulamento ---\n";

$p = new Produto('Teclado Mecânico', 250.00);
echo "Produto: {$p->getNome()} -- R$ {$p->getPreco()}\n";

$p->aplicarDesconto(10);
echo "Com 10% off: R$ {$p->getPreco()}\n";

echo "\n\n";


class Funcionario
{
    public function __construct(
        protected string $nome,
        protected float $salarioBase
    ) {}

    public function calcularSalario(): float
    {
        return $this->salarioBase;
    }

    public function getCargo(): string
    {
        return 'Funcionário';
    }
}

class Desenvolvedor extends Funcionario
{
    private array $linguagens;

    public function __construct(string $nome, float $salarioBase, array $linguagens)
    {
        parent::__construct($nome, $salarioBase);
        $this->linguagens = $linguagens;
    }

    public function getCargo(): string
    {
        return 'Desenvolvedor';
    }

    public function calcularSalario(): float
    {
        $bonus = count($this->linguagens) * 200;
        return $this->salarioBase + $bonus;
    }

    public function getLinguagens(): string
    {
        return implode(', ', $this->linguagens);
    }
}

class Designer extends Funcionario
{
    private string $ferramentaPrincipal;

    public function __construct(string $nome, float $salarioBase, string $ferramenta)
    {
        parent::__construct($nome, $salarioBase);
        $this->ferramentaPrincipal = $ferramenta;
    }

    public function getCargo(): string
    {
        return 'Designer';
    }

    public function calcularSalario(): float
    {
        return $this->salarioBase;
    }
}

echo "--- BLOCO 3: Heranca ---\n";

$dev = new Desenvolvedor('Ana', 5000, ['PHP', 'JavaScript', 'Python']);
$designer = new Designer('Bob', 4500, 'Figma');

$funcionarios = [$dev, $designer];

foreach ($funcionarios as $f) {
    printf(
        "%s: %s -- R$ %.2f\n",
        $f->getCargo(),
        $f->nome,
        $f->calcularSalario()
    );
}

echo "\n\n";


abstract class Pagamento
{
    protected float $valor;

    public function __construct(float $valor)
    {
        $this->valor = $valor;
    }

    public function getValor(): float
    {
        return $this->valor;
    }

    abstract public function processar(): string;
    abstract public function taxa(): float;
}

class PagamentoCartao extends Pagamento
{
    public function processar(): string
    {
        $total = $this->valor + $this->taxa();
        return "[Cartao] Pagamento de R$ {$total} aprovado.";
    }

    public function taxa(): float
    {
        return $this->valor * 0.03;
    }
}

class PagamentoBoleto extends Pagamento
{
    public function processar(): string
    {
        return "[Boleto] Gerado no valor de R$ {$this->valor}. Vence em 3 dias.";
    }

    public function taxa(): float
    {
        return 0;
    }
}

echo "--- BLOCO 4: Classes Abstratas ---\n";

function finalizarCompra(Pagamento $pagamento): void
{
    echo $pagamento->processar() . "\n";
}

finalizarCompra(new PagamentoCartao(150.00));
finalizarCompra(new PagamentoBoleto(150.00));

echo "\n\n";


interface Notificavel
{
    public function enviar(string $mensagem): string;
}

class EmailNotificacao implements Notificavel
{
    public function __construct(private string $email) {}

    public function enviar(string $mensagem): string
    {
        return "[EMAIL para {$this->email}] {$mensagem}";
    }
}

class SMSNotificacao implements Notificavel
{
    public function __construct(private string $telefone) {}

    public function enviar(string $mensagem): string
    {
        return "[SMS para {$this->telefone}] {$mensagem}";
    }
}

class PushNotificacao implements Notificavel
{
    public function __construct(private string $deviceId) {}

    public function enviar(string $mensagem): string
    {
        return "[PUSH para device {$this->deviceId}] {$mensagem}";
    }
}

echo "--- BLOCO 5: Polimorfismo ---\n";

function dispararAlerta(Notificavel $canal, string $msg): void
{
    echo $canal->enviar($msg) . "\n";
}

$canais = [
    new EmailNotificacao('usuario@email.com'),
    new SMSNotificacao('11999999999'),
    new PushNotificacao('abc-123-device'),
];

foreach ($canais as $canal) {
    dispararAlerta($canal, 'Sua conta foi acessada de um novo dispositivo.');
}

echo "\n\n";


trait Logavel
{
    public function log(string $mensagem): void
    {
        $hora = date('Y-m-d H:i:s');
        echo "[LOG {$hora}] {$mensagem}\n";
    }
}

class Pedido
{
    use Logavel;

    public function __construct(private int $id) {}

    public function confirmar(): void
    {
        $this->log("Pedido #{$this->id} confirmado.");
    }
}

class Fatura
{
    use Logavel;

    public function __construct(private string $codigo) {}

    public function emitir(): void
    {
        $this->log("Fatura {$this->codigo} emitida.");
    }
}

echo "--- BLOCO 6: Traits ---\n";

$pedido = new Pedido(42);
$pedido->confirmar();

$fatura = new Fatura('FAT-2025-001');
$fatura->emitir();

echo "\n\n";


class Config
{
    private static array $valores = [];

    public static function set(string $chave, mixed $valor): void
    {
        self::$valores[$chave] = $valor;
    }

    public static function get(string $chave, mixed $padrao = null): mixed
    {
        return self::$valores[$chave] ?? $padrao;
    }

    public static function todos(): array
    {
        return self::$valores;
    }
}

echo "--- BLOCO 7: Metodos Estaticos ---\n";

Config::set('db.host', 'localhost');
Config::set('db.port', 3306);
Config::set('app.name', 'Meu Sistema');

echo "Host: " . Config::get('db.host') . "\n";
echo "App: " . Config::get('app.name') . "\n";
echo "Inexistente: " . Config::get('db.password', 'nao definido') . "\n";

echo "\n\n";


class ItemPedido
{
    public function __construct(
        private string $nome,
        private int $quantidade,
        private float $precoUnitario
    ) {}

    public function subtotal(): float
    {
        return $this->quantidade * $this->precoUnitario;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function getQuantidade(): int
    {
        return $this->quantidade;
    }

    public function getPrecoUnitario(): float
    {
        return $this->precoUnitario;
    }
}

enum StatusPedido: string
{
    case Pendente = 'pendente';
    case Pago = 'pago';
    case Enviado = 'enviado';
    case Entregue = 'entregue';
    case Cancelado = 'cancelado';
}

class PedidoCompra
{
    use Logavel;

    private int $id;
    private array $itens = [];
    private StatusPedido $status;
    private DateTimeImmutable $criadoEm;

    private static int $contador = 0;

    public function __construct(
        private string $cliente
    ) {
        self::$contador++;
        $this->id = self::$contador;
        $this->status = StatusPedido::Pendente;
        $this->criadoEm = new DateTimeImmutable();
    }

    public function adicionarItem(string $nome, int $qtd, float $preco): void
    {
        if ($this->status !== StatusPedido::Pendente) {
            throw new RuntimeException('Pedido ja fechado. Nao pode alterar.');
        }
        $this->itens[] = new ItemPedido($nome, $qtd, $preco);
    }

    public function total(): float
    {
        $soma = 0;
        foreach ($this->itens as $item) {
            $soma += $item->subtotal();
        }
        return $soma;
    }

    public function finalizar(): void
    {
        if (empty($this->itens)) {
            throw new RuntimeException('Pedido vazio nao pode ser finalizado.');
        }
        $this->status = StatusPedido::Pago;
        $this->log("Pedido #{$this->id} finalizado. Total: R$ " . number_format($this->total(), 2, ',', '.'));
    }

    public function resumo(): string
    {
        $linhas = [];
        $linhas[] = "Pedido #{$this->id} -- {$this->cliente}";
        $linhas[] = "Status: {$this->status->value}";
        $linhas[] = "Criado em: {$this->criadoEm->format('d/m/Y H:i')}";
        $linhas[] = "Itens:";

        foreach ($this->itens as $item) {
            $linhas[] = sprintf(
                "  - %s (%dx) R$ %.2f = R$ %.2f",
                $item->getNome(),
                $item->getQuantidade(),
                $item->getPrecoUnitario(),
                $item->subtotal()
            );
        }

        $linhas[] = "Total: R$ " . number_format($this->total(), 2, ',', '.');
        return implode("\n", $linhas);
    }
}

echo "--- BLOCO 8: Mini-sistema de Pedidos ---\n";

$pedido = new PedidoCompra('Maria Silva');
$pedido->adicionarItem('Mouse Sem Fio', 2, 89.90);
$pedido->adicionarItem('Teclado Mecanico', 1, 350.00);
$pedido->adicionarItem('Mousepad Gamer', 1, 79.90);

echo "\n";
echo $pedido->resumo() . "\n\n";

$pedido->finalizar();
