<style>
    .left-size {

    }
</style>
<div class="card">
    <img src="{{$imgUrl}}" class="card-img-top" alt="">
    <div class="card-body left-card">
        <h5 class="card-title text-center">{{$title}}</h5>
        <p class="card-text">{{$content}}</p>
        <hr>
        @if(isset($category_id) && !empty($category_id))
            <a href="{{route('index',['category_id'=>$category_id])}}"
               class="btn btn-outline-primary btn-sm w-100">文章数量{{$count}}</a>
        @else
            <button style="cursor: initial" class="btn btn-outline-primary btn-sm w-100">文章数量{{$count}}</button>
        @endif
    </div>
</div>
