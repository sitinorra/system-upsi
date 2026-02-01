<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ComplaintStatusTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ComplaintStatusTable Test Case
 */
class ComplaintStatusTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ComplaintStatusTable
     */
    protected $ComplaintStatus;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected array $fixtures = [
        'app.ComplaintStatus',
        'app.Complaints',
        'app.ChangedByStaffs',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('ComplaintStatus') ? [] : ['className' => ComplaintStatusTable::class];
        $this->ComplaintStatus = $this->getTableLocator()->get('ComplaintStatus', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->ComplaintStatus);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @link \App\Model\Table\ComplaintStatusTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @link \App\Model\Table\ComplaintStatusTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
