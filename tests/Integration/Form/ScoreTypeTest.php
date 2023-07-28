<?php

namespace App\Tests\Integration\Form;

use App\Entity\Score;
use App\Form\ScoreType;
use Symfony\Component\Form\Test\TypeTestCase;

class ScoreTypeTest extends TypeTestCase
{
    public function testSubmitValidData(): void
    {
        $formData = [
            'totallPoints' => 100,
            'numberKills' => 10,
            'numberDeaths' => 5,
            'numberAssists' => 15,
        ];

        $objectToCompare = new Score();
        $form = $this->factory->create(ScoreType::class, $objectToCompare);

        $object = new Score();
        $object->setTotallPoints($formData['totallPoints']);
        $object->setNumberKills($formData['numberKills']);
        $object->setNumberDeaths($formData['numberDeaths']);
        $object->setNumberAssists($formData['numberAssists']);

        // submit the data to the form directly
        $form->submit($formData);

        // This check ensures there are no transformation failures
        $this->assertTrue($form->isSynchronized());

        // Check that the form returns the correct object
        $this->assertEquals($object, $form->getData());

        // Check that the form view data is correct
        $view = $form->createView();
        $children = $view->children;

        foreach (array_keys($formData) as $key) {
            $this->assertArrayHasKey($key, $children);
        }
    }
}
