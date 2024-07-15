<?php

declare(strict_types=1);

namespace Alura\Mvc\Controller;

use Alura\Mvc\Entity\Video;
use Alura\Mvc\Repository\VideoRepository;
use PDO;

class NewVideoController implements Controller
{
  public function __construct(private VideoRepository $videoRepository)
  {
  }
  public function processaRequisicao(): void
  {
    $url = filter_input(INPUT_POST, 'url', FILTER_VALIDATE_URL);
    if ($url === false) {
      header('Location: /?sucesso=0');
      exit();
    }
    $url = str_replace('watch?v=', 'embed/', $url);

    $titulo = filter_input(INPUT_POST, 'titulo');
    if ($titulo === false) {
      header('Location: /?sucesso=0');
      exit();
    }

    $sucesso = $this->videoRepository->add(new Video($url, $titulo));

    if ($sucesso === false) {
      header('Location:/?sucesso=0');
    } else {
      header('Location:/?sucesso=1');
    }
  }
}