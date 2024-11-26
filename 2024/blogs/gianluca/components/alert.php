<?php
function showAlert($message, $type = 'error') {
    $bgColor = $type === 'error' ? 'bg-red-500/10' : 'bg-green-500/10';
    $borderColor = $type === 'error' ? 'border-red-500' : 'border-green-500';
    $textColor = $type === 'error' ? 'text-red-500' : 'text-green-500';
    $icon = $type === 'error' ? 'x-circle' : 'check-circle';

    return <<<HTML
    <div class="fixed top-4 right-4 z-50 animate-fade-in" id="custom-alert">
        <div class="$bgColor $borderColor border rounded-lg shadow-lg p-4 max-w-md flex items-center">
            <svg class="w-5 h-5 $textColor mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                {$getIcon($icon)}
            </svg>
            <p class="$textColor flex-1">{$message}</p>
            <button onclick="this.parentElement.remove()" class="ml-4 $textColor hover:opacity-75">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    </div>
    HTML;
}

function getIcon($type) {
    switch ($type) {
        case 'x-circle':
            return '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>';
        case 'check-circle':
            return '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>';
        default:
            return '';
    }
}
?>

<style>
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-1rem); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in {
        animation: fadeIn 0.3s ease-out forwards;
    }
</style>