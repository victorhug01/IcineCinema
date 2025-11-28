#!/usr/bin/env php
<?php
declare(strict_types=1);



require __DIR__ . '/vendor/autoload.php';

use Icine\Sistema\Cinema;
use Icine\Sistema\Sala;
use Icine\Sistema\Filme;
use Icine\Sistema\Sessao;
use Icine\Sistema\Pessoa;
use Icine\Sistema\Bilheteria;

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

while (true) {
    echo "\n---- Menu ----\n";
    echo "1) Vender ingresso\n2) Mostrar ocupação\n3) Sair\n";
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
    } else {
        echo "Saindo...\n";
        break;
    }
}
