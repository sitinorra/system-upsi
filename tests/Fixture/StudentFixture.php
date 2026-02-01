<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * StudentFixture
 */
class StudentFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public string $table = 'student';
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'student_id' => 1,
                'user_id' => 1,
                'full_name' => 'Lorem ipsum dolor sit amet',
                'no_student' => 'Lorem ipsum dolor sit amet',
                'gender' => 'Lorem ipsum dolor sit amet',
                'semester' => 'Lorem ipsum dolor sit amet',
                'address_1' => 'Lorem ipsum dolor sit amet',
                'address_2' => 'Lorem ipsum dolor sit amet',
                'posscode' => 'Lorem ip',
                'state' => 'Lorem ipsum dolor sit amet',
                'phone_number' => 'Lorem ipsum dolor ',
                'email_address' => 'Lorem ipsum dolor sit amet',
                'created_at' => 1768755173,
            ],
        ];
        parent::init();
    }
}
