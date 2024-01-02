<?php

namespace Modules\Relatorio\Repositories;

use App\Http\Repositories\BaseRepository;
use Modules\Relatorio\Entities\Relatorio;
use Modules\Relatorio\Repositories\Interfaces\RelatorioRepositoryInterface;

class RelatorioRepository extends BaseRepository implements RelatorioRepositoryInterface
{
    public function __construct(Relatorio $relatorio)
    {
        $this->model = $relatorio;
    }

}
