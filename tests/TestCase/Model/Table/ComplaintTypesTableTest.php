<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ComplaintTypesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ComplaintTypesTable Test Case
 */
class ComplaintTypesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ComplaintTypesTable
     */
    protected $ComplaintTypes;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected array $fixtures = [
        'app.ComplaintTypes',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('ComplaintTypes') ? [] : ['className' => ComplaintTypesTable::class];
        $this->ComplaintTypes = $this->getTableLocator()->get('ComplaintTypes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->ComplaintTypes);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @link \App\Model\Table\ComplaintTypesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
