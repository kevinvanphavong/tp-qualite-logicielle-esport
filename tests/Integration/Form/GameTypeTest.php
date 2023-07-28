<?php

namespace App\Tests\Integration\Form;

use App\Entity\Game;
use App\Form\GameType;
use Symfony\Component\Form\Test\TypeTestCase;

class GameTypeTest extends TypeTestCase
{
    public function testSubmitValidData(): void
    {
        $formData = [
            'name' => 'Test Game',
        ];

        $objectToCompare = new Game();
        $form = $this->factory->create(GameType::class, $objectToCompare);

        $object = new Game();
        $object->setName($formData['name']);

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
