<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Actions\Balance\CreateBalanceAction;
use App\Actions\User\CreateUserAction;
use App\Actions\User\Data\CreateUserData;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class AddUser extends Command
{
    protected $signature = 'user:add {login} {password} {--name=}';

    protected $description = 'Добавление пользователя';

    public function __construct(
        private readonly CreateUserAction $createUserAction,
        private readonly CreateBalanceAction $createBalanceAction,
    ) {
        parent::__construct();
    }

    public function handle(): int
    {
        try {
            DB::transaction(function () {
                $user = $this->createUserAction->exec(
                    CreateUserData::validateAndCreate([
                        'name' => $this->option('name') ?? $this->argument('login'),
                        'email' => $this->argument('login'),
                        'password' => $this->argument('password'),
                    ])
                );
                $this->createBalanceAction->exec($user);
            });
        } catch (ValidationException $e) {
            $this->error($e->getMessage());
            $this->error(json_encode($e->errors()));

            return self::FAILURE;
        }

        $this->info('Пользователь добавлен');
        return self::SUCCESS;
    }
}
