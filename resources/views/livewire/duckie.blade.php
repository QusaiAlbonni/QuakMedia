<div class="container h-100">
    <div class="row h-100 align-items-center">
        <div class="col-5 mt-2 m-auto rounded-2 shadow mb-5 p-0"
            style="background: linear-gradient(-20deg, rgb(233, 222, 250) 0%, rgb(251, 252, 219) 100%);">
            <img src="{{ $apiUrl }}" class="mx-auto rounded-1 mt-3">
            <div class="d-flex justify-content-center my-3">
                <form action="/duckie/{{$animal}}">
                    <button class="btn btn-primary shadow">More Please</button>
                </form>
            </div>
            <div class="d-flex justify-content-center my-3">
                <button class="btn btn-danger shadow mx-3" wire:click='cat'>I want cats</button>
                <button class="btn btn-danger shadow" wire:click='duck'>I want ducks</button>
            </div>
        </div>
    </div>
</div>
