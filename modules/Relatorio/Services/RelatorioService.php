<?php

namespace Modules\Relatorio\Services;

use Modules\Relatorio\Repositories\Interfaces\RelatorioRepositoryInterface;
use Modules\Relatorio\Services\Interfaces\RelatorioServiceInterface;

class RelatorioService implements RelatorioServiceInterface
{

    protected $relatorioRepository;

    public function __construct(RelatorioRepositoryInterface $relatorioRepository)
    {
        $this->relatorioRepository = $relatorioRepository;
    }

    public function list()
    {
        return $this->relatorioRepository->all();
    }

}
