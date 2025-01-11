@include('sweetalert::alert')
<div class="d-flex justify-content-center align-items-center mt-5" style="min-height: 80vh;">

    <div class="card text-start w-50 shadow-lg" style="max-width: 600px; border-radius: 12px;">
        <div class="card-header bg-gradient text-white  bg-primary"
            style="border-top-left-radius: 12px;
            border-top-right-radius: 12px;">
            <h6 class="card-title text-white text-center mb-0 py-2">User Detail</h6>
        </div>
        <div class="card-body bg-light">
            <form wire:submit="update">
                <div class="mb-4">
                    <label for="name" class="form-label fw-bold">Name</label>
                    <input type="text" class="form-control rounded-pill" id="name" wire:model="name"
                        placeholder="Enter your name">
                </div>
                <div class="mb-4">
                    <label for="email" class="form-label fw-bold">Email</label>
                    <input type="email" class="form-control rounded-pill" id="email" wire:model="email"
                        placeholder="Enter your email">
                </div>
                <div class="mb-4">
                    <label for="password" class="form-label fw-bold">Password</label>
                    <input type="password" class="form-control rounded-pill" id="password" wire:model="password"
                        placeholder="Enter your password">
                </div>
                <div class="text-end">
                    <button type="submit" class="btn btn-primary px-4 rounded-pill">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener('swal', (event) => {
            let data = event.detail;
            Swal.fire({
                position: data.position,
                title: data.title,
                icon: data.type,
                timer: 1500
            });
        });
    </script>
@endpush
