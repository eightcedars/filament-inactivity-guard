export default function inactivityGuard(livewire, interactionEvents, inactivityTimeout, logoutTimeout) {
    return {
        inactivityTimer: null,
        logoutTimeout: null,

        init() {
            this.resetInactivityTimer();

            // Listen for user interactions
            interactionEvents.forEach(event => {
                window.addEventListener(event, () => this.resetInactivityTimer());
            });

            window.addEventListener('resumeActivities', () => this.resumeActivities());
        },

        resetInactivityTimer() {
            clearTimeout(this.inactivityTimer);
            clearTimeout(this.logoutTimeout);

            this.inactivityTimer = setTimeout(() => {
                this.showInactivityModal();
            }, inactivityTimeout);
        },

        showInactivityModal() {
            this.$dispatch('open-modal', { id: 'inactivityModal' });

            if (!this.logoutTimeout < 1) {
                livewire.$call('logout');

                return;
            }

            this.$dispatch('start-logout-countdown');

            this.logoutTimeout = setTimeout(() => {
                livewire.$call('logout');
            }, logoutTimeout);
        },

        resumeActivities() {
            this.$dispatch('close-modal', { id: 'inactivityModal' });

            this.resetInactivityTimer();
        },
    };
}
