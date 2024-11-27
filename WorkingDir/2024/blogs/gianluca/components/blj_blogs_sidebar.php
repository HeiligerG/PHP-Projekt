<?php
require_once __DIR__ . '/../models/BljBlog.php';

$bljBlog = new BljBlog();
$blogs = $bljBlog->getAllBlogs();
?>

<div class="bg-slate-800 rounded-lg shadow-lg p-6 sticky top-8">
    <h2 class="text-lg font-semibold mb-4 flex items-center">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
        </svg>
        BLJ-Blogs
    </h2>

    <?php if (empty($blogs)): ?>
        <div class="text-center py-8">
            <p class="text-slate-400 text-sm">Keine BLJ-Blogs verfügbar.</p>
        </div>
    <?php else: ?>
        <ul class="space-y-3">
            <?php foreach ($blogs as $blog): ?>
                <li>
                    <a href="<?php echo htmlspecialchars($blog['blog_url']); ?>"
                       target="_blank"
                       class="flex items-center text-slate-300 hover:text-primary-400 transition-colors p-2 rounded-lg hover:bg-slate-700">
                        <div class="w-8 h-8 rounded-full bg-primary-600 flex items-center justify-center mr-3 flex-shrink-0">
                            <?php echo strtoupper(substr($blog['student_name'], 0, 2)); ?>
                        </div>
                        <div class="flex-1">
                            <div class="font-medium"><?php echo htmlspecialchars($blog['student_name']); ?></div>
                            <div class="text-xs text-slate-400">Jahrgang <?php echo htmlspecialchars($blog['class_year']); ?></div>
                        </div>
                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                        </svg>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</div>