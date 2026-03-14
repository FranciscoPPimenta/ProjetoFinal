import * as THREE from 'three';
import { OrbitControls } from 'three/addons/controls/OrbitControls.js';
import { GLTFLoader } from 'three/addons/loaders/GLTFLoader.js';

let scene, camera, renderer, controls, light, model;
let containerEl;

function base64ToObjectURL(base64, mimeType) {
  const binary = atob(base64);
  const bytes = new Uint8Array(binary.length);
  for (let i = 0; i < binary.length; i++) bytes[i] = binary.charCodeAt(i);
  const blob = new Blob([bytes], { type: mimeType });
  return URL.createObjectURL(blob);
}

function init(container) {
  containerEl = container;

  scene = new THREE.Scene();
  scene.background = new THREE.Color('gainsboro');

  camera = new THREE.PerspectiveCamera(30, 2, 0.1, 1000);
  camera.position.set(0, 0, 10);

  renderer = new THREE.WebGLRenderer({ antialias: true });
  renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));
  containerEl.appendChild(renderer.domElement);

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

  window.addEventListener('resize', () => requestAnimationFrame(resize));
}

function resize() {
  if (!renderer || !camera || !containerEl) return;
  const w = containerEl.clientWidth;
  const h = containerEl.clientHeight;
  if (w <= 0 || h <= 0) return;

  renderer.setSize(w, h, false);
  camera.aspect = w / h;
  camera.updateProjectionMatrix();
}

export async function renderPreview(containerId, texturaBase64, objetoBase64) {
  const container = document.getElementById(containerId);
  if (!container) throw new Error(`Missing container #${containerId}`);

  if (!renderer) init(container);

  resize();

  if (model) {
    scene.remove(model);
    model = null;
  }

  const textureUrl = `data:image/png;base64,${texturaBase64}`;
  const glbUrl = base64ToObjectURL(objetoBase64, 'model/gltf-binary');

  try {
    const [texture, gltf] = await Promise.all([
      new THREE.TextureLoader().loadAsync(textureUrl),
      new GLTFLoader().loadAsync(glbUrl),
    ]);

    model = gltf.scene;

    model.traverse((node) => {
      if (node.isMesh && node.material) {
        node.material.map = texture;
        node.material.needsUpdate = true;
      }
    });

    scene.add(model);

    const box = new THREE.Box3().setFromObject(model);
    const size = box.getSize(new THREE.Vector3());
    if (size.x > 10) model.scale.setScalar(0.05);

    resize();
    return true;
  } finally {
    URL.revokeObjectURL(glbUrl);
  }
}

export function disposePreview() {
  if (!renderer) return;
  renderer.setAnimationLoop(null);
  renderer.dispose();
  renderer.domElement?.remove();
  renderer = null;
  scene = camera = controls = light = model = containerEl = null;
}