document.addEventListener('DOMContentLoaded', () => {
    const videoElement = document.getElementById('cameraStream');
    const btnStart = document.getElementById('btnStart');
    const btnStop = document.getElementById('btnStop');
    const btnSwitch = document.getElementById('btnSwitch');
    const errorMessage = document.getElementById('errorMessage');
    const loadingOverlay = document.getElementById('loadingOverlay');

    let currentStream = null;
    let usingFrontCamera = true;

    // Check if browser supports mediaDevices
    if (!navigator.mediaDevices || !navigator.mediaDevices.getUserMedia) {
        showError("Tu navegador no soporta el acceso a la cámara o no estás usando HTTPS.");
        btnStart.disabled = true;
        return;
    }

    async function startCamera() {
        loadingOverlay.classList.remove('d-none');
        errorMessage.classList.add('d-none');
        
        // Stop current stream if exists
        stopCamera();

        const constraints = {
            video: {
                facingMode: usingFrontCamera ? "user" : "environment",
                width: { ideal: 1280 },
                height: { ideal: 720 }
            }
        };

        try {
            currentStream = await navigator.mediaDevices.getUserMedia(constraints);
            videoElement.srcObject = currentStream;
            
            btnStart.disabled = true;
            btnStop.disabled = false;
            btnSwitch.disabled = false;
        } catch (error) {
            console.error("Error accediendo a la cámara: ", error);
            showError(`Error al acceder a la cámara: ${error.message}`);
        } finally {
            loadingOverlay.classList.add('d-none');
        }
    }

    function stopCamera() {
        if (currentStream) {
            currentStream.getTracks().forEach(track => {
                track.stop();
            });
            videoElement.srcObject = null;
            currentStream = null;
        }
        
        btnStart.disabled = false;
        btnStop.disabled = true;
        btnSwitch.disabled = true;
    }

    function switchCamera() {
        usingFrontCamera = !usingFrontCamera;
        if (currentStream) {
            startCamera();
        }
    }

    function showError(msg) {
        errorMessage.textContent = msg;
        errorMessage.classList.remove('d-none');
    }

    btnStart.addEventListener('click', startCamera);
    btnStop.addEventListener('click', stopCamera);
    btnSwitch.addEventListener('click', switchCamera);
});
