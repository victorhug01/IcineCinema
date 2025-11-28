<?php
declare(strict_types=1);

namespace Icine\Sistema;

class Filme
{
    private string $titulo;
    private int $duracaoMinutos;
    private string $classificacao;

    public function __construct(string $titulo, int $duracaoMinutos, string $classificacao) {
        $this->setTitulo($titulo);
        $this->setDuracao($duracaoMinutos);
        $this->setClassificacao($classificacao);
    }

    public function getTitulo(): string {
        return $this->titulo;
    }

    public function getDuracao(): int {
        return $this->duracaoMinutos;
    }

    public function getClassificacao(): string {
        return $this->classificacao;
    }

    private function setTitulo(string $titulo) : void {
        $this->titulo = $titulo;
    }

    private function setDuracao(int $duracaoMinutos) : void {
        $this->duracaoMinutos = $duracaoMinutos;
    }
    private function setClassificacao(string $classificacao) : void {
        $this->classificacao = $classificacao;
    }
}
