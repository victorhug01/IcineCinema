<?php
declare(strict_types=1);

namespace Icine\Sistema;

class Bilheteria
{
    private int $ultimoNumero = 0;

    public function venderIngresso(Pessoa $pessoa, Sessao $sessao, int $assento, float $valor): ?Ingresso {
        $sala = $sessao->getSala();
        if (!$sala->isAssentoDisponivel($assento)) {
            return null;
        }

        if ($sessao->isLotada()) {
            return null;
        }

        $ocupou = $sala->ocuparAssento($assento);
        if (!$ocupou) {
            return null;
        }

        $this->ultimoNumero++;
        $ingresso = new Ingresso($this->ultimoNumero, $pessoa, $sessao, $valor, $assento);
        $sessao->adicionarIngresso($ingresso);
        return $ingresso;
    }
}
