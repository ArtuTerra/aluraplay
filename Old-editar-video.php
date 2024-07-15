<?php
use Alura\Mvc\Repository\VideoRepository;
use Alura\Mvc\Entity\Video;

$dbPath = __DIR__ . '/banco.sqlite';
$pdo = new PDO("sqlite:$dbPath");

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if ($id === false && $id !== null) {
  header('Location: /?sucesso=0');
  exit();
}

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

$repository = new VideoRepository($pdo);
$video = new Video($url, $titulo);
$video->setId($id);

if ($repository = $repository->update($video) === false) {
  header('Location: /?sucesso=0');
} else {
  header('Location: /?sucesso=1');
}
