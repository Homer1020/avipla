@extends('layouts.dashboard')
@section('title', 'Comentarios')
@push('css')
  <link rel="stylesheet" href="{{ asset('assets/css/datatables.min.css') }}">
@endpush
@section('content')
  <h1 class="mt-4 fs-4">
    <i class="fas fa-newspaper fa-sm"></i>
    Comentarios
  </h1>
  <ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('noticias.index') }}">Noticias</a></li>
    <li class="breadcrumb-item active">Comentarios</li>
  </ol>

  <div class="mb-4 card">
    <div class="card-body">
      <table class="table table-bordered w-100" id="comments-table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Usuario</th>
            <th>Comentario</th>
            <th>Noticia</th>
            <th>Fecha</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($comments as $comment)
            <tr data-comment-row-id="{{ $comment->id }}">
              <td>#{{ $comment->id }}</td>
              <td>
                <div class="d-flex gap-2 align-items-center">
                  @if ($comment->user->afiliado && $comment->user->afiliado->brand)
                    <img src="{{ Storage::url($comment->user->afiliado->brand) }}" alt="Avatar" width="50">
                  @else
                    <img src="{{ asset('assets/img/avatar.jpg') }}" alt="Avatar" width="50">
                  @endif
                  {{ $comment->user->email }}

                  ({{ $comment->user->roles->first()->name }})
                </div>
              </td>
              <td>{{ $comment->content }}</td>
              <td>
                <a href="{{ route('news.item', $comment->noticia) }}" target="_blank">
                  {{ $comment->noticia->titulo }}
                </a>
              </td>
              <td>{{ $comment->created_at->format('dd-mm-Y') }}</td>
              <td style="white-space: nowrap">
                @can('update', $comment)
                  <button
                    data-bs-toggle="modal"
                    data-bs-target="#modalEditComment"
                    data-comment-content="{{ $comment->content }}"
                    data-path="{{ route('comments.update', $comment) }}"
                    class="btn btn-warning"
                  >
                    <i class="fa fa-pen"></i>
                    Editar
              </button>
                @endcan
                @can('delete', $comment)
                  <form class="d-inline-block" action="{{ route('comments.destroy', $comment) }}" onsubmit="submitAfterConfirm(event.target); return false" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="submit">
                      <i class="fa fa-trash"></i>
                      Eliminar
                    </button>
                  </form>
                  @endcan
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="modalEditComment" tabindex="-1" aria-labelledby="modalEditCommentLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalEditCommentLabel">Editar comentario</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="form-edit-comment" method="POST">
            @csrf
            <div class="mb-3">
              <label for="note" class="form-label">Comentario</label>
              <textarea name="content" id="content" cols="7" class="form-control"></textarea>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
          <button form="form-edit-comment" type="submit" class="btn btn-primary">
            <i class="fas fa-message"></i> Guardar
          </button>
        </div>
      </div>
    </div>
  </div>

@endsection

@push('script')
  <script src="{{ asset('assets/css/datatables.min.js') }}"></script>

  @if (session('success'))
    <script>
      Swal.fire({
        icon: "success",
        title: "{{ session('success') }}"
      });
    </script>
  @endif

  <script>
    new DataTable('#comments-table', {
      columnDefs: [
        { orderable: false, targets: 5 },
      ],
      order: false,
      scrollX: true,
      language: datatableES()
    })


    const $modalEditComment = document.getElementById('modalEditComment')
    const $contentTextarea = $modalEditComment.querySelector('#content')
    const $formEditComment = document.getElementById('form-edit-comment')

    const modalEditComment = new bootstrap.Modal('#modalEditComment', {
      keyboard: false
    })

    $formEditComment.addEventListener('submit', async event => {
      event.preventDefault()

      const url = $formEditComment.action

      const resp = await fetch(url, {
        method: 'PUT',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json',
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        body: JSON.stringify({
          content: $contentTextarea.value
        })
      })

      const result = await resp.json()

      if(!result.ok) return;

      await Swal.fire({
        icon: "success",
        title: "Se actualizó el comentario correctamente"
      });

      $(`[data-comment-row-id="${ result.comment.id }"] td:nth-child(3)`).text(result.comment.content);

      modalEditComment.hide()
    })

    $modalEditComment.addEventListener('show.bs.modal', event => {

      const { commentContent, path } = event.relatedTarget.dataset

      $formEditComment.action = path;

      $contentTextarea.value = commentContent
    })

    $modalEditComment.addEventListener('hide.bs.modal', () => {
      $contentTextarea.value = ''
    })
  </script>
@endpush