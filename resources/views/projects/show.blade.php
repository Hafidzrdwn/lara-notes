@extends('layouts.main', ['title' => $project->title])

@section('content')
    <section class="mt-4 mb-5">
        <h1 class="text-center fw-bold">{{ $project->title }}</h1>
        <nav class="mt-3 mb-4 d-flex justify-content-center">
            <a href="{{ route('space', $space->slug) }}" class="text-danger">
                <i class="fas fa-angle-double-left me-1"></i>{{ $space->title }}
            </a>
        </nav>
        @if ($project->note)
            <input type="hidden" id="_note" value="{{ $project->slug }}">
        @endif
        <div class="row justify-content-center align-items-start gap-4">
            <div class="col-lg-6 bg-white border border-dark rounded p-4 note-zone" style="height: 400px; overflow: auto;">
                @if ($project->note)
                    <p style="text-align: justify; text-indent: 50px; font-size:{{ $project->note->font_size }}px;">
                        {{ $project->note->body }}
                    </p>
                @else
                    <img class="w-50 mt-4 mb-3 d-block mx-auto" src="{{ asset('images/note-empty.svg') }}" alt="">
                    <h3 class="text-center">Empty</h3>
                @endif
            </div>
            <div class="col-lg-4 bg-white border border-dark rounded p-3">
                <img src="{{ asset('images/notes.svg') }}" class="w-75 d-block mb-3 mx-auto" alt="project image">
                <div class="btn-groups w-100">
                    <button class="btn btn-danger w-100 mb-2" onclick="createState()">
                        <i class="fas fa-pencil-alt me-2"></i>
                        Create notes
                    </button>
                    @if ($project->note)
                        <form
                            action="{{ route('note.destroy', [
                                'space' => $space->slug,
                                'project' => $project->slug,
                                'note' => $project->note->id,
                            ]) }}"
                            method="post">
                            @csrf
                            @method('delete')
                            <button class="btn btn-dark w-100" onclick="return confirm('Are you sure??')"><i
                                    class="fas fa-trash-alt me-2"></i>Clear note</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection


@section('script')
    <script>
        $(document).ready(function() {
            window.createState = function() {
                let status = "update"
                let noteText = $('.note-zone').text().trim()
                if(noteText == "Empty") {
                    noteText = ""  
                    status = "create"
                } 
                const noteTextLength = noteText.length

                $('.note-zone').html('')
                $('.btn-groups').html('')
                $('.note-zone').removeClass('p-4')
                $('.note-zone').addClass('p-0')
                $('.note-zone').append(
                    `<textarea class="form-control h-100 p-4" name="body" placeholder="Write your notes here..." onfocus="this.setSelectionRange(this.value.length,this.value.length)" oninput="textAreaChange(this.value)">${noteText}</textarea>`
                )

                $('.note-zone').find('textarea').focus()

                $('.btn-groups').append(
                    `<input class="form-control w-100 mb-2 border" min="16" max="40" placeholder="Font size (min:16 max:40)" type="number" name="font_size" id="font-size" onchange="changeFontSize(this.value)"><button class="btn btn-danger d-block w-100 mb-2 btn-save disabled" type="button" onclick="save('${status}')">Save changes</button><div class="btn-group w-100"><button class="btn btn-dark" onclick="resetInput()">Reset input</button><button class="btn btn-secondary" onclick="cancelState()" type="button">Cancel</button></div>`
                )
            }

            window.textAreaChange = function(val) {
                if(val.length > 0){
                    $('.btn-groups').find('.btn-save').removeClass('disabled')
                } else {
                    $('.btn-groups').find('.btn-save').addClass('disabled')
                }
            }

            window.changeFontSize = function(val) {
                if(val >= 16 && val <= 40) $('.note-zone').find('textarea').css('font-size', val + 'px')
            }

            window.resetInput = function() {
                $('.note-zone').find('textarea').val('')
                $('.note-zone').find('textarea').focus()
                $('.btn-groups').find('.btn-save').addClass('disabled')
            }

            window.cancelState = function() {
                $('.note-zone').html('')
                $('.btn-groups').html('')
                $('.note-zone').removeClass('p-0')
                $('.note-zone').addClass('p-4')
                $('.btn-groups').append(
                    `<button class="btn btn-danger w-100 mb-2" onclick="createState()"><i class="fas fa-pencil-alt me-2"></i>Create notes</button> @if ($project->note) <form action="{{ route('note.destroy', ['space' => $space->slug, 'project' => $project->slug, 'note' => $project->note->id ]) }}" method="post"> @csrf @method('delete') <button class="btn btn-dark w-100" onclick="return confirm('Are you sure??')"> <i class="fas fa-trash-alt me-2"></i>Clear note </button> </form> @endif`
                )
                $('.note-zone').append(
                    `@if ($project->note) <p style="text-align: justify; text-indent: 50px; font-size:{{ $project->note->font_size }}px;"> {{ $project->note->body }} </p> @else  <img class="w-50 mt-4 mb-3 d-block mx-auto" src="{{ asset('images/note-empty.svg') }}" alt=""> <h3 class="text-center">Empty</h3> @endif`
                )
            }

            function dataAjax(url, method, data) {
                $.ajax({
                    url: url,
                    method: method,
                    data: data,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        location.reload()
                        cancelState()
                    },
                    error: function(err) {
                        console.log(err)
                    }
                })
            }

            window.save = function(status) {
                const body = $('.note-zone').find('textarea').val().trim();
                let font_size = $('.btn-groups').find('#font-size').val().trim()
                font_size = (font_size.length > 0) ? font_size : 16

                const data = {
                    body,
                    font_size
                }

                switch(status) {
                    case "create":
                        dataAjax("{{ route('note.store', ['space' => $space->slug, 'project' => $project->slug]) }}", "POST", data)
                        break;
                    case "update":
                        dataAjax("@if($project->note){{ route('note.update', ['space' => $space->slug, 'project' => $project->slug, 'note' => $project->note->id]) }}@endif", "PUT", data)
                        break;
                    default:
                        console.error('Unknown status')
                }

            }

        });
    </script>
@endsection
