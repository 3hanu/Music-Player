inputs = document.querySelectorAll('input');
var input_arr;
inputs.forEach(element => {
    element.addEventListener('input',function(){
        check_inputs()
    });
});

function check_inputs(){
    if(!inputs[0].value =="" && !inputs[1].value==""){
        document.querySelector('button').disabled = false;
    }
    else{
        document.querySelector('button').disabled = true;
    }
}

check_inputs();
