    <div class="tags_avalible_container">

        <div class="tags_block_container">
       
            @foreach($avalible as $cat_id_p=> $children)
            <div class="tags_block_top">
                <span>Додати:  {{$children[array_key_first($children)]["category_name_ua"]}} </span>
            </div>
            <select data-id="{{$id_item}}" class="{{$name}}avsel" style="padding: 5px;">
                <option class="tag_add" value="empty">***</option>
                @foreach($children as $cat_id=> $cat)
                <option  @if(isset($cat["disabled"]))disabled  style="color:#9b9b9b;" @endif value="{{$cat["id"]}}">{{$cat["category_name_ua"]}} +</option>
                @endforeach
            </select>
            @endforeach
        </div>

    </div>

    <div class="tags_selected_container">

        @foreach($selected as $cat)
        <div class="tags_block_container" style=" height:4em;border:1px solid #a5a5a5;">
            <div class="tags_block_top"style=" height:4em; "  >
                <span style=" height:2em;"> {{$cat["category_name_ua"]}} </span>
                <button data-id="{{$cat["id"]}}"  class="delete_{{$name}}" style="padding: 5px 10px;  cursor: pointer; align-self:start; height:100%;">
                    <svg class="close_window" width="800px" height="800px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M19.207 6.207a1 1 0 0 0-1.414-1.414L12 10.586 6.207 4.793a1 1 0 0 0-1.414 1.414L10.586 12l-5.793 5.793a1 1 0 1 0 1.414 1.414L12 13.414l5.793 5.793a1 1 0 0 0 1.414-1.414L13.414 12l5.793-5.793z" fill="#ffff"></path>
                    </svg>
                </button>
            </div>
        </div>
        @endforeach
    </div>