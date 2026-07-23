<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Latihan Vercel x Laravel</title>
    <!-- Menggunakan font modern (Inter) -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-color: #0f172a; /* Slate 900 */
            --card-bg: rgba(30, 41, 59, 0.7); /* Slate 800 with opacity */
            --text-primary: #f8fafc; /* Slate 50 */
            --text-secondary: #94a3b8; /* Slate 400 */
            --accent: #3b82f6; /* Blue 500 */
            --accent-glow: rgba(59, 130, 246, 0.5);
            --error: #ef4444; /* Red 500 */
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-color);
            background-image: 
                radial-gradient(circle at 15% 50%, rgba(59, 130, 246, 0.15), transparent 25%),
                radial-gradient(circle at 85% 30%, rgba(168, 85, 247, 0.15), transparent 25%);
            color: var(--text-primary);
            margin: 0;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .glass-card {
            background: var(--card-bg);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 24px;
            padding: 40px;
            width: 100%;
            max-width: 500px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            animation: fadeIn 0.8s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        h1 {
            font-weight: 800;
            font-size: 2rem;
            margin-top: 0;
            margin-bottom: 10px;
            background: linear-gradient(135deg, #60a5fa, #a855f7);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-align: center;
        }

        p.subtitle {
            text-align: center;
            color: var(--text-secondary);
            margin-bottom: 30px;
            font-size: 0.95rem;
        }

        .user-list {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .user-item {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.05);
            padding: 16px 20px;
            border-radius: 12px;
            font-weight: 600;
            display: flex;
            align-items: center;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .user-item:hover {
            transform: translateX(5px);
            background: rgba(255, 255, 255, 0.08);
            border-color: var(--accent);
            box-shadow: 0 0 15px var(--accent-glow);
        }

        .user-item::before {
            content: '👤';
            margin-right: 12px;
            font-size: 1.2rem;
        }

        .error-box {
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid var(--error);
            color: #fca5a5;
            padding: 15px;
            border-radius: 12px;
            font-size: 0.9rem;
            margin-bottom: 20px;
        }

        .empty-state {
            text-align: center;
            color: var(--text-secondary);
            padding: 20px;
            font-style: italic;
        }
        
        .badge {
            display: inline-block;
            background: rgba(59, 130, 246, 0.2);
            color: #93c5fd;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: bold;
            margin-bottom: 15px;
            border: 1px solid rgba(59, 130, 246, 0.3);
        }
        
        .header-wrap {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
    </style>
</head>
<body>

    <div class="glass-card">
        <div class="header-wrap">
            <span class="badge">Laravel 12 x Vercel</span>
            <h1>Data Pengguna</h1>
        </div>
        <p class="subtitle">Aplikasi ini mengambil data langsung dari database MySQL Anda.</p>

        @if(isset($error) && $error)
            <div class="error-box">
                <strong>Oops!</strong> {{ $error }}
            </div>
        @endif

        @if(count($users) > 0)
            <ul class="user-list">
                @foreach($users as $user)
                    <li class="user-item">{{ $user->name }}</li>
                @endforeach
            </ul>
        @else
            @if(!isset($error) || !$error)
                <div class="empty-state">
                    Belum ada data pengguna di database.
                </div>
            @endif
        @endif
    </div>

</body>
</html>
