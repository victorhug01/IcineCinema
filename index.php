<?php

declare(strict_types=1);



require __DIR__ . '/vendor/autoload.php';

use Icine\Sistema\Cinema;
use Icine\Sistema\Sala;
use Icine\Sistema\Filme;
use Icine\Sistema\Sessao;
use Icine\Sistema\Pessoa;
use Icine\Sistema\Bilheteria;
use Icine\Sistema\Estoque;
use Icine\Sistema\Bomboniere;
use Icine\Sistema\Comida;
use Icine\Sistema\Bebida;

function rl(string $prompt): string
{
    $input = readline($prompt);
    if ($input === false) {
        return '';
    }
    return trim($input);
}

echo "=== Sistema simples de Cinema (CLI) ===\n\n";

$nomeCinema = rl("Nome do cinema: ");
if ($nomeCinema === '') $nomeCinema = 'Cinema Demo';
$cinema = new Cinema($nomeCinema);

echo "Criando uma sala...\n";
$numeroSala = (int) rl("Número da sala (ex: 1): ");
$capacidade = (int) rl("Capacidade da sala: ");
$sala = new Sala($numeroSala ?: 1, $capacidade ?: 50);
$cinema->adicionarSala($sala);

echo "Criando um filme...\n";
$titulo = rl("Título do filme: ");
$duracao = (int) rl("Duração (minutos): ");
$class = rl("Classificação (ex: 12): ");
$filme = new Filme($titulo ?: 'Filme Demo', $duracao ?: 120, $class ?: 'Livre');

$horarioStr = rl("Horário da sessão (YYYY-MM-DD HH:MM): ");
$horario = \DateTimeImmutable::createFromFormat('Y-m-d H:i', $horarioStr) ?: new \DateTimeImmutable('+1 hour');
$sessaoId = uniqid('sessao_');
$sessao = new Sessao($sessaoId, $filme, $sala, $horario);

echo "Sessão criada: {$filme->getTitulo()} na sala {$sala->getNumero()} às " . $sessao->getHorario()->format('Y-m-d H:i') . "\n";

$bilheteria = new Bilheteria();

$estoque = new Estoque();
$bomboniere = new Bomboniere($estoque);

while (true) {
    echo "\n---- Menu ----\n";
    echo "1) Vender ingresso\n2) Mostrar ocupação\n3) Bomboniere\n4) Sair\n";
    $opt = rl("Escolha: ");
    if ($opt === '1') {
        $nome = rl("Nome do comprador: ");
        $telefone = rl("Telefone (opcional): ");
        $assento = (int) rl("Escolha um assento (1..{$sala->getCapacidade()}): ");
        $valor = (float) rl("Valor do ingresso (ex: 20.00): ");
        $pessoa = new Pessoa($nome ?: 'Cliente', $telefone ?: null);
        $ingresso = $bilheteria->venderIngresso($pessoa, $sessao, $assento ?: 1, $valor ?: 20.0);
        if ($ingresso === null) {
            echo "Não foi possível vender o ingresso (assento indisponível ou sessão lotada).\n";
        } else {
            echo "Ingresso vendido! Nº: {$ingresso->getNumero()} | Assento: {$ingresso->getAssento()} | Valor: R$ " . number_format($ingresso->getValor(), 2, ',', '.') . "\n";
        }
    } elseif ($opt === '2') {
        $ocupados = count($sessao->getIngressos());
        $disponiveis = $sala->getCapacidade() - $ocupados;
        echo "Ocupados: {$ocupados} | Disponíveis: {$disponiveis} | Capacidade: {$sala->getCapacidade()}\n";
    } elseif ($opt === '3') {
        while (true) {
            echo "\n-- Bomboniere --\n";
            echo "1) Cadastrar produto\n2) Editar produto\n3) Excluir produto\n4) Listar produtos\n5) Vender produto\n6) Voltar\n";
            $bopt = rl("Escolha: ");
            if ($bopt === '1') {
                $tipo = rl("Tipo (C=comida / B=bebida): ");
                $codigo = rl("Código do produto: ");
                $nomeP = rl("Nome: ");
                $preco = (float) rl("Preço (ex: 5.50): ");
                $quant = (int) rl("Quantidade inicial: ");
                if (strtoupper($tipo) === 'C') {
                    $t = rl("Tipo de comida (ex: salgado/doce) [opcional]: ");
                    $prod = new Comida($codigo ?: uniqid('prd_'), $nomeP ?: 'Comida', $preco ?: 0.0, $t ?: null);
                } else {
                    $vol = (float) rl("Volume (ml) [ex: 350]: ");
                    $alc = rl("É alcoólica? (s/n): ");
                    $prod = new Bebida($codigo ?: uniqid('prd_'), $nomeP ?: 'Bebida', $preco ?: 0.0, $vol ?: 0.0, strtolower($alc) === 's');
                }
                $bomboniere->cadastrarProduto($prod, $quant ?: 0);
                echo "Produto cadastrado com sucesso.\n";
            } elseif ($bopt === '2') {
                $codigo = rl("Código do produto para editar: ");
                $nomeP = rl("Novo nome (deixe vazio para manter): ");
                $precoStr = rl("Novo preço (deixe vazio para manter): ");
                $quantStr = rl("Nova quantidade (deixe vazio para manter): ");
                $dados = [];
                if ($nomeP !== '') $dados['nome'] = $nomeP;
                if ($precoStr !== '') $dados['preco'] = (float) $precoStr;
                if ($quantStr !== '') $dados['quantidade'] = (int) $quantStr;
                $ok = $bomboniere->editarProduto($codigo, $dados);
                echo $ok ? "Produto atualizado.\n" : "Produto não encontrado.\n";
            } elseif ($bopt === '3') {
                $codigo = rl("Código do produto para excluir: ");
                $ok = $bomboniere->excluirProduto($codigo);
                echo $ok ? "Produto excluído.\n" : "Produto não encontrado.\n";
            } elseif ($bopt === '4') {
                $itens = $bomboniere->listarProdutos();
                if (empty($itens)) {
                    echo "Nenhum produto cadastrado.\n";
                } else {
                    foreach ($itens as $item) {
                        $p = $item->getProduto();
                        $q = $item->getQuantidade();
                        echo "[{$p->getCodigo()}] {$p->descricao()} | Preço: R$ " . number_format($p->calcularPreco(), 2, ',', '.') . " | Qtde: {$q}\n";
                    }
                }
            } elseif ($bopt === '5') {
                $codigo = rl("Código do produto para vender: ");
                $qtd = (int) rl("Quantidade: ");
                $venda = $bomboniere->vender($codigo, $qtd ?: 1);
                if ($venda === null) {
                    echo "Venda não realizada (produto não encontrado ou estoque insuficiente).\n";
                } else {
                    echo "Venda realizada! Total: R$ " . number_format($venda->getTotal(), 2, ',', '.') . "\n";
                }
            } else {
                break;
            }
        }
    } else {
        echo "Saindo...\n";
        break;
    }
}
