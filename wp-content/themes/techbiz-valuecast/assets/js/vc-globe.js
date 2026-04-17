(function () {
  'use strict';

  var container = document.getElementById('vc-globe-container');
  if (!container) return;

  // Scene
  var scene = new THREE.Scene();
  var camera = new THREE.PerspectiveCamera(45, container.clientWidth / container.clientHeight, 0.1, 1000);
  camera.position.z = 18;

  var renderer = new THREE.WebGLRenderer({ antialias: true, alpha: true });
  renderer.setSize(container.clientWidth, container.clientHeight);
  renderer.setPixelRatio(window.devicePixelRatio);
  container.appendChild(renderer.domElement);

  // Orbit controls
  var controls = new THREE.OrbitControls(camera, renderer.domElement);
  controls.enableDamping = true;
  controls.dampingFactor = 0.05;
  controls.enableZoom = false;
  controls.enablePan = false;

  var globeGroup = new THREE.Group();
  scene.add(globeGroup);

  var GLOBE_RADIUS = 4.5;

  // Inner dark sphere (hides back-face lines)
  var innerGeo = new THREE.SphereGeometry(GLOBE_RADIUS - 0.05, 64, 64);
  var innerMat = new THREE.MeshBasicMaterial({ color: 0x06101e });
  globeGroup.add(new THREE.Mesh(innerGeo, innerMat));

  // Dotted globe surface
  var dotPositions = [];
  for (var lat = -85; lat <= 85; lat += 2.5) {
    var radiusAtLat = Math.cos(lat * Math.PI / 180) * GLOBE_RADIUS;
    var circumference = 2 * Math.PI * radiusAtLat;
    var numDots = Math.floor(circumference / 0.25);
    for (var i = 0; i < numDots; i++) {
      var lon = (i / numDots) * 360 - 180;
      var phi = (90 - lat) * (Math.PI / 180);
      var theta = (lon + 180) * (Math.PI / 180);
      dotPositions.push(
        -(GLOBE_RADIUS * Math.sin(phi) * Math.cos(theta)),
        GLOBE_RADIUS * Math.cos(phi),
        GLOBE_RADIUS * Math.sin(phi) * Math.sin(theta)
      );
    }
  }

  var dotGeo = new THREE.BufferGeometry();
  dotGeo.setAttribute('position', new THREE.Float32BufferAttribute(dotPositions, 3));

  // Circular dot texture
  var canvas = document.createElement('canvas');
  canvas.width = 16;
  canvas.height = 16;
  var ctx = canvas.getContext('2d');
  ctx.beginPath();
  ctx.arc(8, 8, 8, 0, Math.PI * 2);
  ctx.fillStyle = '#ffffff';
  ctx.fill();
  var dotTexture = new THREE.CanvasTexture(canvas);

  var dotMat = new THREE.PointsMaterial({
    color: 0x24558e,
    size: 0.08,
    map: dotTexture,
    transparent: true,
    opacity: 0.8,
    depthWrite: false
  });
  globeGroup.add(new THREE.Points(dotGeo, dotMat));

  // --- Animated arcs ---
  function getPosFromLatLon(lat, lon, radius) {
    var phi = (90 - lat) * (Math.PI / 180);
    var theta = (lon + 180) * (Math.PI / 180);
    return new THREE.Vector3(
      -(radius * Math.sin(phi) * Math.cos(theta)),
      radius * Math.cos(phi),
      radius * Math.sin(phi) * Math.sin(theta)
    );
  }

  var arcVertexShader = [
    'attribute float vertexIdx;',
    'varying float vProgress;',
    'void main() {',
    '  vProgress = vertexIdx / 100.0;',
    '  gl_Position = projectionMatrix * modelViewMatrix * vec4(position, 1.0);',
    '}'
  ].join('\n');

  var arcFragmentShader = [
    'uniform vec3 color;',
    'uniform float time;',
    'varying float vProgress;',
    'void main() {',
    '  float tailLength = 0.35;',
    '  float head = mod(time, 1.0 + tailLength);',
    '  float alpha = 0.0;',
    '  if (vProgress <= head && vProgress >= head - tailLength) {',
    '    alpha = (vProgress - (head - tailLength)) / tailLength;',
    '    alpha = pow(alpha, 1.5);',
    '  }',
    '  gl_FragColor = vec4(color, alpha);',
    '}'
  ].join('\n');

  var arcUniformsArray = [];

  function createAnimatedArc(startLat, startLon, endLat, endLon, colorHex) {
    var start = getPosFromLatLon(startLat, startLon, GLOBE_RADIUS);
    var end = getPosFromLatLon(endLat, endLon, GLOBE_RADIUS);
    var distance = start.distanceTo(end);
    var mid = start.clone().lerp(end, 0.5);
    mid.normalize().multiplyScalar(GLOBE_RADIUS + distance * 0.4);

    var curve = new THREE.QuadraticBezierCurve3(start, mid, end);
    var points = curve.getPoints(100);
    var geometry = new THREE.BufferGeometry().setFromPoints(points);

    var vertexIndices = new Float32Array(points.length);
    for (var j = 0; j < points.length; j++) vertexIndices[j] = j;
    geometry.setAttribute('vertexIdx', new THREE.BufferAttribute(vertexIndices, 1));

    var uniforms = {
      color: { value: new THREE.Color(colorHex) },
      time: { value: Math.random() }
    };
    arcUniformsArray.push(uniforms);

    var material = new THREE.ShaderMaterial({
      uniforms: uniforms,
      vertexShader: arcVertexShader,
      fragmentShader: arcFragmentShader,
      transparent: true,
      depthWrite: false,
      blending: THREE.AdditiveBlending
    });

    globeGroup.add(new THREE.Line(geometry, material));
    createMarker(start, colorHex);
    createMarker(end, colorHex);
  }

  function createMarker(position, colorHex) {
    var ringGeo = new THREE.RingGeometry(0.06, 0.12, 32);
    var ringMat = new THREE.MeshBasicMaterial({
      color: colorHex,
      side: THREE.DoubleSide,
      transparent: true,
      opacity: 0.8,
      blending: THREE.AdditiveBlending
    });
    var marker = new THREE.Mesh(ringGeo, ringMat);
    marker.position.copy(position);
    marker.quaternion.setFromUnitVectors(new THREE.Vector3(0, 0, 1), position.clone().normalize());
    globeGroup.add(marker);

    var cDotGeo = new THREE.CircleGeometry(0.04, 32);
    var cDotMat = new THREE.MeshBasicMaterial({ color: 0xffffff });
    var centerDot = new THREE.Mesh(cDotGeo, cDotMat);
    centerDot.position.copy(position);
    centerDot.quaternion.copy(marker.quaternion);
    centerDot.position.add(position.clone().normalize().multiplyScalar(0.01));
    globeGroup.add(centerDot);
  }

  // --- Text Labels ---
  function createTextSprite(message) {
    var canvas = document.createElement('canvas');
    var context = canvas.getContext('2d');
    var fontSize = 18;
    context.font = "Bold " + fontSize + "px 'Barlow', Arial, sans-serif"; // Matches your theme
    
    var metrics = context.measureText(message);
    var textWidth = metrics.width;
    
    canvas.width = textWidth + 20;
    canvas.height = fontSize + 20;
    
    // Reset font after canvas resize
    context.font = "Bold " + fontSize + "px 'Barlow', Arial, sans-serif";
    context.fillStyle = "rgba(255, 255, 255, 0.9)"; // White text
    
    // Optional: Add a subtle shadow for readability
    context.shadowColor = "rgba(0, 0, 0, 0.8)";
    context.shadowBlur = 4;
    context.shadowOffsetX = 1;
    context.shadowOffsetY = 1;
    
    context.fillText(message, 10, fontSize);
    
    var texture = new THREE.CanvasTexture(canvas);
    var spriteMaterial = new THREE.SpriteMaterial({ 
      map: texture, 
      transparent: true, 
      depthTest: false // Ensures labels don't clip into the globe geometry
    });
    
    var sprite = new THREE.Sprite(spriteMaterial);
    var scale = 0.012; // Adjust this to make text bigger/smaller
    sprite.scale.set(canvas.width * scale, canvas.height * scale, 1);
    
    return sprite;
  }

  function addLabel(lat, lon, text) {
    // Multiply radius by 1.06 to hover slightly above the dots and arcs
    var pos = getPosFromLatLon(lat, lon, GLOBE_RADIUS * 1.06); 
    var sprite = createTextSprite(text);
    sprite.position.copy(pos);
    globeGroup.add(sprite);
  }

  // Routes
  createAnimatedArc(40.71, -74.00, 51.50, -0.12, 0xa855f7);  // NY → London
  createAnimatedArc(34.05, -118.24, 48.85, 2.35, 0xf97316);  // LA → Paris
  createAnimatedArc(51.50, -0.12, 40.41, -3.70, 0xa855f7);   // London → Madrid
  createAnimatedArc(48.85, 2.35, 41.90, 12.49, 0xef4444);    // Paris → Rome
  createAnimatedArc(41.90, 12.49, 25.20, 55.27, 0xeab308);   // Rome → Dubai
  createAnimatedArc(55.75, 37.61, 25.20, 55.27, 0x06b6d4);   // Moscow → Dubai
  
  // --- Add Labels ---
  addLabel(28.61, 77.20, "India");         // New Delhi
  addLabel(33.74, -84.38, "Atlanta");      // Atlanta, GA
  addLabel(25.76, -80.19, "Florida");      // Miami, FL
  // addLabel(34.05, -118.24, "Los Angeles");

  // Tilt
  globeGroup.rotation.x = 0.3;
  globeGroup.rotation.y = -0.5;

  // Animation loop
  var clock = new THREE.Clock();

  function animate() {
    requestAnimationFrame(animate);
    var delta = clock.getDelta();
    globeGroup.rotation.y += 0.0015;
    arcUniformsArray.forEach(function (u) { u.time.value += delta * 0.4; });
    controls.update();
    renderer.render(scene, camera);
  }

  function resizeGlobe() {
    if (!container) return;
    camera.aspect = container.clientWidth / container.clientHeight;
    camera.updateProjectionMatrix();
    renderer.setSize(container.clientWidth, container.clientHeight);
  }

  window.addEventListener('resize', resizeGlobe);
  resizeGlobe();
  animate();
})();