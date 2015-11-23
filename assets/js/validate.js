function isHN(index,myfield,e) 
{
    var keychar,key;     
    var s = $('#'+index).val();
    var l = s.length;
    var p = s.indexOf('/');
    var front=5,back=2;
    var c = $('#'+index).caret();

         if (window.event) key = window.event.keyCode; 
    else if (e) key = e.which; 
    else return true;
    keychar = String.fromCharCode(key);

    if ((key==null) || (key==0) || (key==8) || (key==9) || (key==13) || (key==27) ) return true;  
    if(p == -1)
    {
        if (("0123456789").indexOf(keychar) > -1) 
        {
                 if(l < front)return true;
            else return false;
        }
        if (keychar=='/' && c<=front && l-c<=back)return true; 
    }
    else if(p > -1)
    {
        if (("0123456789").indexOf(keychar) > -1) 
        {
            if(c>p){if(l-p-1 < back)return true;else return false;}
            else {if(p < front)return true;else return false;}
        }
    }
    return false;
}


function isDouble(index,myfield,e,front,back) 
{
    var keychar,key;     
    var s = $('#'+index).val();
    var l = s.length;
    var p = s.indexOf('.');
    var c = $('#'+index).caret();

         if (window.event) key = window.event.keyCode; 
    else if (e) key = e.which; 
    else return true;
    keychar = String.fromCharCode(key);

    if ((key==null) || (key==0) || (key==8) || (key==9) || (key==13) || (key==27) ) return true;  
    if(p == -1)
    {
        if (("0123456789").indexOf(keychar) > -1) 
        {
                 if(l < front)return true;
            else return false;
        }
        if (keychar=='.' && c<=front && l-c<=back)return true; 
    }
    else if(p > -1)
    {
        if (("0123456789").indexOf(keychar) > -1) 
        {
            if(c>p){if(l-p-1 < back)return true;else return false;}
            else {if(p < front)return true;else return false;}
        }
    }
    return false;
}


function isInt(index,myfield,e,length) 
{ 
    var keychar,key;     
    var s = $('#'+index).val();
    var l = s.length;

         if (window.event) key = window.event.keyCode; 
    else if (e) key = e.which; 
    else return true;
    keychar = String.fromCharCode(key);

    if ((key==null) || (key==0) || (key==8) || (key==9) || (key==13) || (key==27) ) return true;  
    if (("0123456789").indexOf(keychar) > -1) 
    {
        if(l < length)return true;
        else return false;
    }
    return false; 
}


function showAllergicDrugs(e)
{  $.ajax({ url: 'http://localhost/OPDSystem/apps/app/Http/Controllers/nurse/getAllergicDrug.php',
            type: "post",
            data: {HN : $('#HN').val()},
            success: function(data)
            {
                $('#oldAllergicDrugs').html("ยาที่ผู้ป่วยแพ้" + '   <font color="red">'+data+'</font>');
            }
        });
}