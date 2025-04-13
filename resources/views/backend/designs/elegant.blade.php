<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Undangan Pernikahan: {{ $wedding->bride_name }} & {{ $wedding->groom_name }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }

        .main-container {
            max-width: 800px;
            margin: 0 auto;
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            margin-top: 30px;
        }

        .header {
            text-align: center;
            padding: 20px;
            background-color: #f3c2c3;
            border-radius: 10px;
            position: relative;
        }

        .header img {
            width: 150px;
            border-radius: 50%;
            border: 5px solid #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        .header h1 {
            font-size: 2.5rem;
            color: #6d4c41;
            margin-top: 15px;
            font-family: 'Georgia', serif;
        }

        .header h2 {
            font-size: 1.5rem;
            color: #d32f2f;
            font-weight: normal;
        }

        .content {
            margin-top: 20px;
            text-align: center;
        }

        .content h3 {
            font-size: 1.5rem;
            color: #3e2723;
            font-weight: bold;
        }

        .content p {
            font-size: 1.2rem;
            margin-top: 15px;
            line-height: 1.6;
            color: #3e2723;
        }

        .date-location {
            margin-top: 20px;
            font-size: 1.2rem;
            color: #d32f2f;
        }

        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 1rem;
            color: #888;
        }

        .btn-preview {
            margin-top: 20px;
            background-color: #9c27b0;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            font-size: 1.1rem;
        }

        .btn-preview:hover {
            background-color: #7b1fa2;
        }
    </style>
</head>

<body>

    <div class="main-container">
        <!-- Header: Couple's Picture and Names -->
        <div class="header">
            <img src="{{ asset('images/wedding/couple.jpg') }}" alt="Couple">
            <h1>{{ $wedding->bride_name }} & {{ $wedding->groom_name }}</h1>
            <h2>With Love and Best Wishes</h2>
        </div>

        <!-- Wedding Details -->
        <div class="content">
            <h3>You're Invited!</h3>
            <p>We are so happy to announce the upcoming wedding of <strong>{{ $wedding->bride_name }}</strong> & <strong>{{ $wedding->groom_name }}</strong>. Join us as we celebrate this joyous occasion!</p>

            <div class="date-location">
                <p><strong>Wedding Date:</strong> {{ \Carbon\Carbon::parse($wedding->wedding_date)->format('d M Y') }}</p>
                <p><strong>Location:</strong> {{ $wedding->location }}</p>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>Looking forward to seeing you on our special day!</p>
            <p><em>Preview Template - {{ $template->name }}</em></p>
        </div>

        <!-- Preview Button (Optional) -->
        <a href="{{ route('designs.preview', $template->view_path) }}" class="btn-preview" target="_blank">Preview Undangan</a>
    </div>

</body>

</html>
