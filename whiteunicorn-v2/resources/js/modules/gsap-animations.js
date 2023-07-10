/**
 * DrawSVG - Animate svg paths
 */
function introAnimation() {

    goldLogoAnimation();

    
    function goldLogoAnimation() {
        const $goldLogo = $loadingScreen.find(".gold-logo-svg");
        if (!$goldLogo) return;
        const $maskPaths = $goldLogo.find(".mask-path");
        gsap.registerPlugin(DrawSVGPlugin);
        gsap.set($maskPaths, { drawSVG: 0 });
        gsap.set($goldLogo, { opacity: 1 });
        let tl = gsap.timeline({ onComplete: animationComplete }).timeScale(1.3);
        tl.to($maskPaths, {
            drawSVG: true,
            ease: "sine.inOut",
            duration: 0.75,
            stagger: .5,
        });

        function animationComplete() {
            $body.addClass("intro-animation-completed");
        }
    }
}