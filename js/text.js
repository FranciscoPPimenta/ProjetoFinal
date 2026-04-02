import * as THREE from 'three';
import * as Main from './index.js';
export function createText(Text,posX,posY,posZ,rotY,size,font,matDark){
        const shapes = font.generateShapes( Text, size );
        const geometry = new THREE.ShapeGeometry( shapes );
        geometry.computeBoundingBox();
        const xMid = - 0.5 * ( geometry.boundingBox.max.x - geometry.boundingBox.min.x );
        geometry.translate( xMid, posY, posZ );
        // make shape ( N.B. edge view not visible )
        // const text = new THREE.Mesh( geometry, matLite );
        // text.position.z = - 150;
        // scene.add( text );

        // make line shape ( N.B. edge view remains visible )

        const holeShapes = [];

        for ( let i = 0; i < shapes.length; i ++ ) {

            const shape = shapes[ i ];

            if ( shape.holes && shape.holes.length > 0 ) {

                for ( let j = 0; j < shape.holes.length; j ++ ) {

                    const hole = shape.holes[ j ];
                    holeShapes.push( hole );

                }

            }

        }

        shapes.push.apply( shapes, holeShapes );

        const lineText = new THREE.Object3D();

        for ( let i = 0; i < shapes.length; i ++ ) {

            const shape = shapes[ i ];

            const points = shape.getPoints();
            const geometry = new THREE.BufferGeometry().setFromPoints( points );

            geometry.translate( xMid+posX, posY, posZ );

            const lineMesh = new THREE.Line( geometry, matDark );
            lineText.add( lineMesh );

        }
        lineText.rotation.y= rotY;
        Main.scene.add( lineText );
}

