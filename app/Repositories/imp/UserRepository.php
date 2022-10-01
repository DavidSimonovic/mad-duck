<?php

namespace App\Repositories\imp;

use App\Models\User;
use App\Repositories\BaseRepositoryInterface;
use Illuminate\Support\Facades\Hash;

/**
 *
 */
class UserRepository extends BaseRepository implements BaseRepositoryInterface
{

    /**
     * @param User $model
     */
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    /**
     * @param string $email
     * @return mixed
     */
    public function userByEmail(string $email): mixed
    {
        return $this->model->whereEmail($email)->first(); // Shorter version of  $this->model->where('email', $email)->first();
    }

    /**
     * @param string $username
     * @return mixed
     */
    public function userByUsername(string $username): mixed
    {
        return $this->model->whereUsername($username)->first(); // Shorter version of  $this->model->where('username',$username)->first();
    }

    /**
     * @param $request
     * @return mixed
     */
    public function registration($request): mixed
    {
        return $this->model::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
    }
}
