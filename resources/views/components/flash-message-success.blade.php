<div class="flash-message flash-message--success" x-ref="flashMessage"
    x-effect="setTimeout(() => {
        $refs.flashMessage.remove();
    }, 5000)">
    {{ session('success') }}
</div>
