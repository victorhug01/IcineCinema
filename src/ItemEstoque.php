<?php

declare(strict_types=1);

namespace Icine\Sistema;

class ItemEstoque
{
    private Produto $produto;
    private int $quantidade;

    public function __construct(Produto $produto, int $quantidade = 0)
    {
        $this->produto = $produto;
        $this->setQuantidade($quantidade);
    }

    public function getProduto(): Produto
    {
        return $this->produto;
    }

    public function getQuantidade(): int
    {
        return $this->quantidade;
    }

    public function setQuantidade(int $q): void
    {
        if ($q < 0) {
            $q = 0;
        }
        $this->quantidade = $q;
    }

    public function aumentar(int $q): void
    {
        $this->setQuantidade($this->quantidade + $q);
    }

    public function reduzir(int $q): bool
    {
        if ($q <= 0) return false;
        if ($this->quantidade < $q) return false;
        $this->setQuantidade($this->quantidade - $q);
        return true;
    }
}
