<?php

namespace App\Twig\Components;

use Symfony\Bundle\SecurityBundle\Security;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\ExposeInTemplate;

#[AsTwigComponent]
final class Alert
{
    public string $type = 'info';
    public string $message = 'Ceci est un message.';

    #[ExposeInTemplate]
    private string $icon = 'fas fa-info';

    public function __construct(
        public readonly Security $security
    )
    {
    }

    public function mount(): void
    {
        if($this->security->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            $this->type = 'success';
            $this->message = 'Connecter avec succes.';
        }else{
            $this->type = 'danger';
            $this->message = 'Erreur de connexion.';
        }

    }

    public function getBootstrapClass(): string
    {
        return sprintf('alert alert-%s', $this->type);
    }

    public function getIcon(): string{
        return $this->icon;
    }

}
