<?php

namespace App\Tests\Controller;

use App\Twig\Components\Alert;
use PHPUnit\Framework\TestCase;

final class AlertControllerTest extends TestCase
{
    public function testDefaultValues(): void
    {
        $alert = new Alert();

        $this->assertSame('info', $alert->type);
        $this->assertSame('Ceci est un message.', $alert->message);
        $this->assertSame('alert alert-info', $alert->getBootstrapClass());
    }

    public function testCustomValues(): void
    {
        $alert = new Alert();
        $alert->type = 'success';
        $alert->message = 'Bravo !';

        $this->assertSame('alert alert-success', $alert->getBootstrapClass());
    }
}
