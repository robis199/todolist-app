<?php

namespace App\Models;

use Carbon\Carbon;

class Task
{
    private string $title;
    private string $id;
    private string $status;
    private string $creationTime;


    public const STATUS_STARTED = 'started';
    public const STATUS_FINISHED = 'finished';

    private const STATUS = [
        self::STATUS_STARTED,
        self::STATUS_FINISHED,
    ];

    public function __construct(
        string $id,
        string $title,
        ?string $status = null,
        ?string $creationTime = null
    )
    {
        $this->title = $title;
        $this->id = $id;
        $this->setStatus($status ?? Task::STATUS_STARTED);
        $this->creationTime = $creationTime ?? Carbon::now();
    }


    public function getId(): string
    {
        return $this->id;
    }



    public function getTitle(): string
    {
        return $this->title;
    }



    public function getStatus(): string
    {
        return $this->status;
    }


    public function getCreationTime()
    {
        return $this->creationTime;
    }


    public function setStatus(string $status): void
    {

        if (!in_array($status, self::STATUS))
        {
            return;


    }
        $this->status = $status;


}

public function toArray(): array
{
    return [
        'id'=> $this->getId(),
        'title'=> $this->getTitle(),
        'status'=> $this->getStatus(),
        'time'=> $this->getCreationTime(),

    ];
}

}