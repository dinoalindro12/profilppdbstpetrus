@php
// File ini tidak dipakai langsung — controller mengarah ke frontend.academic.curriculum
// Redirect ke halaman kurikulum yang benar
header('Location: ' . route('academic.curriculum'));
exit;
@endphp
