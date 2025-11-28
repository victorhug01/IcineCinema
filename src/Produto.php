<?php

declare(strict_types=1);

namespace Icine\Sistema;

abstract class Produto
{
    private string $codigo;
    private string $nome;
    private float $preco;

    public function __construct(string $codigo, string $nome, float $preco)
    {
        $this->setCodigo($codigo);
        $this->setNome($nome);
        $this->setPreco($preco);
    }

    public function getCodigo(): string
    {
        return $this->codigo;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function setNome(string $nome): void
    {
        $this->nome = trim($nome);
    }

    public function getPreco(): float
    {
        return $this->preco;
    }

    public function setPreco(float $preco): void
    {
        if ($preco < 0) {
            $preco = 0.0;
        }
        $this->preco = $preco;
    }

    abstract public function descricao(): string;

    public function calcularPreco(): float
    {
        return $this->preco;
    }

    private function setCodigo(string $codigo) : void {
        $this->codigo = $codigo;
    }
}
