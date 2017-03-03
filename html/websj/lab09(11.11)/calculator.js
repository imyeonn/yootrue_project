"use strict"
window.onload = function () {
    var stack = [];
    var expression ="0";
    var displayVal = "0";
    for (var i in $$('button')) {
        $$('button')[i].onclick = function () {
            var value = this.innerHTML;
            var re= new RegExp("[0-9]");
            var re2= new RegExp("[\*\/\^]");
            var re3= new RegExp("[\+\-]");

            if(value=="AC"){
                displayVal="0";
                expression="0";
                stack=[];
            }
            else if(re.test(value)){
                if(displayVal=="0"){
                    displayVal=value;
                }
                else{
                    displayVal+=value;
                }
            }
            else if(value=="."){
                if(displayVal.indexOf(".")==-1){
                    displayVal+=value;
                }
            }
            else{
                if(re2.test(value)){
                    var op=stack.pop();
                    stack.push(op);
                    if(re2.test(op)){
                        var cal=highPriorityCalculator(stack,displayVal);
                        stack.push(cal);
                        stack.push(value);
                    }
                    else{
                        stack.push(parseFloat(displayVal));
                        stack.push(value);
                    }
                    if(expression=="0"){
                        expression=displayVal;
                    }
                    else{
                        expression+=displayVal;
                    }
                    expression+=value;

                    displayVal="0";
                    //highPriorityCalculator(stack);
                }
                else if(re3.test(value)){

                    stack.push(parseFloat(displayVal));
                    stack.push(value);
                    if(expression=="0"){
                        expression=displayVal;
                    }
                    else{
                        expression+=displayVal;
                    }
                    expression+=value;
                    displayVal="0";
                }
            }
            var i=0;
            for(i=0;i<stack.length;i++){
                alert(stack[i]);
            }
            document.getElementById('result').innerHTML=displayVal;
            document.getElementById('expression').innerHTML=expression;
        };
    }
};
function factorial (x) {

}
function highPriorityCalculator(s, val) {
    var op=s.pop();
    var opd1=s.pop();
    var result;
    if (op=="*"){
        result=opd1 * val;
    }
    else if (op=="/"){
        result=opd1 / val;
    }
    else if (op=="^"){
        result=opd1^val;
    }
    return result;

}
function calculator(s) {
    var result = 0;
    var operator = "+";
    for (var i=0; i< s.length; i++) {
        
    }
    return result;
}
