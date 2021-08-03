@if ($sortingBy !== $field)
<i  class=" text-muted fas fa-sort-amount-up"></i>
@elseif ($sortDirection == 'asc')
<i style="color:rgba(38, 38, 38, 0.774)" class="fas fa-sort-amount-up"></i>
@else
<i style="color:rgba(38, 38, 38, 0.774)" class="fas fa-sort-amount-down"></i>
@endif