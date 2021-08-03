<x-utils.edit-button
    :href="route('admin.department.edit', $department->id)"
    :text="__('Edit')" />
<x-utils.delete-button
    :href="route('admin.department.destroy', $department)"
    :text="__('Delete')" />  