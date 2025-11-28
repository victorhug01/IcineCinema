<?php
declare(strict_types=1);

namespace Icine\Sistema;

class Sessao
{
    private string $id;
    private Filme $filme;
    private Sala $sala;
    private \DateTimeImmutable $horario;
    private array $ingressos = [];

    public function __construct(string $id, Filme $filme, Sala $sala, \DateTimeImmutable $horario) {
        $this->setId($id);
        $this->setFilme($filme);
        $this->setSala($sala);
        $this->setHorario($horario);
    }

    public function getId(): string {
        return $this->id;
    }

    public function getFilme(): Filme {
        return $this->filme;
    }

    public function getSala(): Sala {
        return $this->sala;
    }

    public function getHorario(): \DateTimeImmutable {
        return $this->horario;
    }

    public function adicionarIngresso(Ingresso $ingresso): void {
        $this->ingressos[$ingresso->getNumero()] = $ingresso;
    }

    public function getIngressos(): array {
        return array_values($this->ingressos);
    }

    public function isLotada(): bool {
        return count($this->ingressos) >= $this->sala->getCapacidade();
    }


    private function setId(string $id) : void {
        $this->id = $id;
    }

    private function setFilme(Filme $filme) : void {
        $this->filme = $filme;
    }

    private function setSala(Sala $sala) : void {
        $this->sala = $sala;
    }

    private function setHorario(\DateTimeImmutable $horario) : void {
        $this->horario = $horario;
    }


}
