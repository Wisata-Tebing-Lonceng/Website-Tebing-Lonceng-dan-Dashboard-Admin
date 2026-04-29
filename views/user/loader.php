<?php
// views/user/loader.php
?>
<style>
/* Tebing Lonceng - Global Loader */
.global-loader-overlay {
  position: fixed;
  inset: 0;
  z-index: 999999;
  background-color: #1a1a1a;
  display: flex;
  align-items: center;
  justify-content: center;
  /* Force GPU compositing for the overlay itself */
  will-change: transform;
  transform: translateZ(0);
}

.loader-content {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 20px;
}

.loader-logo-wrap {
  width: 140px;
  height: auto;
  /* Make logo white and GPU-accelerated */
  filter: brightness(0) invert(1);
  transform-origin: top center;
  will-change: transform;
  /* Pure CSS pendulum swing - runs on compositor thread (zero JS lag) */
  animation: bellSwing 2s cubic-bezier(0.37, 0, 0.63, 1) infinite;
}

.loader-logo-wrap svg {
  width: 100%;
  height: auto;
  display: block;
}

.loading-text {
  color: #FBF9F6;
  font-family: 'Instrument Serif', serif;
  font-size: 32px;
  font-weight: 400;
  letter-spacing: 2px;
  font-style: italic;
  opacity: 0.9;
  display: flex;
  align-items: flex-end;
}

.dot {
  font-family: 'Inter', sans-serif;
  font-style: normal;
  font-size: 20px;
  margin-left: 2px;
  animation: blink 1.5s infinite;
  will-change: opacity;
}
.dot:nth-of-type(1) { animation-delay: 0s; }
.dot:nth-of-type(2) { animation-delay: 0.3s; }
.dot:nth-of-type(3) { animation-delay: 0.6s; }

/* Natural pendulum swing: ease-out on each side using cubic-bezier */
@keyframes bellSwing {
  0%   { transform: rotate(-18deg); }
  50%  { transform: rotate(18deg); }
  100% { transform: rotate(-18deg); }
}

@keyframes blink {
  0%, 50% { opacity: 1; }
  51%, 100% { opacity: 0; }
}
</style>

<div class="global-loader-overlay" id="global-loader">
  <div class="loader-content">
    <div class="loader-logo-wrap" id="loader-logo">
      <?php
        // Inline SVG so it loads instantly with the page (no extra HTTP request)
        $svgPath = __DIR__ . '/../../assets/svg/logo.svg';
        if (file_exists($svgPath)) {
            $svg = file_get_contents($svgPath);
            // Strip XML declaration and DOCTYPE for clean inline HTML
            $svg = preg_replace('/<\?xml[^?]*\?>/i', '', $svg);
            $svg = preg_replace('/<!DOCTYPE[^>]*>/i', '', $svg);
            echo trim($svg);
        }
      ?>
    </div>
    <div class="loading-text">
      Tebing Lonceng<span class="dot">.</span><span class="dot">.</span><span class="dot">.</span>
    </div>
  </div>
</div>

<script>
// Hide the loader once the page is fully loaded
function hideLoader() {
    setTimeout(function() {
        var loader = document.getElementById("global-loader");
        if (!loader) return;

        if (typeof gsap !== 'undefined') {
            // GSAP only handles overlay slide-up (one-time, not repeating)
            gsap.to(loader, {
                yPercent: -100,
                duration: 1.0,
                ease: "power4.inOut",
                onComplete: function() {
                    loader.style.display = "none";
                    // Stop CSS animation to free resources once loader is hidden
                    var logo = document.getElementById("loader-logo");
                    if (logo) logo.style.animationPlayState = "paused";
                }
            });
        } else {
            loader.style.transition = "transform 0.8s ease";
            loader.style.transform = "translateY(-100%)";
            setTimeout(function() { loader.style.display = "none"; }, 800);
        }
    }, 500);
}

if (document.readyState === "complete") {
    hideLoader();
} else {
    window.addEventListener("load", hideLoader);
}

// Page transition: intercept internal link clicks
document.addEventListener("DOMContentLoaded", function() {
    var links = document.querySelectorAll('a[href]');
    links.forEach(function(link) {
        link.addEventListener('click', function(e) {
            var href = this.getAttribute('href');
            if (!href) return;

            var isInternal = !href.startsWith('#') &&
                             !href.startsWith('javascript:') &&
                             !href.startsWith('mailto:') &&
                             !href.startsWith('tel:') &&
                             !href.startsWith('http') &&
                             this.target !== '_blank';

            if (isInternal) {
                e.preventDefault();
                var loader = document.getElementById("global-loader");
                if (!loader) { window.location.href = href; return; }

                // Reset and show loader
                loader.style.display = "flex";
                var logo = document.getElementById("loader-logo");
                if (logo) logo.style.animationPlayState = "running";

                if (typeof gsap !== 'undefined') {
                    gsap.fromTo(loader,
                        { yPercent: 100 },
                        {
                            yPercent: 0,
                            duration: 0.7,
                            ease: "power3.inOut",
                            onComplete: function() {
                                window.location.href = href;
                            }
                        }
                    );
                } else {
                    loader.style.transform = "translateY(0)";
                    setTimeout(function() { window.location.href = href; }, 500);
                }
            }
        });
    });
});
</script>
