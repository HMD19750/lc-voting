<x-modal-confirm
    {{-- event-to-open-modal='custom-show-delete-modal' --}}
    livewire-event-to-open-modal='markAsNotSpamCommentWasSet'
    event-to-close-modal='commentWasMarkedAsNotSpam'
    modal-title='Reset Comment Spam Counter'
    modalDescription='Are you sure you want to reset the spam counter of this comment? '
    modal-confirm-button-text='Reset Spam Counter'
    wire-click='markCommentAsNotSpam'
/>
