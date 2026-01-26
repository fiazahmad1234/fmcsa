@extends('layout.app') <!-- Extends your header/footer -->

@section('title', 'Upload Excel to Send Emails')

@section('content')
<div class="main-banner"  style="display: flex; justify-content: center; align-items: center; min-height: 70vh; background-color: #f2f4f8; padding: 20px;">

    <div style="background-color: #ffffff; border-radius: 12px; padding: 40px; width: 100%; max-width: 600px; box-shadow: 0 8px 25px rgba(0,0,0,0.1); text-align: center; font-family: Arial, sans-serif;">

        <!-- Heading -->
        <h2 style="color: #030303; font-size: 26px; margin-bottom: 10px;">Upload Excel File</h2>
        <p style="color: #555555; font-size: 16px; margin-bottom: 25px;">
            Select your Excel file to send emails to all recipients.
        </p>

        <!-- Success message -->
        @if(session('success'))
            <p style="color: green; font-size: 14px; margin-bottom: 20px;">
                {{ session('success') }}
            </p>
        @endif

        <!-- Form -->
        <form action="{{ route('send.emails') }}" method="POST" enctype="multipart/form-data" style="display: flex; flex-direction: column; align-items: center;">
            @csrf

            <label for="excel" style="background-color: #e7e7e7; padding: 12px 25px; border-radius: 8px; cursor: pointer; margin-bottom: 20px; width: 100%; max-width: 300px; text-align: center;">
                Choose Excel File
            </label>
            <input type="file" id="excel" name="excel" required style="display: none;">

            <button type="submit" style="background-color: #0202aa; color: #ffffff; padding: 12px 35px; border: none; border-radius: 8px; font-size: 16px; cursor: pointer; transition: background 0.3s;">
                Send Emails
            </button>
        </form>

        <p style="font-size: 12px; color: #888888; margin-top: 20px;">
            Only .xlsx or .xls files are accepted. Max size 5MB.
        </p>

    </div>
</div>

<script>
    // Show file name when selected
    const input = document.getElementById('excel');
    const label = input.previousElementSibling;
    input.addEventListener('change', function() {
        if(this.files.length > 0) {
            label.textContent = this.files[0].name;
            label.style.backgroundColor = '#dce6ff';
        }
    });
</script>
@endsection
