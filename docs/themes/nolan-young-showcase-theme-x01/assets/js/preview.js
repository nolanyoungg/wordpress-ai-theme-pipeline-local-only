

document.addEventListener('DOMContentLoaded', () => {


    const menuTriggers = document.querySelectorAll('.nolan-menu__trigger');


    const panels = document.querySelectorAll('.nolan-menu__panel');


    const backdrops = document.querySelector('.nolan-menu__backdrop');





    function closeAllPanels() {


        panels.forEach(panel => panel.style.display = 'none');


        backdrops.style.display = 'none';


        document.body.style.overflow = '';


    }





    menuTriggers.forEach(trigger => {


        trigger.addEventListener('click', (e) => {


            const targetPanelId = e.target.getAttribute('data-menu-item');


            const targetPanel = document.querySelector(`div[data-menu-dropdown=${targetPanelId}]`);





            if (targetPanel.style.display === 'none' || !targetPanel.style.display) {


                closeAllPanels();


                targetPanel.style.display = 'block';


                backdrops.style.display = 'block';


                document.body.style.overflow = 'hidden';


            } else {


                closeAllPanels();


            }


        });


    });





    backdrops.addEventListener('click', () => {


        closeAllPanels();


    });





    document.addEventListener('keydown', (e) => {


        if (e.key === 'Escape') {


            closeAllPanels();


        }


    });





    const railButtons = document.querySelectorAll('.nolan-menu__rail-button');


    railButtons.forEach(button => {


        button.addEventListener('click', () => {


            const targetContentId = button.getAttribute('data-rail-item');


            const contents = document.querySelectorAll('.nolan-menu__content section');





            contents.forEach(content => {


                if (content.getAttribute('data-rail-content') === targetContentId) {


                    content.style.display = 'block';


                } else {


                    content.style.display = 'none';


                }


            });


        });





        button.addEventListener('focus', () => {


            const targetContentId = button.getAttribute('data-rail-item');


            const contents = document.querySelectorAll('.nolan-menu__content section');





            contents.forEach(content => {


                if (content.getAttribute('data-rail-content') === targetContentId) {


                    content.style.display = 'block';


                } else {


                    content.style.display = 'none';


                }


            });


        });


    });





    // Add mobile menu interactions here


});


