<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ComplaintTypesFixture
 */
class ComplaintTypesFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'type_id' => 1,
                'type_name' => 'Lorem ipsum dolor sit amet',
            ],
        ];
        parent::init();
    }
}
