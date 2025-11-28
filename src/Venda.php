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

    public function __construct(Produto $produto, int $quantidade) {
        $this->id = uniqid('venda_');
        $this->setProduto($produto);
        $this->setQuantidade($quantidade);
        $this->setData(new \DateTimeImmutable());
        $this->setTotal(round($produto->calcularPreco() * $quantidade, 2));
    }

    public function getId(): string {
        return $this->id;
    }

    public function getProduto(): Produto {
        return $this->produto;
    }

    public function getQuantidade(): int {
        return $this->quantidade;
    }

    public function getTotal(): float {
        return $this->total;
    }

    public function getData(): \DateTimeImmutable {
        return $this->data;
    }

    private function setProduto(Produto $produto) : void {
        $this->produto = $produto;
    }

    private function setQuantidade(int $quantidade) : void {
        $this->quantidade = $quantidade;
    }

    private function setData(\DateTimeImmutable $data) : void {
        $this->data = $data;
    }

    private function setTotal(float $total) : void {
        $this->total = $total;
    }
}
