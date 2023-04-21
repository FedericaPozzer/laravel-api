<div class="modal fade" id="delete-modal-{{$project->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Warning!</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <div class="modal-body">
                Are you sure you wanna delete {{$project->title}}? <br> This operation is reversible!
            </div>
      
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Go back</button>
                <form action="{{ route('admin.projects.destroy', $project) }}" method="POST">
                    @method("delete")
                    @csrf
                    <button type="submit" class="btn btn-primary">Yes, delete!</button>
                </form>
            </div>
        </div>
    </div>
</div>