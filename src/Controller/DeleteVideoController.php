<?php

declare(strict_types=1);

namespace Alura\Mvc\Controller;

use Alura\Mvc\Entity\Video;
use Alura\Mvc\Repository\VideoRepository;
use PDO;

class DeleteVideoController implements Controller
{
  public function __construct(private VideoRepository $videoRepository)
  {
  }
  public function processaRequisicao(): void
  {
    $id = intval($_GET['id']);

    $sucesso = $this->videoRepository->remove($id);

    if ($sucesso === false) {
      header('Location: /?sucesso=0');
    } else {
      header('Location: /?sucesso=1');
    }

  }
}