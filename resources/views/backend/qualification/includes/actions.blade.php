
    @if (
        $logged_in_user->hasAllAccess() ||
        (            
            $logged_in_user->can('admin.qualification.edit-qualification')
        )
    )
    <x-utils.edit-button
        :href="route('admin.qualification.edit', $qualification->id)"
        :text="__('Edit')" />  
    @endif   
    @if (
        $logged_in_user->hasAllAccess() ||
        (            
            $logged_in_user->can('admin.qualification.delete-qualification')
        )
    )
    <x-utils.delete-button
            :href="route('admin.qualification.destroy', $qualification)"
            :text="__('Delete')" />
    @endif
