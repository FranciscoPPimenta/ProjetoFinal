import * as THREE from 'three';
import * as Text from './text.js';
import * as NewText from './newText.js';
import { FontLoader } from 'three/addons/loaders/FontLoader.js';
import { GLTFLoader } from 'three/addons/loaders/GLTFLoader.js';
import * as Model from './3D/3D.js';
// import * as Moving from './movingobjects.js';
export let camera,scene, renderer, canvas,cubeSize=2,clock,controls,sphere,loader3D = new GLTFLoader(),loaderText = new FontLoader(),negative_infinity = -100000,model,models=[],movingmodels=[],buttonZoom;
let transformControls;
let firstPart,secondPart; 
let variableButton;
const startPosition = new THREE.Vector3(0,0,45);
let ThreeDModel = null;
let start = true,change = false;
const textGroup = new THREE.Group();
let buttons = document.querySelectorAll('button[id*="btn_"]');

let isRotatingModel = false;
let lastMouseX = 0;
let lastMouseY = 0;
const rotationSpeed = 0.005;
let small = false;
let wheelTimeout = null; 
let zPos;


function init( ){
    
    
    buttons.forEach(button => {
    console.log(button.id);
    console.log(buttons.length);
    });

    canvas = document.getElementById('c');
    const leftSide = document.getElementById("left");
    scene = new THREE.Scene();
    scene.background = new THREE.Color(0xD9D9D9);

    renderer = new THREE.WebGLRenderer({canvas, antialias: true});
    renderer.setPixelRatio(Math.min(window.devicePixelRatio,2));

    camera = new THREE.PerspectiveCamera(45,2,0.1,45);
    camera.position.copy(startPosition);

    const light = new THREE.DirectionalLight(0xffffff,2);
    light.position.set(20,20,50);
    scene.add(light);

    renderer?.domElement?.addEventListener('mousedown', (e) => {
        console.log(e);
        if (!ThreeDModel) return;

        isRotatingModel = true;
        lastMouseX = e.clientX;
        lastMouseY = e.clientY;

        // Disable transform controls while rotating
        if (transformControls) transformControls.enabled = false;
    });


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


globalThis.zoomTo = function(buttonID,buttonName,texture,object) {
    console.log(small);
    let space;
    
    buttons.forEach(b => b.disabled = true);

    if (buttonName.includes(' ')) {
        space = true;
        [firstPart, secondPart] = buttonName.split(' ');
    }

    variableButton = buttonID;


    if(textGroup.children.length > 0){
        if(textGroup.children[0].name === buttonName && change === false){
            return;
        }
    }

    
    if (ThreeDModel) {
        console.log('retard'+small);
        gsap.to(ThreeDModel.position, {
            z: ThreeDModel.position.z-10,
            duration: 0.8,
            ease: "power3.out"
        });
        gsap.to(ThreeDModel.scale, {
            x: 0.001,
            y: 0.001,
            z: 0.001,
            duration: 0.8,
            ease: "power3.out",
            onComplete:function(){
                small = true;
            }
        });

        if(small === true){
            console.log(small+' niggachan');
            scene.remove(ThreeDModel);
            ThreeDModel = null;
            console.log(small+' niggakun');
        }
    }

    if(!ThreeDModel){
        console.log("preto");
        small = false;
    }

    clearTextGroup(textGroup);


    if(start){
        gsap.to(camera.position, {
                x: 0,
                y: 0,
                z: -35,
                duration: 2,
                onStart:function(){
                    
                    console.log('disabling buttons:', buttons.length);
                    buttons.forEach(b => b.disabled = true);

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
                    buttons.forEach(b => b.disabled = false);
                    start = false;
                    change = false;
                    Model.objeto(texture, object).then((loadedModel) => {
                        
                        ThreeDModel = loadedModel;

                            const finalPos = { x: 0.2, y: -0.2, z: -43 };
                            const finalScale = 0.02;
                            const finalRotY = -1.5;

                            ThreeDModel.position.set(finalPos.x, finalPos.y, finalPos.z - 10);
                            ThreeDModel.scale.set(0.001, 0.001, 0.001);
                            ThreeDModel.rotation.set(0, finalRotY, 0);

                            zPos = ThreeDModel.position.z;
                            console.log(zPos);

                            scene.add(ThreeDModel);

                            gsap.to(ThreeDModel.position, {
                                z: finalPos.z,
                                duration: 0.8,
                                ease: "power3.out"
                            });

                            gsap.to(ThreeDModel.scale, {
                                x: finalScale,
                                y: finalScale,
                                z: finalScale,
                                duration: 0.8,
                                ease: "power3.out"
                            });
                                
                    }).catch(console.error);
                    
                }
            });
    }
    else{
        gsap.to(camera.position,{
            x: startPosition.x,
            y: startPosition.y,
            z: startPosition.z,
            duration: 1,
            onStart:function(){
                                
                console.log('disabling buttons:', buttons.length);
                buttons.forEach(b => b.disabled = true);

            },
            onComplete:function(){
                buttons.forEach(b => b.disabled = false);
                start = true;
                change = true;
                zoomTo(buttonID,buttonName,texture,object);
            }
        });
    }  
};


globalThis.addEventListener('mouseup', () => {
    isRotatingModel = false;
    if (!ThreeDModel) return;

    gsap.to(ThreeDModel.rotation, {
        x: 0, 
        y: -1.5,
        z: 0,
        duration: 0.4,
        ease: "power2.out"
    });
});


globalThis.addEventListener('wheel', (e) => {
    
    if (e.deltaY > 0) {
        console.log('scroll down');
        if (!ThreeDModel) return;
        
        ThreeDModel.position.z -= 1;
    } else {
        console.log('scroll up');
        if (!ThreeDModel) return;
        
        ThreeDModel.position.z += 1;
    }

    
    wheelTimeout = setTimeout(() => {
        // After 0.5s no wheel events, animate back to start
        gsap.to(ThreeDModel.position, {
            x: ThreeDModel.position.x,
            y: ThreeDModel.position.y,
            z: zPos+10,
            duration: 0.6,
            ease: "power2.out",
            onUpdate: render
        });
    }, 500);

    console.log(zPos);
    
});


globalThis.addEventListener('mousemove', (e) => {
    if (!isRotatingModel || !ThreeDModel) return;

    const dx = e.clientX - lastMouseX;
    const dy = e.clientY - lastMouseY;

    ThreeDModel.rotation.y += dx * rotationSpeed;

    ThreeDModel.rotation.x += dy * rotationSpeed;

    ThreeDModel.rotation.x = Math.max(
        -Math.PI / 2,
        Math.min(Math.PI / 2, ThreeDModel.rotation.x)
    );

    lastMouseX = e.clientX;
    lastMouseY = e.clientY;

    render();
});



init();