import * as THREE from 'three';
import * as Text from './text.js';
import * as NewText from './newText.js';
import { OrbitControls } from 'three/addons/controls/OrbitControls.js';
import { FontLoader } from 'three/addons/loaders/FontLoader.js';
import { GLTFLoader } from 'three/addons/loaders/GLTFLoader.js';
// import * as Moving from './movingobjects.js';
export let camera,scene, renderer, canvas,cubeSize=2,clock,controls,sphere,loader3D = new GLTFLoader(),loaderText = new FontLoader(),negative_infinity = -100000,model,models=[],movingmodels=[],buttonZoom;
let getEventos = false,getUO=false;
let variableButton,container,firstPart,secondPart; 
const startPosition = new THREE.Vector3(0,0,45);
let start = true,change = false;
const textGroup = new THREE.Group();



function init( ){
    canvas = document.getElementById('c');
    const leftSide = document.getElementById("left");
    console.log(startPosition);
    scene = new THREE.Scene();
    scene.background = new THREE.Color(0xD9D9D9);

    renderer = new THREE.WebGLRenderer({canvas, antialias: true});
    renderer.setPixelRatio(Math.min(window.devicePixelRatio,2));

    camera = new THREE.PerspectiveCamera(45,2,0.1,45);
    camera.position.copy(startPosition);
    console.log(camera.position)

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


        Text.createText('Instituto Politécnico de Viana do Castelo',0,4,0,0,1,font,matLite);
        Text.createText('IPVC',0,-2,0,0,1,font,matLite);
        Text.createText('O teu ponto de partida!',0,-4,0,0,1,font,matLite);
        render();

    } ); 

    scene.add(textGroup);

    animate();
    
}

function render() {
    renderer.render( scene, camera );
}


function clearTextGroup(group) {
  group.traverse(obj => {
    if (obj.isMesh) {
      obj.geometry?.dispose();
      if (Array.isArray(obj.material)) obj.material.forEach(m => m.dispose());
      else obj.material?.dispose();
    }
  });

  while (group.children.length) group.remove(group.children[0]);
}


globalThis.zoomTo = function(buttonID,buttonName) {
    let space;
    
    console.log(firstPart);
    if(firstPart !== ""){
        console.log(firstPart);
    }
    const buttons = document.querySelectorAll('button[data-id^="initial-"]')
    buttons.forEach(button=>{
        button.setAttribute("disabled","");
        fade(button);     
    });
    if (buttonName.includes(' ')) {
        space = true;
        [firstPart, secondPart] = buttonName.split(' ');
    }
    variableButton = buttonID;


    if(textGroup.children.length > 0){
        console.log(textGroup.children[0].name);
        if(textGroup.children[0].name === buttonName && change === false){
            console.log("mesmo nome");
            return;
        }
    }


    clearTextGroup(textGroup);


    if(start){
        gsap.to(camera.position, {
                x: 0,
                y: 0,
                z: -35,
                duration: 2,
                onStart:function(){
                    loaderText.load('fonts/Kanit_Regular.json', function(font) {
                        const matLite = new THREE.MeshBasicMaterial({
                            color: 0x006699,
                            transparent: true,
                            opacity: 0.4,
                            side: THREE.DoubleSide
                        });

                        if (space) {
                            textGroup.add(NewText.createText(firstPart, 0, 0, -60, 0.05, 0.2, font, matLite));
                            textGroup.add(NewText.createText(secondPart, 0, -0.3, -60, 0.05, 0.2, font, matLite));
                        } else {
                            textGroup.add(NewText.createText(buttonName, 0.5, 0, -42, 0.05, 0.3, font, matLite));
                        }

                        render();
                        });
                },
                onComplete: function(){
                    start = false;
                    change = false;
                }
            });
    }
    else{
        gsap.to(camera.position,{
            x: startPosition.x,
            y: startPosition.y,
            z: startPosition.z,
            duration: 1,
            onComplete:function(){
                start = true;
                change = true;
                zoomTo(buttonID,buttonName);
            }
        });
    }  
};



init();