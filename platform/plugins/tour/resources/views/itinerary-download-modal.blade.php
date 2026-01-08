<!-- Download Itinerary Modal -->
<div
    id="downloadItineraryModal"
    class="download-modal tw-fixed tw-inset-0 tw-z-[100] tw-flex tw-items-center tw-justify-center tw-bg-black/60 tw-backdrop-blur-sm tw-opacity-0 tw-pointer-events-none tw-transition-opacity tw-duration-300 tw-hidden"
    tabindex="-1"
    aria-labelledby="downloadItineraryModalLabel"
    aria-hidden="true"
    role="dialog"
    data-download-url=""
>
    <div class="download-modal-panel tw-w-[min(90vw,600px)] tw-bg-white tw-rounded-xl tw-shadow-2xl tw-overflow-hidden tw-transform tw-transition-all tw-duration-300 tw-opacity-0 tw--translate-y-6">
        <!-- Header -->
        <div class="tw-flex tw-items-center tw-justify-between tw-py-4 tw-px-5" style="background: linear-gradient(to right, #f19135, #f5a962);">
            <h5 class="tw-text-white tw-text-lg tw-font-bold tw-flex tw-items-center tw-gap-2" id="downloadItineraryModalLabel">
                <i class="fas fa-file-pdf"></i>
                <span>Tải File PDF</span>
            </h5>
            <button type="button" class="tw-text-white tw-p-2 tw-rounded-full tw-transition" aria-label="Close" data-modal-close>
                <i class="fas fa-times"></i>
            </button>
        </div>

        <!-- Body -->
        <div class="tw-px-6 tw-py-8 tw-text-center">
            <!-- Preparing Status -->
            <div class="preparing-status tw-mb-6">
                <div class="tw-flex tw-justify-center tw-mb-4">
                    <div class="tw-w-16 tw-h-16 tw-rounded-full tw-bg-yellow-100 tw-flex tw-items-center tw-justify-center" style="background-color: #fef0e6;">
                        <i class="fas fa-spinner tw-text-3xl tw-animate-spin" style="color: #f19135;"></i>
                    </div>
                </div>
                <p class="tw-text-gray-700 tw-font-medium tw-mb-2">
                    Đang chuẩn bị file pdf
                </p>
                <p class="tw-text-gray-500 tw-text-sm">
                    Vui lòng đợi trong giây lát
                </p>
            </div>

            <!-- PDF icon shown when countdown finishes -->
            <div class="pdf-icon-container tw-mb-6" style="display: none;">
                <div class="tw-flex tw-justify-center">
                    <div class="pdf-icon" aria-hidden="true" style="width:128px;height:128px;display:flex;align-items:center;justify-content:center;">
                        <!-- Simple PDF SVG icon -->
                        <svg viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg" width="128" height="128" role="img" aria-label="PDF">
                            <rect x="8" y="6" width="40" height="52" rx="3" ry="3" fill="#f5f5f5" stroke="#e3e3e3"/>
                            <path d="M46 6v14h14" transform="translate(-8,0)" fill="#f44336" />
                            <text x="32" y="42" font-family="Arial, Helvetica, sans-serif" font-size="10" font-weight="700" fill="#b71c1c" text-anchor="middle">PDF</text>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Countdown Timer -->
            <div class="countdown-section tw-my-8">
                <div class="countdown-circle-container tw-flex tw-justify-center tw-mb-6">
                    <div class="countdown-circle tw-relative tw-w-32 tw-h-32 tw-rounded-full tw-border-8 tw-flex tw-items-center tw-justify-center" style="border-color: #f5d8c8; background-color: #fef0e6;">
                        <svg class="countdown-svg tw-absolute tw-w-32 tw-h-32 tw-transform -tw-rotate-90" style="filter: drop-shadow(0 0 4px rgba(241, 145, 53, 0.3));">
                            <circle
                                class="countdown-progress"
                                cx="64"
                                cy="64"
                                r="60"
                                stroke="currentColor"
                                stroke-width="4"
                                fill="none"
                                stroke-dasharray="376.99"
                                stroke-dashoffset="0"
                                stroke-linecap="round"
                                style="color: #f19135; transition: stroke-dashoffset 1s linear;"
                            />
                        </svg>
                        <div class="countdown-text tw-text-center tw-relative tw-z-10">
                            <p class="countdown-number tw-text-5xl tw-font-bold tw-mb-0" style="color: #f19135;">10</p>
                            <p class="tw-text-sm tw-text-gray-500 tw-mt-1">giây</p>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Download Button (Hidden initially) -->
            <div class="download-button-section tw-mt-8 tw-hidden" style="display: none;">
                <p class="tw-text-gray-700 tw-font-medium tw-mb-4">
                    Lịch trình của bạn đã sẵn sàng!
                </p>
                <button type="button" class="btn-download-itinerary tw-inline-flex tw-items-center tw-justify-center tw-px-6 tw-py-3 tw-text-white tw-font-bold tw-rounded-lg tw-transition-all tw-duration-300 hover:tw-shadow-lg tw-flex tw-gap-2" style="background: linear-gradient(to right, #f19135, #f5a962);">
                    <i class="fas fa-download"></i>
                    <span class="download-button-text">Tải Xuống File PDF</span>
                </button>
            </div>
        </div>


    </div>
</div>

