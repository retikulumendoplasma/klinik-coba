<?php

namespace App\Policies;

use App\Models\akun_user;
use App\Models\tender;
use Illuminate\Auth\Access\HandlesAuthorization;

class TenderPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\akun_user  $akunUser
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(akun_user $akunUser)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\akun_user  $akunUser
     * @param  \App\Models\tender  $tender
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(akun_user $akunUser, tender $tender)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\akun_user  $akunUser
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(akun_user $akunUser)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\akun_user  $akunUser
     * @param  \App\Models\tender  $tender
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(akun_user $akunUser, tender $tender)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\akun_user  $akunUser
     * @param  \App\Models\tender  $tender
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(akun_user $akunUser, tender $tender)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\akun_user  $akunUser
     * @param  \App\Models\tender  $tender
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(akun_user $akunUser, tender $tender)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\akun_user  $akunUser
     * @param  \App\Models\tender  $tender
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(akun_user $akunUser, tender $tender)
    {
        //
    }
}
