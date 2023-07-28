<?php

namespace App\Tests\Unit\Form;

use App\Form\ScoreType;
use Symfony\Component\Form\Test\TypeTestCase;
use Symfony\Component\Form\FormBuilderInterface;

class ScoreTypeTest extends TypeTestCase
{
    public function testBuildForm(): void
    {
        $builder = $this->createMock(FormBuilderInterface::class);

        $builder->expects($this->exactly(4))
            ->method('add')
            ->withConsecutive(
                [$this->equalTo('totallPoints')],
                [$this->equalTo('numberKills')],
                [$this->equalTo('numberDeaths')],
                [$this->equalTo('numberAssists')]
            );

        $form = new ScoreType();
        $form->buildForm($builder, []);
    }
}
