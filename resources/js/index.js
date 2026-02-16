export default function inactivityGuard(interactionEvents, inactivityTimeout, logoutTimeout) {
    return {
        inactivityTimer: null,
        logoutTimeout: null,

        init() {
            this.resetInactivityTimer();

            interactionEvents.forEach(event => {
                window.addEventListener(event, () => {
                    // don't reset timer when warning/notice has been shown
                    // let the user explicitly cancel the pending logout
                    if (!this.logoutTimeout) {
                        this.resetInactivityTimer()
                    }
                });
            });

            window.addEventListener('resumeActivities', () => this.resumeActivities());
        },

        resetInactivityTimer() {
            clearTimeout(this.inactivityTimer);
            clearTimeout(this.logoutTimeout);

            this.logoutTimeout = null;

            this.inactivityTimer = setTimeout(() => {
                this.showInactivityModal();
            }, inactivityTimeout);
        },

        showInactivityModal() {
            if (logoutTimeout < 1) {
                this.$wire.$call('logout');

                return;
            }

            this.$dispatch('open-modal', { id: 'inactivityModal' });

            this.$dispatch('start-logout-countdown');

            this.logoutTimeout = setTimeout(() => {
                this.$wire.$call('logout');
            }, logoutTimeout);
        },

        resumeActivities() {
            this.$dispatch('close-modal', { id: 'inactivityModal' });

            this.resetInactivityTimer();
        },
    };
}
