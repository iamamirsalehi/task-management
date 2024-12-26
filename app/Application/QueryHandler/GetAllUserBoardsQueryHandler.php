<?php

namespace App\Application\QueryHandler;

use App\Application\Query\GetAllUserBoardsQuery;
use App\Domain\Persistence\Repository\BoardRepository;
use Illuminate\Support\Collection;

final readonly class GetAllUserBoardsQueryHandler
{
    public function __construct(private BoardRepository $boardRepository)
    {
    }

    public function __invoke(GetAllUserBoardsQuery $getAllUserBoardsQuery): Collection
    {
        return $this->boardRepository->getByUserID($getAllUserBoardsQuery->userID);
    }
}
