<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ComplaintStatusFixture
 */
class ComplaintStatusFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public string $table = 'complaint_status';
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'status_id' => 1,
                'complaint_id' => 1,
                'department_section' => 1,
                'old_status' => 'Lorem ipsum dolor sit amet',
                'new_status' => 'Lorem ipsum dolor sit amet',
                'changed_by_staff_id' => 1,
                'remarks' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'changed_at' => 1768755081,
            ],
        ];
        parent::init();
    }
}
