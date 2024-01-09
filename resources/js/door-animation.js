
import * as THREE from 'three';  // Utilisation de l'import pour charger Three.js
import $ from 'jquery';

$(document).ready(function() {
    // Déclaration des variables Three.js
    let scene, camera, renderer;
    let door;

    // Initialisation de la scène
    function init() {
        scene = new THREE.Scene();
        camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
        renderer = new THREE.WebGLRenderer();
        renderer.setSize(window.innerWidth, window.innerHeight);
        document.querySelector('.card').appendChild(renderer.domElement);

        // Création de la porte
        const doorGeometry = new THREE.BoxGeometry(1, 2, 0.1);
        const doorMaterial = new THREE.MeshBasicMaterial({ color: 0x00ff00 });
        door = new THREE.Mesh(doorGeometry, doorMaterial);
        scene.add(door);

        camera.position.z = 5;
    }

    // Animation de la porte
    function animate() {
        requestAnimationFrame(animate);

        // Animation de la porte
        door.rotation.y += 0.01;

        renderer.render(scene, camera);
    }

    // Gestion du clic sur la porte
    function onDoorClick() {
        // Ajoutez ici le code à exécuter lorsque la porte est cliquée
        console.log('Door clicked!');
    }

    // Initialise la scène et démarre l'animation
    init();
    animate();

    // Ajoute un gestionnaire d'événement au clic sur la porte
    $(document).on('click', '.card-header', onDoorClick);
});
