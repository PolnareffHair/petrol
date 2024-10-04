    
@php
App::setLocale($lang);
$lang = $lang == "ua" ? "/ua" : "";
@endphp

@if(count($compare)==1)
    <p class = 'empty_compare'>
    {{__('header.empty_compare' )}}
</p>

@else
    @foreach($compare as $productId =>$item)
        <div class="comp_tags">
            <div id="comp_img">
                
                @if (isset($item["info"]))
                <svg data-id = "{{$productId}}" class="delete" class="close_window" width="800px" height="800px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M19.207 6.207a1 1 0 0 0-1.414-1.414L12 10.586 6.207 4.793a1 1 0 0 0-1.414 1.414L10.586 12l-5.793 5.793a1 1 0 1 0 1.414 1.414L12 13.414l5.793 5.793a1 1 0 0 0 1.414-1.414L13.414 12l5.793-5.793z" fill="#d3d3d3"></path>
                </svg>
                <img src="{{$item["info"]["img_url"]}}" alt="">
                    <a href="{{$lang}}/product/{{$item["info"]["url"]}}">
                
                        <p> {{$item["info"]["name"]}}</p>
                    </a>
                    @php unset($item["info"]); @endphp
                @else
                <button id="clear_compare"> {{__('header.clear_compare' )}} 
                    
                    <svg id="close_window" class="close_window" width="800px" height="800px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M19.207 6.207a1 1 0 0 0-1.414-1.414L12 10.586 6.207 4.793a1 1 0 0 0-1.414 1.414L10.586 12l-5.793 5.793a1 1 0 1 0 1.414 1.414L12 13.414l5.793 5.793a1 1 0 0 0 1.414-1.414L13.414 12l5.793-5.793z" fill="#d3d3d3"></path>
                    </svg> 
                </button>

                @endif

            </div>
                @foreach($item as $key1 =>$name)

                    @if($productId != 0)
                        <p class="normal_col">{{$name }}</p>
                    @else 
                        <p  class ="first_col">{{$name}}</p>
                    @endif
    
                @endforeach
    
        </div>
    @endforeach
@endif
