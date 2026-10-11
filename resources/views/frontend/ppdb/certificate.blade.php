<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bukti Pendaftaran PPDB</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            padding: 15px;
            background: white;
        }

        .container {
            max-width: 595px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #1e3a5f;
            padding-bottom: 10px;
            margin-bottom: 15px;
        }

        .header h1 {
            font-size: 16px;
            color: #1e3a5f;
            margin: 0;
            font-weight: bold;
        }

        .header p {
            color: #666;
            font-size: 11px;
            margin: 3px 0 0 0;
        }

        .title {
            text-align: center;
            font-size: 13px;
            font-weight: bold;
            color: #1e3a5f;
            margin: 12px 0;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .reg-number {
            background: #1e3a5f;
            color: white;
            padding: 8px;
            text-align: center;
            margin: 10px 0;
            border-radius: 2px;
        }

        .reg-number .label {
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            opacity: 0.9;
            margin-bottom: 2px;
        }

        .reg-number .number {
            font-size: 20px;
            font-weight: bold;
            font-family: 'Courier New', monospace;
            letter-spacing: 1px;
        }

        .warning {
            background: #fff9e6;
            border-left: 3px solid #f39c12;
            padding: 8px;
            margin: 10px 0;
            font-size: 10px;
            color: #333;
            line-height: 1.3;
        }

        .section {
            margin: 8px 0;
            border-left: 3px solid #f39c12;
            background: #fafafa;
            padding: 8px;
        }

        .section-title {
            font-weight: bold;
            color: #1e3a5f;
            font-size: 10px;
            text-transform: uppercase;
            margin-bottom: 6px;
            letter-spacing: 0.3px;
        }

        .info-grid {
            font-size: 10px;
        }

        .info-row {
            display: grid;
            grid-template-columns: 110px 1fr;
            gap: 5px;
            margin-bottom: 3px;
            line-height: 1.3;
        }

        .info-label {
            font-weight: bold;
            color: #333;
        }

        .info-value {
            color: #555;
        }

        .footer {
            margin-top: 12px;
            padding-top: 8px;
            border-top: 1px solid #ddd;
            text-align: center;
            font-size: 9px;
            color: #888;
            line-height: 1.4;
        }

        @media print {
            body { padding: 0; }
            .container { border: none; }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>SMAS RK Delimurni Delitua</h1>
            <p>Bukti Pendaftaran PPDB - Tahun Ajaran {{ $academicYear }}</p>
        </div>

        <!-- Title -->
        <div class="title">Bukti Pendaftaran PPDB</div>

        <!-- Registration Number - PENTING: HARUS TERLIHAT JELAS -->
        <div class="reg-number">
            <div class="label">Nomor Pendaftaran</div>
            <div class="number">{{ $registration->registration_number }}</div>
        </div>

        <!-- Warning -->
        <div class="warning">
            <strong>⚠ Penting:</strong> Simpan nomor pendaftaran ini dengan baik. Gunakan untuk cek status dan komunikasi dengan sekolah.
        </div>

        <!-- Data Calon Siswa -->
        <div class="section">
            <div class="section-title">Data Calon Siswa</div>
            <div class="info-grid">
                <div class="info-row">
                    <div class="info-label">Nama Lengkap</div>
                    <div class="info-value">{{ $registration->full_name }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Jenis Kelamin</div>
                    <div class="info-value">{{ $registration->gender == 'L' ? 'Laki-laki' : 'Perempuan' }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Tempat/Tgl Lahir</div>
                    <div class="info-value">{{ $registration->birth_place }}, {{ $registration->birth_date->format('d-m-Y') }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Alamat</div>
                    <div class="info-value">{{ $registration->address }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Telepon</div>
                    <div class="info-value">{{ $registration->phone }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Sekolah Asal</div>
                    <div class="info-value">{{ $registration->previous_school }}</div>
                </div>
            </div>
        </div>

        <!-- Data Orang Tua -->
        <div class="section">
            <div class="section-title">Data Orang Tua</div>
            <div class="info-grid">
                <div class="info-row">
                    <div class="info-label">Nama Ayah</div>
                    <div class="info-value">{{ $registration->father_name }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Telepon Ayah</div>
                    <div class="info-value">{{ $registration->father_phone ?? '-' }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Nama Ibu</div>
                    <div class="info-value">{{ $registration->mother_name }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Telepon Ibu</div>
                    <div class="info-value">{{ $registration->mother_phone ?? '-' }}</div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <strong>SMAS RK Delimurni Delitua</strong><br>
            Jl. Nogio VI No. 117, Deli Tua Timur, Kec. Deli Tua, Kab. Deli Serdang, Sumatera Utara<br>
            Telp: (061) xxx-xxxx | Email: smarkdelimurnidelitua@gmail.com<br>
            Diunduh: {{ $downloadDate }}
        </div>
    </div>
</body>
</html>
