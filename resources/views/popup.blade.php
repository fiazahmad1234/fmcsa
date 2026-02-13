<!-- Email Popup Modal -->
<div class="modal fade" id="emailModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content popup-bg position-relative text-white">

            <!-- ✅ Close Button -->
            <button type="button" 
                    class="btn-close btn-close-white position-absolute top-0 end-0 m-3" 
                    data-bs-dismiss="modal" 
                    aria-label="Close"
                    style="z-index:1055;">
            </button>

            <div class="modal-body overlay p-4 p-md-5 text-center">

                <h4 class="mb-3 fw-bold text-dark">Subscribe Now</h4>
                <p class="mb-4 small text-dark">Get updates and news directly in your inbox</p>

                <!-- ✅ Success Message -->
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- ✅ Validation Errors -->
                @if ($errors->any())
                    <div class="alert alert-danger text-start">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- ✅ Email Form -->
                <form id="home1" method="POST" action="{{route('subscribe')}}">
                    @csrf
                    <div class="mb-3">
                        <input type="email"
                               name="email"
                               class="form-control form-control-lg"
                               placeholder="Enter Your Email"
                               required
                               value="">
                    </div>

                    <button type="submit"
                            class="btn w-100 text-white fw-bold"
                            style="background:#03a4ed; font-size:16px;">
                        Subscribe
                    </button>
                </form>

            </div>
        </div>
    </div>
</div>

<!-- ✅ Styles -->
<style>
 

.popup-bg {
    background-image: url('https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=800&q=80');
    background-size: cover;
    background-position: center;
    border-radius: 15px;
    max-width: 500px;
    width: 90%;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0,0,0,0.4);
}

.modal-body {
    background: transparent !important;
    color: white;
}


.modal-body h4 {
    font-size: 22px;
}

.modal-body p {
    font-size: 14px;
    color: #e0e0e0;
}

.btn-close {
    z-index: 1055;
}

/* Mobile responsiveness */
@media (max-width: 576px) {
    .modal-dialog { margin: 15px; }
    .modal-body h4 { font-size: 18px; }
    .modal-body p { font-size: 13px; }
    .btn {
        font-size: 14px;
        padding: 10px 0;
    }
}
</style>

<!-- ✅ Script -->
@push('scripts')
<script>
document.addEventListener("DOMContentLoaded", function () {
    var modalEl = document.getElementById('emailModal');
    var modal = bootstrap.Modal.getOrCreateInstance(modalEl);

    // Show if errors or success
    @if ($errors->any() || session('success'))
        modal.show();
    @else
        // Show only once per visitor
        if (!localStorage.getItem("emailPopupShown")) {
            modal.show();
            localStorage.setItem("emailPopupShown", "true");
        }
    @endif
});
</script>
@endpush
