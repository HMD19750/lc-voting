 {{-- Modal to edit idea --}}
 @can('update',$idea)
 <livewire:edit-idea :idea="$idea" />
 @endcan

 <livewire:create-idea />


{{-- Modal to delete idea --}}
@can('delete',$idea)
<livewire:delete-idea :idea="$idea" />
@endcan

{{-- Modal to mark idea as spam --}}

<livewire:mark-idea-as-spam :idea="$idea" />

{{-- Modal to mark idea as not spam --}}

<livewire:mark-idea-as-not-spam :idea="$idea" />

@auth
<livewire:edit-comment />
@endauth

@auth
<livewire:delete-comment />
@endauth

@auth
<livewire:mark-comment-as-spam />
@endauth

<livewire:mark-comment-as-not-spam />


