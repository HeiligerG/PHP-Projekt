<?php
require_once __DIR__ . '/../../includes/config.php';
require_once __DIR__ . '/../../includes/functions.php';
require_once __DIR__ . '/../../models/BljBlog.php';

$bljBlog = new BljBlog();
$blogs = $bljBlog->getAllBlogs();

include __DIR__ . '/../../layouts/header.php';
?>

<div class="container mx-auto px-2 sm:px-4 py-8">
    <div class="bg-slate-800 rounded-lg shadow-xl p-3 sm:p-6">
        <h1 class="text-2xl sm:text-3xl font-bold mb-6 text-white">
            <span class="inline-block border-b-2 border-primary-500">BLJ-Blogs</span>
        </h1>

        <div class="overflow-x-hidden">
            <div class="inline-block min-w-full">
                <div class="grid grid-cols-1 gap-4 sm:hidden">
                    <?php foreach ($blogs as $blog): ?>
                    <div class="bg-slate-700/30 p-4 rounded-lg">
                        <div class="font-medium text-white mb-1"><?php echo htmlspecialchars($blog['student_name']); ?></div>
                        <div class="text-sm text-slate-300 mb-2">
                            <a href="<?php echo htmlspecialchars($blog['blog_url']); ?>"
                               target="_blank"
                               class="text-primary-400 hover:text-primary-300">
                                Blog öffnen ?
                            </a>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-slate-400">
                                <?php echo htmlspecialchars($blog['class_year']); ?>
                            </span>
                            <?php if ($blog['is_active']): ?>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    <span class="w-1.5 h-1.5 mr-1.5 rounded-full bg-green-600"></span>
                                    Aktiv
                                </span>
                            <?php else: ?>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                    <span class="w-1.5 h-1.5 mr-1.5 rounded-full bg-red-600"></span>
                                    Inaktiv
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>

                <table class="hidden sm:table w-full">
                    <thead>
                        <tr class="bg-slate-700/50">
                            <th class="py-3.5 px-4 text-left text-sm font-semibold text-slate-200">Name</th>
                            <th class="py-3.5 px-4 text-left text-sm font-semibold text-slate-200">URL</th>
                            <th class="py-3.5 px-4 text-left text-sm font-semibold text-slate-200">Jahrgang</th>
                            <th class="py-3.5 px-4 text-left text-sm font-semibold text-slate-200">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-700">
                        <?php foreach ($blogs as $blog): ?>
                        <tr class="hover:bg-slate-700/30 transition-colors">
                            <td class="py-4 px-4 text-sm text-white">
                                <?php echo htmlspecialchars($blog['student_name']); ?>
                            </td>
                            <td class="py-4 px-4 text-sm text-slate-300">
                                <a href="<?php echo htmlspecialchars($blog['blog_url']); ?>"
                                   target="_blank"
                                   class="text-primary-400 hover:text-primary-300 hover:underline">
                                    <?php echo htmlspecialchars($blog['blog_url']); ?>
                                </a>
                            </td>
                            <td class="py-4 px-4 text-sm text-slate-300">
                                <?php echo htmlspecialchars($blog['class_year']); ?>
                            </td>
                            <td class="py-4 px-4 text-sm">
                                <?php if ($blog['is_active']): ?>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        <span class="w-1.5 h-1.5 mr-1.5 rounded-full bg-green-600"></span>
                                        Aktiv
                                    </span>
                                <?php else: ?>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                        <span class="w-1.5 h-1.5 mr-1.5 rounded-full bg-red-600"></span>
                                        Inaktiv
                                    </span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>