<?php

namespace App\Entity\ZayEntity;

use App\Entity\AbstractEntity;
use App\Repository\ZayRepository\UserContactRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'user_contact')]
#[ORM\Entity(repositoryClass:UserContactRepository::class)]
class UserContact extends AbstractEntity
{
    #[ORM\Column(nullable: true)]
    private ?string $name = null;

    #[ORM\Column(nullable: true)]
    private ?string $email = null;

    #[ORM\Column(nullable: true)]
    private ?string $subject = null;
    #[ORM\Column(nullable: true)]
    private ?string $message = null;


    public function getName(): ?string
    {
        return $this->name;
    }
    public function setName(?string $name): self
    {
        $this->name = $name;
        return $this;
    }
    public function getEmail(): ?string
    {
        return $this->email;
    }
    public function setEmail(?string $email): self
    {
        $this->email = $email;
        return $this;
    }
    public function getSubject(): ?string
    {
        return $this->subject;
    }
    public function setSubject(?string $subject): self
    {
        $this->subject = $subject;
        return $this;
    }
    public function getMessage(): ?string
    {
        return $this->message;
    }
    public function setMessage(?string $message): self
    {
        $this->message = $message;
        return $this;
    }
}
