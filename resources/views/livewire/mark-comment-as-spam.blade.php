<x-modal-confirm
    {{-- event-to-open-modal='custom-show-delete-modal' --}}
    livewire-event-to-open-modal='markAsSpamCommentWasSet'
    event-to-close-modal='commentWasMarkedAsSpam'
    modal-title='Mark Comment as Spam'
    modalDescription='Are you sure you want to mark this comment as spam? '
    modal-confirm-button-text='Mark as Spam'
    wire-click='markAsSpam'
/>
