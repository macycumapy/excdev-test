<?php

declare(strict_types=1);

namespace App\Jobs;

use App\Actions\Operation\CreateOperationAction;
use App\Actions\Operation\Data\CreateOperationData;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class PushOperationJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    private CreateOperationAction $createOperationAction;

    public function __construct(private readonly CreateOperationData $data)
    {
        $this->createOperationAction = app(CreateOperationAction::class);
    }

    public function handle(): void
    {
        $this->createOperationAction->exec($this->data);
    }
}
