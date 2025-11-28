<?php

declare(strict_types=1);

namespace Icine\Sistema;

class Bebida extends Produto
{
    private float $volume;
    private bool $alcoolica;

    public function __construct(string $codigo, string $nome, float $preco, float $volume = 0.0, bool $alcoolica = false)
    {
        parent::__construct($codigo, $nome, $preco);
        $this->volume = $volume;
        $this->alcoolica = $alcoolica;
    }

    public function getVolume(): float
    {
        return $this->volume;
    }

    public function isAlcoolica(): bool
    {
        return $this->alcoolica;
    }

    public function descricao(): string
    {
        $alc = $this->alcoolica ? 'alcoólica' : 'não alcoólica';
        return sprintf("Bebida: %s (%.0fml, %s)", $this->getNome(), $this->volume, $alc);
    }

    public function calcularPreco(): float
    {
        $preco = parent::calcularPreco();
        if ($this->alcoolica) {
            $preco = round($preco * 1.10, 2);
        }
        return $preco;
    }
}
