<?php
require_once __DIR__ . '/../../includes/config.php';
require_once __DIR__ . '/../../includes/functions.php';
require_once __DIR__ . '/../../models/Post.php';

$post = new Post();
$posts = $post->getAllPosts();

include __DIR__ . '/../../layouts/header.php';
?>

<div class="max-w-7xl mx-auto">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php if (empty($posts)): ?>
            <div class="col-span-3 flex flex-col items-center justify-center py-12">
                <svg class="w-16 h-16 text-slate-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                </svg>
                <p class="text-slate-400 text-lg">Noch keine Blog-Einträge vorhanden.</p>
                <?php if (isLoggedIn()): ?>
                    <a href="/PHP-Projekt/WorkingDir/2024/blogs/gianluca/posts/create"
                       class="mt-4 px-6 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition-colors">
                        Ersten Beitrag erstellen
                    </a>
                <?php endif; ?>
            </div>
        <?php else: ?>
            <?php foreach ($posts as $post): ?>
                <article class="bg-slate-800 rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                    <?php if ($post['image_url']): ?>
                        <a href="/PHP-Projekt/WorkingDir/2024/blogs/gianluca/post/<?php echo $post['id']; ?>" class="block aspect-video overflow-hidden">
                            <img src="<?php echo htmlspecialchars($post['image_url']); ?>"
                                 alt="<?php echo htmlspecialchars($post['title']); ?>"
                                 class="w-full h-full object-cover transition-transform duration-300 hover:scale-105">
                        </a>
                    <?php endif; ?>

                    <div class="p-6">
                        <h2 class="text-xl font-bold mb-2">
                            <a href="/PHP-Projekt/WorkingDir/2024/blogs/gianluca/post/<?php echo $post['id']; ?>"
                               class="hover:text-primary-400 transition-colors">
                                <?php echo htmlspecialchars($post['title']); ?>
                            </a>
                        </h2>

                        <p class="text-slate-400 mb-4 line-clamp-3">
                            <?php echo htmlspecialchars(substr($post['content'], 0, 150)) . '...'; ?>
                        </p>

                        <div class="flex items-center justify-between text-sm">
                            <div class="flex items-center text-slate-500">
                                <div class="w-6 h-6 rounded-full bg-primary-600 flex items-center justify-center text-white mr-2">
                                    <?php echo getInitials($post['username']); ?>
                                </div>
                                <span><?php echo htmlspecialchars($post['username']); ?></span>
                            </div>
                            <time datetime="<?php echo $post['created_at']; ?>" class="text-slate-500">
                                <?php echo formatDate($post['created_at']); ?>
                            </time>
                        </div>
                    </div>
                </article>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<?php include __DIR__ . '/../../layouts/footer.php'; ?>