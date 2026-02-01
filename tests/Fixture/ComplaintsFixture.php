<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ComplaintsFixture
 */
class ComplaintsFixture extends TestFixture
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
                'complaint_id' => 1,
                'student_id' => 1,
                'complainant_name' => 'Lorem ipsum dolor sit amet',
                'complainant_phone' => 'Lorem ipsum dolor ',
                'complainant_email' => 'Lorem ipsum dolor sit amet',
                'type_id' => 1,
                'category_id' => 1,
                'submission_date' => '2026-01-18',
                'description' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'status' => 'Lorem ipsum dolor sit amet',
                'is_confidential' => 1,
                'created_at' => 1768754966,
            ],
        ];
        parent::init();
    }
}
