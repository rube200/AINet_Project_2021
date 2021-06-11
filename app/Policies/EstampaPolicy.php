<?php

namespace App\Policies;

use App\Models\Estampa;
use App\Models\User;

class EstampaPolicy extends FuncionarioPolicy
{
    public function view(?User $user, Estampa $estampa): bool
    {
        if ($this->isFuncionario(optional($user)))
            return true;

        if (is_null($estampa->cliente_id))
            return true;

        return optional($user)->id == $estampa->cliente_id;
    }
}
