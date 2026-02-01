<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * DepartmentsFixture
 */
class DepartmentsFixture extends TestFixture
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
                'dept_id' => 1,
                'dept_name' => 'Lorem ipsum dolor sit amet',
                'dept_code' => 'Lorem ipsum dolor ',
                'dept_email' => 'Lorem ipsum dolor sit amet',
            ],
        ];
        parent::init();
    }
}
