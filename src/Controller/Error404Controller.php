<?php

declare(strict_types=1);

namespace Alura\Mvc\Controller;

use Alura\Mvc\Entity\Video;
use Alura\Mvc\Repository\VideoRepository;
use PDO;

class Error404Controller implements Controller
{
  public function __construct(private VideoRepository $videoRepository)
  {
  }
  public function processaRequisicao(): void
  {
    http_response_code(404);
  }
}