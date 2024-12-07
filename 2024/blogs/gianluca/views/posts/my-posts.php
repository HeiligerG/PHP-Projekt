<?php
require_once __DIR__ . '/../../includes/config.php';
require_once __DIR__ . '/../../includes/functions.php';
require_once __DIR__ . '/../../models/Post.php';

requireLogin();

$post = new Post();
$posts = $post->getPostsByUserId($_SESSION['user_id']);

include __DIR__ . '/../../layouts/header.php';
?>

    <div class="max-w-7xl mx-auto">
        <div class="mb-8 flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold">Meine Beiträge</h1>
                <p class="text-slate-400">Verwalten Sie Ihre Blog-Beiträge</p>
            </div>
        </div>

        <?php if (empty($posts)): ?>
            <div class="bg-slate-800 rounded-lg shadow-lg p-8 text-center">
                <svg class="w-16 h-16 text-slate-600 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                </svg>
                <h2 class="text-xl font-semibold mb-2">Keine Beiträge vorhanden</h2>
                <p class="text-slate-400 mb-4">Sie haben noch keine Blog-Beiträge erstellt.</p>
                <a href="/PHP-Projekt/2024/blogs/gianluca/posts/create"
                   class="inline-flex items-center px-4 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Ersten Beitrag erstellen
                </a>
            </div>
        <?php else: ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php foreach ($posts as $post): ?>
                    <article class="bg-slate-800 rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300">
                        <?php if ($post['image_url']): ?>
                            <a href="/PHP-Projekt/2024/blogs/gianluca/post/<?php echo $post['id']; ?>"
                               class="block aspect-video overflow-hidden">
                                <img src="<?php echo htmlspecialchars($post['image_url']); ?>"
                                     alt="<?php echo htmlspecialchars($post['title']); ?>"
                                     class="w-full h-full object-cover transition-transform duration-300 hover:scale-105">
                            </a>
                        <?php endif; ?>

                        <div class="p-6">
                            <h2 class="text-xl font-bold mb-2">
                                <a href="/PHP-Projekt/2024/blogs/gianluca/post/<?php echo $post['id']; ?>"
                                   class="hover:text-primary-400 transition-colors">
                                    <?php echo htmlspecialchars($post['title']); ?>
                                </a>
                            </h2>

                            <p class="text-slate-400 mb-4 line-clamp-2">
                                <?php echo htmlspecialchars(truncateText($post['content'], 150)); ?>
                            </p>

                            <div class="flex items-center justify-between text-sm text-slate-500">
                                <div class="flex items-center space-x-4">
                                <span>
                                    <svg class="w-5 h-5 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-4l-4 4z"/>
                                    </svg>
                                    <?php echo $post['comment_count']; ?>
                                </span>
                                </div>
                                <time datetime="<?php echo $post['created_at']; ?>" class="text-slate-500">
                                    <?php echo formatDate($post['created_at']); ?>
                                </time>
                            </div>

                            <div class="mt-4 pt-4 border-t border-slate-700 flex justify-between">
                                <a href="/PHP-Projekt/2024/blogs/gianluca/posts/edit/<?php echo $post['id']; ?>"
                                   class="text-primary-400 hover:text-primary-300 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                    Bearbeiten
                                </a>
                                <button onclick="deletePost(<?php echo $post['id']; ?>)"
                                        class="text-red-400 hover:text-red-300 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                    L&#246;schen
                                </button>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>

    <script>
        function deletePost(postId) {
            if (confirm('M\u00F6chten Sie diesen Beitrag wirklich l\u00F6schen?')) {
                fetch(`/PHP-Projekt/2024/blogs/gianluca/api/posts/${postId}`, {
                    method: 'DELETE',
                    credentials: 'same-origin'
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            location.reload();
                        } else {
                            alert('Beim L\u00F6schen ist ein Fehler aufgetreten.');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Beim L\u00F6schen ist ein Fehler aufgetreten.');
                    });
            }
        }
    </script>

<?php include __DIR__ . '/../../layouts/footer.php'; ?>