<?php

declare(strict_types=1);

namespace Icine\Sistema;

class Venda
{
    private string $id;
    private Produto $produto;
    private int $quantidade;
    private float $total;
    private \DateTimeImmutable $data;

    public function __construct(Produto $produto, int $quantidade)
    {
        $this->id = uniqid('venda_');
        $this->produto = $produto;
        $this->quantidade = $quantidade;
        $this->data = new \DateTimeImmutable();
        $this->total = round($produto->calcularPreco() * $quantidade, 2);
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getProduto(): Produto
    {
        return $this->produto;
    }

    public function getQuantidade(): int
    {
        return $this->quantidade;
    }

    public function getTotal(): float
    {
        return $this->total;
    }

    public function getData(): \DateTimeImmutable
    {
        return $this->data;
    }
}
