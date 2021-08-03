<?php

namespace App\Domains\Qualification\Services;

use App\Domains\Qualification\Events\QualificationCreated;
// use App\Domains\Auth\Events\User\UserDeleted;
// use App\Domains\Auth\Events\User\UserDestroyed;
// use App\Domains\Auth\Events\User\UserRestored;
// use App\Domains\Auth\Events\User\UserStatusChanged;
// use App\Domains\Auth\Events\User\UserUpdated;
use App\Domains\Qualification\Models\Qualification;
use App\Exceptions\GeneralException;
use App\Services\BaseService;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

/**
 * Class UserService.
 */
class QualificationService extends BaseService
{
    /**
     * QualificationService constructor.
     *
     * @param  Qualification  $qualification
     */
    public function __construct(Qualification $qualification)
    {
        $this->model = $qualification;
    }

    /**
     * @param $type
     * @param  bool|int  $perPage
     *
     * @return mixed
     */
    public function getByType($type, $perPage = false)
    {
        if (is_numeric($perPage)) {
            return $this->model::byType($type)->paginate($perPage);
        }

        return $this->model::byType($type)->get();
    }

    /**
     * @param  array  $data
     *
     * @return mixed
     * @throws GeneralException
     */
    // public function registerQualification(array $data = []): Qualification
    // {
    //     DB::beginTransaction();

    //     try {
    //         $qualification = $this->createQualification($data);
    //     } catch (Exception $e) {
    //         DB::rollBack();

    //         throw new GeneralException(__('There was a problem creating your qualification.'));
    //     }

    //     DB::commit();

    //     return $qualification;
    // }


    /**
     * @param  array  $data
     *
     * @return Qualification
     * @throws GeneralException
     * @throws \Throwable
     */
    public function store(array $data = []): Qualification
    {
        DB::beginTransaction();

        try {
            $qualification = $this->createQualification([
                'title' => $data['title'],               
            ]);

            // $user->syncRoles($data['roles'] ?? []);

            // if (! config('boilerplate.access.user.only_roles')) {
            //     $user->syncPermissions($data['permissions'] ?? []);
            // }
        } catch (Exception $e) {
            DB::rollBack();

            throw new GeneralException(__('There was a problem creating this qualification. Please try again.'));
        }

        event(new QualificationCreated($qualification));

        DB::commit();

        // They didn't want to auto verify the email, but do they want to send the confirmation email to do so?
        // if (! isset($data['email_verified']) && isset($data['send_confirmation_email']) && $data['send_confirmation_email'] === '1') {
        //     $user->sendEmailVerificationNotification();
        // }

        return $qualification;
    }
    protected function createQualification(array $data = []): Qualification
    {
        return $this->model::create([
            'title' => $data['title'] ?? null,            
        ]);
    }
    /**
     * @param  Qualification  $qualification
     * @param  array  $data
     *
     * @return Qualification
     * @throws \Throwable
     */
    // public function update(User $user, array $data = []): User
    // {
    //     DB::beginTransaction();

    //     try {
    //         $user->update([
    //             'type' => $user->isMasterAdmin() ? $this->model::TYPE_ADMIN : $data['type'] ?? $user->type,
    //             'name' => $data['name'],
    //             'email' => $data['email'],
    //         ]);

    //         if (! $user->isMasterAdmin()) {
    //             // Replace selected roles/permissions
    //             $user->syncRoles($data['roles'] ?? []);

    //             if (! config('boilerplate.access.user.only_roles')) {
    //                 $user->syncPermissions($data['permissions'] ?? []);
    //             }
    //         }
    //     } catch (Exception $e) {
    //         DB::rollBack();

    //         throw new GeneralException(__('There was a problem updating this user. Please try again.'));
    //     }

    //     event(new UserUpdated($user));

    //     DB::commit();

    //     return $user;
    // }

    // /**
    //  * @param  User  $user
    //  * @param  array  $data
    //  *
    //  * @return User
    //  */
    // public function updateProfile(User $user, array $data = []): User
    // {
    //     $user->name = $data['name'] ?? null;

    //     if ($user->canChangeEmail() && $user->email !== $data['email']) {
    //         $user->email = $data['email'];
    //         $user->email_verified_at = null;
    //         $user->sendEmailVerificationNotification();
    //         session()->flash('resent', true);
    //     }

    //     return tap($user)->save();
    // }

    // /**
    //  * @param  User  $user
    //  * @param $data
    //  * @param  bool  $expired
    //  *
    //  * @return User
    //  * @throws \Throwable
    //  */
    // public function updatePassword(User $user, $data, $expired = false): User
    // {
    //     if (isset($data['current_password'])) {
    //         throw_if(
    //             ! Hash::check($data['current_password'], $user->password),
    //             new GeneralException(__('That is not your old password.'))
    //         );
    //     }

    //     // Reset the expiration clock
    //     if ($expired) {
    //         $user->password_changed_at = now();
    //     }

    //     $user->password = $data['password'];

    //     return tap($user)->update();
    // }

    // /**
    //  * @param  User  $user
    //  * @param $status
    //  *
    //  * @return User
    //  * @throws GeneralException
    //  */
    // public function mark(User $user, $status): User
    // {
    //     if ($status === 0 && auth()->id() === $user->id) {
    //         throw new GeneralException(__('You can not do that to yourself.'));
    //     }

    //     if ($status === 0 && $user->isMasterAdmin()) {
    //         throw new GeneralException(__('You can not deactivate the administrator account.'));
    //     }

    //     $user->active = $status;

    //     if ($user->save()) {
    //         event(new UserStatusChanged($user, $status));

    //         return $user;
    //     }

    //     throw new GeneralException(__('There was a problem updating this user. Please try again.'));
    // }

    // /**
    //  * @param  User  $user
    //  *
    //  * @return User
    //  * @throws GeneralException
    //  */
    // public function delete(User $user): User
    // {
    //     if ($user->id === auth()->id()) {
    //         throw new GeneralException(__('You can not delete yourself.'));
    //     }

    //     if ($this->deleteById($user->id)) {
    //         event(new UserDeleted($user));

    //         return $user;
    //     }

    //     throw new GeneralException('There was a problem deleting this user. Please try again.');
    // }

    // /**
    //  * @param User $user
    //  *
    //  * @throws GeneralException
    //  * @return User
    //  */
    // public function restore(User $user): User
    // {
    //     if ($user->restore()) {
    //         event(new UserRestored($user));

    //         return $user;
    //     }

    //     throw new GeneralException(__('There was a problem restoring this user. Please try again.'));
    // }

    // /**
    //  * @param  User  $user
    //  *
    //  * @return bool
    //  * @throws GeneralException
    //  */
    // public function destroy(User $user): bool
    // {
    //     if ($user->forceDelete()) {
    //         event(new UserDestroyed($user));

    //         return true;
    //     }

    //     throw new GeneralException(__('There was a problem permanently deleting this user. Please try again.'));
    // }

    // /**
    //  * @param  array  $data
    //  *
    //  * @return User
    //  */
    // 
}
