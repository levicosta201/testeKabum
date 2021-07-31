<?php

use App\Controller\AddressController;
use App\Controller\Controller;
use App\Model\Address;
use App\Model\Client;
use App\Repositories\AddressRepository;
use App\Repositories\ClientRepository;
use App\Services\AddressService;
use App\Services\ClientService;
use Illuminate\Contracts\View\View;
use Jenssegers\Blade\Blade;

class ClientsControllerTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var \Mockery\Mock
     */
    protected $baseControllerMock;

    /**
     * @var \Mockery\Mock
     */
    protected $addressControllerMock;

    /**
     * @var \Mockery\Mock
     */
    protected $bladeMock;

    /**
     * @var \Mockery\Mock
     */
    protected $viewMock;

    /**
     * @var \Mockery\Mock
     */
    protected $addressServiceMock;

    /**
     * @var \Mockery\Mock
     */
    protected $addressRepositoryMock;

    /**
     * @var \Mockery\Mock
     */
    protected $clientServiceMock;

    /**
     * @var \Mockery\Mock
     */
    protected $clientRepositoryMock;

    /**
     * @var \Mockery\Mock
     */
    protected $clientModelMock;

    /**
     * @var \Mockery\Mock
     */
    protected $addressModelMock;

    /**
     * @var \Mockery\Mock
     */
    protected $dbConnectionMock;

    /**
     * @var \Mockery\Mock
     */
    protected $clientControllerMock;

    protected function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub

        $this->dbConnectionMock = Mockery::mock(\App\Model\Connection::class)
            ->makePartial();

        $this->baseControllerMock = Mockery::mock(Controller::class)
            ->makePartial();

        $this->addressModelMock = Mockery::mock(Address::class)
            ->makePartial();

        $this->bladeMock = Mockery::mock(Blade::class)
            ->makePartial();

        $this->viewMock = Mockery::mock(View::class)
            ->makePartial();

        $this->clientModelMock = Mockery::mock(Client::class)
            ->makePartial();

        $this->addressRepositoryMock = Mockery::mock(AddressRepository::class, [
            $this->addressModelMock,
            $this->clientModelMock
        ])
            ->makePartial();

        $this->addressServiceMock = Mockery::mock(AddressService::class, [
            $this->addressRepositoryMock
        ])
            ->makePartial();

        $this->clientRepositoryMock = Mockery::mock(ClientRepository::class, [
            $this->clientModelMock
        ])
            ->makePartial();

        $this->clientServiceMock = Mockery::mock(ClientService::class, [
            $this->clientRepositoryMock
        ])
            ->makePartial();

        $this->addressControllerMock = Mockery::mock(AddressController::class, [
            $this->addressServiceMock,
            $this->clientServiceMock
        ])
            ->makePartial();

        $this->clientControllerMock = Mockery::mock(\App\Controller\ClientsController::class, [
            $this->clientServiceMock,
            $this->addressServiceMock
        ])
            ->makePartial();

        $this->mockView();
        $this->mockDb();
    }

    protected function mockView()
    {
        $this->viewMock->shouldReceive('with')
            ->andReturn($this->viewMock);

        $this->bladeMock->shouldReceive('make')
            ->andReturn($this->viewMock);
    }

    protected function mockDb()
    {
        $this->addressModelMock->db = $this->dbConnectionMock;
        $this->clientModelMock->db = $this->dbConnectionMock;

        $this->dbConnectionMock->shouldReceive('select')
            ->andReturn($this->dbConnectionMock);

        $this->dbConnectionMock->shouldReceive('join')
            ->andReturn($this->dbConnectionMock);

        $this->dbConnectionMock->shouldReceive('from')
            ->andReturn($this->dbConnectionMock);

        $this->dbConnectionMock->shouldReceive('execute')
            ->andReturn($this->dbConnectionMock);

        $this->dbConnectionMock->shouldReceive('fetchAll')
            ->andReturn($this->dbConnectionMock);
    }

    public function testIndex()
    {
        $this->clientControllerMock->blade = $this->bladeMock;
        $renderView = $this->clientControllerMock->index(collect(['*']));
        $this->assertInstanceOf(View::class, $renderView);
    }

    public function testAdd()
    {
        $this->clientControllerMock->blade = $this->bladeMock;
        $renderView = $this->clientControllerMock->add(collect(['*']));
        $this->assertInstanceOf(View::class, $renderView);
    }

    public function testEdit()
    {
        $this->clientControllerMock->blade = $this->bladeMock;
        $renderView = $this->clientControllerMock->add(collect(['*']));
        $this->assertInstanceOf(View::class, $renderView);
    }
}