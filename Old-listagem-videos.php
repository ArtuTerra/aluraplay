<?php require_once 'inicio-html.php'; ?>

<ul class="videos__container">
    <?php foreach ($videoList as $video): ?>
        <li class="videos__item">
            <iframe width="100%" height="72%" src="<?= $video->url; ?>" title="YouTube video player" frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
            <div class="descricao-video">
                <h2><?= $video->title; ?></h2>
                <div class="acoes-video">
                    <a href="/editar-video?id=<?= $video->id; ?>">Editar</a>
                    <a href="/remover-video?id=<?= $video->id; ?>">Excluir</a>
                </div>
            </div>
        </li>
    <?php endforeach; ?>
</ul>

<?php
$confirmation = $_GET['sucesso'] ?? '';

if ($confirmation === '0') {
    echo "<script>alert('Falha ao realizar ação!');</script>";
} elseif ($confirmation === '1') {
    echo "<script>alert('Ação realizada com sucesso!');</script>";
}
?>

<?php require_once 'fim-html.php'; ?>