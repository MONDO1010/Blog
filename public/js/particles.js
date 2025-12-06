/**
 * Particles Background Effect
 * Effet de particules légères en arrière-plan
 */
(function() {
    'use strict';

    const canvas = document.createElement('canvas');
    canvas.id = 'particles-canvas';
    canvas.style.cssText = `
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        pointer-events: none;
        z-index: -1;
    `;
    document.body.prepend(canvas);

    const ctx = canvas.getContext('2d');
    let particles = [];
    let animationId;

    // Configuration
    const config = {
        particleCount: 50,
        particleColor: 'rgba(102, 126, 234, 0.3)',
        lineColor: 'rgba(102, 126, 234, 0.1)',
        particleRadius: 2,
        speed: 0.5,
        lineDistance: 150
    };

    // Resize canvas
    function resize() {
        canvas.width = window.innerWidth;
        canvas.height = window.innerHeight;
    }

    // Particle class
    class Particle {
        constructor() {
            this.x = Math.random() * canvas.width;
            this.y = Math.random() * canvas.height;
            this.vx = (Math.random() - 0.5) * config.speed;
            this.vy = (Math.random() - 0.5) * config.speed;
            this.radius = Math.random() * config.particleRadius + 1;
        }

        update() {
            this.x += this.vx;
            this.y += this.vy;

            // Bounce off edges
            if (this.x < 0 || this.x > canvas.width) this.vx *= -1;
            if (this.y < 0 || this.y > canvas.height) this.vy *= -1;
        }

        draw() {
            ctx.beginPath();
            ctx.arc(this.x, this.y, this.radius, 0, Math.PI * 2);
            ctx.fillStyle = config.particleColor;
            ctx.fill();
        }
    }

    // Initialize particles
    function init() {
        particles = [];
        for (let i = 0; i < config.particleCount; i++) {
            particles.push(new Particle());
        }
    }

    // Draw lines between nearby particles
    function drawLines() {
        for (let i = 0; i < particles.length; i++) {
            for (let j = i + 1; j < particles.length; j++) {
                const dx = particles[i].x - particles[j].x;
                const dy = particles[i].y - particles[j].y;
                const distance = Math.sqrt(dx * dx + dy * dy);

                if (distance < config.lineDistance) {
                    const opacity = 1 - (distance / config.lineDistance);
                    ctx.beginPath();
                    ctx.moveTo(particles[i].x, particles[i].y);
                    ctx.lineTo(particles[j].x, particles[j].y);
                    ctx.strokeStyle = `rgba(102, 126, 234, ${opacity * 0.15})`;
                    ctx.lineWidth = 1;
                    ctx.stroke();
                }
            }
        }
    }

    // Animation loop
    function animate() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);

        particles.forEach(particle => {
            particle.update();
            particle.draw();
        });

        drawLines();
        animationId = requestAnimationFrame(animate);
    }

    // Start
    function start() {
        resize();
        init();
        animate();
    }

    // Event listeners
    window.addEventListener('resize', () => {
        resize();
        init();
    });

    // Reduce animation when not visible
    document.addEventListener('visibilitychange', () => {
        if (document.hidden) {
            cancelAnimationFrame(animationId);
        } else {
            animate();
        }
    });

    // Initialize when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', start);
    } else {
        start();
    }
})();
