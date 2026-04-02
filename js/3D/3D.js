import * as THREE from 'three';
import { OrbitControls } from 'three/addons/controls/OrbitControls.js';
import { GLTFLoader } from 'three/addons/loaders/GLTFLoader.js';

let container, scene, camera, renderer, controls, light;
let model = null;

// Helper: base64 -> Blob URL
function base64ToObjectURL(base64, mimeType) {
  const binary = atob(base64);
  const bytes = new Uint8Array(binary.length);
  for (let i = 0; i < binary.length; i++) bytes[i] = binary.charCodeAt(i);
  const blob = new Blob([bytes], { type: mimeType });
  return URL.createObjectURL(blob);
}

function initThreeIfNeeded(containerId) {
  const target = document.getElementById(containerId);
  if (!target) throw new Error(`Missing #${containerId} container`);

  if (renderer && container !== target) {
    container = target;

    if (renderer.domElement.parentElement !== container) {
      container.innerHTML = '';
      container.appendChild(renderer.domElement);
    }

    onResize();
    return;
  }

  if (renderer) return;

  container = target;

  scene = new THREE.Scene();
  scene.background = new THREE.Color('gainsboro');

  camera = new THREE.PerspectiveCamera(
    30,
    container.clientWidth / container.clientHeight,
    0.1,
    1000
  );
  camera.position.set(0, 0, 10);

  renderer = new THREE.WebGLRenderer({ antialias: true });
  renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));
  renderer.setSize(container.clientWidth, container.clientHeight, false);
  container.appendChild(renderer.domElement);

  controls = new OrbitControls(camera, renderer.domElement);
  controls.enableDamping = true;

  light = new THREE.DirectionalLight('white', Math.PI);
  light.position.set(30, 30, 30);
  scene.add(light);

  renderer.setAnimationLoop(() => {
    controls.update();
    light.position.copy(camera.position);
    renderer.render(scene, camera);
  });

  window.addEventListener('resize', () => requestAnimationFrame(onResize));
}

function onResize() {
  if (!renderer || !camera || !container) return;

  const width = container.clientWidth;
  const height = container.clientHeight;

  if (width <= 0 || height <= 0) return;

  renderer.setSize(width, height, false);
  camera.aspect = width / height;
  camera.updateProjectionMatrix();
}

export async function objeto(texturaBase64, objetoBase64, containerId = 'c') {
  initThreeIfNeeded(containerId);

  if (model) {
    scene.remove(model);
    model.traverse((node) => {
      if (node.isMesh) {
        node.geometry?.dispose?.();
        if (node.material?.map) node.material.map.dispose?.();
        node.material?.dispose?.();
      }
    });
    model = null;
  }

  const textureUrl = `data:image/png;base64,${texturaBase64}`;
  const glbUrl = base64ToObjectURL(objetoBase64, 'model/gltf-binary');

  const textureLoader = new THREE.TextureLoader();
  const gltfLoader = new GLTFLoader();

  try {
    const [texture, gltf] = await Promise.all([
      textureLoader.loadAsync(textureUrl),
      gltfLoader.loadAsync(glbUrl),
    ]);

    model = gltf.scene;

    model.traverse((node) => {
      if (node.isMesh && node.material) {
        node.material.map = texture;
        node.material.needsUpdate = true;
      }
    });

    const box = new THREE.Box3().setFromObject(model);
    const size = box.getSize(new THREE.Vector3());
    if (size.x > 10) model.scale.set(0.05, 0.05, 0.05);

    onResize();

    return model;
  } finally {
    URL.revokeObjectURL(glbUrl);
  }
}