document.addEventListener('DOMContentLoaded', function () {
    const opcionSelect = document.getElementById('type_certificate');

    const bloque1 = document.getElementById('bloque1');
    const bloque2 = document.getElementById('bloque2');
    const bloque3 = document.getElementById('bloque3');
    const bloque4 = document.getElementById('bloque4');
    const bloque5 = document.getElementById('bloque5');
    const bloque6 = document.getElementById('bloque6');
    const bloque7 = document.getElementById('bloque7');
    const bloque8 = document.getElementById('bloque8');
    const bloque9 = document.getElementById('bloque9');
    const bloque10 = document.getElementById('bloque10');
    const bloque11 = document.getElementById('bloque11');
    const bloque12 = document.getElementById('bloque12');


    bloque9.style.display = 'none';
    if(bloque10 != null){
        bloque10.style.display = 'none';
        bloque11.style.display = 'none';
        bloque12.style.display = 'none';
    }
    if (opcionSelect.value === 'cm') {
        bloque1.style.display = 'none';
        bloque2.style.display = 'none';
        bloque3.style.display = 'block';
        bloque4.style.display = 'block';
        bloque5.style.display = 'none';
        bloque6.style.display = 'none';
        bloque7.style.display = 'none';
        bloque8.style.display = 'none';
        bloque9.style.display = 'block';
        if(bloque10 != null){
            bloque10.style.display = 'none';
            bloque11.style.display = 'none';
            bloque12.style.display = 'none';
        }

    }else if(opcionSelect.value === 't'){
        
        bloque1.style.display = 'none';
        bloque2.style.display = 'none';
        bloque3.style.display = 'block';
        bloque4.style.display = 'block';
        bloque5.style.display = 'block';
        bloque6.style.display = 'none';
        bloque7.style.display = 'block';
        bloque8.style.display = 'block';
        bloque9.style.display = 'none';
        if(bloque10 != null){
            bloque10.style.display = 'block';
            bloque11.style.display = 'block';
            bloque12.style.display = 'block';
        }

    }
    opcionSelect.addEventListener('change', function () {
        bloque1.style.display = 'block';
        bloque2.style.display = 'block';
        bloque3.style.display = 'block';
        bloque4.style.display = 'block';
        bloque5.style.display = 'block';
        bloque6.style.display = 'block';
        bloque7.style.display = 'block';
        bloque8.style.display = 'block';
        bloque9.style.display = 'none';
        if(bloque10 != null){
            bloque10.style.display = 'none';
            bloque11.style.display = 'none';
            bloque12.style.display = 'none';
        }

        if (opcionSelect.value === 'cm') {
            bloque1.style.display = 'none';
            bloque2.style.display = 'none';
            bloque3.style.display = 'block';
            bloque4.style.display = 'block';
            bloque5.style.display = 'none';
            bloque6.style.display = 'none';
            bloque7.style.display = 'none';
            bloque8.style.display = 'none';
            bloque9.style.display = 'block';
            if(bloque10 != null){
                bloque10.style.display = 'none';
                bloque11.style.display = 'none';
                bloque12.style.display = 'none';
            }  

        }else if(opcionSelect.value === 'c'){
            bloque1.style.display = 'block';
            bloque2.style.display = 'block';
            bloque3.style.display = 'block';
            bloque4.style.display = 'block';
            bloque5.style.display = 'block';
            bloque6.style.display = 'block';
            bloque7.style.display = 'block';
            bloque8.style.display = 'block';
            bloque9.style.display = 'none';
            if(bloque10 != null){
                bloque10.style.display = 'none';
                bloque11.style.display = 'none';
                bloque12.style.display = 'none';
            }
            
        }else if(opcionSelect.value === 't'){
            bloque1.style.display = 'none';
            bloque2.style.display = 'none';
            bloque3.style.display = 'block';
            bloque4.style.display = 'block';
            bloque5.style.display = 'block';
            bloque6.style.display = 'none';
            bloque7.style.display = 'block';
            bloque8.style.display = 'block';
            bloque9.style.display = 'none';
            if(bloque10 != null){
                bloque10.style.display = 'block';
                bloque11.style.display = 'block';
                bloque12.style.display = 'block';
            }
        }
    });
});