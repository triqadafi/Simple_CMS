<div class="container-fluid">

    <!-- 404 Error Text -->
    <div class="text-center">
        <div class="error mx-auto" data-text="403">403</div>
        <p class="lead text-gray-800 mb-5">Forbidden</p>
        <p class="text-gray-500 mb-0">It looks like you found a glitch in the matrix...</p>
        <a href="<?= base_url('auth') ?>">← Back to Dashboard</a>
    </div>

</div>
<style>
    .ml-auto,
    .mx-auto {
        margin-left: auto !important;
    }

    .mr-auto,
    .mx-auto {
        margin-right: auto !important;
    }

    .error {
        color: #5a5c69;
        font-size: 7rem;
        position: relative;
        line-height: 1;
        width: 12.5rem;
    }

    .error:before {
        content: attr(data-text);
        position: absolute;
        left: 10px;
        text-shadow: 2px 0 #4e73df;
        top: 0;
        color: #5a5c69;
        background: #f8f9fc;
        overflow: hidden;
        animation: noise-anim-2 3s infinite linear alternate-reverse;
    }

    .error:after {
        content: attr(data-text);
        position: absolute;
        left: 8px;
        text-shadow: -2px 0 #e74a3b;
        top: 0;
        color: #5a5c69;
        background: #f8f9fc;
        overflow: hidden;
        animation: noise-anim 2s infinite linear alternate-reverse;
    }

    @keyframes noise-anim {
        0% {
            clip-path: inset(79% 0 9% 0);
        }

        5% {
            clip-path: inset(2% 0 72% 0);
        }

        10% {
            clip-path: inset(75% 0 1% 0);
        }

        15% {
            clip-path: inset(26% 0 46% 0);
        }

        20% {
            clip-path: inset(38% 0 6% 0);
        }

        25% {
            clip-path: inset(7% 0 66% 0);
        }

        30% {
            clip-path: inset(24% 0 10% 0);
        }

        35% {
            clip-path: inset(97% 0 3% 0);
        }

        40% {
            clip-path: inset(74% 0 10% 0);
        }

        45% {
            clip-path: inset(65% 0 8% 0);
        }

        50% {
            clip-path: inset(74% 0 18% 0);
        }

        55% {
            clip-path: inset(37% 0 18% 0);
        }

        60% {
            clip-path: inset(99% 0 2% 0);
        }

        65% {
            clip-path: inset(38% 0 21% 0);
        }

        70% {
            clip-path: inset(60% 0 41% 0);
        }

        75% {
            clip-path: inset(55% 0 12% 0);
        }

        80% {
            clip-path: inset(12% 0 47% 0);
        }

        85% {
            clip-path: inset(12% 0 62% 0);
        }

        90% {
            clip-path: inset(73% 0 8% 0);
        }

        95% {
            clip-path: inset(32% 0 68% 0);
        }

        100% {
            clip-path: inset(79% 0 16% 0);
        }
    }

    @keyframes noise-anim-2 {
        0% {
            clip-path: inset(80% 0 7% 0);
        }

        5% {
            clip-path: inset(45% 0 16% 0);
        }

        10% {
            clip-path: inset(27% 0 43% 0);
        }

        15% {
            clip-path: inset(64% 0 14% 0);
        }

        20% {
            clip-path: inset(49% 0 11% 0);
        }

        25% {
            clip-path: inset(57% 0 7% 0);
        }

        30% {
            clip-path: inset(75% 0 22% 0);
        }

        35% {
            clip-path: inset(1% 0 71% 0);
        }

        40% {
            clip-path: inset(32% 0 34% 0);
        }

        45% {
            clip-path: inset(13% 0 70% 0);
        }

        50% {
            clip-path: inset(44% 0 6% 0);
        }

        55% {
            clip-path: inset(78% 0 1% 0);
        }

        60% {
            clip-path: inset(56% 0 28% 0);
        }

        65% {
            clip-path: inset(99% 0 1% 0);
        }

        70% {
            clip-path: inset(99% 0 2% 0);
        }

        75% {
            clip-path: inset(4% 0 68% 0);
        }

        80% {
            clip-path: inset(92% 0 4% 0);
        }

        85% {
            clip-path: inset(47% 0 34% 0);
        }

        90% {
            clip-path: inset(25% 0 73% 0);
        }

        95% {
            clip-path: inset(75% 0 8% 0);
        }

        100% {
            clip-path: inset(20% 0 52% 0);
        }
    }
</style>