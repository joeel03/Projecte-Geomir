@foreach ($posts as $post)
        <div class="border posts">
            <div class="boton-black"> 
                <div>
                    <i class="fa-solid fa-user"></i> {{$post->user->name }}
                </div>
                <div>
                    <a href="{{ route('posts.edit', $post) }}" class="boton-black" style="font-size:25px;"type="submit"><i class="fa-solid fa-ellipsis-vertical"></i></a>
                </div>
            </div>
            <div class="imagen-posts"> 
                    @foreach ($files as $file)
                        @if($file->id == $post->file_id)
                            <div class="div-foto-post">
                                    <img class="img-posts" src='{{ asset("storage/{$file->filepath}") }}'/>
                            </div>
                        @endif
                    @endforeach
            </div>

            <div class="boton-posts"> 
                <div>
                @if($post->comprovarlike())                       
                    <form action="{{ route('posts.likes',$post) }}" method="post" enctype="multipart/form-data">
                    @csrf                            
                        <button class="btn btn-primary"><i class="fa-regular fa-heart h3"></i></button>                           
                    </form>
                @else
                    <form action="{{ route('posts.unlikes',$post) }}" method="post" enctype="multipart/form-data">
                    @csrf 
                    @method('DELETE')                          
                        <button class="btn btn-primary"><i class="fa-solid fa-heart"></i></button>                           
                    </form>
                @endif
                <a class="btn btn-primary my-2 my-sm-0" style="font-size:25px;"type="submit">COMENTARIOS </a>
                <a class="btn btn-primary my-2 my-sm-0" style="font-size:25px;"type="submit"><i class="fa-solid fa-square-share-nodes"></i> </a>
            
                </div>
            </div>
            <div class="texto">
                 {{ $post->body }} 
            </div>
        </div>
        @endforeach