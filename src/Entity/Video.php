<?php

declare(strict_types=1);

namespace Alura\Mvc\Entity;

class Video
{
  public readonly int $id;
  public readonly string $url;

  public function __construct(
    string $url,
    public readonly string $title,
  ) {
    $this->setUrl($url);
  }

  public function setUrl(string $url): void
  {
    if (filter_var($url, FILTER_VALIDATE_URL) === false) {
      $this->url = 'https://www.youtube.com/embed/G7RgN9ijwE4?si=8CxBkfRbybeiT1Ob';
    } else {
      $this->url = $url;
    }
  }
  public function setId(int $id): void
  {
    $this->id = $id;
  }

}