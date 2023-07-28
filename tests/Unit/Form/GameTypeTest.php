<?php

namespace App\Tests\Unit\Form;

use App\Form\GameType;
use Symfony\Component\Form\Test\TypeTestCase;
use Symfony\Component\Form\FormBuilderInterface;

class GameTypeTest extends TypeTestCase
{
    public function testBuildForm(): void
    {
        $builder = $this->createMock(FormBuilderInterface::class);

        $builder->expects($this->once())
            ->method('add')
            ->with($this->equalTo('name'));

        $form = new GameType();
        $form->buildForm($builder, []);
    }
}
