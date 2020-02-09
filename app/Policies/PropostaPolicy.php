<?php

namespace App\Policies;

use App\Proposta;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PropostaPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any propostas.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the proposta.
     *
     * @param  \App\User  $user
     * @param  \App\Proposta  $proposta
     * @return mixed
     */
    public function view(User $user, Proposta $proposta)
    {
        return $user->id === $proposta->user_id;
    }

    /**
     * Determine whether the user can create propostas.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the proposta.
     *
     * @param  \App\User  $user
     * @param  \App\Proposta  $proposta
     * @return mixed
     */
    public function update(User $user, Proposta $proposta)
    {
        return $user->id === $proposta->user_id;
    }

    /**
     * Determine whether the user can delete the proposta.
     *
     * @param  \App\User  $user
     * @param  \App\Proposta  $proposta
     * @return mixed
     */
    public function delete(User $user, Proposta $proposta)
    {
        return $user->id === $proposta->user_id;
    }

    /**
     * Determine whether the user can restore the proposta.
     *
     * @param  \App\User  $user
     * @param  \App\Proposta  $proposta
     * @return mixed
     */
    public function restore(User $user, Proposta $proposta)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the proposta.
     *
     * @param  \App\User  $user
     * @param  \App\Proposta  $proposta
     * @return mixed
     */
    public function forceDelete(User $user, Proposta $proposta)
    {
        //
    }
}
