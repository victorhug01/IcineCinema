<?php

declare(strict_types=1);

namespace Icine\Sistema;

class Comida extends Produto
{
    private ?string $tipo;

    public function __construct(string $codigo, string $nome, float $preco, ?string $tipo = null)
    {
        parent::__construct($codigo, $nome, $preco);
        $this->tipo = $tipo;
    }

    public function getTipo(): ?string
    {
        return $this->tipo;
    }

    public function setTipo(?string $tipo): void
    {
        $this->tipo = $tipo;
    }

    public function descricao(): string
    {
        return sprintf("Comida: %s (%s)", $this->getNome(), $this->tipo ?? 'geral');
    }

    // Exemplo de polimorfismo: comidas podem ter desconto fixo
    public function calcularPreco(): float
    {
        $preco = parent::calcularPreco();
        // desconto simbólico de 5% para comidas
        return round($preco * 0.95, 2);
    }
}
