<!-- Notification Container -->
<div id="notification-container" class="fixed top-20 right-4 z-50 space-y-2 max-w-md">
    <!-- Notifications will be inserted here by JavaScript -->
</div>

<style>
    .notification {
        animation: slideInRight 0.3s ease-out;
    }

    .notification.removing {
        animation: slideOutRight 0.3s ease-out;
    }

    @keyframes slideInRight {
        from {
            transform: translateX(400px);
            opacity: 0;
        }

        to {
            transform: translateX(0);
            opacity: 1;
        }
    }

    @keyframes slideOutRight {
        from {
            transform: translateX(0);
            opacity: 1;
        }

        to {
            transform: translateX(400px);
            opacity: 0;
        }
    }
</style>

<script>
    // Notification System using Design System Colors
    function showNotification(message, type = 'success', duration = 5000) {
        const container = document.getElementById('notification-container');
        if (!container) return;

        const notification = document.createElement('div');
        notification.className = 'notification';

        // Use CSS variables for colors
        const styles = {
            success: 'background-color: var(--accent); color: white;',
            error: 'background-color: var(--destructive); color: white;',
            warning: 'background-color: var(--accent); color: white;',
            info: 'background-color: var(--accent); color: white;'
        };

        const icons = {
            success: '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>',
            error: '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>',
            warning: '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>',
            info: '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>'
        };

        notification.innerHTML = `
            <div style="${styles[type]} font-family: 'Inter', sans-serif;" class="px-6 py-4 rounded-lg shadow-lg flex items-center gap-3">
                <div class="flex-shrink-0">
                    ${icons[type]}
                </div>
                <div class="flex-1 text-sm font-medium">
                    ${message}
                </div>
                <button onclick="removeNotification(this.parentElement.parentElement)" class="flex-shrink-0 hover:opacity-70 rounded p-1 transition-opacity">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        `;

        container.appendChild(notification);

        // Auto remove after duration
        if (duration > 0) {
            setTimeout(() => removeNotification(notification), duration);
        }
    }

    function removeNotification(notification) {
        notification.classList.add('removing');
        setTimeout(() => notification.remove(), 300);
    }

    // Show Laravel flash messages as notifications
    document.addEventListener('DOMContentLoaded', function () {
        @if(session('success'))
            showNotification("{{ session('success') }}", 'success');
        @endif

        @if(session('error'))
            showNotification("{{ session('error') }}", 'error');
        @endif

        @if(session('warning'))
            showNotification("{{ session('warning') }}", 'warning');
        @endif

        @if(session('info'))
            showNotification("{{ session('info') }}", 'info');
        @endif

        @if($errors->any())
            @foreach($errors->all() as $error)
                showNotification("{{ $error }}", 'error');
            @endforeach
        @endif
    });
</script>