<?php

namespace App\Entity;

use DateTimeImmutable;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;
use Doctrine\ORM\Mapping\MappedSuperclass;

#[MappedSuperclass]
#[HasLifecycleCallbacks]
abstract class AbstractEntity
{

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::INTEGER, nullable: true, options: ['default' => 0])]
    private ?int $recordState = 0;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE)]
    private DateTimeImmutable $createdAt;


    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    #[ORM\PrePersist] // This attribute calls the method before the entity is first persisted
    public function onPrePersist(): void
    {
        $this->createdAt = new DateTimeImmutable();
    }
    public function getId(): ?int
    {
        return $this->id;
    }


    public function getRecordState(): ?int
    {
        return $this->recordState;
    }

    public function setRecordState(?int $recordState): self
    {
        $this->recordState = $recordState;
        return $this;
    }


}
