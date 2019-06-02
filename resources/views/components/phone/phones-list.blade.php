 <div class="list-group mb-2">
     @foreach($phones as $phone)
         <div class="list-group-item list-group-item-light">{{ $phone->number }} ({{ $phone->type }})</div>
     @endforeach
 </div>