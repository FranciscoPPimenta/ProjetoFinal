import * as THREE from 'three';
import * as Text from './text.js';
import { OrbitControls } from 'three/addons/controls/OrbitControls.js';
import { FontLoader } from 'three/addons/loaders/FontLoader.js';
import { GLTFLoader } from 'three/addons/loaders/GLTFLoader.js';
// import * as Moving from './movingobjects.js';
export let camera,scene, renderer, canvas,cubeSize=2,clock,controls,sphere,loader3D = new GLTFLoader(),loaderText = new FontLoader(),negative_infinity = -100000,model,models=[],movingmodels=[],buttonZoom;
let getEventos = false,getUO=false;
let variableButton,container;            

function init( ){
    canvas = document.getElementById('c');
    const leftSide = document.getElementById("left");

    scene = new THREE.Scene();
    scene.background = new THREE.Color(0xD9D9D9);

    renderer = new THREE.WebGLRenderer({canvas, antialias: true});
    renderer.setPixelRatio(Math.min(window.devicePixelRatio,2));

    camera = new THREE.PerspectiveCamera(45,2,0.1,30);
    camera.position.set(0,0,25);

    resizeToLeft();

    window.addEventListener('resize',()=> requestAnimationFrame(resizeToLeft));

    const ReObserver = new ResizeObserver(()=>requestAnimationFrame(resizeToLeft));
    ReObserver.observe(leftSide);

    function resizeToLeft(){
        const width = leftSide.clientWidth;
        const height = leftSide.clientHeight;

        if (width <= 0 || height <= 0) return;

        const size = new THREE.Vector2();
        renderer.getSize(size);
        if(size.x === width && size.y === height) return;

        renderer.setSize(width,height,false);

        camera.aspect = width/height;
        camera.updateProjectionMatrix();
    }

    function animate(){
        requestAnimationFrame(animate);
        renderer.render(scene,camera);
    }

    loaderText.load( 'fonts/Kanit_Regular.json', function ( font ) {

        const color = 0x006699;

        const matLite = new THREE.MeshBasicMaterial( {
            color: color,
            transparent: true,
            opacity: 0.4,
            side: THREE.DoubleSide
        } );


        Text.createText('Instituto Politécnico de Viana do Castelo',0,0,0,0,0.5,font,matLite);
        Text.createText('IPVC',0,-1,0,0,0.5,font,matLite);
        render();

    } ); 

    animate();
    
}

function render() {
    renderer.render( scene, camera );
}


init();