<style>
    .countdown-circle {
        box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .countdown-svg {
        filter: drop-shadow(0 0 6px rgba(59, 130, 246, 0.3));
    }

    .countdown-progress {
        transition: stroke-dashoffset 1s linear;
    }

    /* Modal animations */
    .download-modal.is-open .download-modal-panel {
        animation: slideInDown 0.3s ease-out;
    }

    @keyframes slideInDown {
        from {
            opacity: 0;
            transform: translateY(-30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Button hover effect */
    .btn-download-itinerary {
        position: relative;
        overflow: hidden;
    }

    .btn-download-itinerary::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.3);
        transform: translate(-50%, -50%);
        transition: width 0.6s, height 0.6s;
    }

    .btn-download-itinerary:hover::before {
        width: 300px;
        height: 300px;
    }

    .btn-download-itinerary i {
        position: relative;
        z-index: 1;
    }

    /* Spin animation for loading */
    @keyframes spin {
        from {
            transform: rotate(0deg);
        }
        to {
            transform: rotate(360deg);
        }
    }

    .tw-animate-spin {
        animation: spin 1s linear infinite;
    }

    /* PDF icon sizing to match countdown */
    .pdf-icon svg { width: 128px; height: 128px; }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const modal = document.getElementById('downloadItineraryModal');
        if (!modal) return;

        const modalPanel = modal.querySelector('.download-modal-panel');
        const modalTriggers = document.querySelectorAll('[data-modal-target="downloadItineraryModal"]');
        const closeButtons = modal.querySelectorAll('[data-modal-close]');

        let countdownInterval = null;
        let autoDownloadStarted = false;

        function openModal() {
            resetCountdown();
            startCountdown();

            modal.classList.remove('tw-hidden');
            modal.setAttribute('aria-hidden', 'false');
            requestAnimationFrame(() => {
                modal.classList.remove('tw-pointer-events-none', 'tw-opacity-0');
                modal.classList.add('tw-opacity-100', 'is-open');
                modalPanel?.classList.remove('tw-opacity-0', 'tw--translate-y-6');
                modalPanel?.classList.add('tw-opacity-100', 'tw-translate-y-0');
            });
        }

        function closeModal() {
            if (countdownInterval) {
                clearInterval(countdownInterval);
            }

            autoDownloadStarted = false;
            setButtonIdle();

            modal.classList.add('tw-pointer-events-none', 'tw-opacity-0');
            modal.classList.remove('tw-opacity-100', 'is-open');
            modal.setAttribute('aria-hidden', 'true');

            modalPanel?.classList.add('tw-opacity-0', 'tw--translate-y-6');
            modalPanel?.classList.remove('tw-translate-y-0');

            setTimeout(() => {
                modal.classList.add('tw-hidden');
            }, 220);
        }

        // Handle download button click (disable to prevent spam)
        const downloadBtn = modal.querySelector('.btn-download-itinerary');
        const downloadBtnText = modal.querySelector('.download-button-text');
        function setButtonLoading() {
            if (!downloadBtn) return;
            downloadBtn.disabled = true;
            downloadBtn.setAttribute('aria-busy', 'true');
            if (downloadBtnText) downloadBtnText.textContent = 'Đang tải...';
            downloadBtn.querySelector('i')?.classList.add('fa-spinner', 'tw-animate-spin');
        }
        function setButtonIdle() {
            if (!downloadBtn) return;
            downloadBtn.disabled = false;
            downloadBtn.removeAttribute('aria-busy');
            if (downloadBtnText) downloadBtnText.textContent = 'Tải Xuống File PDF';
            const icon = downloadBtn.querySelector('i');
            if (icon) {
                icon.classList.remove('fa-spinner', 'tw-animate-spin');
                icon.classList.add('fa-download');
            }
        }

        downloadBtn?.addEventListener('click', function(e) {
            e.preventDefault();
            if (downloadBtn.disabled) return; // already in progress
            setButtonLoading();
        });

        modalTriggers.forEach(trigger => {
            trigger.addEventListener('click', function(e) {
                e.preventDefault();
                openModal();
            });
        });

        closeButtons.forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                closeModal();
            });
        });

        modal.addEventListener('click', function(e) {
            if (e.target === modal) {
                closeModal();
            }
        });

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && !modal.classList.contains('tw-hidden')) {
                closeModal();
            }
        });

        function resetCountdown() {
            const countdownNumber = modal.querySelector('.countdown-number');
            countdownNumber.textContent = '10';

            const svg = modal.querySelector('.countdown-svg circle');
            svg.style.strokeDashoffset = '0';

            modal.querySelector('.download-button-section').style.display = 'none';
            modal.querySelector('.preparing-status').style.display = 'block';
            // ensure countdown visible and pdf icon hidden
            const countdownSection = modal.querySelector('.countdown-section');
            const pdfIcon = modal.querySelector('.pdf-icon-container');
            if (countdownSection) countdownSection.style.display = 'block';
            if (pdfIcon) pdfIcon.style.display = 'none';
            autoDownloadStarted = false;
        }

        function startCountdown() {
            if (countdownInterval) {
                clearInterval(countdownInterval);
            }

            let timeLeft = 10;
            const countdownNumber = modal.querySelector('.countdown-number');
            const svg = modal.querySelector('.countdown-svg circle');
            const circumference = 2 * Math.PI * 60; // r = 60

            countdownInterval = setInterval(function() {
                timeLeft--;
                const dashOffset = circumference * (timeLeft / 10 - 1);
                svg.style.strokeDashoffset = dashOffset;
                countdownNumber.textContent = timeLeft;

                if (timeLeft < 0) {
                    clearInterval(countdownInterval);
                    showDownloadButton();
                }
            }, 1000);
        }

        function showDownloadButton() {
            modal.querySelector('.preparing-status').style.display = 'none';
            modal.querySelector('.download-button-section').style.display = 'block';
            // swap countdown for PDF icon
            const countdownSection = modal.querySelector('.countdown-section');
            const pdfIcon = modal.querySelector('.pdf-icon-container');
            if (countdownSection) countdownSection.style.display = 'none';
            if (pdfIcon) pdfIcon.style.display = 'block';
        }


    });
</script>
