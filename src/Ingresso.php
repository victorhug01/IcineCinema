<?php
declare(strict_types=1);

namespace Icine\Sistema;

class Ingresso
{
    private int $numero;
    private Pessoa $pessoa;
    private Sessao $sessao;
    private float $valor;
    private int $assento;

    public function __construct(int $numero, Pessoa $pessoa, Sessao $sessao, float $valor, int $assento) {
        $this->setNumero($numero);
        $this->setPessoa($pessoa);
        $this->setSessao($sessao);
        $this->setValor($valor);
        $this->setAssento($assento);
    }

    public function getNumero(): int {
        return $this->numero;
    }

    public function getPessoa(): Pessoa {
        return $this->pessoa;
    }

    public function getSessao(): Sessao {
        return $this->sessao;
    }

    public function getValor(): float {
        return $this->valor;
    }

    public function getAssento(): int {
        return $this->assento;
    }

    private function setNumero(int $numero) : void {
        $this->numero = $numero;
    }
    private function setPessoa(Pessoa $pessoa) : void {
        $this->pessoa = $pessoa;
    }

    private function setSessao(Sessao $sessao) : void {
        $this->sessao = $sessao;
    }

    private function setValor(float $valor) : void {
        $this->valor = $valor;
    }

    private function setAssento(int $assento) : void {
        $this->assento = $assento;
    }
}
