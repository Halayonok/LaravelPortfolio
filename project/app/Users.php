<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;

class Users extends Authenticatable
{
    use Notifiable;

    const ROLE_ROOT = 1000;

    const ROLE_ADMIN = 900;

    const ROLE_MEMBER = 800;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'role'
    ];

    /**
     * @return array
     */
    public static function getRoles(): array
    {
        return [
            self::ROLE_ROOT,
            self::ROLE_ADMIN,
            self::ROLE_MEMBER,
        ];
    }

    /**
     * @param Request $request
     * @return bool
     */
    public function builder(Request $request): bool
    {
        $this->name = $request->post('name');
        $this->email = $request->post('email');
        $this->password = isset($password) ? \Hash::make($password) : $this->password;
        $this->role = $request->post('role');

        return $this->save();
    }

    /**
     * @param int $role
     * @return bool
     */
    public function checkRole(int $role): bool
    {
        return (int)$this->role >= (int)$role;
    }

    /**
     * @param $role
     * @return bool
     */
    public static function authUserIsRole($role): bool
    {
        return \Auth::getUser()->checkRole($role);
    }
}
