import * as THREE from 'three';
export function createText(var_arr_texto){
        let var_text = var_arr_texto[0];
        let posX = var_arr_texto[1];
        let posY = var_arr_texto[2];
        let posZ = var_arr_texto[3];
        let rotY = var_arr_texto[4];
        let size = var_arr_texto[5];
        let font = var_arr_texto[6];
        let matDark = var_arr_texto[7]
        const shapes = font.generateShapes( var_text, size );
        const geometry = new THREE.ShapeGeometry( shapes );
        geometry.computeBoundingBox();
        const xMid = - 0.5 * ( geometry.boundingBox.max.x - geometry.boundingBox.min.x );
        geometry.translate( xMid, posY, posZ );

        const holeShapes = [];

        for (const shape of shapes) {

            if (shape.holes && shape.holes.length > 0) {

                for (const hole of shape.holes) {
                holeShapes.push(hole);
                }

            }

        }

        shapes.push(...holeShapes );

        const lineText = new THREE.Object3D();

        for (const shape of shapes) {

            const points = shape.getPoints();
            const geometry = new THREE.BufferGeometry().setFromPoints(points);

            geometry.translate(xMid + posX, posY, posZ);

            const lineMesh = new THREE.Line(geometry, matDark);
            lineText.add(lineMesh);

        }
        lineText.rotation.y= rotY;
        lineText.name = var_text;
        return lineText;
}

