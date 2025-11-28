<?php

declare(strict_types=1);

namespace Icine\Sistema;

class Bomboniere
{
    private Estoque $estoque;
    private array $vendas = [];

    public function __construct(Estoque $estoque) {
        $this->setEstoque($estoque);
    }

    public function cadastrarProduto(Produto $produto, int $quantidade = 0): void {
        $this->estoque->cadastrarProduto($produto, $quantidade);
    }

    public function editarProduto(string $codigo, array $dados): bool {
        return $this->estoque->editarProduto($codigo, $dados);
    }

    public function excluirProduto(string $codigo): bool {
        return $this->estoque->removerProduto($codigo);
    }

    public function listarProdutos(): array {
        return $this->estoque->listarProdutos();
    }

    public function vender(string $codigo, int $quantidade): ?Venda {
        $item = $this->estoque->obterProduto($codigo);
        if ($item === null) return null;
        if ($item->getQuantidade() < $quantidade) return null;
        $produto = $item->getProduto();
        $ok = $item->reduzir($quantidade);
        if (!$ok) return null;
        $v = new Venda($produto, $quantidade);
        $this->vendas[$v->getId()] = $v;
        return $v;
    }

    public function getVendas(): array {
        return array_values($this->vendas);
    }

    private function setEstoque(Estoque $estoque) : void {
        $this->estoque = $estoque;
    }
}
