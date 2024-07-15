<?php

declare(strict_types=1);

namespace Alura\Mvc\Repository;

use Alura\Mvc\Entity\Video;

use PDO;

class VideoRepository
{
  public function __construct(private PDO $pdo)
  {

  }
  public function add(Video $video): video
  {
    $sql = 'INSERT INTO videos (url, title) VALUES (?,?)';
    $statement = $this->pdo->prepare($sql);
    $statement->bindValue(1, $video->url);
    $statement->bindValue(2, $video->title);

    if (!$statement->execute()) {
      $errorInfo = $statement->errorInfo();
      throw new \RuntimeException('Failed to execute query: ' . $errorInfo[2]);
    }

    $id = $this->pdo->lastInsertId();
    $video->setId(intval($id));
    return $video;
  }

  public function remove(int $id): bool
  {
    $sql = 'DELETE FROM videos WHERE id = ?';
    $statement = $this->pdo->prepare($sql);
    $statement->bindValue(1, $id);

    return $statement->execute();
  }

  public function update(Video $video): bool
  {
    $sql = 'UPDATE videos SET url = :url, title = :title WHERE id = :id ';
    $statement = $this->pdo->prepare($sql);
    $statement->bindValue(':url', $video->url);
    $statement->bindValue(':title', $video->title);
    $statement->bindValue(':id', $video->id, PDO::PARAM_INT);

    return $statement->execute();
  }

  /**
   * @return Video[]
   */
  public function all(): array
  {
    $videoList = $this->pdo
      ->query('SELECT * FROM videos;')
      ->fetchALL(PDO::FETCH_ASSOC);
    return array_map(
      $this->arrayToVideo(...),
      $videoList
    );
  }

  public function find(int $id)
  {
    $statement = $this->pdo->prepare('SELECT * FROM videos WHERE id = ?;');
    $statement->bindValue(1, $id, PDO::PARAM_INT);
    $statement->execute();

    $video = $statement->fetch(PDO::FETCH_ASSOC);
    if (empty($video) || empty($video['id'])) {
      header('Location: /?sucesso=0');
    } else {
      return $this->arrayToVideo($video);
    }
  }

  public function arrayToVideo(array $videoData): Video
  {
    if (empty($videoData)) {
      throw new \RuntimeException('Video Data Vazio! Linha não deve existir!');
    } else {
      $video = new Video($videoData['url'], $videoData['title']);
      $video->setId($videoData['id']);

      return $video;
    }
  }
}