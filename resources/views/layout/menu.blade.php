<div class="col-md-3 ">
    <ul class="list-group" id="menu">
        <li href="#" class="list-group-item menu1 active">
            Menu
        </li>
        @foreach ($theloai as $item)
            <li href="#" class="list-group-item menu1">
                {{$item->Ten}}
            </li>
            
            <ul>
                @foreach ($loaitin as $item)
                <li class="list-group-item">
                    <a href="">{{$item->Ten}}</a>
                </li>  
                @endforeach   
            </ul>
        @endforeach
    </ul>
</div>