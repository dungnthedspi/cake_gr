<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AgenciesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AgenciesTable Test Case
 */
class AgenciesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\AgenciesTable
     */
    public $Agencies;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.agencies'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Agencies') ? [] : ['className' => 'App\Model\Table\AgenciesTable'];
        $this->Agencies = TableRegistry::get('Agencies', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Agencies);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
