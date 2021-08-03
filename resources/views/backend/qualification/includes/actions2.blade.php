
 @if (
        $logged_in_user->hasAllAccess() ||
        (            
            $logged_in_user->can('admin.qualification.update-qualification')
        )
    )
    <x-utils.edit-button
        :href="route('admin.qualification.edit', $qualification->id)"
        :text="__('Edit')" />  
    @endif
    <!-- {{ count($qualification->units)}} -->
    <!-- $number = count($qualification->units); -->
    <!-- @if (count($qualification->units)>0) -->
    <!-- <a class="btn btn-sm btn-danger" style="color:#fff" disabled><span data-toggle="tooltip" title="It has associate units"><i class="fas fa-trash"></i>Delete</span></a> -->
    <!-- <button class="btn btn-sm btn-danger" disabled><span data-toggle="tooltip" title="It has associate units"><i class="fas fa-trash"></i>Delete</span></button> -->
    <!-- @if (
        $logged_in_user->hasAllAccess()
    ) -->
    <x-utils.delete-button
            :href="route('admin.qualification.destroy', $qualification)"
            :text="__('Delete')" />
    <!-- @endif     -->
    <!-- @else -->
        <!-- <x-utils.delete-button
            :href="route('admin.qualification.destroy', $qualification)"
            :text="__('Delete')" /> -->
    <!-- @endif -->
