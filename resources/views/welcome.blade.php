@extends('public.layouts.app')

@section('title', 'Beranda')

@section('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">

<style>
    body, html {
        margin: 0;
        padding: 0;
    }

    .hero {
        min-height: 90vh;
        position: relative;
        display: flex;
        align-items: flex-end;
        overflow: hidden;
        font-family: 'Plus Jakarta Sans', sans-serif;
        margin: 0;
        padding: 0;
    }

    .hero-bg {
        position: absolute;
        inset: 0;
        background: url('https://images.unsplash.com/photo-1438232992991-995b7058bbb3')
                    center / cover no-repeat;
    }

    .hero-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(
            135deg,
            rgba(11, 27, 58, 0.88) 0%,
            rgba(11, 27, 58, 0.55) 60%,
            rgba(26, 53, 96, 0.40) 100%
        );
    }

    .hero-deco {
        position: absolute;
        inset: 0;
        pointer-events: none;
        overflow: hidden;
    }
    .hero-deco::before,
    .hero-deco::after {
        content: '';
        position: absolute;
        top: -40px;
        height: 140%;
        transform: rotate(15deg);
        background: linear-gradient(
            180deg,
            transparent 0%,
            #F5C842 30%,
            #F5C842 70%,
            transparent 100%
        );
    }
    .hero-deco::before { left: -60px; width: 3px; opacity: 0.22; }
    .hero-deco::after  { left: -20px; width: 1px; opacity: 0.12; }

    .hero-content {
        position: relative;
        z-index: 2;
        padding: 0 5% 5rem;
        max-width: 660px;
    }

    .hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(245, 200, 66, 0.12);
        border: 1px solid rgba(245, 200, 66, 0.35);
        color: #F5C842;
        font-size: 12px;
        font-weight: 600;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        padding: 6px 14px;
        border-radius: 100px;
        margin-bottom: 20px;
    }
    .hero-badge-dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: #F5C842;
        animation: pulse 2s infinite;
    }
    @keyframes pulse {
        0%, 100% { opacity: 1; transform: scale(1); }
        50%       { opacity: 0.5; transform: scale(0.7); }
    }

    .hero-content h1 {
        color: #F9F6EE;
        font-size: 48px;
        font-weight: 800;
        line-height: 1.15;
        letter-spacing: -0.5px;
        margin: 0 0 16px;
    }
    .hero-content h1 em {
        font-style: normal;
        color: #F5C842;
        position: relative;
    }
    .hero-content h1 em::after {
        content: '';
        position: absolute;
        left: 0; bottom: -2px;
        width: 100%; height: 2px;
        background: #F5C842;
        opacity: 0.5;
        border-radius: 2px;
    }

    .hero-content p {
        color: rgba(249, 246, 238, 0.75);
        font-size: 17px;
        line-height: 1.7;
        margin: 0 0 28px;
        max-width: 480px;
    }

    .hero-actions {
        display: flex;
        align-items: center;
        gap: 14px;
        flex-wrap: wrap;
    }
    .hero-btn-primary {
        background: #F5C842;
        color: #0B1B3A;
        font-family: inherit;
        font-size: 15px;
        font-weight: 700;
        padding: 13px 26px;
        border-radius: 8px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: background 0.2s, transform 0.15s;
    }
    .hero-btn-primary:hover { background: #e6b82a; transform: translateY(-2px); }

    .hero-btn-secondary {
        color: rgba(249, 246, 238, 0.85);
        font-family: inherit;
        font-size: 15px;
        font-weight: 600;
        padding: 12px 22px;
        border-radius: 8px;
        border: 1px solid rgba(249, 246, 238, 0.25);
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: border-color 0.2s, color 0.2s, transform 0.15s;
    }
    .hero-btn-secondary:hover {
        border-color: rgba(249, 246, 238, 0.55);
        color: #F9F6EE;
        transform: translateY(-2px);
    }

    .hero-stats {
        position: absolute;
        bottom: 3rem;
        right: 5%;
        z-index: 2;
        display: flex;
        flex-direction: column;
        gap: 10px;
        align-items: flex-end;
    }
    .stat-card {
        background: rgba(249, 246, 238, 0.07);
        border: 1px solid rgba(249, 246, 238, 0.12);
        backdrop-filter: blur(8px);
        border-radius: 10px;
        padding: 10px 16px;
        text-align: right;
    }
    .stat-card strong {
        display: block;
        color: #F5C842;
        font-size: 22px;
        font-weight: 800;
        line-height: 1;
    }
    .stat-card span {
        color: rgba(249, 246, 238, 0.55);
        font-size: 11px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.08em;
    }

    .hero-scroll {
        position: absolute;
        bottom: 1.5rem;
        left: 50%;
        transform: translateX(-50%);
        z-index: 2;
        width: 1px;
        height: 32px;
        background: linear-gradient(180deg, rgba(245, 200, 66, 0.7) 0%, transparent 100%);
        animation: scrollAnim 1.8s ease-in-out infinite;
    }
    @keyframes scrollAnim {
        0%   { opacity: 0; transform: translateX(-50%) scaleY(0); transform-origin: top; }
        50%  { opacity: 1; transform: translateX(-50%) scaleY(1); }
        100% { opacity: 0; transform: translateX(-50%) scaleY(1); transform-origin: bottom; }
    }

    @media (max-width: 768px) {
        .hero-content h1 { font-size: 30px; }
        .hero-content p  { font-size: 15px; }
        .hero-stats      { display: none; }
        .hero-content    { padding: 0 5% 3.5rem; }
    }
</style>
@endsection

@section('content')
<section class="hero">
    <div class="hero-bg"></div>
    <div class="hero-overlay"></div>
    <div class="hero-deco"></div>

    <div class="hero-content">
        <h1>Bertumbuh dalam <em>Iman</em><br>& Kasih Kristus</h1>
        <p>Temukan panggilan hidupmu melalui pendidikan yang berakar pada Firman Tuhan dan dipandu oleh pengajar yang setia melayani.</p>
    </div>

    <div class="hero-scroll" aria-hidden="true"></div>
</section>
@endsection