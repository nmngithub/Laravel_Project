<div class="col-md-3 ">
    <ul class="list-group" id="menu">
        <li href="#" class="list-group-item menu1 active">
            Menu
        </li>
      
        @foreach ($theloai as $item1)
            <li class="list-group-item menu1">
                {{$item1->Ten}}
            </li>
            <ul>

                    @foreach ($lt[$item1->Ten] as $item2)
                    <li class="list-group-item">
                        
                        <a href="category/{{$item2}}">{{$item2}}</a>
                    </li>   
                    @endforeach
            </ul>
        @endforeach
    </ul>
</div>