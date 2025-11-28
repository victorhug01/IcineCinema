<?php

declare(strict_types=1);

namespace Icine\Sistema;

class Estoque
{
    private array $itens = [];

    public function cadastrarProduto(Produto $produto, int $quantidade = 0): void
    {
        $this->itens[$produto->getCodigo()] = new ItemEstoque($produto, $quantidade);
    }

    public function editarProduto(string $codigo, array $dados): bool
    {
        $item = $this->itens[$codigo] ?? null;
        if ($item === null) return false;
        $produto = $item->getProduto();
        if (isset($dados['nome'])) $produto->setNome((string) $dados['nome']);
        if (isset($dados['preco'])) $produto->setPreco((float) $dados['preco']);
        if (isset($dados['quantidade'])) $item->setQuantidade((int) $dados['quantidade']);
        return true;
    }

    public function removerProduto(string $codigo): bool
    {
        if (!isset($this->itens[$codigo])) return false;
        unset($this->itens[$codigo]);
        return true;
    }

    public function listarProdutos(): array
    {
        return array_values($this->itens);
    }

    public function obterProduto(string $codigo): ?ItemEstoque
    {
        return $this->itens[$codigo] ?? null;
    }

    public function reduzirQuantidade(string $codigo, int $q): bool
    {
        $item = $this->obterProduto($codigo);
        if ($item === null) return false;
        return $item->reduzir($q);
    }
}
