<?php
$currentSort = '';
$currentSortOrder = 'ASC';
if(!empty($_GET['sort'])){
    $currentSort = $_GET['sort'];
}
if(!empty($_GET['sort_order'])){
    $currentSortOrder = $_GET['sort_order'];
}
$isActive = false;
if($currentSort == $sortField){
    $isActive = true;
}
$btnClass = 'btn-link';
if($isActive){
    $btnClass = 'btn-primary';
}
?>
{!! Former::open()->method('GET')->addClass('d-inline') !!}
<input type="hidden" name="sort" value="{{ $sortField }}">
<input type="hidden" name="page" value="1">
@if($isActive && $currentSortOrder == 'ASC')
    <input type="hidden" name="sort_order" value="DESC">
@else
    <input type="hidden" name="sort_order" value="ASC">
@endif
@if(isset($_GET))
    @foreach($_GET as $parameterKey => $parameterValue)
        @if(!in_array($parameterKey,['sort','sort_order','page']))
        <input type="hidden" name="{{ $parameterKey }}" value="{{ $parameterValue }}">
        @endif
    @endforeach
@endif
<button class="btn {{ $btnClass }} btn-sm" type="submit">
    <i class="fa fa-sort" aria-hidden="true"></i>
</button>
{!! Former::close() !!}