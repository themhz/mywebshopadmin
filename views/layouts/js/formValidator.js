//Κλάση για έλεγχο πεδίων
class FrormValidator{
    //φορτώνω τα πεδία σε ένα πίνακα από json αντικείμενα ώστε να τα ελέγξω μετά
    //το format είναι {id:value, type:value, required:value}
    //το id to χρησιμοποιώ για να πάρω το πεδίο. Ανάλογα με το type γίνεται και ο αντίστοιχος έλεγχος και επίσης με το required. Δηλαδή αν χρειάζεται η όχι.
    constructor(fields){ 
        this.fields = fields;
        //console.log(this.fields);
    }

    validate(){
        
        var errorFields = {};
        for(var i=0;i<this.fields.length;i++){

            switch(this.fields[i].type) {
                case "textbox":
                    if(this.fields[i].required && (document.getElementById(this.fields[i].id).value == "" || this.checkLength(this.fields[i]))){
                        document.getElementById(this.fields[i].id).style = "background-color:red";
                        errorFields[this.fields[i].id] = this.fields[i].id + " is required";
                    }else{
                        document.getElementById(this.fields[i].id).style = "background-color:none;";
                    }
                    break;
                case "password":                    
                    if(this.fields[i].required && (document.getElementById(this.fields[i].id).value == "" || this.checkLength(this.fields[i]))){
                        document.getElementById(this.fields[i].id).style = "background-color:red";
                        errorFields[this.fields[i].id] = this.fields[i].id + " is required";
                    }else{
                        document.getElementById(this.fields[i].id).style = "background-color:none;";
                        
                    }
                    break;
                case "textarea":
                    if(this.fields[i].required && (document.getElementById(this.fields[i].id).value == "" || this.checkLength(this.fields[i]))){
                        document.getElementById(this.fields[i].id).style = "background-color:red";
                        errorFields[this.fields[i].id] = this.fields[i].id + " is required";
                    }else{
                        document.getElementById(this.fields[i].id).style = "background-color:none;";
                    }
                    break;
                case "date":
                    if(this.fields[i].required && (document.getElementById(this.fields[i].id).value == "" || this.checkLength(this.fields[i]))){
                        document.getElementById(this.fields[i].id).style = "background-color:red";
                        errorFields[this.fields[i].id] = this.fields[i].id + " is required";
                    }else{
                        document.getElementById(this.fields[i].id).style = "background-color:none;";
                    }
                    break;
                case "datetime":
                    // code block
                    break;
                case "time":
                    // code block
                    break;
                case "image":
                    // code block
                    break;
                case "label":
                    // code block
                    break;
                case "checkbox":
                    // code block
                    break;
                case "multicheckbox":
                    // code block
                    break;
                case "select":
                    if(this.fields[i].required && (document.getElementById(this.fields[i].id).value == "" || this.checkLength(this.fields[i]))){
                        document.getElementById(this.fields[i].id).style = "background-color:red";
                        errorFields[this.fields[i].id] = this.fields[i].id + " is required";
                    }else{                        
                        document.getElementById(this.fields[i].id).style = "background-color:none;";
                    }
                    break;
                case "multiselect":                    
                    break;
                case "email":
                    if(this.fields[i].required && (!this.isemail(document.getElementById(this.fields[i].id).value) || this.checkLength(this.fields[i]))){
                        document.getElementById(this.fields[i].id).style = "background-color:red";
                        errorFields[this.fields[i].id] = this.fields[i].id + " is required";
                    }else{                        
                        document.getElementById(this.fields[i].id).style = "background-color:none;";
                    }

                    break;
                case "phone":
                    if (this.fields[i].required && !this.isphonenumber(document.getElementById(this.fields[i].id).value)) {
                        errorFields[this.fields[i].id] = { result: "error" };
                        document.getElementById(this.fields[i].id).style = "background-color:red";
                    } else if (!this.fields[i].required && !this.isempty(document.getElementById(this.fields[i].id).value) && !this.isphonenumber(document.getElementById(this.fields[i].id).value)) {
                        errorFields[this.fields[i].id] = { result: "error" };
                        document.getElementById(this.fields[i].id).style = "background-color:red";
                    }else {
                        document.getElementById(this.fields[i].id).style = "background-color:white";                        
                    }
                    break;         
                default:
                  // code block
              }
        }

        var canSubmit = true;
        //console.log(Object.keys(errorFields).length);
        if(Object.keys(errorFields).length>0){
            canSubmit = false;
        }
        return {canSubmit : canSubmit, fields : errorFields};
    }

    isemail(x) {
        const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

        if (re.test(String(x).toLowerCase())) {
            return true;
        }

        return false;
    }

    checkLength(x){
        
        if(x.hasOwnProperty('size')){
            
            //alert(x.size.test)
            //alert(document.getElementById(x.id).value.length)
            var xsizetest = x.size.test;
            var xsizelen = parseInt(x.size.len);
            var valuelength = document.getElementById(x.id).value.length;

            //alert(xsizelen + xsizetest + valuelength)
            switch(xsizetest){
                case ">":                    
                    if(xsizelen>valuelength){
                        return false;
                    }
                    break;
                case "<":                    
                    if(xsizelen<valuelength){
                        return false;
                    }
                    break;
                case "=":                    
                    if(xsizelen==valuelength){                        
                        return false;
                    }
                    break;
                case ">=":
                if(xsizelen>=valuelength){
                    return false;
                }
                    break;
                case "<=":
                if(xsizelen<=valuelength){
                    return false;
                }
                    break;
                default:                    
                    return true;
            }

            return true;
        }else{
            return false;
        }
    }

    isphonenumber(x) {           
        
        var numbers = /^[0-9]+$/;
        if (x.match(numbers) && x.length=="10") {            
            return true;
        }

        return false;

    }

    isempty(x) {

        if (x.replace(/\s/g, "").length == 0) {
            return true;
        }

        return false;
    }
}