<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * AttachmentsFixture
 */
class AttachmentsFixture extends TestFixture
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
                'attachment_id' => 1,
                'complaint_id' => 1,
                'file_name' => 'Lorem ipsum dolor sit amet',
                'file_path' => 'Lorem ipsum dolor sit amet',
                'file_type' => 'Lorem ipsum dolor sit amet',
                'upload_date' => 1768754952,
            ],
        ];
        parent::init();
    }
}
