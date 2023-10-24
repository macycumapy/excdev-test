<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Actions\Operation\Data\CreateOperationData;
use App\Jobs\PushOperationJob;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Validation\ValidationException;

class PushOperation extends Command
{
    protected $signature = 'operation:push {login} {operation} {sum} {description}';

    protected $description = 'Проведение операции по балансу пользователя';

    public function handle(): int
    {
        $user = User::findByEmail($this->argument('login'));
        if (!$user) {
            $this->error('Пользователь с указанным логином не найден');
            return self::INVALID;
        }

        try {
            PushOperationJob::dispatch(CreateOperationData::validateAndCreate([
                'user' => $user,
                'type' => $this->argument('operation'),
                'sum' => $this->argument('sum'),
                'description' => $this->argument('description')
            ]));
        } catch (ValidationException $e) {
            $this->error($e->getMessage());
            $this->error(json_encode($e->errors()));

            return self::FAILURE;
        }

        $this->info('Операция добавлена в очередь');
        return self::SUCCESS;
    }
}
