<?php
declare(strict_types=1);

namespace Icine\Sistema;

class Cinema
{
    private string $nome;
    private array $salas = [];

    public function __construct(string $nome) {
        $this->setNome($nome);
    }

    public function getNome(): string {
        return $this->nome;
    }

    public function adicionarSala(Sala $sala): void {
        $this->salas[$sala->getNumero()] = $sala;
    }

    public function getSalas(): array {
        return array_values($this->salas);
    }

    public function obterSala(int $numero): ?Sala {
        return $this->salas[$numero] ?? null;
    }

    private function setNome(string $nome) : void {
        $this->nome = $nome;
    }
}
