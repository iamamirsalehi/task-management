<?php

namespace App\Application\QueryHandler;

use App\Application\Query\GetBoardTasksQuery;
use App\Domain\Exception\BoardException;
use App\Domain\Persistence\Repository\BoardRepository;
use App\Domain\Persistence\Repository\TaskRepository;
use Illuminate\Support\Collection;

final readonly class GetBoardTasksQueryHandler
{
    public function __construct(
        private BoardRepository $boardRepository,
        private TaskRepository  $taskRepository,
    )
    {
    }

    /**
     * @throws BoardException
     */
    public function __invoke(GetBoardTasksQuery $getBoardTasksQuery): Collection
    {
        $board = $this->boardRepository->findByID($getBoardTasksQuery->boardID);
        if (is_null($board)) {
            throw BoardException::invalidID();
        }

        return $this->taskRepository->getAllByUserIDAndBoardID($getBoardTasksQuery->userID, $board->getId());
    }
}
