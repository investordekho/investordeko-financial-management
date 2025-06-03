<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Investor Dekho 3D Crystal</title>
  <style>
    html, body {
      margin: 0;
      height: 100%;
      overflow: hidden;
      background: radial-gradient(circle, #101010 0%, #000000 100%);
    }
    canvas {
      display: block;
    }
  </style>
</head>
<body>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/three@0.128.0/examples/js/controls/OrbitControls.js"></script>

  <script>
    const scene = new THREE.Scene();
    const camera = new THREE.PerspectiveCamera(60, window.innerWidth / window.innerHeight, 0.1, 1000);
    camera.position.z = 12;

    const renderer = new THREE.WebGLRenderer({ antialias: true });
    renderer.setSize(window.innerWidth, window.innerHeight);
    renderer.setPixelRatio(window.devicePixelRatio);
    document.body.appendChild(renderer.domElement);

    const controls = new THREE.OrbitControls(camera, renderer.domElement);
    controls.enableZoom = false;
    controls.enablePan = false;
    controls.autoRotate = true;
    controls.autoRotateSpeed = 1.2;

    // Lighting
    scene.add(new THREE.AmbientLight(0xffffff, 0.4));

    const directionalLight = new THREE.DirectionalLight(0xffffff, 1);
    directionalLight.position.set(5, 10, 10);
    scene.add(directionalLight);

    const backLight = new THREE.PointLight(0xaaaaaa, 1, 30);
    backLight.position.set(-5, -5, -10);
    scene.add(backLight);

    // High-Detail Crystal Shape
    const geometry = new THREE.IcosahedronGeometry(4, 2); // More sides with detail level 2
    const material = new THREE.MeshStandardMaterial({
      color: 0xe5e5e5,
      roughness: 0.2,
      metalness: 0.4,
      flatShading: true,
    });

    const shape = new THREE.Mesh(geometry, material);
    scene.add(shape);

    // Float animation
    const clock = new THREE.Clock();
    function animate() {
      requestAnimationFrame(animate);
      shape.position.y = Math.sin(clock.getElapsedTime() * 0.8) * 0.4;
      controls.update();
      renderer.render(scene, camera);
    }

    animate();

    // Resize handler
    window.addEventListener("resize", () => {
      camera.aspect = window.innerWidth / window.innerHeight;
      camera.updateProjectionMatrix();
      renderer.setSize(window.innerWidth, window.innerHeight);
    });
  </script>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\demo\investordeko-financial-management\resources\views\logoeffect.blade.php ENDPATH**/ ?>