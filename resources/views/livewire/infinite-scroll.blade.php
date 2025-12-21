<div
    x-data="{
        observer: null,
        init() {
            this.observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        $wire.loadMore();
                    }
                });
            }, { rootMargin: '100px' });
            this.observer.observe(this.$refs.sentinel);
        },
        destroy() {
            if (this.observer) {
                this.observer.disconnect();
            }
        }
    }"
>
    <div style="display: flex; flex-direction: column; gap: 16px;">
        {{ $slot ?? '' }}
    </div>

    @if($this->loading)
        <div style="display: flex; justify-content: center; padding: 32px 0;">
            <svg style="width: 32px; height: 32px; color: #9ca3af; animation: spin 1s linear infinite;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle style="opacity: 0.25;" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path style="opacity: 0.75;" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
        </div>
        <style>@keyframes spin { to { transform: rotate(360deg); } }</style>
    @endif

    @if(!$this->hasMore && count($this->items) > 0)
        <div style="text-align: center; padding: 32px 0; color: #6b7280;">
            No more items to load
        </div>
    @endif

    <div x-ref="sentinel" style="height: 16px;"></div>
</div>
