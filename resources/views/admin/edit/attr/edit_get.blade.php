
    <div class="tags_avalible_container">
            @foreach($avalible as $key=>$attr)
            <div class="tags_block_container">
                <div  class="tags_block_top">
                    <span>Додати: {{$attr_names[$key]}} </span>
                </div>  

                <select  data-id="{{$key}}" class="{{$name}}avsel" style="padding: 5px;">
                    <option class="tag_add" value="empty">***</option>
                    @foreach($attr as $attr_v)
                    <option value="{{$attr_v}}">{{$attr_v}} +</option>
                    @endforeach
                </select>
            </div>
            @endforeach
        </div>

        <div class="tags_selected_container">
          
            @foreach($selected as $key=>$attr)
            <div class="tags_block_container">
                <div class="tags_block_top">
                    <span> {{$attr_names[$key]}} </span>
                    <button data-id=" {{$key}} "  class="delete_{{$name}}" style="padding: 5px 10px;  cursor: pointer;">
                        <svg  class="close_window" width="800px" height="800px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M19.207 6.207a1 1 0 0 0-1.414-1.414L12 10.586 6.207 4.793a1 1 0 0 0-1.414 1.414L10.586 12l-5.793 5.793a1 1 0 1 0 1.414 1.414L12 13.414l5.793 5.793a1 1 0 0 0 1.414-1.414L13.414 12l5.793-5.793z" fill="#ffff"></path>
                        </svg>
                    </button>
                </div>
                <select data-id="{{$key}}"  class="{{$name}}sel">
                    @foreach($attr as $attr_v)
                    <option value="{{  $attr_v}}">{{ $attr_v}}</option>
                    @endforeach
                </select>
            </div>
            @endforeach
        </div>

