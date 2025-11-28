<?php
declare(strict_types=1);

namespace Icine\Sistema;

class Pessoa {
    private string $nome;
    private ?string $telefone;

    public function __construct(string $nome, ?string $telefone = null) {
        $this->setNome($nome);
        $this->setTelefone($telefone);
    }

    public function getNome(): string {
        return $this->nome;
    }

    public function getTelefone(): ?string {
        return $this->telefone;
    }

    private function setNome(string $nome) : void {
        $this->nome = $nome;
    }

    private function setTelefone(?string $telefone) : void {
        $this->telefone = $telefone;
    }
}
