
<div class="relative pt-4 my-8 mt-1 space-y-6 comments-container md:ml-22">

    @forelse($comments as $comment)

        <livewire:idea-comment
            :comment="$comment"
            :key="$comment->id"
            :ideaUserId="$idea->user->id"
        />


@empty
<p class="mt-6 font-bold text-center text-gray-400">No comments yet for this idea...</p>
@endforelse

</div> <!-- end comments-container -->


